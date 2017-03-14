<?php
	include( 'session2.php' );

	$id = isSet( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

	$photo = isset( $_GET['photoonly'] ) ? intval( $_GET['photoonly'] ) : 0;

//echo 'get<br/>';
//echo '<pre>';
//echo print_r( $_GET );
//echo '</pre>';
	if($id > 0) {

    $sthCov = $pdo->prepare( 'SELECT cover FROM regal WHERE id = :id');
    $sthCov->bindParam( ':id', $id );
    $sthCov->execute();

    $cover = $sthCov->fetch()['cover'];

    if( $cover ) {
      unlink( __DIR__ . '/img/' . $cover);
      unlink( __DIR__ . '/img/' . str_replace( 'cover_', 'org_', $cover ) );
    }

    if( $photo == 0 ) {
      $sth = $pdo->prepare( 'DELETE FROM regal WHERE id = :id');
      $sth->bindParam( ':id', $id );
      $sth->execute();
      header('location: loop.php?msg=Rekord zostal usuniety');
    }

		header('location: loop.php?msg=Okładka usunięta');
	} else {
		header('location: loop.php?msg=Nie usunieto rekordu');
	}