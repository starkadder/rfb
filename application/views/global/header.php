<html>
<head>
<title>Radio Free Blossom</title>
<link rel="stylesheet" type="text/css" href="/rfb/css/rfb.css" />
<!--
<link rel='shortcut icon' href='/rfb/images/edna_icon.png' type='image/png' />
-->
<script type="text/javascript" language="JavaScript" src="/rfb/js/jquery.js"></script>
<script type="text/javascript" language="JavaScript" src="/rfb/js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" language="JavaScript" src="/rfb/js/tablesorter.js"></script>
<?php 

error_reporting(0);  // this lets you have undeclared variables and not get a warning message
echo $meta;

?>
<script>
$(document).ready(function() {
  // menu controls:
  $('#nav li').hoverIntent(
	 function () {$('ul', this).slideDown(100); $(this).addClass('hover'); },
         function () {$('ul', this).slideUp(100); $(this).removeClass('hover'); } );
  $('#nav li ul li').hover(
	 function () {$(this).addClass('hover'); },
         function () {$(this).removeClass('hover'); } );
  // page supplied:

<?php echo $jQueryCode; ?>
} );
<?php  echo $javascript; ?>
</script>
</head>
<body>
<div class='menu' >
<center>
 <h1>Radio Free Blossom</h1>
  <h2><?php  // echo $title; ?></h2>
</center>
</div>

<div class='menu'>
  <?php $this->load->view("global/menu");?>
</div>
<div class='content'>

<?php 
// restore PHP warnings
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>
