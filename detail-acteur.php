
<?php
session_start();
try {

    $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', '');
}

catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());

}

 ?>


<!-- méthode du cours pour récupérer l'id -->

<?php //ajouter id superieur ou egal a 0
if(isset($_GET['id']))
{
$idActeur = (int) $_GET['id'];
//query
$reponse = $bdd->query('select * from actors where id=' . $idActeur);
$actor = $reponse->fetch();

}

else {
	echo 'id inexistant';
}
?>

<!-- méthode du mentor pour récupérer l'id -->
<?php

//print_r($_GET);
//var_dump($_GET);
//echo '</pre>';
?>

<?php
$date = new Datetime();
$dateaenvoyer = $date->format('y-m-d h:i:s');

if (!empty($_POST['comment'])) {
      $req = $bdd->prepare('INSERT INTO comments(created_at, content, accounts_id, actors_id) VALUES(:created_at, :content, :accounts_id, :actors_id)');
      $req->execute(array(
        'created_at' => $dateaenvoyer,
        'content' => $_POST['comments'],
        'accounts_id' => $_SESSION['auth']['id'] ,
        'actors_id' => $actor["id"]));
}

    $req = $bdd->prepare('SELECT * FROM comments');
    $req->execute(array(
));

$resultat = $req->fetchAll();
//echo '<pre>';
//print_r($resultat);
//echo '</pre>';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Formation & co</title>
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

	<!-- SECTION HEADER -->
  <header>
	<section id="header-site">
		<div class="content-header">
			<div>
				<p><img class="img-logo" src="images/GBAF.png" alt="Logo"></p>
			</div>
			<div class="content-user">
				<img class="img-user" src="images/user.png" alt="utilisateur">
				<p>nom & pr&eacutenom</p>
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
<?php
//var_dump($_SESSION['auth']);
  if(isset($_SESSION['auth'])) {

 ?>
	<section id="commentaires">
<!-- faire comme pour register avec le input submit => rajouter value etc -->
		<form method="post">

			<p> <label for="comments">COMMENTAIRE : </label>
          <input type="textarea" name="comments" id="comments" value="<?= !empty($_POST['comments']) ? $_POST['comments'] : '' ?>"/>
      </p>
			<p><input type="submit" name="comment" value="Publier"/></p>

    </form>



  <!--  afficher le commentaire publié avec le prénom -->


	</section>
<?php   }
 ?>
 <div class="content-comments">
   <div class="content-buttons">
     <form method="post">
       <button><i class="far fa-thumbs-up"></i></button>
     </form>
     <form method="post">
       <button><i class="far fa-thumbs-down"></i></button>
     </form>
   </div>
   <div class="comment">
    <?php foreach ($resultat as $key => $value): ?>
     <p>Prenom : <?=ucfirst($value["id"])?></p>
     <p>Date :  <?=ucfirst($value["created_at"])?> </p>
     <p>Commentaire : <?=ucfirst($value["content"])?></p>
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
