<?php
if (! session_id() ) {
	session_start();
}
require_once( '../Library/Controller/LoginController.php'); ?>
<form method="post" name="loginform" id="loginform" class="navbar-form navbar-right">
<?php logged_in();?>
</form>