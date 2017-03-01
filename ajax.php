<?php
$method = $_REQUEST["method"];
$status_id = $_REQUEST["status_id"];

switch($method)
{
	case 'DeleteStatus':
		DeleteStatus($status_id);
	break;

	case 'PostStatus':
		PostStatus($status_id);
	break;

	case 'DisableStatus':
		DisableStatus($status_id);
	break;
	
	case 'EnableStatus':
		EnableStatus($status_id);
	break;	
}

function PostStatus($status_id)
{
$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$query = "SELECT * FROM campagains WHERE facebook_user_id = '10'";
echo $query;
}


function DeleteStatus($status_id)
{
$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$query = "DELETE FROM status_text WHERE id =".$status_id;
echo $query;
$result=mysqli_query($connection,$query);
die("Success");
}

function EnableStatus($status_id)
{
$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$query = "UPDATE status_text SET enabled = 'yes' WHERE id =".$status_id.";";
//echo $query;

$result=mysqli_query($connection,$query);

//if ($result)
		die("Success");
}


function DisableStatus($status_id)
{
$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$query = "UPDATE status_text SET enabled = 'no' WHERE id =".$status_id.";";
//echo $query;

$result=mysqli_query($connection,$query);

//if ($result)
	die("Sucess");
}
?>