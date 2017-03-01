<?php
include 'inc/header.php';
include 'global.php';
require_once("library_func.php");

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

if($_REQUEST["method"]=="Create New Campagain")
{
	$campagain["facebook_user_id"] = $_SESSION['idFB'];
	$campagain["campagain_name"] = $_REQUEST["CampagainName"];
	$campagain["facebook_page_id"] = $_REQUEST["pages"];

	$campagain["post_type"] = $_REQUEST["post_type"];

	$campagain["album_id"] = 0;
	$campagain["album_name"] = 'Not Applicable';
	
	$token = generateLongTermAccessToken($_SESSION['fb_token'],$_REQUEST["pages"]);
	
	$campagain["access_token"] = $token["access_token"];
	$campagain["facebook_page_name"] = $token["page_name"];
	
	//var_dump($campagain);
	//die();	
	saveCampagain($campagain);

	//echo"Insert Data In DB";
	
}

if($_REQUEST["method"]=="Create New Photo Campagain")
{
	$campagain["facebook_user_id"] = $_SESSION['idFB'];
	$campagain["campagain_name"] = $_REQUEST["CampagainName"];
	$campagain["facebook_page_id"] = $_REQUEST["pages"];
	
	$campagain["post_type"] = $_REQUEST["post_type"];

	$campagain["album_id"] = $_REQUEST["album_id"];
	$campagain["album_name"] = $_REQUEST["album_name"];	
	
	$token = generateLongTermAccessToken($_SESSION['fb_token'],$_REQUEST["pages"]);
	
	$campagain["access_token"] = $token["access_token"];
	$campagain["facebook_page_name"] = $token["page_name"];
	
	//var_dump($campagain);
	//die();
	
	saveCampagain($campagain);
	
	//echo"Insert Data In DB";
	
}
?>
<div id="main_body" class="row">
    <div id="main" class="col-md-9">

        <?php
        if (isset($_SESSION['valid']) && $_SESSION['valid'] == true) 
		{
            if (isset($_SESSION['username'])) {
                // echo username;
                echo '<div class="alert alert-success">';
                echo 'You logged in as local Web account: ' . $_SESSION['username'];
                echo '</div>';
                echo '<hr/>';
            }

            if (isset($_SESSION['FB']) && ($_SESSION['FB'] == true)) 
			{
                // echo FB user info
				require_once("template.php");
			}
			
        } else {
            echo '<div class="alert alert-info">';
            echo 'You have NOT logged in.';
            echo '</div>';
        }
        ?>        

    </div>
</div>
<!-- end main_body -->
<?php
include 'inc/footer.php';
?>