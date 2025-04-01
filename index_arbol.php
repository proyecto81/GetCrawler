<?PHP
if (isset($_POST['url'])) {
    error_reporting(E_ALL ^ E_NOTICE);

    include('simple_html_dom.php');
    include("Crawler.php");
    include("GenerarPagina.php");

    $dom_base = $_POST['dom_base'];
    $tam_base = strlen($dom_base);
    $url = $_POST['url'];

    $tem_a = $_POST['tem_a'];
    $tem_b = $_POST['tem_b'];

    $mycrawler = new Crawler();
    $GenSite   = new CrearSitio();

    $sitio_01 = array();
    $sitio_02 = array();
    $sitio_final = array();

    $link_01 = $mycrawler->crawlLinks($url);

    $GenSite->generarPagina($url, $tem_a);

    // for each link 01
    for ($i = 0; $i < sizeof($link_01['link']); $i++) {
        // Verifico que este dentro del dominio
        $dominio_01 = substr($link_01['link'][$i], 0, $tam_base);
        //echo $link_01['link'][$i]."<br>";

        $buscar_a = 'mailto';
        $buscar_b = '.pdf';
        $buscar_c = 'javascript:';
        $buscar_d = '../../';
        $bus_url_a = 'insti/_institucional.asp';
        $bus_url_b = 'oferta/carreras/_carreras.asp';
        $bus_url_c = 'investigacion/investigacion.asp';
        $bus_url_d = 'arte/_arte.asp';
        $bus_url_e = 'comunidad/comunidad.asp';
        $bus_url_f = 'alumnos/_alumnos.asp';
        $bus_url_g = '#contenido';
        $bus_url_h = 'home/_c_llegar.asp';

        $pos_a = stripos($link_01['link'][$i], $buscar_a);
        $pos_b = stripos($link_01['link'][$i], $buscar_b);
        $pos_c = stripos($link_01['link'][$i], $buscar_c);
        $pos_d = stripos($link_01['link'][$i], $buscar_d);
        $url_a = stripos($link_01['link'][$i], $bus_url_a);
        $url_b = stripos($link_01['link'][$i], $bus_url_b);
        $url_c = stripos($link_01['link'][$i], $bus_url_c);
        $url_d = stripos($link_01['link'][$i], $bus_url_d);
        $url_e = stripos($link_01['link'][$i], $bus_url_e);
        $url_f = stripos($link_01['link'][$i], $bus_url_f);
        $url_g = stripos($link_01['link'][$i], $bus_url_g);
        $url_h = stripos($link_01['link'][$i], $bus_url_h);

        if (
            $pos_a === false &&
            $pos_b === false &&
            $pos_c === false &&
            $pos_d === false &&
            $url_a === false &&
            $url_b === false &&
            $url_c === false &&
            $url_d === false &&
            $url_e === false &&
            $url_f === false &&
            $url_g === false &&
            $url_h === false
        ) {
            $bsc_cont = '1';
        } else {
            $bsc_cont = '0';
        }

        // Verifico
        if ($bsc_cont == '1' && $url != $link_01['link'][$i] && $url != $dom_base && $link_01['link'][$i] != $dom_base) {
            if ($dominio_01 != $dom_base) {
                //echo "No pertenece al dominio UNSAM: <em>".$link_01['link'][$i]."</em><br>";
            } else {
                $sitio_01[] = $link_01['link'][$i];
                // SOLO PARA HUMANIDADES
                $link_final = str_replace('escuelas/humanidades/escuelas/humanidades/', 'escuelas/humanidades/', $link_01['link'][$i]);
                $link_final = str_replace('escuelas/humanidades/centros/c_cebj/escuelas/humanidades/', 'escuelas/humanidades/centros/c_cebj/', $link_final);
                $link_final = str_replace('centros/c_cebj/centros/c_cebj/', 'centros/c_cebj/', $link_final);

                if (!in_array($link_final, $sitio_final)) {
                    $sitio_final[] = $link_final;
                    $GenSite->generarPagina($link_final, $tem_b);
                }

                //$link_02 = $mycrawler->crawlLinks($link_01['link'][$i]);
            }
        } else {
            //echo "No es un LINK valido para clonar: <em>".$link_01['link'][$i]."</em><br>";
        }
    }

    echo "<pre>";
    print_r($sitio_final);
    echo "</pre>";
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
    <link rel="stylesheet" type="text/css" href="template/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="template/css/basics.css" />
    <link rel="stylesheet" type="text/css" href="template/css/respgrid.css" />
    <link rel="stylesheet" type="text/css" href="template/css/styles.css" />
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
                    <p>Ultima Dominio Base:<strong>
                            <?PHP if (isset($_POST['dom_base'])) {
                                echo $_POST['dom_base'];
                            } ?>
                        </strong></p>
                    <label for="dom_base">Dominio Base <br />
                        <input name="dom_base" type="text" id="dom_base" style="width:90%" value="" />
                    </label>
                    <div class="separador"></div>
                    <p>Ultima enviada:<strong>
                            <?PHP if (isset($_POST['url'])) {
                                echo $_POST['url'];
                            } ?>
                        </strong></p>
                    <label for="url">URL del Sitio<br />
                        <input name="url" type="text" id="url" style="width:90%" value="" />
                    </label>

                    <div class="separador"></div>

                    template a
                    <select name="tem_a" id="tem_a">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    template b
                    <select name="tem_b" id="tem_b">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="col span_2_of_12">&nbsp;
                    <input type="submit" name="submit" id="submit" value=" Use bajo su responsabilidad " />
                </div>
            </div>
            <div class="separador"></div>
            <div id="maincont" class="section group">
                <div class="col span_6_of_12 bg_green">
                    <?PHP if (isset($old_titulo)) {
                        echo htmlentities($old_titulo);
                    } ?>
                </div>
                <div class="col span_6_of_12 bg_green">
                    <?PHP if (isset($old_cont)) {
                        echo htmlentities($old_cont);
                    } ?>
                </div>
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