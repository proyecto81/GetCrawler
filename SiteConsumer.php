<?php
error_reporting(E_ALL ^ E_NOTICE);

include("Crawler.php");
$url='http://www.unsam.edu.ar/escuelas/humanidades/_novedades.asp';

$mycrawler=new Crawler();

$sitio_01 = array();
$sitio_02 = array();
$sitio_final = array();

$link_01 = $mycrawler->crawlLinks($url);
// for each link 01
for($i=0;$i<sizeof($link_01['link']);$i++)
	{
	// Verifico que este dentro del dominio
	$dominio_01 = substr($link_01['link'][$i], 0, 24);
	if($dominio_01 != "http://www.unsam.edu.ar/escuelas/humanidades/"){
		echo "No pertenece al dominio UNSAM: <em>".$link_01['link'][$i]."</em><br>";
	}else{

		$sitio_01[] = $link_01['link'][$i];
		$sitio_final[] = $link_01['link'][$i];
		$link_02 = $mycrawler->crawlLinks($link_01['link'][$i]);
		
		// for each link 02
		for($j=0;$j<sizeof($link_02['link']);$j++)
			{
				// Verifico que este dentro del dominio
				$dominio_02 = substr($link_02['link'][$j], 0, 24);
				if($dominio_02 != "http://www.unsam.edu.ar/escuelas/humanidades/"){
					echo "No pertenece al dominio UNSAM: <em>".$link_02['link'][$j]."</em><br>";
				}else{
					
					// Verifico no haberlo cargado antes (duplicado)
					if(in_array($link_02['link'][$j], $sitio_final)){
						echo "ya existe: ".$link_02['link'][$j]."<br>";
					}else{
						echo "es nuevo<br>";
						$sitio_02[] = $link_02['link'][$j];
						$sitio_final[] = $link_02['link'][$j];
						$link_03 = $mycrawler->crawlLinks($link_02['link'][$j]);

						// for each link 03
						for($k=0;$k<sizeof($link_03['link']);$k++)
						{
							// Verifico que este dentro del dominio
							$dominio_03 = substr($link_03['link'][$k], 0, 24);
							if($dominio_03 != "http://www.unsam.edu.ar/escuelas/humanidades/"){
								echo "No pertenece al dominio UNSAM: <em>".$link_03['link'][$k]."</em><br>";
							}else{
								if(in_array($link_03['link'][$k], $sitio_final)){
									echo "ya existe: ".$link_03['link'][$k]."<br>";
								}else{
									echo "es nuevo<br>";
									$sitio_03[] = $link_03['link'][$k];
									$sitio_final[] = $link_03['link'][$k];
									$link_04 = $mycrawler->crawlLinks($link_03['link'][$k]);

									// for each link 04
									for($m=0;$m<sizeof($link_04['link']);$m++)
									{
										// Verifico que este dentro del dominio
										$dominio_04 = substr($link_03['link'][$m], 0, 24);
										if($dominio_04 != "http://www.unsam.edu.ar/escuelas/humanidades/"){
											echo "No pertenece al dominio UNSAM: <em>".$link_03['link'][$m]."</em><br>";
										}else{
											if(in_array($link_04['link'][$m], $sitio_final)){
												echo "ya existe: ".$link_04['link'][$m]."<br>";
											}else{
												echo "es nuevo<br>";
											}
										}
									// Espero
									time_sleep_until(time()+1);
									}
								}
							}
						// Espero
						time_sleep_until(time()+1);
						}
					}
				}
			// Espero
			time_sleep_until(time()+1);
			}
		}
	// Espero
	time_sleep_until(time()+1);
	}


echo "<pre>";
print_r($sitio_final);
echo "</pre>";







?>