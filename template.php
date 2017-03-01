<?php
$view=$_REQUEST["view"];

switch($view)
{
case 'List_Photo_List_Status':
	showProfile();
	include_once("list_photo_status.php");
break;

case 'List_Status':
	showProfile();
	$status = ListFacebookStatus($_SESSION['idFB']);
	echo"<div style='clear:both;'></div>
	<div id ='page-place-holder' style='padding-left:10px;'>
		<table class='rows' style='border:1px solid;'>
			<tr><td colspan='7'>List of your Added Facebook Status</td></tr>
			<tr>
			<td style='width:20px;'>ID</td>
			<td style='width:400px;'>Status</td>
			<td style='width:40px;'>Date</td>
			<td style='width:40px;'>Time</td>
			<td>Campagain Name</td>
			<td>Facebook Page Name</td>
			<td>View/Edit</td>";
			foreach ($status as $s1)
			{
			echo
			"<tr>
			<td>",$s1["id"],"</td>
			<td>",$s1["status_text"],"</td>
			<td>",$s1["date"],"</td>			
			<td>",$s1["time"],"</td>
			<td>",$s1["campagain_name"],"</td>
			<td>",$s1["facebook_page_name"],"</td>			
			<td>
			<a href='javaScript:void(0);' onClick='EditStatus(",$s1["id"],");'>Edit</a><br>
			";
			if($s1["enabled"]=="yes")
				echo"<a href='javaScript:void(0);' onClick='DisableStatus(",$s1["id"],");'>Disable</a><br>";
			if($s1["enabled"]=="no")
				echo"<a href='javaScript:void(0);' onClick='EnableStatus(",$s1["id"],");'>Enable</a><br>";
				
			echo"
			<a href='javaScript:void(0);' onClick='DeleteStatus(",$s1["id"],");'>Delete</a><br>			
			<a href='javaScript:void(0);' onClick='PostStatus(",$s1["id"],");'>Post on FB Now</a>			
			</td>
			</tr>";
			}
		echo"</table>
		</div>";		
break;

case 'Create_Campagain':
	
	showProfile();
	
echo'
		<div style="padding-left:50px;">
		<form action="" method="POST">
				<h1>Create New Campagain</h1>
				<h3>Schedule your Facebook News Feed Postings</h3>
				<input type="hidden" name="view" value="List_Campagains" />
				<table>
				<tr>
					<td>Campagain Name</td>
					<td><input type="text" value="" name="CampagainName" style="width:300px;" /></td>
					</tr>
				<tr>
					<td>Select Page</td>
					<td>',getFacebookPages($_SESSION['fb_token'],$_REQUEST['page_id']),'</td>
				</tr>
				<tr>
					<td>CSV File</td>
					<td><input type="File" name="status_bulk" /></td>
				</tr>	
				<tr>
					<td colspan="2"><a href="#">Read File Guidelines and CSV Format</a></td>
				</tr>	
				<tr>
					<td colspan="2"><input type ="submit" name="method" value="Create New Campagain" /></td>
				</tr>					
				</table>';
				echo"<input type='hidden' name='post_type' value='text' />";
echo'</form>
</div>';
break;

case 'Create_Photo_Campagain':
	
	showProfile();
	
echo'
		<div style="padding-left:50px;">
		<form action="" method="POST">
				<h1>Create Photo New Campagain</h1>
				<h3>Schedule your Facebook Photo News Feed Postings</h3>
				<input type="hidden" name="view" value="List_Campagains" />
				<table>
				<tr>
					<td>Campagain Name</td>
					<td><input type="text" value="" name="CampagainName" style="width:300px;" /></td>
					</tr>
				<tr>
					<td>Select Page</td>
					<td>',getFacebookPages($_SESSION['fb_token'],$_REQUEST['page_id']),'</td>
				</tr>
				<tr>
					<td>Select Album</td>
					<td>',getFacebookPageAlbums($_SESSION['fb_token'],$_REQUEST['page_id']),'</td>
				</tr>
				<tr>
					<td>Zip File with all images</td>
					<td><input type="File" name="images_bulk" /></td>
				</tr>	
				<tr>
					<td colspan="2"><a href="#">Read Zip File Guidelines and Image Bulk Upload</a></td>
				</tr>	
				<tr>
					<td colspan="2"><input type ="submit" name="method" value="Create New Photo Campagain" /></td>
				</tr>					
				</table>';
				echo"<input type='hidden' name='post_type' value='photo' />";
echo'</form>
</div>';
break;


case 'List_Campagains':
	showProfile();
			echo"<br><a href='index.php?view=Create_Campagain'>Create Another Text Status Campagain</a> | 
			<a href='index.php?view=Create_Photo_Campagain'>Create Another  Photo Status Campagain</a>
			<br>";
			$campagains = ListCampagains($_SESSION['idFB']);
			echo"<table class='rows'>
			<tr><td colspan='5'>List of your Added Campagains</td></tr>
			<tr>
			<td>Id</td>
			<td>Campagain Name</td>
			<td>Creation Time</td>
			<td>Campagain Type</td>
			<td>Associated FB Page</td>
			<td>View/Edit</td>";
			foreach ($campagains as $campagain)
			{
			echo
			"<tr>
			<td>",$campagain["campagainid"],"</td>
			<td>",$campagain["campagain_name"],"</td>
			<td>",$campagain["Created"],"</td>
			<td>",$campagain["post_type"],"</td>
			<td>",$campagain["facebook_page_name"],"</td>
			<td><a href='#'>View Campagain</a></td>
			</tr>";
			}
			echo"</table>";	
	
break;

case 'Manage_Photos':
	showProfile();
	echo'
	<h4>Create New Directory inside folder PICS and upload all the images you wish post on facebook Page.</h4>';
	
	var_dump($_REQUEST);
	
	$directory = "pics/";
	
	$files = glob($directory . "*");
	echo'
	<form action="" method="GET">
	<select name="Photo_albums">';
	echo"<option value=0>Select Album</option>";
	foreach($files as $file)
	{	
		if(is_dir($file))
		{
			$file = str_replace($directory, '', $file);
			echo"<option>$file</option>";
		}
	}
	echo'</select>
	<input type="text" name="view" value="Manage_Photos" />
	<input type="submit" name="action" value="list_images" />
	<input type="button" value="Build Photos Campagain for all pics in this Album" value="build_photo_campagain" />
	</form>
	';
	
	if($_REQUEST["action"]=="list_images")
	{
			$directory="pics/".$_REQUEST["Photo_albums"];
			
			//echo $directory;
			
			$files = glob($directory .'/*.*');
			echo"<table>";
			$i=1;
			foreach($files as $file)
			{	
			echo'<tr>';
			if(is_file($file))
				{
					//$file = str_replace($directory, '', $file);
					echo"<td>$i</td>";
					echo"<td><input type='checkbox' name=photos[] /></td>";
					echo"<td><img src='$file' style='height:200px;' /></td>";
					echo"<td><a href='#'>Delete</a>";
					echo"<td><a href='#'>Post Image</a>";
				}
			echo'</tr>';
			$i++;
			}	
			echo"</table>";
	}
break;

default:
		showProfile();
		$FBid=$_SESSION['idFB'];
		$output = TotalCampagains($FBid);		
		echo'
		<div style="margin-left: 100px; margin-top: 20px; width: 700px; height:100%;">
		';
		///	var_dump($output);
		if($output<=0)
		{
			echo "<h4>No Campagains Added So Far Click to Create First Campagain</h4>";
			echo"<a href='index.php?view=Create_Campagain'>Create Another Text Status Campagain</a> | 
			<a href='index.php?view=Create_Photo_Campagain'>Create Another  Photo Status Campagain</a>";
		}
		else
		{
			$campagains = ListCampagains($FBid);
			echo"<br><a href='index.php?view=Create_Campagain'>Create Another Campagain</a> | 
			<a href='index.php?view=Create_Photo_Campagain'>Create Another  Photo Status Campagain</a>";
			
			$campagains = ListCampagains($_SESSION['idFB']);
			echo"<table class='rows'>
			<tr><td colspan='4'>List of your Added Campagains</td></tr>
			<tr><td>Campagain Name</td>
			<td>Creation Time</td>
			<td>Associated FB Page</td>
			<td>View/Edit</td>";
			foreach ($campagains as $campagain)
			{
			echo
			"<tr>
			<td>",$campagain["campagain_name"],"</td>
			<td>",$campagain["Created"],"</td>
			<td>",$campagain["facebook_page_name"],"</td>
			<td><a href='#'>View Campagain</a></td>
			</tr>";
			}
			echo"</table>";
		}	
		echo'</div>';
break;		
}

function showProfile()
{
		$picture = getFacebookPicture($_SESSION['fb_token']);
		echo '<div style="background-color:#E0E0E0; min-height: 200px;">';
				echo"<div style='float:left; width:250px;'>";
					echo"<img height='".$picture->height."' width='".$picture->width."' src='".$picture->url."' />";
				echo"</div>";		
				echo"<div style=' padding-top:30px;'>";
					echo '<strong>You logged in as Facebook account:</strong> ' . '<br/>';
					echo 'Name: ' . $_SESSION['usernameFB'] . '<br/>';
					echo 'First name: ' . $_SESSION['first_nameFB'] . '<br/>';
					echo 'Last name: ' . $_SESSION['last_nameFB'] . '<br/>';
					echo 'Gender: ' . $_SESSION['genderFB'] . '<br/>';
					echo 'Id: ' . $_SESSION['idFB'];
				echo"</div>";
        echo '</div>';	
}