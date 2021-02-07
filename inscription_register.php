<?php

//accès à DB
try {
$bdd = new PDO('mysql:host=localhost;dbname=gbaf', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}


//****************** les mêmes verifs pour tous les champs, avec strlen en fonction de la STRUCTURE de la DB gbaf
//vérification que les champs existent
//qu'ils ne sont pas nuls
//et que leur longueur ets inférieure  à 255
if (
((isset($_POST['mot_de_passe'])) AND ($_POST['mot_de_passe'] != null) AND (strlen($_POST['mot_de_passe']) < 70))
AND ((isset($_POST['username'])) AND ($_POST['username'] != null) AND (strlen($_POST['username']) < 255))
AND ((isset($_POST['firstname'])) AND ($_POST['firstname'] != null) AND (strlen($_POST['firstname']) < 45))
AND ((isset($_POST['lastname']))  AND ($_POST['lastname'] != null) AND (strlen($_POST['lastname']) < 45))
AND ((isset($_POST['question'])) AND ($_POST['question'] != null) AND (strlen($_POST['question']) < 255))
AND ((isset($_POST['answer']))  AND ($_POST['answer'] != null) AND (strlen($_POST['answer']) < 255))
)
{

//inscription en DB avec mot de passe haché
//*********************** accounts(username,....,...,.... ) VALUES(?, ?, ?, ?, ?)
$req = $bdd->prepare('INSERT INTO accounts(username, password, firstname, lastname, answer, question) VALUES(?, ?, ?, ?, ?, ?)');
//*********************passer les 5 valeurs en $_POST dans le même ordre
$req->execute(array(
  $_POST['username'],
  password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT),
  $_POST['firstname'],
  $_POST['lastname'],
  $_POST['answer'],
  $_POST['question']

));

echo 'Votre compte a bien été créé';

}

//non-inscription - message d'erreur
else {

echo 'Erreur lors de l\'enregistrement, veuillez réessayer';

}

 ?>
