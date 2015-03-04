<?PHP
	require_once("App/class/SitioWeb.php");
	$Sitio = new SitioWeb();
	$rsSitio = $Sitio->getSitio(2);
?>
<!-- Meta data -->
<meta http-equiv="Content-Type" content="text/html; UTF-8"/>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Language" content="es"/>

<!-- Meta Autor -->
<?PHP echo $rsSitio['meta_autor']; ?>

<!-- Meta Robots -->
<?PHP echo $rsSitio['meta_robots']; ?>

<!-- Favicon -->
<?PHP echo $rsSitio['favicon']; ?>

<!-- Meta Lenguage -->
<?PHP echo $rsSitio['meta_lang']; ?>

<!-- Meta Location -->
<?PHP echo $rsSitio['meta_location']; ?>

<!-- Meta KeyWords -->
<?PHP if(isset($meta_kwords) && $meta_kwords != ""){ ?>
	<meta name="keywords" content="<?PHP echo utf8_decode($meta_kwords); ?>">
<?PHP }else{ ?>
    <meta name="keywords" content="<?PHP echo $rsSitio['meta_keywords']; ?>">
<?PHP } ?>

<!-- Meta Description -->
<?PHP if(isset($meta_desc) && $meta_desc != ""){ ?>
    <meta name="description" content="<?PHP echo $meta_desc; ?>">
<?PHP }else{ ?>
    <meta name="description" content="<?PHP echo $rsSitio['meta_description']; ?>">
<?PHP } ?>


<!-- Title -->
<?PHP if(isset($meta_titulo)){ ?>
<meta name="title" content="<?PHP echo utf8_decode($meta_titulo); ?>">
<title><?PHP echo utf8_decode($meta_titulo); ?></title>
<?PHP }else{ ?>
<meta name="title" content="<?PHP echo $rsSitio['meta_title']; ?>">
<title><?PHP echo $rsSitio['meta_title']; ?></title>
<?PHP } ?>


<!-- Etiquetas para Facebook -->
<?PHP if(isset($meta_titulo)){ ?>
<meta property="og:title" content="<?PHP echo utf8_decode($meta_titulo); ?>" />
<?PHP }else{ ?>
<meta property="og:title" content="<?PHP echo $rsSitio['meta_title']; ?>" />
<?PHP } ?>
<meta property="og:site_name" content="<?PHP echo $rsSitio['meta_title']; ?>" />
<meta property="og:image" content="http://www.conciliodelsur.com.ar/images/layout/logo_concilio.jpg"; />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?PHP echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />
<?PHP if(isset($meta_desc)){ ?>
<meta property="og:description" content="<?PHP echo $meta_desc; ?>" />
<?PHP } ?>

<!-- Meta Herramientas Google y GA -->
<?PHP echo $rsSitio['google_site_verification']; ?>

<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="css/normalize.css"/>
<link rel="stylesheet" type="text/css" href="css/basics.css"/>
<link rel="stylesheet" type="text/css" href="css/p81grid/gs6_01.css"/>

<!-- Template -->
<link rel="stylesheet" type="text/css" href="template/css/styles.css"/>
<!-- Menu -- | Menu Creado con http://cssmenumaker.com -->
<link rel="stylesheet" type="text/css" href="template/cssmenu/menu_source/styles.css"/>
<!-- Typos -->
<link href='http://fonts.googleapis.com/css?family=Jim+Nightshade' rel='stylesheet' type='text/css'>

<!-- Google Analitycs -->
<?PHP echo $rsSitio['google_analitycs']; ?>
