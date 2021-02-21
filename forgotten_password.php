<?php

session_start();

if (isset($_SESSION['auth']['username'])) {
  header('Location: acteurs.php');
  exit;
}



//$_SESSION['username'] = '';

//try accès DB
try {
    $bdd = new PDO('mysql:host=localhost;dbname=gbaf', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$error = 0;
$msgError = [];
$resultat = '';

if (!empty($_POST['forgottenPwd'])) {

    if (empty($_POST['username'])) {
        $msgError['username'] = "Le pseudo est vide";
        $error++;
    }

    if ($error === 0) {
        $username = htmlspecialchars($_POST['username']);

        $req = $bdd->prepare('SELECT * FROM accounts WHERE username = :username ');
        $req->execute(array(
            'username' => $username
        ));

        $resultat = $req->fetch();

        if ($resultat)
        {
          $_SESSION['msg'] = 'Veuillez repondre à votre question secrete';
          $_SESSION['auth']['id'] = $resultat['id'];

        } else {
                $_SESSION['msg'] = 'Veuillez rentrer un pseudo existant';
        }
    } else {
            $_SESSION['msg'] = 'Veuillez rentrer un pseudo existant';
    }

    }

if (!empty($_POST['response']) and ($_POST['matchingUsername'] == true)) {
    if ($_POST['db_answer'] == $_POST['answer']) {

          //requete pour update MDP avec fonction de chiffrage

          $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
          $req = $bdd->prepare('UPDATE accounts SET password = :password WHERE id = :id');
           $req->execute(array(

                  'password' => $password,

                  'id'  => $_SESSION['auth']['id']

                ));

               $_SESSION['msg'] = "Votre mot de passe a bien été mis a jour";


    } else {
         $_SESSION['msg'] = 'La réponse ne correspond pas, veuillez recommencer';
    }
}




//if de verification si existe, non null
//if (
//((isset($_POST['username'])) AND ($_POST['username'] !=null))
//AND ((isset($_POST['password'])) AND ($_POST['password'] !=null))
//)

//cas où les var existent
//{
//  $req = $bdd->prepare('SELECT id, password FROM accounts WHERE username = " ' .$_POST['username'] . ' " ');

?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Page de connexion</title>
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

    <h1>MODIFICATION MOT DE PASSE</h1>

      <p>
        Entrez votre pseudo pour acceder a votre question secrete :
      </p>
      <form method="post">

        <p>
          <label for="username">PSEUDO: </label>
          <input type="text" name="username" id="username" value="<?= !empty($_POST['username']) ? $_POST['username'] : '' ?>" />
          <p class="<?= !empty($msgError['username']) ? 'dblock' : 'dnone' ?>"><?= !empty($msgError['username']) ? $msgError['username'] : '' ?></p>
        </p>

        <input type="submit" value="Envoyer" name="forgottenPwd">

      </form>

  <?php if ($resultat) : ?>



    <p>
      QUESTION SECRETE : <?=$resultat["question"]?>
    </p>
    <form method="post">

      <p>
        <label for="answer">REPONSE </label>
        <input type="text" name="answer" id="answer" value="<?= !empty($_POST['answer']) ? $_POST['answer'] : '' ?>" />
        <p class="<?= !empty($msgError['answer']) ? 'dblock' : 'dnone' ?>"><?= !empty($msgError['answer']) ? $msgError['answer'] : '' ?></p>
      </p>

      <p>
        <label for="password">NOUVEAU MOT DE PASSE: </label>
        <input type="password" name="password" id="password"/>
        <span class="<?= !empty($msgError['password']) ? 'dblock' : 'dnone' ?>"><?= !empty($msgError['password']) ? $msgError['password'] : '' ?></span>
      </p>

      <input id="matchingUsername" name="matchingUsername" type="hidden" value="true">
      <input id="db_answer" name="db_answer" type="hidden" value="<?=$resultat['answer']?>">

      <input type="submit" value="Envoyer" name="response">

    </form>

    <?php endif; ?>





    <!-- SECTION FOOTER -->
    <footer id="footer">
      <p class="copyright">Mentions légales Contact</p>
    </footer>
  </body>
</html>
