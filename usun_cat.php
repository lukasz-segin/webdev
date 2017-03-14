<?php
  include( 'session2.php' );

  $id = isSet($_GET['id']) ? intval($_GET['id']) : 0;

  if($id > 0) {
    $sth = $pdo->prepare( 'DELETE FROM category WHERE id = :id');
    $sth->bindParam( ':id', $id );
    $sth->execute();

    header('location: category.php?msg=Rekord zostal usuniety');
  } else {
    header('location: category.php?msg=Nie usunieto rekordu');
  }