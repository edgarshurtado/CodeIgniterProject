<!DOCTYPE html>
<html>
<head>
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</head>
<body>
 <a href="<?php echo site_url("login/incidencias")?>">Incidencias</a> |
 <a href="<?php echo site_url("login/usuarios")?>">Usuarios</a>
    <div><?php echo $output; ?> </div>
    </body>
</html>
