<?php 
$this->load->view("global/header",array("title" => $title));
?>
<br />
<br />
<br />
<center>

<form action="/rfb/links" method="post">
   Link: <input name="link" type="text" size="60" value="" />
   <br />
   <br />
   <input type="submit" name="submit" value="Play"/> &nbsp;
   <input type="submit" name="submit" value="Stop"/>
</form>

<?php
$this->load->view("global/footer");
?>

