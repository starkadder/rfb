<?php 
$this->load->view("global/header",array("title" => $title));
?>
<br />
<br />
<br />
<center>

<form action="/rfb/albums" method="post">
<select name="album">

<?php
foreach ($albums->result() as $album) {
  if ($album->id == $nowplaying) {
    echo "<option selected='selected' value='" . $album->id . "'>" . $album->name ."</option>\n";
  }
  else {
    echo "<option value='" . $album->id . "'>" . $album->name ."</option>\n";
  }
}
?>
</select>

<br />
<br />
<input type="submit" name="submit" value="Play"/> &nbsp;
<input type="submit" name="submit" value="Stop"/>
</form>

<?php
$this->load->view("global/footer");
?>

