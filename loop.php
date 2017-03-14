<?php
include( 'session2.php' );

	// echo 'POST<pre>';
	// echo print_r($tbl);
	// echo '</pre>';
	if(isset($_GET['msg']))
		echo $_GET['msg'].'<br/>';

	echo '<br/><a href="add.php">Dodaj Ksiazke</a><br/>';
	echo '<br/><a href="add_cat.php">Dodaj Kategorę</a><br/>';

	function t1( $val, $min, $max ) {
	  return ( $val >= $min && $val <= $max );
  }

	$count = $pdo->query( 'SELECT COUNT( id ) as cnt FROM regal' )->fetch()[ 'cnt' ];

  $page = isSet($_GET['page']) ? intval($_GET['page'] - 1) : 1;

  $limit = 10;

  $from = $page * $limit;

  $allPage = ceil( $count / $limit );

  $sql = 'SELECT r.*, c.name as Nazwa_cat FROM `regal` r LEFT JOIN category c ON r.cat_id = c.id ORDER BY r.id ASC LIMIT ' . $from . ', ' . $limit;

  echo 'PAGE: ' . $page . '<br/>';
  echo 'COUNT: ' . $count . '<br/>';
  echo 'LIMIT: ' . $limit . '<br/>';
  echo 'FROM: ' . $from . '<br/>';
  echo 'ALL PAGE: ' . $allPage . '<br/>';
  echo 'SQL: ' . $sql . '<br/>';

	echo 'Regal:<br>';
	$tbl = $pdo->query( $sql );

	echo '<table border="1">';
    echo '<tr>';
      echo '<th>Id</th>';
      echo '<th>Tytuł</th>';
      echo '<th>Autor</th>';
      echo '<th>Recenzja</th>';
      echo '<th>Kategoria</th>';
      echo '<th>Opcje</th>';
    echo '</tr>';

    foreach ($tbl ->fetchAll() as $value) {
      echo '<tr>';
      echo '<td>'.$value['id'].'</td>';
      echo '<td>'.$value['tytul'].'</td>';
      echo '<td>'.$value['autor'].'</td>';
      echo '<td>'.$value['recenzja'].'</td>';
      echo '<td>'.$value['Nazwa_cat'].'</td>';
      echo '<td>
        <a href="usun.php?id='.$value['id'].'">Usun</a> | 
        <a href="add.php?id='.$value['id'].'">Edycja</a>
      </td>';
      echo '</tr>';
    }
	echo '</table>';

  if( $page > 4 ) {
    echo '&nbsp;<a href="loop.php?page=1"> << pierwsza strona</a>&nbsp;';
  }

  for( $i = 1; $i <= $allPage; $i++ ) {

    if( t1( $i, ( $page - 3), ( $page + 5) ) ) {

      $bold = ($i == ($page + 1)) ? 'style="font-size: 24px;"' : '';

      echo '&nbsp;<a ' . $bold . ' href="loop.php?page=' . $i . '">' . $i . '</a>&nbsp;';
    }
  }

  if( $page < $allPage - 5 ) {
    echo '&nbsp;<a href="loop.php?page=' . $allPage . '">ostatnia strona >></a>&nbsp;';
  }

	echo '<br/><br/>Stojak:<br>';

	$tbl1 = $pdo->query( 'SELECT * FROM `stojak`' );

	echo '<table border="1">';
    echo '<tr>';
      echo '<th>Id</th>';
      echo '<th>Tytuł</th>';
      echo '<th>Autor</th>';
      echo '<th>Recenzja</th>';
    echo '</tr>';

    foreach ($tbl1 ->fetchAll() as $value) {
      echo '<tr>';
      echo '<td>'.$value['id'].'</td>';
      echo '<td>'.$value['tytul'].'</td>';
      echo '<td>'.$value['autor'].'</td>';
      echo '<td>'.$value['recenzja'].'</td>';
      echo '<td><a href="usun.php?id='.$value['id'].'">Usun</a></td>';
      echo '</tr>';
    }
	echo '</table>';

	echo 'JOIN:<br>';

	$tbl3 = $pdo->query( 'SELECT a.id, a.tytul, b.autor FROM stojak as b RIGHT JOIN regal as a ON b.id = a.id' );

	echo '<table border="1">';
    echo '<tr>';
      echo '<th>Id</th>';
      echo '<th>Tytuł</th>';
      echo '<th>Autor</th>';
//      echo '<th>Recenzja</th>';
    echo '</tr>';

    foreach ($tbl3 ->fetchAll() as $value) {

    // echo 'POST<pre>';
    // echo print_r($value);
    // echo '</pre>';
      echo '<tr>';
      echo '<td>'.$value['id'].'</td>';
      echo '<td>'.$value['tytul'].'</td>';
      echo '<td>'.$value['autor'].'</td>';
//      echo '<td>'.$value['recenzja'].'</td>';
      // echo '<td><a href="usun.php?id='.$value['id'].'">Usun</a></td>';
      echo '</tr>';
    }
	echo '</table>';

	// for($i=0;$i<10;$i++) {
	// 	echo $i.'<br/>';
	// }