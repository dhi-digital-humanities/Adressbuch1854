<?php


session_start();
require_once(__DIR__."/../functions/export.php");

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récupération des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
   $n = (isset($_POST['n'])? $_POST['n']:  (isset($_GET['n'])? $_GET['n']:null )) ;
   $u = (isset($_POST['u'])? $_POST['u']:  (isset($_GET['u'])? $_GET['u']:null )) ;

   //On traite $q qui peut être un entier simple ou un tableau d'entiers
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p,$n,$u);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Default:
         break;
   }
}


?>

<!-- tableau récapitulatif des personnes ou compagnies enregistrées -->
   <div class="container">
      <div class="row">
         <div class="column-responsive column-80">
            <div class="content">
               <table>
                  <tr>
                     <td colspan="4"><?= __('Ihre Aufnahmen') ?></td>
                  </tr>
                  <tr>
                     <td>Id</td>
                     <td><?= __('Name')?></td>
                     <!--<td>Profession</td>-->
                     <td><?= __('Link') ?></td>
                     <td><?= __('Löschen') ?></td>
                     <td><?= __('Export JSON') ?></td>
                     <td><?= __('Export XML') ?></td>
                  </tr>
    <?php
    if (creationPanier())
    {
       $nbArticles=count($_SESSION['panier_export']['Identifiant']);
       if ($nbArticles <= 0)
       echo "<tr><td>". __('Keine Aufnahmen'). "</ td></tr>";
       else
       {
          for ($i=0 ;$i < $nbArticles ; $i++)
          {
             echo "<tr>";
             echo "<td>".htmlspecialchars($_SESSION['panier_export']['Identifiant'][$i])."</ td>";
             echo "<td>".htmlspecialchars($_SESSION['panier_export']['name_persons'][$i])."</ td>";
             //echo "<td>".htmlspecialchars($_SESSION['panier_export']['profession'][$i])."</ td>";

             //On va créer un lien pour aller sur la vue de la personne ou de la compagnie

             echo "<td><a target='blank' href='".htmlspecialchars($_SESSION['panier_export']['uri'][$i])."/view/{$_SESSION['panier_export']['Identifiant'][$i]}/'>VIEW</a></ td>";

             //On va créer le bouton de suppression si on ne souhaite garder l´élément

             echo "<td><a href=\"".htmlspecialchars("panier_export?action=suppression&l=".rawurlencode($_SESSION['panier_export']['Identifiant'][$i]))."\">DELETE</a></td>";

             //On va exporter en JSON ou en XML en reprenant l'URI et l'identifiant.

             echo "<td><a href='{$_SESSION['panier_export']['uri'][$i]}/view/{$_SESSION['panier_export']['Identifiant'][$i]}?export=json'>JSON</a></td>";
             echo "<td><a href='/persons/view/{$_SESSION['panier_export']['Identifiant'][$i]}?export=xml'>XML</a></td>";
             echo "</tr>";


          }
       }
    }
            echo "<td>". compterArticles() ."</td>";
    ?>
               </table>
            </div>
         </div>
      </div>
   </div>