
<!-- Volume slider -->
<div id="voldiv"  style="display: none" >
Volume:<br />
 <input type="range" id="volume" min="0" max="100"  style="width: 75%" >
</div>
<br />
<br />
<div id="playlist" class="playlist" ></div>


<script>
var slider = document.getElementById("volume");

slider.onchange = function() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/getvol.php?volume=" + this.value , true);
  xhttp.send();
}

function playlist() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("playlist").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "/playing.php", true);
  xhttp.send();
  setTimeout(playlist,5000);
}

document.addEventListener('DOMContentLoaded', function() {

    playlist();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       slider.value =  this.responseText.trim();
       document.getElementById("voldiv").style.display = "block"; 
    }
  };
  xhttp.open("GET", "/getvol.php" , true);
  xhttp.send();
}, false);

</script>



</div>
</body>
</html>
