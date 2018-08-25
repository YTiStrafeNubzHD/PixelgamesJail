<?php

/*
 * This file is a part of Jail.
 * Copyright (C) 2017 hoyinm14mc
 *
 * Jail is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jail is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jail. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Authors\PixelgamesJail\tasks\updater;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use pocketmine\utils\Utils;

use Authors\PixelgamesJail\Jail;

class AsyncUpdateChecker extends AsyncTask
{
    private $channel;

    
    public function __construct($complexData = null, string $channel)
    {
        $this->channel = $channel;
    }


    public function onRun()
    {

        $arr = [];
        
        //Github Channel
        $git_iden = json_decode(Utils::getURL("https://api.github.com/repos/gordonmhy/Jail/releases"), true);
        $git_iden_latest = $git_iden[0];

        //Poggit Channel
        $serverApi = \pocketmine\API_VERSION;
        list(, $headerGroups, $httpCode) = Utils::simpleCurl("https://poggit.pmmp.io/get/Jail?api=$serverApi&prerelease", 10, [], [
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_NOBODY => true
        ]);

        if ($httpCode != 302) {
            return;
        }
        foreach ($headerGroups as $headers) {
            foreach ($headers as $name => $value) {
                if ($name === "x-poggit-resolved-version") {
                    $arr["poggit_ver"] = $value;
                }
            }
        }

        if (!isset($arr["poggit_ver"])) {
            throw new \Exception("API Error");
        }
        $arr["github_ver"] = $git_iden_latest["tag_name"];
        $arr["github_desc"] = $git_iden_latest["body"];
        $key = 0;

        while ($git_iden[$key]["tag_name"] != $arr["poggit_ver"]) {
            $key++;
        }

        $arr["poggit_desc"] = $git_iden[$key]["body"];
        $arr["github_dllink"] = "https://github.com/gordonmhy/Jail/releases/tag/" . $git_iden_latest["tag_name"];
        $arr["poggit_dllink"] = "https://poggit.pmmp.io/p/Jail/" . $git_iden[$key]["tag_name"];
        $this->setResult($arr);
    }


    public function onCompletion(Server $server)
    {

        $plugin = Jail::getInstance();

        switch ($this->channel) {
            case "poggit":

                $plugin->getLogger()->info($plugin->colorMessage("§d>>>>> §fKanal: §3Poggit §d<<<<<"));
                $no_update = true;

                if (version_compare($this->getResult()["poggit_ver"], $plugin->getDescription()->getVersion(), ">") !== false) {
                    $plugin->getLogger()->info($plugin->colorMessage("§aDeine Version ist §cveraltet§a! \n§fAktuelle Version: §e" . $this->getResult()["poggit_ver"]));
                    $plugin->getLogger()->info("\nUpdate-Details für v" . $this->getResult()["poggit_desc"] . "\nDownloadlink: " . $this->getResult()["poggit_dllink"]);
                    $no_update = false;
                }

                if ($no_update !== false) {
                    $plugin->getLogger()->info($plugin->colorMessage("§aDu besitzt die §caktuellste §aVersion von Jail."));
                }

                $plugin->getLogger()->info($plugin->colorMessage("§6-------------------------------"));
                break;

            case "github":

                $plugin->getLogger()->info($plugin->colorMessage("§d>>>>> §fKanal: §3Github §d<<<<<"));
                $no_update = true;

                if (version_compare($this->getResult()["github_ver"], $plugin->getDescription()->getVersion(), ">") !== false) {
                    $plugin->getLogger()->info($plugin->colorMessage("§aDeine Version ist §cveraltet§a! \n§fAktuelle Version: §e" . $this->getResult()["github_ver"]));
                    $plugin->getLogger()->info("\nUpdate-Details für v" . $this->getResult()["github_desc"] . "\nDownloadlink: " . $this->getResult()["github_dllink"]);
                    $no_update = false;
                }

                if ($no_update !== false) {
                    $plugin->getLogger()->info($plugin->colorMessage("§aDu besitzt die §caktuellste §aVersion von Jail."));
                }

                $plugin->getLogger()->info($plugin->colorMessage("§6-------------------------------"));
                break;

            default:
                
                $plugin->getLogger()->info($plugin->colorMessage("§4Nicht identifizierbarer Kanal. Bitte die Einstellung in der Config überprüfen."));
                $server->getScheduler()->cancelTask($this->getTaskId());
        }
    }
}
