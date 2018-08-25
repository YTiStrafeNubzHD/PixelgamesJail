<?php

namespace Authors\PixelgamesJail\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use Authors\PixelgamesJail\base\BaseCommand;

class Jail_HelpCommand extends BaseCommand
{
    public function onCommand(CommandSender $issuer, Command $cmd, string $label, array $args): bool {
        if ($cmd->getName() === "jail-help") {
            $issuer->sendMessage("§9---§aJail-Plugin§9---");
            $issuer->sendMessage("§a/jail <Spieler> <Gefängnisname> <Zeit in Min.|-i> <Grund..> §b-> Sperrt einen Spieler ein (-i steht für infinite = unendlich)");
            $issuer->sendMessage("§a/jails §b-> Zeigt eine Liste aller verfügbaren Gefängnisse §c[TEST]");
            $issuer->sendMessage("§a/setjail <Gefängnisname> [args...] §b-> Setzt ein Gefängnis §c[TEST]");
            $issuer->sendMessage("§a/deljail <Gefängnisname> §b-> Entfernt ein Gefängnis");
            $issuer->sendMessage("§a/unjail <Spieler> §b-> Befreit einen Spieler, der online oder offline ist §c[TEST]");
            $issuer->sendMessage("§a/jailed §b-> Zeigt einer Liste aller Gefangenen");
            $issuer->sendMessage("§a/switchjail <Spieler> <Gefängnisname> §b-> Verlegt einen Gefangenen in ein anderes Gefängnis §c[TEST]");
            $issuer->sendMessage("§a/tpjail <Gefängnisname> <Spieler> §b-> Teleportiert einen Spieler zu einem Gefängnis §c[TEST]");
            $issuer->sendMessage("§a/bail §b-> Kaufe dich für Geld aus dem Gefängnis frei §c[TEST] [BROKEN?]");
            $issuer->sendMessage("§a/votejail <Spieler> §b-> Votet einen Spieler in Gefängnis §c[TEST]");
            $issuer->sendMessage("§a/jailmine <reset|set|remove|check> <Gefängnisname(mine)> §b-> Einstellungen für Gefängnisminen §c[TEST]");
            $issuer->sendMessage("§a/jailsellhand §b-> Verkaufe deine gefarmten Erze, um Geld zu erhalten §c[TEST]");
            $issuer->sendMessage("§a/jailresetmine §b-> Resete deine Gefängnismine §c[TEST]");
            $issuer->sendMessage("§a/jailinfo <Gefängnisname> §b-> Zeigt Informationen über ein Gefängnis §c[TEST] [BROKEN?]");
            $issuer->sendMessage("§a/prisonerinfo <Spieler> §b-> Zeigt Informationen über einen Gefangenen §c[TEST]");
            $issuer->sendMessage("§6/jail-info §b-> Zeigt Details über das Plugin");
            $issuer->sendMessage("§6/jail-help §b-> Zeigt dieses Hilfemenü an");
            return true;
        }
    }
}