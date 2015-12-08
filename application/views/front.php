<!DOCTYPE html>
<html>

<head>
	<meta charset='UTF-8'>
	
	<title>Responsive Table</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/style.css')?>">
	
	<!--[if !IE]><!-->
	<style>
	
	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {
	
		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		tr { border: 1px solid #ccc; }
		
		td { 
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee; 
			position: relative;
			padding-left: 50%; 
		}
		
		td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
		
		/*
		Label the data
		*/
		td:nth-of-type(1):before { content: "Número"; }
		td:nth-of-type(2):before { content: "Tipo"; }
		td:nth-of-type(3):before { content: "Descripción"; }
		td:nth-of-type(4):before { content: "Ubicación"; }
		td:nth-of-type(5):before { content: "Usuario"; }
		td:nth-of-type(6):before { content: "Prioridad"; }
		td:nth-of-type(7):before { content: "Fecha Alta"; }
	}
	
	/* Smartphones (portrait and landscape) ----------- */
	@media only screen
	and (min-device-width : 320px)
	and (max-device-width : 480px) {
		body { 
			padding: 0; 
			margin: 0; 
			width: 320px; }
		}
	
	/* iPads (portrait and landscape) ----------- */
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		body { 
			width: 495px; 
		}
	}
	
	</style>
	<!--<![endif]-->

</head>

<body>

	<div id="page-wrap">

	<h1>Responsive Table</h1>
  
    <a href="<?php echo site_url("admin/index") ?>"> Login </a>
	<table>
		<thead>
		<tr>
			<th>Número</th>
			<th>Tipo</th>
			<th>Descripción</th>
			<th>Ubicación</th>
			<th>Usuario</th>
			<th>Prioridad</th>
			<th>Fecha Alta</th>
		</tr>
		</thead>
		<tbody>
        <?php
//Fill table
$fields = array("numero", "tipo", "descripcion", "ubicacion",
                "usuario", "prioridad", "fecha_alta");

foreach($incidents as $incident){
    echo "<tr>";
    foreach($fields as $field){
        echo "<td>";
        echo $incident->$field;
        echo "</td>";
    }
    echo "</tr>";
}
        ?>
		</tbody>
        <tfoot>
            <?php
                echo $links;
            ?>
        </tfoot>
	</table>
	
	</div>
		
</body>

</html>
