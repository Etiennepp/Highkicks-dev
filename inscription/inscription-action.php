<?php
session_start();

$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

try {

	$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    

	$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo
        ::ERRMODE_EXCEPTION);

    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);

    $bdd->exec('SET NAMES utf8');

}

catch(Exception $e) {

    echo 'Exception -> ';

    var_dump($e->getMessage());

}



if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pseudo_inscription']) && isset($_POST['mdp']) && isset($_POST['mdp_confirm']) && isset($_POST['zipcode']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['pays']) && isset($_POST['mail'])) {

        if (strlen($_POST['nom']) > 1 && strlen($_POST['prenom']) > 1 && strlen($_POST['pseudo_inscription']) > 1 && $_POST['mdp'] == $_POST['mdp_confirm'] && in_array($_POST['pays'], $countries) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && $_POST['ville'] != '' && $_POST['zipcode'] != '') {




    $check_double_psd = $bdd->prepare("SELECT COUNT(*) FROM comptes WHERE Pseudo = '".$_POST['pseudo_inscription']."'");
    $check_double_mail = $bdd->prepare("SELECT COUNT(*) FROM comptes WHERE mail = '".$_POST['mail']."'");

    $check_double_psd -> execute(); 
    $check_double_mail -> execute(); 

    if ($check_double_psd->fetchColumn()!=0) {

        echo "erreur_double_psd";

    } else if ($check_double_mail->fetchColumn()!=0) {

        echo "erreur_double_mail";

    } else {



    date_default_timezone_set('Europe/Paris');

    

	$prepare_insert = $bdd -> prepare("INSERT INTO comptes (Nom, Prenom, Pseudo, mdpasse, adresse, code_postal, ville, pays, mail, forgot_pass_key, Date_inscription) VALUES (:nom,:prenom,:pseudo,:mot_de_passe,:adresse, :code_postal, :ville, :pays, :mail,:key,:date_inscription)");



	$prepare_insert->execute(array(

            "nom" => $_POST['nom'], 

            "prenom" => $_POST['prenom'],

            "pseudo" => $_POST['pseudo_inscription'],

            "mot_de_passe" => md5($_POST['mdp']),

            "adresse" => $_POST['adresse'],
            "code_postal" => $_POST['zipcode'],
            "ville" => $_POST['ville'],
            "pays" => $_POST['pays'],

            "mail" => $_POST['mail'],

            "key" => bin2hex(openssl_random_pseudo_bytes(16)),

            "date_inscription" =>  date("Y-m-d H:i:s")

            ));



	echo "success";

    $_SESSION['connected_id'] = $bdd->lastInsertId();
}

} else {

    echo "bad_values";

}

} else {

	echo "erreur_champs";

}

?>