<!doctype html>
<html lang="es">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>estilos.css">
	 <!-- toastr -->
	 <script src="<?php echo JS_PATH ?>jquery-3.5.1.min.js"  crossorigin="anonymous"></script>
	 <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>toastr.min.css">
	 <script type="text/javascript" src="<?php echo JS_PATH ?>toastr.min.js" defer></script>
     <script type="text/javascript" defer>
		// Default Configuration
		$(document).ready(function() {
			toastr.options = {
				'closeButton': true,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
				'positionClass': 'toast-top-right',
				'preventDuplicates': false,
				'showDuration': '1000',
				'hideDuration': '1000',
				'timeOut': '5000',
				'extendedTimeOut': '1000',
				'showEasing': 'swing',
				'hideEasing': 'linear',
				'showMethod': 'fadeIn',
				'hideMethod': 'fadeOut',
			}
			
		});
	</script>
	
	
</script>
     
     <script src="https://kit.fontawesome.com/a48a758cbb.js" crossorigin="anonymous"></script>
     <title>MoviePass</title>
     

</head>
<body>
