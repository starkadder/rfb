<?php 
$this->load->view("global/header");
?>
<br />
<br />
<br />
<center>

<form action="/rfb/stations/edit" method="post">
<select name="station">

<?php
foreach ($stations->result() as $station) {
    echo "<option value='" . $station->id . "'>" . $station->name ."</option>\n";
}
?>
</select>

<input type="submit" name="submit" value="Edit Station"/> 
</form>

<?php
$this->load->view("global/footer");
?>

