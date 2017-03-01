function DeleteStatus(status_id)
{
var retVal = confirm("Do you want to Delete Status?");
   if( retVal == true )
   {
		$('#page-place-holder').fadeTo('slow',.6);
		$('#page-place-holder').attr("disabled", true);
		
	  var url="http://tronixs.com/fb/ajax.php?method=DeleteStatus&status_id="+status_id;
		$.get(url,function(data,status){
			alert("Data: " + data + "\nStatus: " + status);
				if(status=="success")
				{
					location.reload();
				}
		});
	}//ifff
}

function getAlbums(dropdown)
{

var yourSelect = document.getElementById( "pages" );
var page_id = yourSelect.options[ yourSelect.selectedIndex ].value;
//alert(page_id);
window.location="?view=Create_Photo_Campagain&page_id="+page_id;
}

function DisableStatus(status_id)
{
var retVal = confirm("Do you want to Disable Status?");
   if( retVal == true )
   {
   
		$('#page-place-holder').fadeTo('slow',.6);
		$('#page-place-holder').attr("disabled", true);

   	  var url="http://tronixs.com/fb/ajax.php?method=DisableStatus&status_id="+status_id;
		$.get(url,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			if(status=="success")
					{
					//alert(1);
					location.reload();
					}
		});
   }//ifff				
}
 
function EnableStatus(status_id)
{
var retVal = confirm("Do you want to Enable Status?");
   if( retVal == true )
   {
	   
	$('#page-place-holder').fadeTo('slow',.6);
	$('#page-place-holder').attr("disabled", true);
		
   	  var url="http://tronixs.com/fb/ajax.php?method=EnableStatus&status_id="+status_id;
		$.get(url,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			if(status=="success")
					{
					//alert(1);
					location.reload();
					}
		});
	}// ifff		
}



function EditStatus()
{
var retVal = confirm("Do you want to Edit Status ?");
   if( retVal == true )
   {
      alert("Edit Status");
	  return true;
   }		
}

function PostStatus(status_id)
{
var retVal = confirm("Do you really want to Post Status on Page?");
   if( retVal == true )
   {
		$('#page-place-holder').fadeTo('slow',.6);
		$('#page-place-holder').attr("disabled", true);
		
	  var url="http://tronixs.com/fb/post_status.php?statusid="+status_id;
	  //alert(url);
		$.get(url,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
				if(status=="success")
				{
					alert("Status Posted Successfully. Check your Facebook page to confirm?");
					location.reload();
				}
		});
	}//ifff
}