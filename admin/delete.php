<?php
try {
	$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]"); 
	$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
    $bdd->exec('SET NAMES utf8');
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
};
if (isset($_POST['suppr'])) {
	$get_img_query = $bdd->prepare("SELECT * FROM Articles WHERE id=".$_POST['suppr']." LIMIT 1");
	$get_img_query -> execute();

	$get_img = $get_img_query -> fetch();

	unlink("../data/photo-articles/".$get_img['image1']);
	if ($get_img['image2'] != '') {
		unlink("../data/photo-articles/".$get_img['image2']);
	}
	if ($get_img['image3'] != '') {
		unlink("../data/photo-articles/".$get_img['image3']);
	}


	$query = "DELETE FROM Articles WHERE id=".$_POST['suppr'];
	$bdd -> query($query);

}
?>
