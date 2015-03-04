<?php
error_reporting(E_ALL ^ E_NOTICE);

include("Crawler.php");
include("GenerarPagina.php");
include('simple_html_dom.php');

$dom = 'http://www.unsam.edu.ar/';
$url = 'http://www.unsam.edu.ar/escuelas/humanidades/_novedades.asp';

$mycrawler = new Crawler();
$GenSite   = new CrearSitio();

$sitio_01 = array();
$sitio_02 = array();
$sitio_final = array();

$link_01 = $mycrawler->crawlLinks($url);
// for each link 01
for($i=0;$i<sizeof($link_01['link']);$i++)
	{
	// Verifico que este dentro del dominio
	$dominio_01 = substr($link_01['link'][$i], 0, 24);
	
	$buscar_a = 'mailto';
	$buscar_b = '.pdf';
	
	$pos_a = stripos($link_01['link'][$i], $buscar_a);
	$pos_b = stripos($link_01['link'][$i], $buscar_b);
	
	// Verifico
	if ($pos_a === false && $pos_b === false && strlen($link_01['link'][$i]) > strlen($url)) {
		if($dominio_01 != $dom){
			//echo "No pertenece al dominio UNSAM: <em>".$link_01['link'][$i]."</em><br>";
		}else{
			$sitio_01[] = $link_01['link'][$i];
			if(!in_array($link_01['link'][$i], $sitio_final)){
				$sitio_final[] = $link_01['link'][$i];
				//$GenSite->generarPagina($link_01['link'][$i]);
			}

			//$link_02 = $mycrawler->crawlLinks($link_01['link'][$i]);
		}
	}else{
		echo "No es un LINK valido para clonar: <em>".$link_01['link'][$i]."</em><br>";
	}
}

echo "<pre>";
print_r($sitio_final);
echo "</pre>";




?>