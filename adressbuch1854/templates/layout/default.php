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
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $description ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('favicon.jpg', '../../webroot/favicon.jpg', ['type' => 'icon']) ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->css('addr.general.css') ?>
</head>
<body>
	<header>
        <div class="wrapper-item">
			<!-- todo: Link ändern -->
            <a id="title-logo" href="../Pages">Adressbuch der Deutschen in Paris von 1854</a>
        </div>
		<div class="wrapper-item search form" id="simp-search">
			<?= $this->Form->create(null, ['type' => 'get', 'url' => '/search/results']) ?>
			<fieldset class="simp-search-item">
				<?php
					// set parameter for search type to "simple"
					echo $this->Form->hidden('type', ['value' => 'simp']);
					echo $this->Form->control('text', ['maxlength' => 256, 'label' => false, 'placeholder' => __('Freitextsuche')]);
				?>
			</fieldset>
			<?= $this->Form->button(__('Los'), ['class' => 'simp-search-item']) ?>
			<?= $this->Form->end() ?>
			<!--Hinweis: Die Freitextsuche sucht nach den Feldern (Nach)Name, Vorname, Berufsbezeichnung,
			Anmerkungen zur Person/zum Unternehmen, alter und neuer Straßenname sowie Anmerkungen zur Adresse.
			Für genauere Abfragen nutzen Sie bitte die erweiterte Suche.-->
		</div>
	</header>
    <nav class="top-nav">
		<?= $this->Html->link(__('Suche'), ['controller' => 'Search', 'action' => 'query'], ['class' => 'top-nav-item']) ?>
		<?= $this->Html->link(__('Das Adressbuch'), ['controller' => 'Pages', 'action' => 'addressbook'], ['class' => 'top-nav-item']) ?>
		<?= $this->Html->link(__('Das Projekt'), ['controller' => 'Pages', 'action' => 'project'], ['class' => 'top-nav-item']) ?>
		<?= $this->Html->link(__('Links und Publikationen'), ['controller' => 'Pages', 'action' => 'publications'], ['class' => 'top-nav-item']) ?>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
		<a target="_blank" href="https://www.dhi-paris.fr/">
			<img class='wrapper-item' id="dhi-logo" src="../../webroot/img/logo-dhi.png" alt="Logo DHIP" width="75" height="37" />
		</a>
		<?= $this->Html->link(__('Impressum'), ['controller' => 'Pages', 'action' => 'credits'], ['class' => 'wrapper-item', 'id' => 'credits']) ?>		
    </footer>
</body>
</html>
