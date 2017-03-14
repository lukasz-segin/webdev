<?php
	include( 'session2.php' );

	$id = isSet($_GET['id']) ? intval($_GET['id']) : 0;

	if($id > 0) {
		$sth = $pdo->prepare( 'DELETE FROM regal WHERE id = :id');
		$sth->bindParam( ':id', $id );
		$sth->execute();

		header('location: loop.php?msg=Rekord zostal usuniety');
	} else {
		header('location: loop.php?msg=Nie usunieto rekordu');
	}