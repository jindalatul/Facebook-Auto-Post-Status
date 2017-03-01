<?php
include 'inc/header.php';
include 'global.php';
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
<div id="main_body" class="row">
    <div id="main" class="col-md-9">

<?php
// init app with app id and secret
$id = '844440958914198'; // please use yours
$secret = '4b9cd83bf8bd421a3fc1ab27ccd0f8f6'; // please use yours

if($_REQUEST["confirm_page"]=="confirm_page_selection")
{
$curr_pages = $_REQUEST["pages"];
$url = "https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id=".$id."&client_secret=".$secret."&fb_exchange_token=".$_SESSION['fb_token'];

			$longSession = file_get_contents($url);

			$longSession = substr($longSession,13);
			
			//echo $longSession;
			
			$session = new FacebookSession($longSession);
				
				// graph api request for user data
				$request = new FacebookRequest($session, 'GET', '/me/accounts');
				$response = $request->execute();
				$graphObject = $response->getGraphObject()->asArray();
			
			//var_dump($graphObject);
			
			foreach($graphObject["data"] as $page)
			{
					if($curr_pages ==$page->id)
					{
					echo $page->access_token;
					echo $page->id;
					echo $page->name;
					
					$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );
					$query = "INSERT INTO tronixs_socialmedia.sessions (id,name, page_id, session_id) VALUES (NULL,'".$page->name."', '".$page->id."', '".$page->access_token."')";
					#echo $query;	
					$result = mysqli_query($connection,$query);						
					break;
					}
			}
			
			/*
			$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );
			$query = "INSERT INTO tronixs_socialmedia.sessions (id, page_id, session_id) VALUES (NULL, '".$page."', '".$longSession."')";
			#echo $query;
			$result = mysqli_query($connection,$query);	
			*/

	}
?>
	
        <?php
        if (isset($_SESSION['valid']) && $_SESSION['valid'] == true) 
		{
            if (isset($_SESSION['username'])) 
			{
                // echo username;
                echo '<div class="alert alert-success">';
                echo 'You logged in as local Web account: ' . $_SESSION['username'];
                echo '</div>';
                echo '<hr/>';
            }

            if (isset($_SESSION['FB']) && ($_SESSION['FB'] == true)) 
			{
				// echo FB user info
                echo '<div class="alert alert-success">';
                echo '<strong>You logged in as Facebook account:</strong> ' . '<br/>';
                echo 'Name: ' . $_SESSION['usernameFB'] . '<br/>';
                echo 'First name: ' . $_SESSION['first_nameFB'] . '<br/>';
                echo 'Last name: ' . $_SESSION['last_nameFB'] . '<br/>';
                echo 'Gender: ' . $_SESSION['genderFB'] . '<br/>';
                echo 'Id: ' . $_SESSION['idFB'];
                echo '</div>';		
			} 
			else 
			{
            echo '<div class="alert alert-info">';
            echo 'You have NOT logged in.';
            echo '</div>';
			}
		}
        ?>        

    </div>
    <!-- end main -->

    <div id="sidebar" class="col-md-3">
        <?php
        include 'inc/sidebar.php';
        ?>
    </div>
    <!-- end sidebar --> 
</div>
<!-- end main_body -->

<?php
include 'inc/footer.php';
?>