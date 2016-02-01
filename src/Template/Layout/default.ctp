<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?php echo $this->Html->script('Chart'); ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <section class="top-bar-section">
          <ul class="left">
              <li><?= $this->Html->link('Dashboard', ['controller' => 'wetter', 'action' => 'index', '_full' => true]); ?></li>
              <li><?= $this->Html->link('Tagesverlauf', ['controller' => 'wetter', 'action' => 'tagesverlauf', '_full' => true]); ?></li>
              <li><?= $this->Html->link('Wochenverlauf', ['controller' => 'wetter', 'action' => 'wochenverlauf', '_full' => true]); ?></li>
              <li><?= $this->Html->link('Monatsverlauf', ['controller' => 'wetter', 'action' => 'monatsverlauf', '_full' => true]); ?></li>
              <li><?= $this->Html->link('Jahresverlauf', ['controller' => 'wetter', 'action' => 'jahresverlauf', '_full' => true]); ?></li>
              <li><?= $this->Html->link('Historie', ['controller' => 'wetter', 'action' => 'historie', '_full' => true]); ?></li>
          </ul>
            <ul class="right">
                <li><a target="_blank" href="http://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="http://api.cakephp.org/3.0/">API</a>
                <li><a>Es ist gerade <?= date('H:i:s', time()) ?> (<?= date_default_timezone_get() ?>)</a></></li>
            </ul>
        </section>

    </nav>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
    </footer>
</body>
</html>
