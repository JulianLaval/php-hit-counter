<?php 

### EDIT HERE ###

// DB CONNECT INFO
$db_host = "INSERT_DB_HOST_HERE";
$db_name = "INSERT_DB_NAME_HERE";
$db_user = "INSERT_DB_USERNAME_HERE";
$db_pw = "INSERT_DB_PASSWORD_HERE";

// DB TABLE INFO
$GLOBALS['hits_table_name'] = "INSERT_HITS_TABLE_NAME_HERE";
$GLOBALS['info_table_name'] = "INSERT_INFO_TABLE_NAME_HERE";

### STOP EDITING HERE ###

// CONNECT TO DB
try {   
	$GLOBALS['db'] = new PDO("mysql:host=".$db_host.";dbname=".$db_name, $db_user, $db_pw, array(PDO::ATTR_PERSISTENT => false, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false));  
}  
catch(PDOException $e) {  
    echo $e->getMessage();
}

?>