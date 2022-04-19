<?php
/*
Homepage
*/

?>
<div class="container">
<div class='background'>
        <br>
        <div class='header2'>
                <div class="wrapper-item search form" id="simp-search" style="display: flex; justify-content:center; align-items: center;">
                <?= $this->Form->create(null, ['type' => 'get', 'url' => '/search/results']) ?>
                <?php
                // Set parameter for search type to "simple"
                echo $this->Form->hidden('type', ['value' => 'simp']);
                echo $this->Form->control('text', ['maxlength' => 256, 'label' => false, 'placeholder   ' => __('Freitextsuche')]);?>
                <?= $this->Form->button(__('Los'), ['class' => 'simp-search-item']) ?>
                <?= $this->Form->end() ?>
                <?= $this->Html->link(__('Erweitert'), ['controller'=>'Search', 'action'=>'query']) ?>
                </div>  
                <h1 style="display: flex; justify-content:center; color:#606c76;"><?= __('Adressbuch der Deutschen in Paris von 1854') ?></h1>           
                <p style='text-align: center;'><?= __('Die Datenbank basiert auf einem gedruckten Buch, das deutsche Kaufleute, Unternehmer, Handwerker und andere Selbständige verzeichnet, die 1854 in Paris und den angrenzenden Vororten ansässig waren.')?></p>
        </div>
        <div class="header3">
                <div class="divhome">
                <h3 style="padding-left:16px"><?= __('Interaktive Karte') ?></h3>
                <p style="padding-left: 16px"> <?= __('Besuchen Sie die Karte, um die Daten zu sehen'); ?><br>
                <?= $this->Html->link(__('Weiterlesen...'), ['controller'=>'Pages', 'action'=>'karte']); ?></p>
                </div>

                <div class="divhome">
                <h3 style="padding-left:16px"><?= __('Zeige alle') ?></h3>
                <?= $this->Html->link(__('Personen'), ['controller'=> 'Persons', 'action'=>'index'],['class'=>'button2']) ?><br>
                <?= $this->Html->link(__('Unternehmen'), ['controller'=>'Companies', 'action'=>'index'],['class'=>'button2'])?><br>
                <?= $this->Html->link(__('Straßen'), ['controller'=>'Streets', 'action'=>'index'],['class'=>'button2'])?><br>
                <?= $this->Html->link(__('Arrondissements'), ['controller'=>'Arrondissements', 'action'=>'index'],['class'=>'button2']) ?>
                </div>
                <div class="divhome">
         
                <h3 style="padding-left: 16px;"><?= __('Export') ?></h3>
                <?= $this->Html->link('JSON', ['controller' => 'App', 'action' => 'export', '?' => ['exportAll' => 'json']], ['class'=>'button2'])?><br>
                <?= $this->Html->link('XML', ['controller' => 'App', 'action' => 'export', '?' => ['exportAll' => 'xml']],['class'=>'button2'])?><br>
                <?= $this->Html->link('CSV', ['controller' => 'App', 'action' => 'export', '?' => ['exportAll' => 'csv']],['class'=>'button2'])?><br>
                <?= $this->Html->link('SQL', ['controller' => 'App', 'action' => 'export', '?' => ['exportAll' => 'sql']],['class'=>'button2'])?>
                </div>
             
              </div>
       
        <div class='divhome'>
        <?php 

        echo "<h3 style='padding-left:16px;'><a target='blank' href='/persons/view/".rand(1,4772)."'>Serendipity-Suche</a></h3><p>Zufällige Anzeige einer Person</p>";
?>
        </div>


      
</div>
</div>