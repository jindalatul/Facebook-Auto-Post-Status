<?php
function get_campagains($FBid)
{
$connection = mysqli_connect("localhost","tronixs_social", "?(Ia5,mt~lwJ", "tronixs_socialmedia" );

$query = "SELECT * FROM campagains WHERE facebook_user_id = '".$FBid."'";

echo $query;

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
	var_dump($data);
	return $data;
}
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
	</form>
	<form action="" method="GET">
	<select name="campagain" id="campagain">';
	
	$data=get_campagains('10152326259197749');
	
	foreach($data as $c)
	{
	echo "<option>",$c['campagain_name'],"</option>";
	}
	echo'</select>
	<input type="submit" value="Build Photos Campagain for all pics in this Album" name="build_photo_campagain" />
	</form>
	';
	
	$directory="pics/".$_REQUEST["Photo_albums"];
			
			//echo $directory;
			
			$files = glob($directory .'/*.*');
			echo"<div style='clear:both;'></div>
				<div id ='page-place-holder' style='padding-left:10px;'>
				<table class='rows' style='border:1px solid;'>
					<tr><td colspan='7'>List of your Added Photo Status Posts</td></tr>
					<tr>
					<td><input type='checkbox' /></td>
					<td>Image</td>
					<td>Campagain</td>
					<td></td>
					<td></td>
					</tr>
			";
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
					echo"<td>Campagain</td>";
					echo"<td><a href='#'>Delete</a>";
					echo"<td><a href='#'>Post Image</a>";
				}
			echo'</tr>';
			$i++;
			}	
			echo"</table>";
?>