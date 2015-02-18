<?PHP
// Incluyo la clase de parseo
include('simple_html_dom.php');

// Declaro la funcion que va a hacer la movida de capturar el contenido
	function separar ($string, $start, $end) {
		$content = explode($start, $string);
		echo count($content);
		//print_r($content);
		$content = explode($end, $content[1]);
		$content = str_replace('<!--', '', $content);
		return trim($content[0]);
	}
	
	if(isset($_POST['url'])){
		// Le digo cual es la url a parsear
		//$url = 'http://www.unsam.edu.ar/secretarias/ciencia/direccion/_becas.asp';
		$url = $_POST['url'];

		// Capturo el nombre del archivo para no renombrarlo
		$nombre_de_archivo = basename($url);

		$carpetas_url = explode("/",$url);
		//print_r($carpetas_url);
		//echo "<br>";
		
		$carpetas_url = array_slice($carpetas_url, 3);
		//print_r($carpetas_url);
		$ary_last = count($carpetas_url)-1;
		//echo "<br>";
		
		$carpetas_url = array_slice($carpetas_url, 0, $ary_last);
		//print_r($carpetas_url);

		if(isset($carpetas_url[0])){
			@mkdir("cache/".$carpetas_url[0]);
			$last_dir = "cache/".$carpetas_url[0];
		}

		if(isset($carpetas_url[1])){
			@mkdir("cache/".$carpetas_url[0]."/".$carpetas_url[1]);
			$last_dir = "cache/".$carpetas_url[0]."/".$carpetas_url[1];
		}

		if(isset($carpetas_url[2])){
			@mkdir("cache/".$carpetas_url[0]."/".$carpetas_url[1]."/".$carpetas_url[2]); 
			$last_dir = "cache/".$carpetas_url[0]."/".$carpetas_url[1]."/".$carpetas_url[2];
		}

		if(isset($carpetas_url[3])){
			@mkdir("cache/".$carpetas_url[0]."/".$carpetas_url[1]."/".$carpetas_url[2]."/".$carpetas_url[3]); 
			$last_dir = "cache/".$carpetas_url[0]."/".$carpetas_url[1]."/".$carpetas_url[2]."/".$carpetas_url[3];
		}

		if(isset($carpetas_url[4])){
			@mkdir("cache/".$carpetas_url[0]."/".$carpetas_url[1]."/".$carpetas_url[2]."/".$carpetas_url[3]."/".$carpetas_url[4]);
			$last_dir = "cache/".$carpetas_url[0]."/".$carpetas_url[1]."/".$carpetas_url[2]."/".$carpetas_url[3]."/".$carpetas_url[4]; 
		}

		if(isset($carpetas_url[5])){
			@mkdir("cache/".$carpetas_url[0]."/".$carpetas_url[1]."/".$carpetas_url[2]."/".$carpetas_url[3]."/".$carpetas_url[4]."/".$carpetas_url[5]);
			$last_dir = "cache/".$carpetas_url[0]."/".$carpetas_url[1]."/".$carpetas_url[2]."/".$carpetas_url[3]."/".$carpetas_url[4]."/".$carpetas_url[5];
		}

		// Si el archivo empieza con _ se lo sacamos para la nueva version
		if(substr($nombre_de_archivo, 0, 1) == '_'){$nombre_de_archivo = substr($nombre_de_archivo, 1);}
		
		// Capturo el codigo de la pagina
		$template_1 = file_get_contents("template.txt");
		
		// Lo paso por CURL (Tiene que estar instalada la extension php_curl en el apache / servidor)
			$c = curl_init($url); 
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			$page = curl_exec($c);
			curl_close($c);
			unset($c);

		// Asigno el inicio y fin del contenido
		$comienzo_cont = 'InstanceBeginEditable name="contenido" -->'; 
		$fin_cont = 'InstanceEndEditable';
		// Capturo el contenido
		$old_cont = separar($page, $comienzo_cont, $fin_cont);

		// Asigno el inicio y fin del titulo
		$comienzo_tit = 'InstanceBeginEditable name="links_secundarios" --> 
      <div class="titulo">'; 
		$fin_tit = '</div>';
		// Capturo el titulo
		$old_titulo = separar($page, $comienzo_tit, $fin_tit);

		// Le aplico el nuevo Template
		$newphrase = trim(str_replace("{{contenido}}", utf8_encode($old_cont), $template_1));
		$newphrase = trim(str_replace("{{titulo_area}}", utf8_encode($old_titulo), $newphrase));
		
		$link_sec_nuevo  = '<!--#include virtual="/2015/inc/links_secundarios/menu_pyg.asp" -->';
		$newphrase = trim(str_replace("{{link_secundarios}}", $link_sec_nuevo, $newphrase));
		
		
		$archivo_final = $last_dir."/".$nombre_de_archivo;
		
		if(file_exists($archivo_final)){
			unlink($archivo_final);
		}
		
		$ar = fopen($archivo_final,"a") or die("Problemas en la creacion");
		fputs($ar,$newphrase);
		unset($newphrase);
		fclose($ar);
		unset($ar);

		//header('Location: descarga.php?f='.$archivo_final);
		//exit;

	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- Responsive and mobile friendly stuff -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements and feature detects -->
<script src="js/modernizr.custom.js"></script>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>

<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="template/css/normalize.css"/>
<link rel="stylesheet" type="text/css" href="template/css/basics.css"/>
<link rel="stylesheet" type="text/css" href="template/css/respgrid.css"/>
<link rel="stylesheet" type="text/css" href="template/css/styles.css"/>
<title>Capturador Web</title>
</head>
<body>
<header>
  <div id="headcont" class="section group">
    <div class="col span_3_of_12">
      <h1>Capturador Web</h1>
    </div>
  </div>
</header>
<form id="webparser" name="webparser" method="post" action="">
<section id="contenido">
  <div id="maincont" class="section group">
    <div class="col span_10_of_12">
        <label for="url">URL del Sitio</label>
        <input name="url" type="text" id="url" style="width:90%" value="" />
    </div>
    <div class="col span_2_of_12">&nbsp;
      <input type="submit" name="submit" id="submit" value=" Use bajo su responsabilidad " />
    </div>
  </div>
  
  <div class="separador"></div>
  
  
  <div id="maincont" class="section group">
  	<div class="col span_6_of_12 bg_green"><?PHP if(isset($old_titulo)){ echo htmlentities($old_titulo); } ?></div>
	<div class="col span_6_of_12 bg_green"><?PHP if(isset($old_cont)){ echo htmlentities($old_cont); } ?></div>
  </div>
</section>
</form>
<footer>
  <div id="headcont" class="section group bg_acme">
    <div class="col span_1_of_12">&nbsp;</div>
    <div class="col span_9_of_12">&copy; 2015</div>
    <div class="col span_2_of_12"><img src="template/images/Completa-acme.gif" /></div>
  </div>
</footer>
</body>
</html>