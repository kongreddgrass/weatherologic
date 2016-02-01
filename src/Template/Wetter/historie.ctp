<style type="text/css">
<!--

.paging li {
  display: inline-block;
  padding: 0px 9px;
  margin-right: 4px;
  border-radius: 3px;
  border: solid 1px #c0c0c0;
  background: #e9e9e9;
  box-shadow: inset 0px 1px 0px rgba(255,255,255, .8), 0px 1px 3px rgba(0,0,0, .1);
  font-size: .875em;
  font-weight: bold;
  text-decoration: none;
  color: #717171;
  text-shadow: 0px 1px 0px rgba(255,255,255, 1);
}

.paging li:hover {
  background: #fefefe;
  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FEFEFE), to(#f0f0f0));
  background: -moz-linear-gradient(0% 0% 270deg,#FEFEFE, #f0f0f0);
}

.paging li.active {
  border: none;
  background: #616161;
  box-shadow: inset 0px 0px 8px rgba(0,0,0, .5), 0px 1px 0px rgba(255,255,255, .8);
  color: #f0f0f0;
  text-shadow: 0px 0px 3px rgba(0,0,0, .5);
}

.paging.next {
  display: inline-block;
  padding: 0px 9px;
  margin-right: 4px;
  border-radius: 3px;
  border: solid 1px #c0c0c0;
  background: #e9e9e9;
  box-shadow: inset 0px 1px 0px rgba(255,255,255, .8), 0px 1px 3px rgba(0,0,0, .1);
  font-size: .875em;
  font-weight: bold;
  text-decoration: none;
  color: #717171;
  text-shadow: 0px 1px 0px rgba(255,255,255, 1);
}

.paging.next.disabled {
  border: none;
  background: #e9e9e9;
  box-shadow: inset 0px 0px 8px rgba(0,0,0, .5), 0px 1px 0px rgba(255,255,255, .8);
  color: #717171;
  text-shadow: 0px 0px 3px rgba(0,0,0, 1);
}

.paging.prev {
  display: inline-block;
  padding: 0px 9px;
  margin-right: 4px;
  border-radius: 3px;
  border: solid 1px #c0c0c0;
  background: #e9e9e9;
  box-shadow: inset 0px 1px 0px rgba(255,255,255, .8), 0px 1px 3px rgba(0,0,0, .1);
  font-size: .875em;
  font-weight: bold;
  text-decoration: none;
  color: #717171;
  text-shadow: 0px 1px 0px rgba(255,255,255, 1);
}

.paging.prev.disabled {
  border: none;
  background: #e9e9e9;
  box-shadow: inset 0px 0px 8px rgba(0,0,0, .5), 0px 1px 0px rgba(255,255,255, .8);
  color: #717171;
  text-shadow: 0px 0px 3px rgba(0,0,0, 1);
}

/* "Winter Blues" CSS theme for CSS Table Gallery (http://icant.co.uk/csstablegallery/) by Gunta Klavina (http://www.klavina.com) */

table {font: 85% "Lucida Grande", "Lucida Sans Unicode", "Trebuchet MS", sans-serif;padding: 0; margin: 0; border-collapse: collapse; color: #333; background: #F3F5F7;}

table a {color: #3A4856; text-decoration: none; border-bottom: 1px solid #C6C8CB;}

table a:visited {color: #777;}

table a:hover {color: #000;}

table caption {text-align: left; text-transform: uppercase;  padding-bottom: 10px; font: 200% "Lucida Grande", "Lucida Sans Unicode", "Trebuchet MS", sans-serif;}

table thead th {background: #3A4856; padding: 15px 10px; color: #fff; text-align: left; font-weight: normal;}

table tbody, table thead {border-left: 1px solid #EAECEE; border-right: 1px solid #EAECEE;}

table tbody {border-bottom: 1px solid #EAECEE;}

table tbody td, table tbody th {padding: 10px; background: url("td_back.gif") repeat-x; text-align: left;}

table tbody tr {background: #F3F5F7;}

table tbody tr.odd {background: #F0F2F4;}

table tbody  tr:hover {background: #EAECEE; color: #111;}

table tfoot td, table tfoot th, table tfoot tr {text-align: left; font: 120%  "Lucida Grande", "Lucida Sans Unicode", "Trebuchet MS", sans-serif; text-transform: uppercase; background: #fff; padding: 10px;}

-->
</style>

<br />

<div style="text-align: center; margin: 20px; padding: 10px;  background: #f5f5f5; border: 1px solid #FFF; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; box-shadow: 1px 2px 4px rgba(0,0,0,.4);">
  <div style="background-color: #FDFDEF; border: 1px solid #EBE9C5; border-radius: 4px; padding: 10px;">Die letzten Messwerte:<br /></div><br />
  <div id="wrapper" style="width: 1570px; display: block; margin-left: auto; margin-right: auto;">
    <div style="float:left;">
      Sortieren per Klick auf Spaltentitel
    </div>
    <div class="paging" style="float:right;">
        <?php
        echo $this->Paginator->first('< ' . __d('users', 'zum Anfang'), array('tag' => 'button'), null, array('tag' => 'button'));
        echo $this->Paginator->prev('< ' . __d('users', 'zurück'), array('tag' => 'button'), null, array('tag' => 'button'));
        echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-default', 'currentClass' => 'disabled', 'tag' => 'button'));
        echo $this->Paginator->next(__d('users', 'vor') . ' >', array('tag' => 'button'), null, array('tag' => 'button'));
        echo $this->Paginator->last(__d('users', 'zum Ende') . ' >', array('tag' => 'button'), null, array('tag' => 'button'));
        ?>
    </div>
    <div style="clear:both;"></div>
    <br />
    <table>
      <tr>
        <th><?php echo $this->Paginator->sort('timestamp'); ?></th>
        <th><?php echo $this->Paginator->sort('temperatur_1'); ?></th>
        <th><?php echo $this->Paginator->sort('temperatur_2'); ?></th>
        <th><?php echo $this->Paginator->sort('luftfeuchtigkeit_1'); ?></th>
        <th><?php echo $this->Paginator->sort('luftdruck_2'); ?></th>
      </tr>
    <?php foreach ($messwerte as $messwert): ?>
      <tr><td><?= $messwert->timestamp ?></td><td><?= $messwert->temperatur_1.' Grad' ?></td><td><?= $messwert->temperatur_2.' Grad' ?></td><td><?= $messwert->luftfeuchtigkeit_1.' %' ?></td><td><?= $messwert->luftdruck_2.' hPas'; ?></td></tr>
    <?php endforeach; ?>
    </table>
  <br />
  <div class="paging" style="float:right;">
      <?php
      echo $this->Paginator->first('< ' . __d('users', 'zum Anfang'), array('tag' => 'button'), null, array('tag' => 'button'));
      echo $this->Paginator->prev('< ' . __d('users', 'zurück'), array('tag' => 'button'), null, array('tag' => 'button'));
      echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-default', 'currentClass' => 'disabled', 'tag' => 'button'));
      echo $this->Paginator->next(__d('users', 'vor') . ' >', array('tag' => 'button'), null, array('tag' => 'button'));
      echo $this->Paginator->last(__d('users', 'zum Ende') . ' >', array('tag' => 'button'), null, array('tag' => 'button'));
      ?>
  </div>
  <div style="clear:both;"></div>
  <br />
  </div>

</div>





</div>
