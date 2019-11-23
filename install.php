<?php

try {
    if(!$server = readline("Enter Server Name (localhost) ")) $server ="localhost" ;
    
    if(!$username = readline("Enter Username (default root) "))  $username = "root";
    if(!$password = readline("Enter Password (leave blank if empty) "))  $password = '';
    $dbName = readline("Enter Database name " );
    while(!$dbName)
    {
        $dbName = readline("Please Enter Database name (required)");
    }
    echo "----------------Congiguration------------------\n";
    echo "Server Name :". $server."\n";
    echo "Server userame: ". $username."\n";
    echo "Database Name : " .$dbName."\n";
    echo "-----------Connecting To Server -----------------\n";
    $conn = mysqli_connect($server,$username,$password) or die("Connection Could Not be Made");
    if($conn) echo "Connected Successfully";
    

    

    $sql = "DROP DATABASE IF EXISTS `$dbName`";
    $result = mysqli_query($conn,$sql);
    $sql = "CREATE DATABASE IF NOT EXISTS `$dbName`";
    
    $result = mysqli_query($conn,$sql);
    echo "\n Database Created \n";
    mysqli_select_db($conn,$dbName);
    createConfigFile($server,$username,$password,$dbName);
    echo "\n---Config File Created ---\n";
    installSchema($conn);
    echo "\n---Tables Created ---\n";
    


} catch (Exception $e) {
    echo $th->getMessage();
}


// $conn = mysqli_connect($server,$username,$password,$dbName);
// $sql = "DROP DATABASE IF EXISTS `$dbName`";
// $result = mysqli_query($conn,$sql);

// $createDb = "CREATE DATABASE `$dbName`";
// $result = mysqli_query($conn,$createDb);
// if($result) echo "DB Created";



function createConfigFile($server='localhost',$username='root',$password='',$dbName){
    $file = fopen("config.inc.php","w");
    $content = '<?php  $server = "'.$server.'"; $username = "'.$username.'"; $password = "'.$password.'"; $dbName = "'.$dbName.'"; ?>';
    fwrite($file,$content);
    fclose($file);

}

function installSchema($conn)
{
    $templine = '';
    $lines = file('schema/crud.sql');
    foreach ($lines as $line) {
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;
        $templine .= $line;
        if (substr(trim($line), -1, 1) == ';') {
            mysqli_query($conn, $templine) or print('Error performing query on ' . basename($filename) . $templine . ':' . mysqli_error($conn));
            $templine = '';
        }
    }
    $lines = "";
}
?>