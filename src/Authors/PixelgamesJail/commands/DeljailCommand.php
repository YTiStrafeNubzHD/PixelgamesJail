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

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use Authors\PixelgamesJail\base\BaseCommand;

class DeljailCommand extends BaseCommand
{
    public function onCommand(CommandSender $issuer, Command $cmd, string $label, array $args): bool
    {
        switch (strtolower($cmd->getName())) {
            case "deljail":

                if (isset($args[0]) !== true) {
                    return false;
                }

                if ($issuer->hasPermission("jail.command.deljail") !== true) {
                    $issuer->sendMessage($this->getPlugin()->getMessage("no.permission"));
                    return true;
                }

                if ($this->getPlugin()->jailExists($args[0]) !== true) {
                    $issuer->sendMessage($this->getPlugin()->getMessage("jail.not.exist"));
                    return true;
                }

                if ($this->getPlugin()->delJail($args[0]) !== false) {
                    $issuer->sendMessage($this->getPlugin()->getMessage("deljail.success"));
                    return true;
                }
                break;
        }
    }
}
