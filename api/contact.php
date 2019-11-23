<?php
require '../config.inc.php';

$conn = mysqli_connect($server,$username,$password,$dbName);
if(!$conn) echo "Some Problems are encountered";

$method = $_SERVER['REQUEST_METHOD'];
// $request = explode('/',trim($_SERVER['PATH_INFO'],'/'));
// $input = json_decode(file_get_contents('php://input',true));
// $array = (array) $input;

switch($method){
	case "GET":
		
		$sql = "SELECT * FROM contact";
	break;

	case "POST":
		$name = $_POST['name'];
		$email = $_POST['email'];
		$country = $_POST['country'];
		$job = $_POST['job'];
		$city = $_POST['city'];

		$sql = "INSERT INTO contact(name,email,country,job,city) values('$name','$email','$country','$job','$city')";
	break;
}

$result = mysqli_query($conn,$sql);

if(!$result)
{
	http_response_code(404);
	die(mysqli_error($conn));	
}

if($method=="GET")
{
	 echo '[';
	for($i=0;$i<mysqli_num_rows($result); $i++)
	{
		echo($i>0?',':'').json_encode(mysqli_fetch_object($result));
	}
	
	 echo ']';
}elseif($method=="POST")
{
	echo json_encode(['id'=> mysqli_insert_id($conn),'name'=>$name,'email'=>$email,'country'=> $country,'job'=>$job ,'city' => $city]);
}else
{
	echo mysqli_affected_rows($conn);
}
$conn->close();