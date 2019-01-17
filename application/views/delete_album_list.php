<?php 
$this->load->view("global/header");
?>
<br />
<br />
<br />
<center>

<form action="/rfb/albums/delete" method="post">
<select name="album">

<?php
foreach ($albums->result() as $album) {
    echo "<option value='" . $album->id . "'>" . $album->name ."</option>\n";
}
?>
</select>

<input type="submit" name="submit" value="Delete Album"  onclick="return confirm('confirm delete')" /> 
</form>

<?php
$this->load->view("global/footer");
?>

