<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$description = 'Adressbuch 1854';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>
        <?= $description ?>:
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

	<!-- Cake's css -->
    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>

	<!-- own css -->
    <?= $this->Html->css('style.css') ?>

	<!-- Leaflet css -->
	<?= $this->Html->css('https://unpkg.com/leaflet@1.6.0/dist/leaflet.css', ['integrity' => 'sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==', 'crossorigin' => '']);?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.0/MarkerCluster.Default.css'); ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.0/MarkerCluster.css'); ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.0/MarkerCluster.Default.min.css'); ?>

	<!-- JQuery script -->
	<?= $this->Html->script('https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js'); ?>

	<!-- Leaflet script -->
	<?= $this->Html->script('https://unpkg.com/leaflet@1.6.0/dist/leaflet.js', ['integrity' => 'sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==', 'crossorigin' => '']); ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier-Leaflet/0.2.6/oms.min.js'); ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.0/leaflet.markercluster-src.js'); ?>

	<!-- fetched meta -->
	<?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	<header>
        <div class="wrapper-item">
            <h1>
			    <?= $this->Html->link('Adressbuch der Deutschen in Paris von 1854', ['controller' => 'Pages', 'action' => 'home', 'id' => 'title-logo'])?>
            </h1>
        </div>
		<div class="wrapper-item search form" id="simp-search">
			<?= $this->Form->create(null, ['type' => 'get', 'url' => '/search/results']) ?>
			<?php
                // Set parameter for search type to "simple"
                echo $this->Form->hidden('type', ['value' => 'simp']);
                echo $this->Form->control('text', ['maxlength' => 256, 'label' => false, 'placeholder' => __('Freitextsuche')]);
            ?>
			<?= $this->Form->button(__('Los'), ['class' => 'simp-search-item']) ?>
			<?= $this->Form->end() ?>
		</div>
	</header>
    <nav class="top-nav">
		<?= $this->Html->link(__('Suche'), ['controller' => 'Search', 'action' => 'query'], ['class' => 'top-nav-item']) ?>
		<?= $this->Html->link(__('Das Adressbuch'), ['controller' => 'Pages', 'action' => 'addressbook'], ['class' => 'top-nav-item']) ?>
		<?= $this->Html->link(__('Das Projekt'), ['controller' => 'Pages', 'action' => 'project'], ['class' => 'top-nav-item']) ?>
		<?= $this->Html->link(__('Links und Publikationen'), ['controller' => 'Pages', 'action' => 'publications'], ['class' => 'top-nav-item']) ?>
        <?= $this->Html->link(__('Partner und Team'), ['controller'=>'Pages', 'action'=>'partners'], ['class'=>'top-nav-item']) ?>

    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
		<a target="_blank" href="https://www.dhi-paris.fr/">
			<?=$this->Html->image('logo.png', ['class' => 'wrapper-item', 'id' => 'dhi-logo', 'alt' => 'Logo DHIP', 'width' => '100px'])?>
		</a>
		<?= $this->Html->link(__('Impressum'), ['controller' => 'Pages', 'action' => 'credits'], ['class' => 'wrapper-item', 'id' => 'credits']) ?>
    </footer>
</body>
</html>
