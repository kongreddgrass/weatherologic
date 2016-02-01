<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;

class RetrieveShell extends Shell
{
    public function main()
    {
        // =======================================================
        // TODO: Skript wird alle 6 Minuten per Cron ausgeführt
        // =======================================================

        // Temperatur und Luftfeuchtigkeit auslesen
        $retrievetemp = shell_exec("sudo /data/wetterpi/lol_dht22/loldht 7");
        $retrievetemp = explode("=", $retrievetemp);
        $luftfeuchtigkeit_1 = substr($retrievetemp[1], 1, 5);
        $temperatur_1 = substr($retrievetemp[2], 1, 5);

        // Luftdruck und Temperatur 2 auslesen
        $retrievepressure = shell_exec("sudo /data/wetterpi/adafruit_raspi_py/Adafruit_BMP085/Adafruit_BMP085_example.py");
        $retrievepressure = explode(":", $retrievepressure);
        $temperatur_2 = substr($retrievepressure[1], 1, 5	);
        $luftdruck_2 = substr($retrievepressure[2], 4, 6);
        $hoehe_2 = substr($retrievepressure[3], 4, 6);

        echo "TMP1  | FEU1  | TMP2  | BAR2   | HOE2\n";
        echo $temperatur_1.'   '.$luftfeuchtigkeit_1.'   '.$temperatur_2.'   '.$luftdruck_2.'   '.$hoehe_2;
        echo "\n";

        $t_messwerte = TableRegistry::get('Messwerte');
        $messwerte = $t_messwerte->query();
        $messwerte->insert(['temperatur_1', 'temperatur_2', 'luftfeuchtigkeit_1', 'luftdruck_2', 'hoehe_2', 'timestamp'])
            ->values([
                'temperatur_1' => $temperatur_1,
                'temperatur_2' => $temperatur_2,
                'luftfeuchtigkeit_1' => $luftfeuchtigkeit_1,
                'luftdruck_2' => $luftdruck_2,
                'hoehe_2' => $hoehe_2,
                'timestamp' => date('Y-m-d, H:i:s', time())
            ])
            ->execute();
        echo date('Y-m-d, H:i:s', time())." | Messwerte wurden um in die Datenbank geschrieben\n";
    }

}
