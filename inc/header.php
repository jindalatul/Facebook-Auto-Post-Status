<?php
ob_start();
session_start();
include 'inc/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tronixs.com - Facebook Application</title>
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="lib.js"></script>
		<style>
		 .navbar-brand
		 {
		 text-decoration:none;
		 color:#FFFFFF;
		 margin-left:30px;
		 }
		.rows td
		{
		padding: 5px;
		border:1px solid black;
		}
		</style>
    </head>
    <body style="margin:auto; width:98%;">

        <div id="wrapper" class="container">
                 <div style="padding:5px 0px; background-color:#B01C1C; width:100%; height:40px;"> 
                        <!-- Home and toggle get grouped for better mobile display -->
					<div style="float:right; margin-right:80px;">
						<a class="navbar-brand" href="<?php echo $current_dir; ?>">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;

                        <!-- Collect the nav links, forms, and other content for toggling -->
						<a class="navbar-brand" href="index.php?view=List_Campagains">View Campagains</a> &nbsp;
						<a class="navbar-brand" href="index.php?view=List_Photo_List_Status">View Photos Status List</a> &nbsp;
						<a class="navbar-brand" href="index.php?view=List_Status">View FB Status List</a> &nbsp;
						<?php
                                if (isset($_SESSION['valid']) && $_SESSION['valid'] ==
                                        true) {
                                    $inactive = 60 * 60 * 1;
                                    if (time() - $_SESSION['timeout'] > $inactive) {
                                        header('Location: redirect.php?action=timeover');
                                    } else {
                                        if (isset($_SESSION['username'])) {
                                            echo '<a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;&nbsp;'
                                            . $_SESSION['username'] . '</a>';
                                            echo '<a class="navbar-brand" href="redirect.php?action=logout">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                    }
                                } else {
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;<a class="navbar-brand" href="login.php">Login</a>';
                                }
                                if (isset($_SESSION['FB']) && ($_SESSION['FB']) ==
                                        true) {
                                    if (isset($_SESSION['valid']) && $_SESSION['valid'] ==
                                            true) {
                                        echo 'Welcome <b>'.$_SESSION['usernameFB'].'</b> <a class="navbar-brand" href="' . $_SESSION['logoutUrlFB'] . '">Logout FB</a>';
                                    } else {
                                        echo '<a class="navbar-brand" href="loginFB.php">Login with Facebook</a>';
                                    }
                                } else {
                                    echo '<a class="navbar-brand" href="loginFB.php">Login with Facebook</a>';
                                }
                                ?>
							</div>
                    </div>