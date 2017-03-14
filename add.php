<?php
include( 'session2.php' );

//echo 'post<br/>';
//echo '<pre>';
//echo print_r( $_POST );
//echo '</pre>';
//echo 'get<br/>';
//echo '<pre>';
//echo print_r( $_GET );
//echo '</pre>';

/*
 *	Trzeba dodać filtrowanie
 *	if(!isset($_POST['autor']))
 *		return 0;
 *	if(!isset($_POST['tytul']))
 *		return 0;
 *	if(!isset($_POST['recenzja']))
 *		return 0;
 */


	if(isset($_POST['autor'])) {
		$id = isSet($_POST['id']) ? intval($_POST['id']) : 0;
		if ($id > 0) {
			$sth = $pdo->prepare( 'UPDATE regal SET autor=:autor, tytul=:tytul, recenzja=:recenzja, cat_id=:cat_id WHERE id = :id' );
		$sth->bindParam( ':id', $_POST['id']);
		} else {
			$sth = $pdo->prepare( 'INSERT INTO regal(autor, tytul, recenzja, cat_id) VALUES (:autor, :tytul, :recenzja, :cat_id)' );
		}

		$sth->bindParam( ':autor', $_POST['autor']);
		$sth->bindParam( ':tytul', $_POST['tytul']);
		$sth->bindParam( ':recenzja', $_POST['recenzja']);
		$sth->bindParam( ':cat_id', $_POST['cat_id']);
		$sth->execute();

		header('location: loop.php?msg=Operacja wykonana pomyślnie.');
	}

	$idGet = isSet($_GET['id']) ? intval($_GET['id']) : 0;
	if($idGet > 0) {
		$sth = $pdo->prepare( 'SELECT * FROM regal WHERE id = :id');
		$sth->bindParam( ':id', $idGet );
		$sth->execute();

		$result = $sth->fetch(); // TO ROBIMY PRZY JEDNYM REKORDZIE
	}

	$sth2 = $pdo->prepare( 'SELECT * FROM category ORDER BY name ASC');
	$sth2->execute();

	$category = $sth2->fetchAll(); // TO ROBIMY PRZY WIELU REKORDACH
?>
<form method="post" action="add.php">

<?php 
	if ($idGet > 0) {
		echo '<input type="hidden" name="id" value="'.$idGet.'">';
	}
?>

	Autor: <input type="text" name="autor" <?php if(isSet($result['autor'])) echo 'value="'.$result['autor'].'"'; ?> ><br/><br/>
	Kategoria: <select name="cat_id">
		<?php
			foreach( $category as $value ) {
				$selected = ( $result['cat_id'] == $value['id'] ) ? 'selected="selected"' : '';
				echo '<option value="'.$value['id'].'"'.$selected.'>'.$value['name'].'</option>';
			}
		?>
	</select>

	<br/><br/>

	Tytul: <input type="text" name="tytul" <?php if(isSet($result['tytul'])) echo 'value="'.$result['tytul'].'"'; ?> ><br/><br/>
	Recenzja: <textarea name="recenzja"> <?php if(isSet($result['recenzja'])) echo $result['recenzja']; ?> </textarea><br/><br/>
	<input type="submit" value="Zapisz">
</form>