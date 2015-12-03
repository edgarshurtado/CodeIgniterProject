<?php
 echo "<h1>Hola ". $_SESSION['name'] .", Usted sabe qué es lo que me excita</h1>";
?>
<br>
<img src="https://i.ytimg.com/vi/alukgT3K2-E/hqdefault.jpg">
<?php
 header("refresh:3;url=".site_url("backoffice/incidencias"));
 
 echo "Incidencias por resolver MADAFAKA!!!". incidencias_no_resuletas();
?>

