<pre>
<?php
include("Crawler.php");
$mycrawler = new Crawler();
$url_base='http://www.unsam.edu.ar/';

$sitio = array ();
array_push($sitio, $url_base);

$sitio_enviado = array ();

//print the result

function crear_vista($link){
	$mycrawler = new Crawler();
	$crear = $mycrawler->crawlLinksKai($link);
	return $crear;
}


function mostrar_vista($url){
	for($i=0;$i<sizeof($url);$i++)
	{
		$mostrar = crear_vista($url);
		//$mostrar = $url;
	}
	return $mostrar;
}

function crawlear_vista($sitio, $sitio_enviado){
	$sitio_last = array();
	
	for($i=0;$i<sizeof($sitio);$i++)
	{
		//echo $sitio[$i];
		$vista_final = mostrar_vista($sitio[$i]);
		//echo $vista_final[2];
		//echo "<br>";
		$sitio_last[] = $sitio[$i];
		echo $i;
		
		if (in_array($sitio[$i], $sitio_last)) {
			echo "ese link ya existe.<br>";
			echo $i;
		}else{
			for($i=0;$i<sizeof($sitio[$i]);$i++)
			{
				$vista_final = mostrar_vista($sitio[$i]);
				$sitio_last[] = $sitio[$i];
				echo $i;
			}
		}
	}
	
	//print_r($sitio_last);
	
	return $vista_final;
	
}

crawlear_vista($sitio, $sitio_enviado);
?>
</pre>