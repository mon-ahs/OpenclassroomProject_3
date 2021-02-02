<!-- accès à base de données-->
<?php
try {

    $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', '');
}

catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());

}

$reponse = $bdd->query('select * from actors');

$donnees = $reponse->fetchAll();

 ?>


<!-- méthode du cours pour récupérer l'id -->

<?php //ajouter id superieur ou egal a 0
if(isset($_GET['id']))
{
$idActeur = (int) $_GET['id'];
	echo 'idActeur est ' . $idActeur . ' . ';
}

else {
	echo 'id inexistant';
}
?>

<!-- méthode du mentor pour récupérer l'id -->
<?php

echo '<pre>';
print_r($_GET);
var_dump($_GET);
echo '</pre>';
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

	<!-- parties logo et contenu -->
	<!-- SECTION CONTENU -->
	<section id="contenu">

		<p><img class="logo-acteur1" src="images/formation_co.png" alt="Logo du partenaire Formation&Co"></p>

		<h2 class="title-page">Pr&eacutesentation</h2>

		<!-- <div class="lien-droite">
			<a class="lien-acteurs" href="page_formationco.html">lire la suite</a>
		</div> -->
		<div class="contenu-textuel">

			<p> <span class="spanCouleur">Formation&co</span> est une association française présente sur tout le territoire.
				Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.
				Notre proposition :

			<div>

				<ul class="list-presentation-contenu">
					<li>un financement jusqu’à 30 000€ ;</li>
					<li>un suivi personnalisé et gratuit ;</li>
					<li>une lutte acharnée contre les freins sociétaux et les stéréotypes.</li>

				</ul>
			</div>

			Le financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.
			Vous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.</p>

		</div>

	</section>

	<section id="commentaires"> <!-- remplir action avec fichier php prendre exemple sur cible.php dans folder testPHP -->
		<form class="" action="   " method="post">
			<p><label>prenom : <input type="text" name="prenom"/></label></p>
			<p><label>commentaire : <input type="textarea" name="commentaire"/></label></p>
			<p><input type="submit"/></p>

  </form>

		<div class="content-comments">
			<div>
				<p>Commentaires</p>
			</div>
			<div class="content-buttons">
				<button>Nouveau commentaire</button>
				<button><i class="far fa-thumbs-up"></i></button>
				<button><i class="far fa-thumbs-down"></i></button>
			</div>
		</div>

		<div class="comment">
			<div>Prénom</div>
			<div>Date</div>
			<div>Texte</div>
		</div>

		<div class="comment">
			<div>Prénom</div>
			<div>Date</div>
			<div>Texte</div>
		</div>

		<div class="comment">
			<div>Prénom</div>
			<div>Date</div>
			<div>Texte</div>
		</div>

	</section>

	<!-- SECTION FOOTER -->
	<footer id="footer">
		<p class="copyright">Mentions légales Contact</p>
	</footer>

</body>

</html>
