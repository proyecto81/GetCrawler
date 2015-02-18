<?php
include_once('../simple_html_dom.php');

echo print_r(file_get_html('http://www.unsam.edu.ar/escuelas/humanidades/centros/cedesi/_presentacion.asp')->plaintext);
?>