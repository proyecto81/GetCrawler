<?PHP
error_reporting(E_ALL ^ E_NOTICE);

include('simple_html_dom.php');
include("GenerarPagina.php");

if (isset($_POST['url'])) {

    $tem_a = $_POST['tem_a'];

    $links_sec = $_POST['links_sec'];
    $links_ter = $_POST['links_ter'];

    $GenSite = new CrearSitio();
    $GenSite->generarPagina($_POST['url'], $tem_a, $links_sec, $links_ter);
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
            <div class="col span_4_of_12">
                <h1>Capturador Web / 2015</h1>
            </div>
        </div>
    </header>
    <form id="webparser" name="webparser" method="post" action="">
        <section id="contenido">
            <div id="maincont" class="section group">
                <div class="col span_10_of_12">
                    <p>Ultima enviada:<strong>
                            <?PHP if (isset($_POST['url'])) {
                                echo $_POST['url'];
                            } ?>
                        </strong></p>
                    <label for="url">URL del Sitio<br />
                        <input name="url" type="text" id="url" style="width:90%" value="" />
                    </label>
                    <div class="separador"></div>
                    <label for="links_sec">links_sec<br />
                        <input name="links_sec" type="text" id="links_sec" style="width:70%" value="<?PHP if (isset($_POST['links_sec'])) {
                                                                                                        echo $_POST['links_sec'];
                                                                                                    } ?>" />
                    </label>
                    <div class="separador"></div>
                    <label for="links_ter">links_ter<br />
                        <input name="links_ter" type="text" id="links_ter" style="width:70%" value="<?PHP if (isset($_POST['links_ter'])) {
                                                                                                        echo $_POST['links_ter'];
                                                                                                    } ?>" />
                    </label>
                    <div class="separador"></div>
                    template a
                    <select name="tem_a" id="tem_a">
                        <option value="1">1</option>
                        <option value="2" selected="selected">2</option>
                    </select>
                    <div class="separador"></div>

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