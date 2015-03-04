<?PHP
class CrearSitio
{
public function separar($string, $start, $end) {
		$content = explode($start, $string);
		$content = explode($end, $content[1]);
		$content = str_replace('<!--', '', $content);
		return trim($content[0]);
	}

public function generarPagina($url, $temp, $links_sec, $links_ter) {
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
		$old_cont = self::separar($page, $comienzo_cont, $fin_cont);

		// Asigno el inicio y fin del titulo
		$comienzo_tit = 'InstanceBeginEditable name="links_secundarios" --><div class="titulo">'; 
		$fin_tit = '</div>';
		// Capturo el titulo
		$old_titulo = self::separar($page, $comienzo_tit, $fin_tit);

		// Asigno el inicio y fin del titulo terciario
		// TemplateBeginEditable name="links_secundarios" -->
		$comienzo_tit_ter = 'InstanceBeginEditable name="links_izquierda" -->
           <div class="titulo">';
		$fin_tit_ter = '</div>';
		// Capturo el titulo
		$old_titulo_ter = self::separar($page, $comienzo_tit_ter, $fin_tit_ter);

		if($temp == '1'){
			// TEMPLATE BASE SECUNDARIO
			$template_1 = file_get_contents("template.txt");
			$old_titulo_sub = "";
		}elseif($temp == '2'){
			// TEMPLATE BASE TERCIARIO
			$template_1 = file_get_contents("template2.txt");
			$old_titulo_sub = "Centros";
		}
		
		// Le aplico el nuevo Template
		$newphrase = trim(str_replace("{{contenido}}", utf8_encode($old_cont), $template_1));
		$newphrase = trim(str_replace("{{titulo_area}}", utf8_encode($old_titulo), $newphrase));
		$newphrase = trim(str_replace("{{titulo_ter}}", utf8_encode($old_titulo_ter), $newphrase));
		$newphrase = trim(str_replace("{{titulo_sub}}", utf8_encode($old_titulo_sub), $newphrase));

		$link_sec_nuevo  = '<!--#include virtual="/2015/inc/links_secundarios/'.$links_sec.'" -->';
		$newphrase = trim(str_replace("{{link_secundarios}}", $link_sec_nuevo, $newphrase));

		if($temp == '2'){
			$link_izq_nuevo  = '<!--#include virtual="/2015/inc/links_izquierda/'.$links_ter.'" -->';
			$newphrase = trim(str_replace("{{links_izquierda}}", $link_izq_nuevo, $newphrase));
		}
		
		$archivo_final = $last_dir."/".$nombre_de_archivo;
		
		if(file_exists($archivo_final)){
			unlink($archivo_final);
		}
		
		$ar = fopen($archivo_final,"a") or die("Problemas en la creacion");
		fputs($ar,$newphrase);
		unset($newphrase);
		fclose($ar);
		unset($ar);
	}

}
?>