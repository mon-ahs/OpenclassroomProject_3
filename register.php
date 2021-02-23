<?php
session_start();
if (isset($_SESSION['auth']['username'])) {
  header('Location: acteurs.php');
  exit;
}

try {
$bdd = new PDO('mysql:host=localhost;dbname=gbaf', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}



$error = 0;
$msgError = [];

if (!empty($_POST['register'])) {

    if (empty($_POST['firstname'])) {
        $msgError['firstname'] = "Le prénom est vide";
        $error++;
    } elseif (strlen($_POST['firstname']) > 45) {
        $msgError['firstname'] = "Le prénom est trop long (45 caractères max)";
        $error++;
    }

    if (empty($_POST['lastname'])) {
        $msgError['lastname'] = "Le nom est vide";
        $error++;
    } elseif (strlen($_POST['lastname']) > 45) {
        $msgError['lastname'] = "Le nom est trop long (45 caractères max)";
        $error++;
    }

    if (empty($_POST['username'])) {
        $msgError['username'] = "Le pseudo est vide";
        $error++;
    } elseif (strlen($_POST['username']) > 45) {
        $msgError['username'] = "Le pseudo est trop long (45 caractères max)";
        $error++;
    }

    if (empty($_POST['password'])) {
        $msgError['password'] = "Le mot de passe est vide";
        $error++;
    } elseif (strlen($_POST['password']) > 70) {
        $msgError['password'] = "Le mot de passe est trop long (70 caractères max)";
        $error++;
    }
    if (empty($_POST['question'])) {
        $msgError['question'] = "Le question est vide";
        $error++;
    } elseif (strlen($_POST['question']) > 255) {
        $msgError['question'] = "Le question est trop longue (255 caractères max)";
        $error++;
    }

    if (empty($_POST['answer'])) {
        $msgError['answer'] = "Le reponse est vide";
        $error++;
    } elseif (strlen($_POST['answer']) > 255) {
        $msgError['answer'] = "Le reponse est trop longue (255 caractères max)";
        $error++;
    }

//version avec ? et $_POST

  //  if ($error === 0) {

      //$req = $bdd->prepare('INSERT INTO accounts(username, password, firstname, lastname, answer, question) VALUES(?, ?, ?, ?, ?, ?)');
    //  $req->execute(array(
        // $_POST['username'],
        //password_hash($_POST['password'], PASSWORD_BCRYPT),
        // $_POST['firstname'],
        //$_POST['lastname'],
        //$_POST['answer'],
        //$_POST['question']
    //  ));
    //  $_SESSION['msg'] = "Votre compte a bien été créé";
  //  }


//version avec :nomVariable et 'nomVariable' => $_POST
    if ($error === 0) {

      $req = $bdd->prepare('INSERT INTO accounts(username, password, firstname, lastname, answer, question) VALUES(:username, :password, :firstname, :lastname, :answer, :question)');
      $req->execute(array(
        'username' => $_POST['username'] ,
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT) ,
        'firstname' => $_POST['firstname'] ,
        'lastname'=> $_POST['lastname'] ,
        'answer'=> $_POST['answer'],
        'question'=>$_POST['question'] ));
      $_SESSION['msg'] = "Votre compte a bien été créé";
    }

}

 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Page d'inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css">
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

    <h1>INSCRIPTION SUR LE SITE GBAF: </h1>

<!-- formulaire  d'inscription -->
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

      <input type="submit" name="register" value="Valider"/>


      </form>





      <!-- SECTION FOOTER -->
    	<footer id="footer">
    		<p class="copyright">Mentions légales Contact</p>
    	</footer>



    </body>
  </html>
