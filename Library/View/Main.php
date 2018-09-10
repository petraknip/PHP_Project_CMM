<div class="container">
	<div class="row">
<?php
include_once(DOCUMENT_ROOT . 'Library/Controller/DatabaseController.php');
include_once(DOCUMENT_ROOT . 'Library/Controller/SanitizeController.php');
include_once(DOCUMENT_ROOT . 'Library/Controller/NewsController.php');
        
$mysqli = databaseController();        
getNews ($mysqli, $query = 'SELECT id, title, date, intro FROM posts');
?>
	</div>
</div>
<hr>