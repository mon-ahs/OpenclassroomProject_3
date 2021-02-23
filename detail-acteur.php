<?php
session_start();

require 'function.php';


if (!isset($_SESSION['auth']['username'])) {
  header('Location: index.php');
  exit;
}



 ?>


<!-- méthode du cours pour récupérer l'id -->

<?php //ajouter id superieur ou egal a 0
if(isset($_GET['id']))
{
    $idActeur = (int) $_GET['id'];
    //query
    $actor = getActor($idActeur);

    // ici requête SELECT * from votes where actorid = $idActeur and accountid = $_SESSION(id)

} else {
    $_SESSION['msg'] = "Partenaire introuvable";
  	header('Location: acteurs.php');
}

$error = 0;
$msgError = [];

if (!empty($_POST['up'])) {
    // récupérer l'id de l'acteur
    // récupérer l'id du user ($_SESSION)
    // UPDATE VERS BDD avec opinion = 1
}

if (!empty($_POST['down'])) {
  // récupérer l'id de l'acteur
  // récupérer l'id du user ($_SESSION)
  // UPDATE VERS BDD avec opinion = 0
}

if (!empty($_POST['comment'])) {
    if (empty($_POST['comments']))  {
        $msgError['content'] = "Vous avez oublie de rentrer votre commentaire";
        $error++;
    } elseif (strlen($_POST['comments']) > 45) {
        $msgError['content'] = "Le commentaire est trop long (45 caractères max)";
        $error++;
    }

    if ($error === 0) {
        $date = new Datetime();
        $dateaenvoyer = $date->format('y-m-d H:i:s');

        insertComment($dateaenvoyer, $_POST['comments'], $_SESSION['auth']['id'], $actor["id"]);



        $_SESSION['msg'] = "Votre commentaire a bien été ajouté";
    }
}

$resultat = getResultat();
$totalComments = getTotalComments();




/*
$sql2 = 'SELECT id FROM comments';
$req2 = $bdd->query($sql);
$req2->execute();
$resultat2 = $req2->rowcount();

echo '<pre>';
print_r($resultat2);
die();*/
//echo '<pre>';
//print_r($resultat);
//echo '</pre>';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Formation & co</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/tablett.css" media="screen and (min-width: 425px)">
	<link rel="stylesheet" type="text/css" href="css/desktop.css" media="screen and (min-width: 769px)">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/e6af1cc587.js" crossorigin="anonymous"></script>
</head>

<!--

REGISTER :
$_POST
RECUPERE LES VALEURs $_POST
REGARDE SI LA VARIABLE N'EST PAS VIDE (pour chaque champ)
REGARDE SI LA LONGUEUR EST INFERIEUR A LA LONGUEUR DE LA COLONNE EN BDD (pour chaque champ)
HASHER LE PASSWORD (password_hash : bcrypt)
INSCRIRE LA PERSONNE EN BDD

CONNECTION :
$_POST
RECUPERE LES VALEURs $_POST
REGARDE SI LA VARIABLE N'EST PAS VIDE (pour chaque champ)
TU VA RECUPERER L'ENTREE DE LA BASE DE DONNEES QUI A POUR VALEUR (PSEUDO) CELLE DU FORMULAIRE
SI LE PSEUDO EXISTE ON CONTINUE SINON ARRETE
UTILISER password_verify pour CHECKER SI LE PASSWORD DU FORMULAIRE CORRESPOND A CELUI DE LA BASE DE DONNEES
SI C'EST BON ON LOG LA PERSONNE EN UTILISANT $_SESSION
IL FAUT ENREGISTRER LES DONNEES DE LA PERSONNE A CONNECTER DANS $_SESSION (toutes sauf le mot de passe)
NE PAS OUBLIER DE METTRE UN session_start() en début de fichier index.php

-->

<body>
  <?php if (isset($_SESSION['msg'])) : ?>

    <p><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></p>

  <?php endif; ?>
	<!-- SECTION HEADER -->
  <header>
	<section id="header-site">
    <form action="disconnection.php" method="post">
       <p><input type="submit" name="disconnect" value="Deconnexion"/></p>
    </form>
		<div class="content-header">
			<div>
				<p><img class="img-logo" src="images/GBAF.png" alt="Logo"></p>
			</div>
			<div class="content-user">
				<img class="img-user" src="images/user.png" alt="utilisateur">
				<p>
          <?=$_SESSION['auth']['lastname']?> <?=$_SESSION['auth']['firstname']?>
        </p>
			</div>
		</div>
	</section>
    </header>

	<!-- parties logo et contenu -->
	<!-- SECTION CONTENU -->
	<section id="contenu">

		<p><img class="logo-acteur1" src="images/<?= $actor["filename"]?>"  alt="Logo du partenaire <?=$actor["title"]?>"></p>

		<h2 class="title-page">Pr&eacutesentation</h2>


		<div class="contenu-textuel">

			<p>

        <?= $actor["description"]?>
      </p>
		</div>

	</section>

	<section id="commentaires">
<!--  comme dans register.php : utiliser la span pour afficher message d'erreur si le champ est vide -->
<div class="content-buttons">
  <!-- ajouter un if -->
  <form method="post">
    <button><i class="far fa-thumbs-up"></i></button>
    <input type="hidden" name="up" value="upvote">
  </form>
  <form method="post">
    <button><i class="far fa-thumbs-down"></i></button>
    <input type="hidden" name="down" value="downvote">
  </form>
  <!-- ajouter un else -->
  <p>Vous avez déjà voté</p>
  <!-- endif -->
</div>
    <p><?= $totalComments  ?> commentaires</p>
		<form method="post">

			<p>
        <label for="comments">Nouveau commentaire : </label>

        <input type="input" name="comments" id="comments" value="<?= (!empty($_POST['comments']) AND !empty($msgError['content'])) ? $_POST['comments'] : '' ?>"/>
        <span class="<?= !empty($msgError['content']) ? 'dblock' : 'dnone' ?>"><?= !empty($msgError['content']) ? $msgError['content'] : '' ?></span>
      </p>
			<p><input type="submit" name="comment" value="Publier"/></p>

    </form>


	</section>

 <div class="content-comments">

   <div class="">
    <?php foreach ($resultat as $value): ?>
      <div class="comment">
        <?php
            $date = new DateTime($value["created_at"]);
            $date->setTimezone(new DateTimeZone('Europe/Paris'));
        ?>
     <p>Prenom : <?= ucfirst($value["username"]) ?></p>
     <p>Date :  <?= 'Le ' . $date->format('d-m-y') . ' à ' . $date->format('H:i:s') ?> </p>
     <p>Commentaire : <?= ucfirst($value["content"]) ?></p>
     </div>
    <?php endforeach; ?>
   </div>
 </div>


<?php
if (!empty($_POST['comment'])) {

  //quand le bouton PUBLIER est cliqué, affiche ce message :
  echo '<pre>';
      print_r('Votre commentaire a été pris en compte');
      echo '<pre>';

  //affiche tous les paramètres de session, une fois passé par connection_form.php
      print_r($_SESSION);
      echo '</pre>';

//permet d'afficher le prénom de l'utilisateur connecté
      echo '<pre>';
          print_r('Prénom : ' . $_SESSION['auth']['firstname']);


}
 ?>

	<!-- SECTION FOOTER -->
	<footer id="footer">
		<p class="copyright">Mentions légales Contact</p>
	</footer>

</body>

</html>
