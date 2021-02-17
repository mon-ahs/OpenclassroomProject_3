<?php
session_start();

print_r($_POST);


if (!isset($_SESSION['auth']['username'])) {
  header('Location: index.php');
  exit;
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', '');
}

catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if (!empty($_POST['update'])) {
// update instead of insert


  //$req = $bdd->prepare('INSERT INTO accounts(username, password, firstname, lastname, answer, question) VALUES(:username, :password, :firstname, :lastname, :answer, :question)');
//  $req->execute(array(
    //'username' => $_POST['username'] ,
    //'password' => password_hash($_POST['password'], PASSWORD_BCRYPT) ,
  //  'firstname' => $_POST['firstname'] ,
  //  'lastname'=> $_POST['lastname'] ,
  //  'answer'=> $_POST['answer'],
  //  'question'=>$_POST['question'] ));
  //$_SESSION['msg'] = "Votre compte a bien été créé";

}

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

  <h1>Profil utilisateur: </h1>


  <!-- formulaire parametres du compte utilisateur   -->
      <form method="post">

        <p>
          <label for="firstname">PRENOM: </label>
          <input type="text" name="firstname" id="firstname" value="<?= !empty($_POST['firstname']) ? $_POST['firstname'] : '' ?>" />
          <span class="<?= !empty($msgError['firstname']) ? 'dblock' : 'dnone' ?>"><?= !empty($msgError['firstname']) ? $msgError['firstname'] : '' ?></span>
        </p>

        <p>
          <label for="lastname">NOM: </label>
          <input type="text" name="lastname" id="lastname" value="<?= !empty($_POST['lastname']) ? $_POST['lastname'] : '' ?>" />
          <span class="<?= !empty($msgError['lastname']) ? 'dblock' : 'dnone' ?>"><?= !empty($msgError['lastname']) ? $msgError['lastname'] : '' ?></span>
        </p>

        <p>
          <label for="username">PSEUDO: </label>
          <input type="text" name="username" id="username" value="<?= !empty($_POST['username']) ? $_POST['username'] : '' ?>" />
          <span class="<?= !empty($msgError['username']) ? 'dblock' : 'dnone' ?>"><?= !empty($msgError['username']) ? $msgError['username'] : '' ?></span>
        </p>

        <p>
          <label for="password">MOT DE PASSE: </label>
          <input type="password" name="password" id="password"/>
          <span class="<?= !empty($msgError['password']) ? 'dblock' : 'dnone' ?>"><?= !empty($msgError['password']) ? $msgError['password'] : '' ?></span>
        </p>

        <p>
          <label for="question">QUESTION SECRETE: </label>
          <input type="text" name="question" id="question" value="<?= !empty($_POST['question']) ? $_POST['question'] : '' ?>" />
          <span class="<?= !empty($msgError['question']) ? 'dblock' : 'dnone' ?>"><?= !empty($msgError['question']) ? $msgError['question'] : '' ?></span>
        </p>

        <p>
          <label for="answer">REPONSE: </label>
          <input type="text" name="answer" id="answer" value="<?= !empty($_POST['answer']) ? $_POST['answer'] : '' ?>" />
          <span class="<?= !empty($msgError['answer']) ? 'dblock' : 'dnone' ?>"><?= !empty($msgError['answer']) ? $msgError['answer'] : '' ?></span>
        </p>

        <input type="submit" name="update" value="Mettre a jour"/>


        </form>





  <!-- SECTION FOOTER -->
  <footer id="footer">
    <p class="copyright">Copyright moi, tous droits réservés</p>
  </footer>

</body>


</html>
