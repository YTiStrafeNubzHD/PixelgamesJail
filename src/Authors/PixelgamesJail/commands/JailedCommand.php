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

namespace Authors\PixelgamesJail\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use Authors\PixelgamesJail\Jail;
use Authors\PixelgamesJail\base\BaseCommand;

class JailedCommand extends BaseCommand
{
    public function onCommand(CommandSender $issuer, Command $cmd, string $label, array $args): bool
    {
        switch (strtolower($cmd->getName())) {
            case "jailed":
                
                if ($issuer->hasPermission("jail.command.jailed") !== true) {
                    $issuer->sendMessage($this->getPlugin()->getMessage("no.permission"));
                    return true;
                }

                $issuer->sendMessage(str_replace("%prisoners%", $this->getPlugin()->jailedToString(), $this->getPlugin()->getMessage("jailed.listing")));
                return true;
                break;
        }
        return false;
    }
}
