<?php
ob_start();
include 'inc/header.php';
?>

<?php
if (!isset($_SESSION['valid'])) {
    header('Location: redirect.php?action=invalid_permission');
}
?>

<div id="main_body" class="row">
    <div id="main" class="col-md-9">
        <h3>Update Data</h3>
        <h4>Permission for logged in users only</h4>
        <p>(if you are here, you are already logged in)</p>
        <p>Perform then submit modification here...</p>
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

<!--
  By Lộc Nguyễn
  URL: http://www.umsl.edu/~lhn7c5/
  May 18, 2014
-->
