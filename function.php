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

function getActor($idActeur) {
  $bdd = getBdd();
  $reponse = $bdd->query('select * from actors where id=' . $idActeur);
  $actor = $reponse->fetch();
  return $actor;
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
