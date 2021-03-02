<?php

function getBdd() {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
    }

    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
}

//sql requests index + forgotten pwd
function getAccount($username) {
  $bdd = getBdd();
  $req = $bdd->prepare('SELECT * FROM accounts WHERE username = :username ');
  $req->execute(array(
      'username' => $username
  ));
  return $req->fetch();
}

//sql forgotten pwd
function updatePassword($password, $id){
    $bdd = getBdd();
    $req = $bdd->prepare('UPDATE accounts SET password = :password WHERE id = :id');
     $req->execute(array(
            'password' => $password,
            'id'  =>   $id
          ));
}


//sql requests register
function register($username, $password, $firstname, $lastname, $answer, $question) {
  $bdd = getBdd();
  $req = $bdd->prepare('INSERT INTO accounts(username, password, firstname, lastname, answer, question) VALUES(:username, :password, :firstname, :lastname, :answer, :question)');
  $req->execute(array(
    'username' => $username,
    'password' => password_hash($password, PASSWORD_BCRYPT) ,
    'firstname' => $firstname,
    'lastname'=> $lastname,
    'answer'=> $answer,
    'question'=>$question));
}

//sql requests acteurs
function getAllActors() {
    $bdd = getBdd();
    $reponse = $bdd->query('select * from actors');
    return $reponse->fetchAll();
}


//sql requests detail-acteur
function getActor($idActeur) {
  $bdd = getBdd();
  $reponse = $bdd->query('select * from actors where id=' . $idActeur);
  $actor = $reponse->fetch();
  return $actor;
}

function getTotalVotes($idActeur, $idAccount) {
    $bdd = getBdd();
    $req = $bdd->prepare('SELECT * FROM votes WHERE actors_id = :actors_id AND accounts_id = :accounts_id');
    $req->execute(array(
        'actors_id' => $idActeur,
        'accounts_id' => $idAccount
    ));
    return $req->fetchAll();
}

function insertVotes($idAccount, $idActeur, $opinion) {
    $bdd = getBdd();
    $req = $bdd->prepare('INSERT INTO votes(accounts_id, actors_id, opinion) VALUES(:accounts_id, :actors_id, :opinion)');
    $req->execute(array(
         'accounts_id'  => $idAccount,
         'actors_id' => $idActeur,
         'opinion' => $opinion
       ));
}

function getResultat() {
  $bdd = getBdd();
  $sql = 'SELECT c.content, c.created_at, a.username FROM comments as c INNER JOIN accounts as a ON c.accounts_id = a.id';
  $req = $bdd->query($sql);
  $req->execute();
  return $req->fetchAll();
}

function getTotalComments() {
  $bdd = getBdd();
  $sql = 'SELECT c.content, c.created_at, a.username FROM comments as c INNER JOIN accounts as a ON c.accounts_id = a.id';
  $req = $bdd->query($sql);
  $req->execute();
  //$resultat = $req->fetchAll()
  return $req->rowcount();
}

function insertComment($dateaenvoyer, $comments, $account_id, $actor_id) {
  $bdd = getBdd();
  $req = $bdd->prepare('INSERT INTO comments(created_at, content, accounts_id, actors_id) VALUES(:created_at, :content, :accounts_id, :actors_id)');
  $req->execute([
    'created_at' => $dateaenvoyer,
    'content' => $comments,
    'accounts_id' => $account_id,
    'actors_id' => $actor_id
  ]);
}

//requests for profile-parameters
function selectAccountsWithId($id){
  $bdd = getBdd();
  $req = $bdd->prepare('SELECT * FROM accounts WHERE id = :id ');
  $req->execute(array(
      'id' => $id
  ));
  return $req->fetch();
}


function updateProfile($username, $firstname, $lastname, $answer, $question, $password, $id){
  $bdd = getBdd();
  $sql = 'UPDATE accounts SET username = :username, firstname = :firstname, lastname = :lastname, answer = :answer, question = :question, password = :password';
  $parameters = array(
         'username' => $username,
         'firstname' => $firstname,
         'lastname' => $lastname,
         'answer'=> $answer,
         'question' => $question,
         'id'  => $id,
         'password' =>  password_hash($password, PASSWORD_BCRYPT)
  );



  $sql.= ' WHERE id = :id';
  $req = $bdd->prepare($sql);
  $req->execute($parameters);
}
