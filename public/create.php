<?php
require_once('../Library/Settings/settings.php' );

$pagetitle = 'create';
$h1 = 'Bericht toevoegen';
$paragraph = '';

include_once( DOCUMENT_ROOT . 'Library/View/Header.php'		);
include_once( DOCUMENT_ROOT . 'Library/View/Navigation.php'	);
include_once( DOCUMENT_ROOT . 'Library/View/Jumbotron.php'	);

include_once(DOCUMENT_ROOT . 'Library/Controller/DatabaseController.php' );
include_once(DOCUMENT_ROOT . 'Library/Controller/SanitizeController.php' );
include_once(DOCUMENT_ROOT . 'Library/Controller/NewsController.php'     );


?>
<div class="container">
<?php
    
$mysqli = databaseController();
newNews($mysqli, 'INSERT INTO `posts` (`title`, `intro`, `post`) VALUES (?, ?, ?)');

          
?>
<hr>
<?php include('../Library/View/Footer.php'); ?>
</div>