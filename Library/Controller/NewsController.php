<?php
/**
 * 1. Haal data op uit database 
 *    en vang eventuele fouten op
 * 2. Stuur resultaat op juiste manier door naar de View
 * 3. Toon formulier om bericht te bewerken
 * 	
 * @param Object $mysqli
 * @param Object $query
 * 
 * @return Object 
 */
function getNews( $mysqli, $query ) {
    
    # 1
    
    try {
        
        if ( empty ( $query ) ) {
            throw new Exception('<div class="container">Helaas bevat ons archief nog geen berichten.</div>');
        }
    
        if ( ! $stmt = $mysqli->prepare( $query ) ) {
            throw new Exception('<div class="container">Helaas ging er iets mis bij het ophalen van de berichten.</div>');
        }

        $id=false;
        
        if (isset($_GET['id'])) {
            $id = intval(sanit_input($_GET['id']));
        }

        if ( $id ) {
            $stmt->bind_param('i', $id);
        }

        if ( ! $stmt->execute() ) {
			 throw new Exception('<div class="container">Helaas ging er iets mis bij het ophalen van de berichten.</div>');
        }
     
        $result = $stmt->get_result();
        
        # 2
        
        if ( $result->num_rows > 0 ) {
            
            while ( $row = $result->fetch_assoc() ) {
               
                // Standaard weergave TITLE + INTRO in variabele
                $message = '<div class="col-lg-4">
                            <h2>' . $row ['title'] . '</h2>
                            <p>' . $row ['date'] . '</p>
                            <p><b>' . $row ['intro'] . '</b></p>';
                
                    
                if (! isset( $_GET['id'] ) ) {
                    // Als alle berichten moeten worden getoond met VIEW MORE knop
                    echo $message;
                    echo '<a href="post.php?id=' . $row ['id'] . '" class="btn btn-default">View more &raquo;</a></p></div>';
                }
                 
                if ( isset( $_GET['id'] )) {
                    
                    if ( strpos( $_SERVER ['REQUEST_URI'], 'post' ) ) {
                    
                        echo $message;
                        echo '<p>' . $row ['post'] . '</p>';
                    
                        if ( isset($_SESSION['email'] ) ) {   
                            // Als er een ID moet worden getoond met INLOG dus met EDIT KNOP, = link naar bewerkingsformulier 
                            echo '<a href="edit.php?id=' . $row ['id'] . '" class="btn btn-default">Edit &raquo;</a>';
                        }
                    }
                    
                    # 3
                    
                    if ( strpos( $_SERVER ['REQUEST_URI'], 'edit' ) && isset($_SESSION['email'] ) ) {
                        
                        echo '<form method="post"><div><label><h3>Titel</h3></label></div><textarea name="title" cols="12" rows="2" autofocus required>' . $row['title'] . '</textarea><br><div><label><h3>Inleiding</h3></label></div><textarea name="intro" cols="12" rows="4" required>' . $row['intro'] . '</textarea><br><div><label><h3>Bericht</h3></label></div><textarea name="post" rows="15" required>' . $row['post'] . '</textarea><br><div class="btnRow"><button type="submit" name="save" class="btn btn-success">Opslaan</button></div></form>';
                    } 
                }    
            }    
        }
    }
    catch (Exception $e) { 
        echo $e->getMessage();
    }
}





/**
 * 1. Zorg ervoor dat er een formulier wordt getoond 
 *    om nieuwe berichten te maken als iemand is ingelogd, 
 *    en dat de invoer in de velden blijft staan 
 *    als het wordt opgeslagen.  
 * 2. Haal data op, verwijder ongewenste input
 *    en sla op in de database
 * 
 * @param Object $mysqli
 * @param Object $newQuery
 *
 * @return String 
 */
function newNews ( $mysqli, $newQuery ) {
    
    $title='';
    $intro='';
    $post='';
  
    // Als er NIET ingelogd is, toon onderstaande boodschap.
    if (!isset($_SESSION['email'] )) { 
        echo 'U kunt alleen berichten toevoegen als u ingelogd bent.'; 
    }
    
    if ( isset( $_SESSION['email'] ) ) {
        
        if ( isset($_POST['title'])) {
            $title = htmlentities ($_POST['title']);
        }
        if ( isset($_POST['intro'])) { 
            $intro = htmlentities ($_POST['intro']);
        }
        if ( isset($_POST['post'])) { 
            $post = htmlentities ($_POST['post']);
        }
        
        # 1
        
        // Als er WEL ingelogd is, toon formulier.
        echo  '<form method="post"><div><label><h3>Titel</h3></label></div>
        <textarea name="title" cols="12" rows="2">' . $title . '</textarea><br>
        <div><label><h3>Inleiding</h3></label></div>
        <textarea name="intro" cols="12" rows="4">' . $intro . '</textarea><br>
        <div><label><h3>Bericht</h3></label></div>
        <textarea name="post" rows="15">' . $post . '</textarea><br>
        <div class="btnRow"><button type="submit" name="save" 
        class="btn btn-success">Opslaan</button></div></form>';
        
        # 2
        
        if ( isset($_POST['save'])) {
 
            try {
                if ( empty ( $newQuery ) ) {
                    throw new Exception('<div class="container">Helaas bevat het bericht geen inhoud.</div>');
                }
            
                if ( ! $stmt = $mysqli->prepare( $newQuery ) ) {
                    throw new Exception('<div class="container">Helaas ging er iets mis...</div>');
                }
                
                if ( $_POST ) {
                    sanit_input($title, $intro, $post);
                    $stmt->bind_param('sss', $title, $intro, $post);
                }

                if(!$stmt->execute()) {
	   	   	       throw new Exception('<div class="container">Helaas ging er iets mis bij het bewaren van het bericht.</div>');
                }
                
                echo 'Uw bericht is opgeslagen';
            }
            catch (Exception $e) { 
                echo $e->getMessage();
            }
        }
    }   
}





/**
 * 1. Zorg ervoor dat er een formulier wordt getoond 
 *    met de tekst van het gevraagde bericht 
 *    en dat de gewijzigde invoer in de velden blijft staan 
 *    als het wordt opgeslagen.  
 * 2. Haal data op, verwijder ongewenste input
 *    en sla gewijzigde versie op in de database
 *
 * @param Object $mysqli
 * @param Object $editQuery
 * 
 * @return String 
 */
function editNews ($mysqli, $editQuery) {
    

    if ( isset($_POST['save'])) {
        
            $title = htmlentities ($_POST['title']);
            $intro = htmlentities ($_POST['intro']); 
            $post = htmlentities ($_POST['post']);
        
            sanit_input($title, $intro, $post);
            
            if (isset($_GET['id'])) {
                $id = intval(sanit_input($_GET['id']));
            }
 
        try {
        
            if ( ! $stmt = $mysqli->prepare( $editQuery ) ) {
                throw new Exception('<div class="container">Helaas ging er iets mis...</div>');
            }
            
            $stmt->bind_param('sssi', $title, $intro, $post, $id); 
        
            if(!$stmt->execute()) {
                throw new Exception('<div class="container">Helaas ging er iets mis bij het bewaren van het bericht.</div>');
            }
         
        }
        catch (Exception $e) { 
            echo $e->getMessage();
        }
                    
    echo 'Uw bericht is gewijzigd en opgeslagen';
    }
                    
        if (! isset($_SESSION['email'] ) ) {   
            echo 'U kunt alleen berichten bewerken als u ingelogd bent.'; 
        }
    }