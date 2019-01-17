<?php 
$this->load->view("global/header",array("title" => $title));
?>
<br />
<br />
<br />
<center>

<form action="/rfb/" method="post">
<select name="station">

<?php
foreach ($stations->result() as $station) {
  if ($station->id == $nowplaying) {
    echo "<option selected='selected' value='" . $station->id . "'>" . $station->name ."</option>\n";
  }
  else {
    echo "<option value='" . $station->id . "'>" . $station->name ."</option>\n";
  }
}
?>
</select>

<br />
<br />
<input type="submit" name="submit" value="Play"/> &nbsp;
<input type="submit" name="submit" value="Stop"/>
</form>
<br />


<?php
$this->load->view("global/footer");
?>

