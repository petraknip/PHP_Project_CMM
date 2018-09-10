<?php
require_once('../Library/Settings/settings.php' );

$pagetitle = 'news';
$h1 = 'Nieuws';
$paragraph = '<a href="create.php" class="btn btn-primary btn-lg">Nieuw bericht toevoegen</a>';

include_once( DOCUMENT_ROOT . 'Library/View/Header.php'		);
include_once( DOCUMENT_ROOT . 'Library/View/Navigation.php'	);
include_once( DOCUMENT_ROOT . 'Library/View/Jumbotron.php'	);

include_once( DOCUMENT_ROOT . 'Library/Controller/DatabaseController.php' );
include_once( DOCUMENT_ROOT . 'Library/Controller/SanitizeController.php' );
include_once( DOCUMENT_ROOT . 'Library/Controller/NewsController.php'     );

?>
<div class="container">
	<div class="row">
<?php
        
$mysqli = databaseController();
getNews( $mysqli, 'SELECT id, title, date, intro, post FROM posts WHERE id = ?');
        
?>
<hr>
<?php include_once('../Library/View/Footer.php'); ?>
    </div>
</div>