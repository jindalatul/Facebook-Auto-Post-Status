<?php
require_once("global.php");

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


// init app with app id and secret
$id = '844440958914198'; // please use yours
$secret = '4b9cd83bf8bd421a3fc1ab27ccd0f8f6'; // please use yours

$permissions = array(
'email',
'user_location',
'user_birthday',
'publish_actions',
'manage_pages'
);

FacebookSession::setDefaultApplication($id, $secret);
//</editor-fold>

$helper = new FacebookRedirectLoginHelper('http://tronixs.com/fb/loginFB.php');

// see if a existing session exists
if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
    // create new session from saved access_token
    $session = new FacebookSession($_SESSION['fb_token']);
    // validate the access_token to make sure it's still valid
    try {
        if (!$session->validate()) {
            $session = null;
        }
    } catch (Exception $e) {
        // catch any exceptions
        $session = null;
    }
} else {
    // no session exists
    try {
        $session = $helper->getSessionFromRedirect();
    } catch (FacebookRequestException $ex) {
        // When Facebook returns an error
    } catch (Exception $ex) {
        // When validation fails or other local issues
        echo $ex->message;
    }
	
}

// see if we have a session
if (isset($session)) {
    // save the session
    $_SESSION['fb_token'] = $session->getToken();
    // create a session using saved token or the new one we generated at login
    $session = new FacebookSession($session->getToken());
    // graph api request for user data
    $request = new FacebookRequest($session, 'GET', '/me/');
    $response = $request->execute();
    $graphObject = $response->getGraphObject()->asArray();
	
	$name = $graphObject['first_name']." ".$graphObject['last_name'];	
	$email = ( isset($graphObject['email']) ? $graphObject['email'] : "" );
	InsertLoginData($name,$graphObject['id'],$email,$password="");
	

    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();

    $_SESSION['FB'] = true;

    $_SESSION['usernameFB'] = $graphObject['name'];
    $_SESSION['idFB'] = $graphObject['id'];
    $_SESSION['first_nameFB'] = $graphObject['first_name'];
    $_SESSION['last_nameFB'] = $graphObject['last_name'];
    $_SESSION['genderFB'] = $graphObject['gender'];
	
    // logout and destroy the session, redirect url must be absolute url
    $linkLogout = $helper->getLogoutUrl($session,
            'http://tronixs.com/fb/redirect.php?action=logout');

    $_SESSION['logoutUrlFB'] = $linkLogout;	
	//die("ATUL JINDAL");
    header('Location: index.php');
} 
else 
{
	//die("ATUL JINDAL");

    header('Location: ' . $helper->getLoginUrl($permissions));
}
?>