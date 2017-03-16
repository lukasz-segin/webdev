<?php
	// echo 'POST<pre>';
	// echo print_r($tbl);
	// echo '</pre>';

	//'root', 'lukasz12');
	//'root', 'root');

	try {
		$pdo = new PDO('mysql:host=localhost;dbname=ksiazki;encoding=utf8', 'root', 'root');
		$pdo-> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // do wyswietlania bledow
		$pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // wyswietlanie/pokazywanie danych jako tablica asocjacyjna, a nie wszystko w jednej linii
	} catch (PDOException $e) {
		echo $e->getMessage();
	}

	// $username ="root";
	// $password = "lukasz12";
	// $host = "localhost";
	// $table = "ksiazki";
	// $conn = new mysqli("$host", "$username", "$password", "$table");