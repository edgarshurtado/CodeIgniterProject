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
    if(!isset($_SESSION['name'])){
        header("location: ". site_url("login/index"));
    }
?>
</head>
<body>
Logged:<?php echo $_SESSION['name']?>
 <a href="<?php echo site_url("backoffice/incidencias")?>">Incidencias</a> |
 <a href="<?php echo site_url("backoffice/usuarios")?>">Usuarios</a> |
 <a href="<?php echo site_url("backoffice/roles")?>">Roles</a> |
 <a href="<?php echo site_url("backoffice/tiposIncidencias")?>">Tipos Incidencias</a> |
 <a href="<?php echo site_url("backoffice/logout")?>">Logout</a>
    <div><?php echo $output; ?> </div>
    </body>
</html>
