<?php
	include( 'baza.php' );

	session_start();

	if( isset( $_POST['login'] ) ) {
		$login = $_POST['login'];
		$pass = md5( $_POST['pass'] );

		$sth = $pdo->prepare( 'SELECT * FROM users WHERE login = :login AND pass = :pass' );
		$sth->bindParam( ':login', $login, PDO::PARAM_STR ); // trzeci parametr, to rzutowanie na typ zmiennej
		$sth->bindParam( ':pass', $pass, PDO::PARAM_STR );

		$sth->execute();

		$result = $sth->fetch();

		if( $result && isset( $result['id'] ) ) {
			$_SESSION['logged'] = true;
			$_SESSION['userLogin'] = $result['login'];
			header( 'location:loop.php' );
		}
	}

	if( !isset( $_SESSION['logged'] ) || $_SESSION['logged'] == false ) {
?>
		<form action="session2.php" method="post">
			Login:<br/>
			<input type="text" name="login"><br/><br/>
			Pass:
			<input type="password" name="pass"><br/><br/>
			<input type="submit" value="Zaloguj">
		</form>
<?php
		die;
	}
?>