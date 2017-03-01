<?php
// added in v4.0.5
use Facebook\FacebookHttpable;
use Facebook\FacebookCurl;
use Facebook\FacebookCurlHttpClient;
// added in v4.0.0
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;
?>
<?php
function InsertLoginData($name,$FBid,$email="",$password="")
{
$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$next_query = "";

$query = "SELECT * FROM users WHERE facebookid = '".$FBid."';";

if ($result=mysqli_query($connection,$query))
  {
  $rowcount=mysqli_num_rows($result);
  mysqli_free_result($result);
  }
  
		if($rowcount>0)
		{
			$next_query ="UPDATE tronixs_socialmedia.users SET lastlogin = NOW( ) WHERE facebookid =".$FBid;
		}
		else
		{
			$next_query = "INSERT INTO tronixs_socialmedia.users (id, Name, facebookid, email, password, acc_creation) VALUES (NULL, '".$name."', '".$FBid."', '".$email."', '".$password."', NOW() );";		
		}

# echo $query;	
# echo $next_query;	
$result = mysqli_query($connection,$next_query);	
}

function TotalCampagains($FBid)
{
$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$query = "SELECT * FROM campagains WHERE facebook_user_id = '".$FBid."'";

#echo $query;

if ($result=mysqli_query($connection,$query))
  {
	$rowcount=mysqli_num_rows($result);
	mysqli_free_result($result);

	#echo "<br>Rows ::::",$rowcount,"<br>";
	return $rowcount;
	}
}

function ListCampagains($FBid)
{
$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$query = "SELECT * FROM campagains WHERE facebook_user_id = '".$FBid."'";

#echo $query;

if ($result=mysqli_query($connection,$query))
  {
	  $rowcount=mysqli_num_rows($result);  
			if($rowcount<=0)
			{
				return false;
			}
		
		$data = array();
		while($row = mysqli_fetch_assoc($result))
			$data[] = $row;
			
		mysqli_free_result($result);
	}
	return $data;
}

function getFacebookPages($curr_token,$page_id)
{
$session = new FacebookSession($curr_token);
$request = new FacebookRequest($session, 'GET', '/me/accounts');
$response = $request->execute();
$graphObject = $response->getGraphObject()->asArray();
echo"<select name='pages' id='pages' style='width:300px;' onchange='getAlbums();'>";
			foreach($graphObject["data"] as $page)
			{
				if($page->id==$page_id)
					echo "<option value='",$page->id,"' selected>",$page->name," - ", $page->category,"</option>";
				else
					echo "<option value='",$page->id,"'>",$page->name," - ", $page->category,"</option>";
			}
echo"</select>";
}

function getFacebookPageAlbums($curr_token,$page_id)
{
if($page_id==0) 
	return false;
$session = new FacebookSession($curr_token);
$request = new FacebookRequest($session, 'GET', '/'.$page_id.'/albums');
$response = $request->execute();
$graphObject = $response->getGraphObject()->asArray();
echo"<select name='album_id' style='width:300px;'>";
			foreach($graphObject["data"] as $album)
			{
				echo "<option value='",$album->id,"'>",$album->name,"</option>";
			}
echo"</select>";
}

function getFacebookPicture($curr_token)
{
	$session = new FacebookSession($curr_token);
	$request = new FacebookRequest( $session , 'GET', '/me/picture', array ('redirect' => false,'height' => '200','type' => 'normal', 'width' => '200') );
	$response = $request->execute();
	$picture = $response->getGraphObject()->asArray();
	return $picture;
}

function saveCampagain($campagain)
{
$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$query = "INSERT INTO tronixs_socialmedia.campagains (campagainid, post_type, facebook_user_id, album_id, campagain_name, Created, facebook_page_id, facebook_page_name, access_token) VALUES (NULL,'".$campagain["post_type"]."' ,'".$campagain["facebook_user_id"]."','".$campagain["album_id"]."','".$campagain["campagain_name"]."', NOW(), '".$campagain["facebook_page_id"]."','".$campagain["facebook_page_name"]."', '".$campagain["access_token"]."');";

echo $query;
$result = mysqli_query($connection,$query);	
}

function generateLongTermAccessToken($session,$pageId)
{
	$id = '844440958914198';
	$secret = '4b9cd83bf8bd421a3fc1ab27ccd0f8f6';
	$url = "https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id=".$id."&client_secret=".$secret."&fb_exchange_token=".$session;
	$longSession = file_get_contents($url);
	$longSession = substr($longSession,13);

	$session = new FacebookSession($longSession);

	// graph api request for user data
	$request = new FacebookRequest($session, 'GET', '/me/accounts');
	$response = $request->execute();
	$graphObject = $response->getGraphObject()->asArray();
	$token = array();
	foreach($graphObject["data"] as $page)
			{
					if($pageId == $page->id)
					{
					$token = array(
						"access_token"=> $page->access_token,
						"page_id"=>$page->id,
						"page_name"=>$page->name);
						
					return $token;
					break;
					}

			}
}

function ListFacebookStatus($FBid)
{
$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$query = "SELECT status_text.id,status_text.status_text, status_text.date , status_text.time,
status_text.enabled,
campagains.campagain_name, campagains.facebook_page_name FROM campagains,status_text WHERE 
campagains.campagainid = status_text.campagainid AND campagains.facebook_user_id ='".$FBid."'";

#echo $query;

if ($result=mysqli_query($connection,$query))
  {
	  $rowcount=mysqli_num_rows($result);  
			if($rowcount<=0)
			{
				return false;
			}
		
		$data = array();
		while($row = mysqli_fetch_assoc($result))
			$data[] = $row;
			
		mysqli_free_result($result);
	}
	return $data;
}
?>