<?php
/**
 * @package TestFran
 * @version 1.6
 */
/*
Plugin Name: Hello Dolly
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Matt Mullenweg
Version: 1.6
Author URI: http://ma.tt/
*/

function do_anything() {
    //$model=new LoginForm;
	//$model->validate();
	//$model->login();
}
add_action('wp_login', 'do_anything');

function poyo(){
	add_menu_page( 'Data Ferro', 'Data Ferro', 'manage_options',"data-ferro" ,dataFerroTest, '',76 );
	
}
function dataFerroTest(){
	//$secciones= ["jugador","partido","campeonato","club","categoria"];
	$secciones= ["jugador"];
	foreach($secciones as $seccion){
		?>
		<h3 style="text-transform:capitalize"><?php echo $seccion; ?></h3>
		<a href="<?php echo home_url().'/'.$seccion.'/create'; ?>" target="_blank">Crear</a>
		<a href="<?php echo home_url().'/'.$seccion.'/admin'; ?>" target="_blank">Administrar</a>
		<hr>
		<?php
	}
	?>
	<h3 style="text-transform:capitalize">Directores Técnicos</h3>
		<a href="<?php echo home_url().'/'."staff".'/create'; ?>" target="_blank">Crear</a>
		<a href="<?php echo home_url().'/'."staff".'/admin'; ?>" target="_blank">Administrar</a>
		<hr>
	<h3>Datos Especiales</h3>
		<a href="<?php echo home_url().'/'."dataExtra".'/proximo'; ?>" >Editar Próximo Partido</a>
		<a href="<?php echo home_url().'/'."dataExtra".'/resultados'; ?>" >Editar Estadísticas totales</a>
		<hr>
	<?php
}

add_action('admin_menu', 'poyo');
?>
