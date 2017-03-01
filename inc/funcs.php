<?php
// current working directory (without http) relative to root
$dir_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// current working directory with full http, end with '/'
$current_dir = 'http://' . $_SERVER['HTTP_HOST'] . $dir_self;
?>

<!--
  By Lộc Nguyễn
  URL: http://www.umsl.edu/~lhn7c5/
  May 18, 2014
-->