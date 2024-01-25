<?php
	if(isset($_GET['page'])){
		switch($_GET['page']){
			case "homepage";
				include("module/homepage/view/".$_GET['page'].".html");
				break;
			case "controller_vivienda";
				include("module/viviendas/controller/".$_GET['page'].".php");
				break;
			case "services";
				include("module/services/".$_GET['page'].".php");
				break;
			case "aboutus";
				include("module/aboutus/".$_GET['page'].".php");
				break;
			case "contactus";
				include("module/contact/".$_GET['page'].".php");
				break;
			case "404";
				include("view/inc/error".$_GET['page'].".php");
				break;
			case "503";
				include("view/inc/error".$_GET['page'].".php");
				break;
			default;
				include("module/inicio/view/inicio.php");
				break;
		}
	} else{
		include("module/inicio/view/inicio.php");
	}	
?>