<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Controller\Component\PaginatorComponent;
use Cake\View\Helper\PaginatorHelper;
use Cake\View\Helper\FlashHelper;
use Cake\Controller\Component\RetrieveDataComponent;

class WetterController extends AppController
{

  public $helpers = [
    'Paginator' => ['templates' => 'paginator-templates']
  ];

  public $paginate = [
    'limit' => 40,
    'order' => [
      'Messwerte.id' => 'desc'
    ]
  ];

  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('Paginator');
    $this->loadComponent('RetrieveData');
  }

  public function index()
  {
    // Zeitausgabe zur Kontrolle
    $this->set('zeitzone', date_default_timezone_get());
    $this->set('zeit', date('H:i:s'));

    // =========================================================================
    // Verlauf der letzten Stunden
    // =========================================================================

    // übergebene Variablen: von, bis, Zeitraum(Day, Week, Month, Year), Gruppierung (Minute, Stunde, Tag), Zeitformatierung, Limit
    $RDgetData = $this->RetrieveData->getData(null, null, '-1 day', 'hour', 'd,m G:i', '30');
    $this->set('verlauf_aktuell_humidity', $RDgetData[0]);
    $this->set('verlauf_aktuell_items', $RDgetData[1]);
    $this->set('verlauf_aktuell_bars', $RDgetData[2]);
    $this->set('verlauf_aktuell_tage', $RDgetData[3]);

    // =========================================================================

      // Wärmsten und kältesten Tag ermitteln
      $t_messwerte = TableRegistry::get('Messwerte');
      $waermster = $t_messwerte->find('all')->select(['temperatur_1', 'timestamp'])->order(['temperatur_1' => 'DESC'])->first();
      $this->set('waermster_time', $waermster->timestamp);
      $this->set('waermster_max', round($waermster->temperatur_1, 2));

      $kaeltester = $t_messwerte->find('all')->select(['temperatur_1', 'timestamp'])->order(['temperatur_1' => 'ASC'])->first();
      $this->set('kaeltester_time', $kaeltester->timestamp);
      $this->set('kaeltester_max', round($kaeltester->temperatur_1, 2));

      $this->Flash->success('Deine Flashnachrichten funktionieren mittlerweile auch :-)');

    }

    public function tagesverlauf()
    {
      // =========================================================================
      // Verlauf des Tages
      // =========================================================================
      $t_messwerte = TableRegistry::get('Messwerte');
      $verlauf_tag = $t_messwerte->find();
      $verlauf_tag = $verlauf_tag
      ->select(['maxtemp' => $verlauf_tag->func()->max('temperatur_1')])
      ->select(['stamp' => $verlauf_tag->func()->max('timestamp')])
      ->select(['maxbar' => $verlauf_tag->func()->max('luftdruck_2')])
      ->select(['maxhum' => $verlauf_tag->func()->max('luftfeuchtigkeit_1')])
      ->where(['timestamp >' => new \DateTime('-1 day')])
      ->group(['day(timestamp)'])
      ->group(['hour(timestamp)'])
      ->order(['id' => 'desc'])
      // ->limit(24)
      ->toArray();

      $verlauf_tag_reverse = array_reverse($verlauf_tag);
      $verlauf_tag = $verlauf_tag_reverse;


      $verlauf_tag_humidity = array();
      $verlauf_tag_items = array();
      $verlauf_tag_bars = array();
      $verlauf_tag_tage = array();

      foreach ($verlauf_tag as $jeder_tag) {
        $verlauf_tag_humidity[] = $jeder_tag->maxhum;
        $verlauf_tag_bars[] = $jeder_tag->maxbar;
        $verlauf_tag_items[] = $jeder_tag->maxtemp;
        $verlauf_tag_tage[] = '"'.date('G:i', strtotime(str_replace('-','/', $jeder_tag->stamp))).' Uhr'.'"';
      }

      $verlauf_tag_humidity_1 = implode(', ', $verlauf_tag_humidity);
      $verlauf_tag_items_1 = implode(', ', $verlauf_tag_items);
      $verlauf_tag_bars_1 = implode(', ', $verlauf_tag_bars);
      $verlauf_tag_tage_1 = implode(', ', $verlauf_tag_tage);
      $this->set('verlauf_tag_humidity', $verlauf_tag_humidity_1);
      $this->set('verlauf_tag_items', $verlauf_tag_items_1);
      $this->set('verlauf_tag_bars', $verlauf_tag_bars_1);
      $this->set('verlauf_tag_tage', $verlauf_tag_tage_1);
      // =========================================================================
    }

    public function wochenverlauf()
    {
      // =========================================================================
      // Verlauf in der Woche
      // =========================================================================
      $t_messwerte = TableRegistry::get('Messwerte');
      $verlauf_woche = $t_messwerte->find();
      $verlauf_woche = $verlauf_woche
      ->select(['maxtemp' => $verlauf_woche->func()->max('temperatur_1')])
      ->select(['stamp' => $verlauf_woche->func()->max('timestamp')])
      ->select(['maxbar' => $verlauf_woche->func()->max('luftdruck_2')])
      ->select(['maxhum' => $verlauf_woche->func()->max('luftfeuchtigkeit_1')])
      ->where(['timestamp >' => new \DateTime('-7 days')])
      ->group(['week(timestamp)'])
      ->group(['day(timestamp)'])
      ->order(['id' => 'desc'])
      // ->limit(7)
      ->toArray();

      $verlauf_woche_reverse = array_reverse($verlauf_woche);
      $verlauf_woche = $verlauf_woche_reverse;


      $verlauf_woche_humidity = array();
      $verlauf_woche_items = array();
      $verlauf_woche_bars = array();
      $verlauf_woche_tage = array();

      foreach ($verlauf_woche as $jeder_tag) {
        $verlauf_woche_humidity[] = $jeder_tag->maxhum;
        $verlauf_woche_bars[] = $jeder_tag->maxbar;
        $verlauf_woche_items[] = $jeder_tag->maxtemp;
        $verlauf_woche_tage[] = '"'.date('D, d.m', strtotime($jeder_tag->stamp)).'"';
      }

      $verlauf_woche_humidity_1 = implode(', ', $verlauf_woche_humidity);
      $verlauf_woche_items_1 = implode(', ', $verlauf_woche_items);
      $verlauf_woche_bars_1 = implode(', ', $verlauf_woche_bars);
      $verlauf_woche_tage_1 = implode(', ', $verlauf_woche_tage);
      $this->set('verlauf_woche_humidity', $verlauf_woche_humidity_1);
      $this->set('verlauf_woche_items', $verlauf_woche_items_1);
      $this->set('verlauf_woche_bars', $verlauf_woche_bars_1);
      $this->set('verlauf_woche_tage', $verlauf_woche_tage_1);
      // =========================================================================
    }

    public function monatsverlauf()
    {
      // =========================================================================
      // Verlauf im Monat
      // =========================================================================
      $t_messwerte = TableRegistry::get('Messwerte');
      $verlauf_monat = $t_messwerte->find();
      $verlauf_monat = $verlauf_monat
      ->select(['maxtemp' => $verlauf_monat->func()->max('temperatur_1')])
      ->select(['stamp' => $verlauf_monat->func()->max('timestamp')])
      ->select(['maxbar' => $verlauf_monat->func()->max('luftdruck_2')])
      ->select(['maxhum' => $verlauf_monat->func()->max('luftfeuchtigkeit_1')])
      ->where(['timestamp >' => new \DateTime('-1 month')])
      ->group(['month(timestamp)'])
      ->group(['day(timestamp)'])
      ->order('timestamp')
      // ->limit(31)
      ->toArray();

      // $verlauf_monat_reverse = array_reverse($verlauf_monat);
      // $verlauf_monat = $verlauf_monat_reverse;


      $verlauf_monat_humidity = array();
      $verlauf_monat_items = array();
      $verlauf_monat_bars = array();
      $verlauf_monat_tage = array();

      foreach ($verlauf_monat as $jeder_tag) {
        $verlauf_monat_humidity[] = $jeder_tag->maxhum;
        $verlauf_monat_bars[] = $jeder_tag->maxbar;
        $verlauf_monat_items[] = $jeder_tag->maxtemp;
        $verlauf_monat_tage[] = '"'.date('D, d.m', strtotime($jeder_tag->stamp)).'"';
      }

      $verlauf_monat_humidity_1 = implode(', ', $verlauf_monat_humidity);
      $verlauf_monat_items_1 = implode(', ', $verlauf_monat_items);
      $verlauf_monat_bars_1 = implode(', ', $verlauf_monat_bars);
      $verlauf_monat_tage_1 = implode(', ', $verlauf_monat_tage);
      $this->set('verlauf_monat_humidity', $verlauf_monat_humidity_1);
      $this->set('verlauf_monat_items', $verlauf_monat_items_1);
      $this->set('verlauf_monat_bars', $verlauf_monat_bars_1);
      $this->set('verlauf_monat_tage', $verlauf_monat_tage_1);
      // =========================================================================
    }

    public function jahresverlauf()
    {
      // =========================================================================
      // Verlauf im Jahr
      // =========================================================================
      $t_messwerte = TableRegistry::get('Messwerte');
      $verlauf_jahr = $t_messwerte->find();
      $verlauf_jahr = $verlauf_jahr
      ->select(['maxtemp' => $verlauf_jahr->func()->max('temperatur_1')])
      ->select(['stamp' => $verlauf_jahr->func()->max('timestamp')])
      ->select(['maxbar' => $verlauf_jahr->func()->max('luftdruck_2')])
      ->select(['maxhum' => $verlauf_jahr->func()->max('luftfeuchtigkeit_1')])
      ->where(['timestamp >' => new \DateTime('-1 year')])
      ->group(['month(timestamp)'])
      ->order('timestamp')
      // ->limit(12)
      ->toArray();

      // $verlauf_jahr_reverse = array_reverse($verlauf_jahr);
      // $verlauf_jahr = $verlauf_jahr_reverse;


      $verlauf_jahr_humidity = array();
      $verlauf_jahr_items = array();
      $verlauf_jahr_bars = array();
      $verlauf_jahr_tage = array();

      foreach ($verlauf_jahr as $jeder_tag) {
        $verlauf_jahr_humidity[] = $jeder_tag->maxhum;
        $verlauf_jahr_bars[] = $jeder_tag->maxbar;
        $verlauf_jahr_items[] = $jeder_tag->maxtemp;
        $verlauf_jahr_tage[] = '"'.date('M Y', strtotime($jeder_tag->stamp)).'"';
      }

      $verlauf_jahr_humidity_1 = implode(', ', $verlauf_jahr_humidity);
      $verlauf_jahr_items_1 = implode(', ', $verlauf_jahr_items);
      $verlauf_jahr_bars_1 = implode(', ', $verlauf_jahr_bars);
      $verlauf_jahr_tage_1 = implode(', ', $verlauf_jahr_tage);
      $this->set('verlauf_jahr_humidity', $verlauf_jahr_humidity_1);
      $this->set('verlauf_jahr_items', $verlauf_jahr_items_1);
      $this->set('verlauf_jahr_bars', $verlauf_jahr_bars_1);
      $this->set('verlauf_jahr_tage', $verlauf_jahr_tage_1);
      // =========================================================================
    }

    public function historie()
    {
      $t_messwerte = TableRegistry::get('Messwerte');
      $query = $t_messwerte->find('all');
      $this->set('messwerte', $this->paginate($query));
    }
  }
