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
                padding-top: 50px;
            }
            .starter-template {
                padding: 40px 15px;
                text-align: center;
            }
        </style>

    </head>

    <body>

        <div class="container">

            <div class="starter-template">
                <?php
                $msg = '';
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == 'succeed') {
                        $msg = 'Logged successfully...';
                        echo '<p class="lead">' . $msg . '</p>';
                        header('Refresh: 2; URL=index.php');
                    } else if ($_GET['action'] == 'timeover') {
                        session_unset();
                        session_destroy();
                        $msg = 'Inactivity so long, now need to sign-in again.';
                        echo '<p class="lead">' . $msg . '</p>';
                        header('Refresh: 2; URL=login.php');
                    } else if ($_GET['action'] == 'logout') {
                        session_unset();
                        session_destroy();
                        $msg = 'Logged out. Now come back to homepage';
                        echo '<p class="lead">' . $msg . '</p>';
                        header('Refresh: 2; URL=index.php');
                    } else if ($_GET['action'] == 'invalid_permission') {
                        session_unset();
                        session_destroy();
                        $msg = 'Invalid permission. Come back to homepage...';
                        echo '<p class="lead">' . $msg . '</p>';
                        header('Refresh: 2; URL=index.php');
                    }
                } else {
                    header('Location: index.php');
                }
                ?>
                <h2 class="text-center"><a href="<?php
                    echo 'http://' . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['PHP_SELF']),
                            '', $_SERVER['PHP_SELF']);
                    ?>" target="_self">Home <span class="glyphicon glyphicon-home"></span></a></h2>
            </div>
        </div><!-- /.container -->
    </body>
</html>

<!--
  By Lộc Nguyễn
  URL: http://www.umsl.edu/~lhn7c5/
  May 18, 2014
-->

