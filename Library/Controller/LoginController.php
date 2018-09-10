<?php 
/*
 * De functie logged_in checkt of de formuliervelden ingevuld zijn, 
 * zo ja, sla values op in de sessie en zet uitlogknop klaar,
 * zo nee, zet inlogvelden klaar, en ruim alle (session-)cookies op.
 *
 * @return String
 */
function logged_in() {
    

 	if (isset($_POST['logout'])) {
		$_SESSION = array();
	}
    
	if ( !empty($_POST['email']) && !empty($_POST['password']) ) {
		$_SESSION['email'] = $_POST['email']; 
	}
    
	if (isset($_SESSION['email'])) {
		echo '<p class="userName">U bent ingelogd</p><a href="<?= htmlspecialchars($_SERVER[\'PHP_SELF\']) ?>?logout"><input type="submit" name="logout" class="btn btn-success" value = "Uitloggen"></a>';
    }
    
 	if (!isset($_SESSION['email'])) {
		echo '<div class="form-group"><input type="text" placeholder="Email" name = "email" class="form-control"></div><div class="form-group"><input type="password" placeholder="Password" name = "password" class="form-control"></div><input type="submit" class="btn btn-success" name="login" value = "Inloggen">';
	}
}