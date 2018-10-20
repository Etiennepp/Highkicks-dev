<?php
session_start();

$id = $_GET['article'];
$size = $_GET['size'];

include_once("../panier/fonctions-panier.php");
ajouterArticle($id, 1);
modifierTaille($id, $size);

?>