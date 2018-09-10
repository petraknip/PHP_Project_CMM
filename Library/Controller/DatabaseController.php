<?php

/**
 * Zorgt voor connectie met de database
 * en checkt of die lukt.
 *
 * @return Object
 */
function databaseController() {
    
    $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
    
    try {    
        if ( $mysqli->connect_errno ) {
            throw new Exception('Helaas is er momenteel geen verbinding mogelijk.');
        }  
    } 
    catch (Exception $e) {

        echo $e->getMessage();
        die();
    }
    return $mysqli; 
}