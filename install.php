<?php

require_once('conn.php');

// CREATE PAGE HIT TABLE
try {   
	$sql = "CREATE TABLE ".$GLOBALS['hits_table_name']." (page VARCHAR(255), count INTEGER, PRIMARY KEY (page))";
	$query = $GLOBALS['db']->prepare($sql);
	$query->execute();
	echo "Hits table successfully created!<br />";
}  
catch(PDOException $e) {  
    echo "Unable to create hits table in database. Script has exited. Original error message: ".$e->getMessage()."<br />";
	exit;
}

// CREATE VISITOR INFO TABLE
try {   
	$sql = "CREATE TABLE ".$GLOBALS['info_table_name']." (id INTEGER AUTO_INCREMENT, ip_address VARCHAR(255), user_agent VARCHAR(255), time_accessed TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id))";
	$query = $GLOBALS['db']->prepare($sql);
	$query->execute();
	echo "Visitor info table successfully created!<br />";
}  
catch(PDOException $e) {  
    echo "Unable to create visitor info table in database. Script has exited. Original error message: ".$e->getMessage()."<br />";
	exit;
}

// IF SUCCESSFUL
echo "Installation successful!";

?>