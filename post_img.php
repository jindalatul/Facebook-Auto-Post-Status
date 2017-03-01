<?php
ob_start();
session_start();
// include required files form Facebook SDK
// added in v4.0.5
require_once( 'Facebook/FacebookHttpable.php' );
require_once( 'Facebook/FacebookCurl.php' );
require_once( 'Facebook/FacebookCurlHttpClient.php' );

// added in v4.0.0
require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookOtherException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphSessionInfo.php' );

require_once( 'Facebook/FacebookClientException.php' );
require_once( 'Facebook/FacebookOtherException.php');

use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
 
use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;
 
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


$query = "SELECT pic_url,facebook_page_id, access_token FROM campagains,status_pics WHERE status_pics.enabled='yes' AND status_pics.posted='no' AND campagains.campagainid=status_pics.campagainid ORDER BY RAND() LIMIT 0,1;";

echo $query;

$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$result = mysqli_query($connection,$query);	

$row = mysqli_fetch_assoc($result);

var_dump($row);

$post = $row["pic_url"];

$uri="/".$row["facebook_page_id"]."/photos";

$session = new FacebookSession( $row["access_token"] );
 
$request = new FacebookRequest(
  $session,
  'POST',
  $uri,
  array (
    'url' => $post,
  )
);

$response = $request->execute();
$data = $response->getGraphObject()->asArray();

//$new_query="UPDATE status_text SET enabled ='no', posted ='yes' WHERE status_text.id =".$statusid;
//$result = mysqli_query($connection,$new_query);	

var_dump($data);
?>