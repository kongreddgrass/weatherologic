<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class RetrieveDataComponent extends Component
{
    // übergebene Variablen: von, bis, Zeitraum(Day, Week, Month, Year), Gruppierung (Minute, Stunde, Tag), Zeitformatierung, Limit

    //ToDo:
    // - von
    // - bis
    // - Zeitraum(Day, Week, Month, Year)
    // Gruppierung (Minute, Stunde, Tag)
    // Zeitformatierung
    // Limit

    public function getData($RDfrom, $RDuntil, $RDtime, $RDgroup, $RDformat, $RDlimit = null)
    {
      if (!empty($RDfrom) && !empty($RDuntil)) {
        $RDuntil    = strtotime($RDuntil);
        $newRDuntil = $RDuntil + (3600*24);
        $RDuntil    = date("Y-m-d H:i:s", $newRDuntil);
      } else
      if (!empty($RDtime)) {
        $RDuntil    = date('Y-m-d H:i:s');
        $RDfrom     = date('Y-m-d H:i:s', strtotime($RDuntil . $RDtime));
      }

      $t_messwerte = TableRegistry::get('Messwerte');
      $verlauf = $t_messwerte->find();
      $verlauf = $verlauf
      ->select(['maxtemp' => $verlauf->func()->max('temperatur_1')])
      ->select(['stamp' => $verlauf->func()->max('timestamp')])
      ->select(['maxbar' => $verlauf->func()->max('luftdruck_2')])
      ->select(['maxhum' => $verlauf->func()->max('luftfeuchtigkeit_1')])

      ->where(function ($exp, $q) use($RDfrom,$RDuntil) {
        if (!empty($RDfrom) && !empty($RDuntil)) {
          return $exp->between('timestamp', $RDfrom, $RDuntil);
        }
      })

      ->group(['week(timestamp)'])
      ->group([$RDgroup.'(timestamp)'])

      ->order('id', 'timestamp')

      ->limit($RDlimit)
      ->toArray();

      // $verlauf_reverse = array_reverse($verlauf);
      // $verlauf = $verlauf_reverse;

      $verlauf_humidity = array();
      $verlauf_temp = array();
      $verlauf_bars = array();
      $verlauf_tage = array();

      foreach ($verlauf as $jeder_tag) {
        $verlauf_humidity[] = $jeder_tag->maxhum;
        $verlauf_bars[] = $jeder_tag->maxbar;
        $verlauf_temp[] = $jeder_tag->maxtemp;
        $verlauf_tage[] = '"'.date($RDformat, strtotime($jeder_tag->stamp)).'"';
      }

      $verlauf_humidity = implode(', ', $verlauf_humidity);
      $verlauf_temp = implode(', ', $verlauf_temp);
      $verlauf_bars = implode(', ', $verlauf_bars);
      $verlauf_tage = implode(', ', $verlauf_tage);
      return array($verlauf_humidity, $verlauf_temp, $verlauf_bars, $verlauf_tage);
    }
}
