<?php 

global $puestos;
$puestos=$model;
$kopa_setting = kopa_get_template_setting();
 $sidebars = $kopa_setting['sidebars'];
 
 
 get_template_part( 'library/templates/template', 'ficha-general' ); ?>