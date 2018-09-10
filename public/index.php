<?php
require_once ('../Library/Settings/settings.php' );

$pagetitle = 'home';
$h1 = 'Home';
$paragraph = '<a href="create.php" class="btn btn-primary btn-lg">Nieuw bericht toevoegen</a>';


include_once ( DOCUMENT_ROOT . 'Library/View/Header.php'        );
include_once ( DOCUMENT_ROOT . 'Library/View/Navigation.php'    );
include_once ( DOCUMENT_ROOT . 'Library/View/Jumbotron.php'	    );
include_once ( DOCUMENT_ROOT . 'Library/View/Main.php'          );
include_once ( DOCUMENT_ROOT . 'Library/View/Footer.php'        );