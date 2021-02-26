<?php
session_start();

require 'function.php';

if (!isset($_SESSION['auth']['username'])) {
  header('Location: index.php');
  exit;
}

//récupère tous les acteurs pour pouvoir les afficher sur la page
$donnees = getAllActors();
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
  <script src="https://kit.fontawesome.com/e6af1cc587.js" crossorigin="anonymous"></script>
</head>

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
    <form action="profile-parameters.php" method="post">
       <p><input type="submit" name="profile" value="Changer mes parametres de profil"/></p>
    </form>
    <div class="content-header">
      <div>
        <p><img class="img-logo" src="images/GBAF.png" alt="Logo"></p>
      </div>
      <div class="content-user">
        <img class="img-user" src="images/user.png" alt="utilisateur">
        <p><?=$_SESSION['auth']['lastname']?> <?=$_SESSION['auth']['firstname']?></p>
      </div>
    </div>
  </section>
  </header>

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

      <p><?= $value["description_short"]?></p>
    </div>
  </div>

  <div class="lien-droite">
    <a class="lien-acteurs" href="detail-acteur.php?id=<?= $value["id"]?> ">lire la suite</a>
  </div>
<?php endforeach; ?>

    </div>

  </section>

  <!-- SECTION FOOTER -->
  <footer id="footer">
    <p class="copyright">Copyright moi, tous droits réservés</p>
  </footer>

</body>

</html>
