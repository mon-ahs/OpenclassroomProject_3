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

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>GBAF EXTRANET</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/tablett.css" media="screen and (min-width: 425px)">
  <link rel="stylesheet" type="text/css" href="css/desktop.css" media="screen and (min-width: 769px)">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
</head>

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

  <!-- SECTION PRESENTATION -->
  <section id="presentation">
    <h1>Le Groupement Banque Assurance Français (GBAF) est une fédération
      représentant les 6 grands groupes français :</h1>

    <!-- list-presentation -->
    <div class="list-presentation">

      <ul>
        <li>BNP Paribas</li>
        <li>BPCE</li>
        <li>Credit Agricole</li>
        <li>Credit Mutuel-CIC</li>
        <li>Societe Generale</li>
        <li>La Banque Postale</li>
      </ul>
    </div>

  </section>

  <!-- SECTION ILLUSTRATION -->
  <section id="illustration">
    <p><img class="img-clavier" src="images\illustration_presentation.jpg" alt=""></p>

  </section>

  <!-- SECTION ACTEURS -->
  <section id="acteurs">

    <h2>Voici les quatres partenaires du GBAF</h2>

    <div>

      <ul class="list-acteurs">
        <?php foreach ($donnees as $key => $value): ?>
        <li><?=ucfirst($value["title"])?></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- parties avec logo -->
    <div class="style-acteurs">
<?php foreach ($donnees as $key => $value): ?>
  <div class="display-acteurs">
    <img class="logo-acteurs" src="images/<?= $value["filename"]?>" alt="Logo du partenaire <?=$value["title"]?>">
    <div>
      <h2 class="spanCouleur"><?=ucfirst($value["title"])?></h2>
      <!-- <p><span class="spanCouleur">Formation&Co</span> est une association française présente sur tout le territoire.
        Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.
        Formation&co est une association française présente sur tout le territoire.
      </p> -->
      <p><?= $value["description"]?></p>
    </div>
  </div>

  <div class="lien-droite">
    <a class="lien-acteurs" href="detail-acteur.php?id=<?= $value["id"]?> ">lire la suite</a>
  </div>
<?php endforeach; ?>
      <!-- acteur1 -->


    <!--
      <div class="display-acteurs">
        <img class="logo-acteurs" src="images/protectpeople.png" alt="Logo du partenaire Protectpeople">

        <p><span class="spanCouleur">Protectpeople</span> finance la solidarité nationale.
          Nous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.</p>
      </div>

      <div class="lien-droite">
        <a class="lien-acteurs" href="page_protectpeople.html">lire la suite</a>
      </div>


      <div class="display-acteurs">
        <img class="logo-acteurs" src="images/Dsa_france.png" alt="Logo du partenaire DSAFrance">

        <p><span class="spanCouleur">Dsa France</span> accélère la croissance du territoire et s’engage avec les collectivités territoriales.
          Nous accompagnons les entreprises dans les étapes clés de leur évolution.</p>
      </div>

      <div class="lien-droite">
        <a class="lien-acteurs" href="page_dsafrance.html">lire la suite</a>
      </div>



      <div class="display-acteurs">
        <img class="logo-acteurs" src="images/cde.png" alt="Logo du partenaire CDE">

        <p><span class="spanCouleur">La CDE</span> (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation.</p>
      </div>

      <div class="lien-droite">
        <a class="lien-acteurs" href="page_cde.html">lire la suite</a>
      </div>
-->

    </div>

  </section>

  <!-- SECTION FOOTER -->
  <footer id="footer">
    <p class="copyright">Copyright moi, tous droits réservés</p>
  </footer>

</body>

</html>
