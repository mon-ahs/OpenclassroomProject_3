<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Page d'inscription</title>
  </head>

  <body>

    <h1>INSCRIPTION SUR LE SITE GBAF: </h1>

<!-- formulaire avec username + pwd (déjà fait)
********* + firstname + lastname + question + answer (type text)

-->
    <form action="inscription_register.php" method="post">

      <p>
        <label>PRENOM: </label><input type="text" name="firstname"/>
      </p>
      <p>
        <label>NOM: </label><input type="text" name="lastname"/>
      </p>
      <p>
        <label>PSEUDO: </label><input type="text" name="username"/>
      </p>
      <p>
        <label>MOT DE PASSE: </label><input type="password" name="mot_de_passe"/>
      </p>
      <p>
        <label>QUESTION SECRETE: </label><input type="text" name="question"/>
      </p>
      <p>
        <label>REPONSE: </label><input type="text" name="answer"/>
      </p>

      <input type="submit" value="Valider"/>

    </form>


  </body>
</html>
