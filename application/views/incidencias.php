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

<?php
    if(!isset($_SESSION['usuario'])){
        header("location: ". site_url("login/index"));
    }
?>
</head>
<body>
 <a href="<?php echo site_url("login/incidencias")?>">Incidencias</a> |
 <a href="<?php echo site_url("login/usuarios")?>">Usuarios</a> |
 <a href="<?php echo site_url("login/roles")?>">Roles</a> |
 <a href="<?php echo site_url("login/tiposIncidencias")?>">Tipos Incidencias</a> |
 <a href="<?php echo site_url("login/logout")?>">Logout</a>
    <div><?php echo $output; ?> </div>
    </body>
</html>
