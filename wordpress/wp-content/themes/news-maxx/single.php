<?php

if( get_the_category()[0]->name=="Museo"||get_the_category()[0]->name=="Rincón del Mudo"){
	$kopa_setting = kopa_get_template_setting();
	//$sidebars = $kopa_setting['sidebars'];
	get_template_part( 'library/templates/layout', "single-gallery" );
}else if( get_the_category()[0]->name=="Evento"){
		$kopa_setting = kopa_get_template_setting();
	//$sidebars = $kopa_setting['sidebars'];
	get_template_part( 'library/templates/layout', "blog-preview" );

}else{
	$kopa_setting = kopa_get_template_setting();
	$sidebars = $kopa_setting['sidebars'];
	get_template_part( 'library/templates/layout', $kopa_setting['layout_id'] );
}

