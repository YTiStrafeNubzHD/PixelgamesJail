<?php

namespace Authors\PixelgamesJail\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use Authors\PixelgamesJail\base\BaseCommand;

class JailMenuInfoCommand extends BaseCommand
{
    public function onCommand(CommandSender $issuer, Command $cmd, string $label, array $args): bool {
        if ($cmd->getName() === "jail-info") {
            $issuer->sendMessage("§e-------------------------------------");
            $issuer->sendMessage("§ePlugin von hoyinm14mc, iStrafeNubzHDyt");
            $issuer->sendMessage("§bName: PixelgamesJail");
            $issuer->sendMessage("§bOriginal: Jail");
            $issuer->sendMessage("§bVersion: 2.0.1#");
            $issuer->sendMessage("§bFür PocketMine-API: 3.0.0, 4.0.0");
            $issuer->sendMessage("§6Permissions: pgjail.override.restrictions, pgjail.command.setjail, pgjail.command.deljail, pgjail.command.jails, pgjail.command.jail, pgjail.command.unjail, pgjail.command.jailed, pgjail.command.switchjail, pgjail.command.jailtp, pgjail.command.bail, pgjail.command.jailmine, pgjail.command.votejail, pgjail.uuidcheck.bypass, pgjail.sign.destroy, pgjail.sign.create, pgjail.sign.use, pgjail.modify.bypass, pgjail.command.jailsellhand, pgjail.command.jailresetmine, pgjail.command.jailinfo, pgjail.command.prisonerinfo, pgjail.showInOutMessage, pgjail.visit.bypass, pgjail.command.jail.info, pgjail.command.jail.help");
            $issuer->sendMessage("§eSpeziell für PIXELGAMES entwickelt");
            $issuer->sendMessage("§e-------------------------------------");
            return true;
        }
    }
}
