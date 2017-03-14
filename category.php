<?php
include( 'session2.php' );
if(isset($_GET['msg']))
  echo $_GET['msg'].'<br/>';

echo '<br/><a href="add.php">Dodaj Ksiazke</a><br/>';
echo '<br/><a href="add_cat.php">Dodaj Kategorę</a><br/>';

echo 'Kategorie:<br>';

$tbl = $pdo->query( 'SELECT * FROM `category`' );

echo '<table border="1">';
echo '<tr>';
echo '<th>Id</th>';
echo '<th>Nazwa</th>';
echo '<th>Opcje</th>';
echo '</tr>';

foreach ($tbl ->fetchAll() as $value) {
  echo '<tr>';
  echo '<td>'.$value['id'].'</td>';
  echo '<td>'.$value['name'].'</td>';
  echo '<td>
			<a href="usun_cat.php?id='.$value['id'].'">Usun</a> |
			<a href="add_cat.php?id='.$value['id'].'">Edycja</a>
		</td>';
  echo '</tr>';
}