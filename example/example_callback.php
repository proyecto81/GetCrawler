<?php
include_once('../simple_html_dom.php');


// 1. Write a function with parameter "$element"
function my_callback($element) {
    if ($element->tag=='input')
        $element->outertext = 'input';

    if ($element->tag=='img')
        $element->outertext = 'img';

    if ($element->tag=='a')
        $element->outertext = 'a';
}


// 2. create HTML Dom
$html = file_get_html('http://www.unsam.edu.ar/escuelas/humanidades/centros/cedesi/_presentacion.asp');


// 3. Register the callback function with it's function name
$html->set_callback('my_callback');


// 4. Callback function will be invoked while dumping
echo $html;
?>