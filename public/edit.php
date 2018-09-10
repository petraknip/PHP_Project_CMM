<?php
require_once('../Library/Settings/settings.php' );

$pagetitle = 'edit';
$h1 = 'Bericht bewerken';
$paragraph = '';

include_once( DOCUMENT_ROOT . 'Library/View/Header.php'		);
include_once( DOCUMENT_ROOT . 'Library/View/Navigation.php'	);
include_once( DOCUMENT_ROOT . 'Library/View/Jumbotron.php'	);

include_once( DOCUMENT_ROOT . 'Library/Controller/DatabaseController.php' );
include_once( DOCUMENT_ROOT . 'Library/Controller/SanitizeController.php' );
include_once( DOCUMENT_ROOT . 'Library/Controller/NewsController.php'     );


?>
<div class="container">
<?php   

$mysqli = databaseController();      
getNews($mysqli, 'SELECT id, title, date, intro, post FROM posts WHERE id = ?');
editNews($mysqli, 'UPDATE posts SET title = ?, intro = ?, post = ? WHERE id = ?');

         
?>
<hr>
<?php include('../Library/View/Footer.php'); ?>
</div>