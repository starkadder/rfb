<?php 
$this->load->view("global/header");
?>
<br />
<br />
<br />
<form action="/rfb/albums/<?php echo $action; ?>" method='post'>
<input type="hidden" name="return" value="1"/>
<input type="hidden" name="album" value="<?php echo $album; ?>"/>
<center>

<table cellpadding="10">
  <tr>
    <td>
   Album Name:
    </td>
    <td>
   <input type="text" name="name" size="50" value="<?php echo $name; ?>"/>
    </td>
  </tr>
  <tr>
    <td>
   Album URL:
    </td>
    <td>
   <input type="text" name="url" size="50" value="<?php echo $url; ?>"/>
    </td>
  </tr>
  <tr>
    <td>
   MPlayer Options:
    </td>
    <td>
   <input type="text" name="options" size="50" value="<?php echo $options; ?>"/>
    </td>
  </tr>
</table>

<input type="submit" value="Submit"/>
<br />
<h2><?php echo $error; ?></h2>

</center>
</form>

<?php
$this->load->view("global/footer");
?>

