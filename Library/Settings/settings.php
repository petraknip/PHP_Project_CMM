<?php



switch( $_SERVER['SERVER_NAME'] ) {

    // dev
    case 'dev.cmmwerkmap2.nl' :

        define('DB_HOST'            , 'localhost'                                   );
        define('DB_USER'            , 'root'                                        );
        define('DB_PASS'            , 'secret'                                      );
        define('DB_NAME'            , 'justadatabase'                               );

        define('DOCUMENT_ROOT'      , '/var/www/'                                   );
        define('WEB_URL'            , '//dev.cmmwerkmap.nl/'                        );

        ini_set('error_reporting'   , E_ALL                                         );
        ini_set('display_errors'    , 1                                             );

        break;

    // test  
    case 'test.opdracht14.nl' : 
        
        define('DB_HOST'            , 'localhost'                                   );
        define('DB_USER'            , 'root'                                        );
        define('DB_PASS'            , 'secret'                                      );
        define('DB_NAME'            , 'testdatabase'                                );
        
        define('DOCUMENT_ROOT'      , '/Users/Owner/Sites/Projecten/opdracht14/'    );
        define('WEB_URL'            , '//test.opdracht14.nl/'                       );
        
        ini_set('error_reporting'   , E_ALL                                         );
        ini_set('display_errors'    , 1                                             );

        break;
    
    // www.opdracht14.nl
    default: 
        
        define('DB_HOST'            , 'localhost'                                   );
        define('DB_USER'            , 'prod_user_1234'                              );
        define('DB_PASS'            , 'hfes_rci45o6tif'                             );
        define('DB_NAME'            , 'therealdeal'                                 );
                
        define('DOCUMENT_ROOT'      , '/usr/user1234/domains/opdracht14/'           );
        define('WEB_URL'            , '//opdracht14.nl/'                            );
                
        ini_set('error_reporting'   , E_ALL                                         );
        ini_set('display_errors'    , 0                                             );       
}
