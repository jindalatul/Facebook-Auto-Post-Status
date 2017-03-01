<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TodayThoughts Template</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                    <![endif]-->

        <style>
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #eee;
            }

            .form-signin {
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin .checkbox {
                font-weight: normal;
            }
            .form-signin .form-control {
                position: relative;
                height: auto;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding: 10px;
                font-size: 16px;
            }
            .form-signin .form-control:focus {
                z-index: 2;
            }
            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }
        </style>

    </head>

    <body>

        <div class="container form-signin">
            <?php
            $msg = '';
            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                // logged-in successfully with username 'Loc' and password '1234'
                if ($_POST['username'] == 'Loc' && $_POST['password'] == '1234') {
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();

                    $_SESSION['username'] = 'Loc';

                    header('Location: redirect.php?action=succeed');
                } else {
                    $msg = 'Wrong username or password';
                }
            }
            ?>
        </div> <!-- /container -->

        <div class="container">
            <form class="form-signin" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <h4 class="form-signin-heading"><?php echo $msg; ?></h4>

                <input type="text" class="form-control" name="username" placeholder="username = Loc" required autofocus>
                <input type="password" class="form-control" name="password" placeholder="password = 1234" required>

                <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>  

                <h2 class="form-signin-heading text-center"><a href="index.php">Home <span class="glyphicon glyphicon-home"></span></a></h2>      
            </form>
        </div> <!-- /container -->
    </body>
</html>

<!--
  By Lộc Nguyễn
  URL: http://www.umsl.edu/~lhn7c5/
  May 18, 2014
-->
