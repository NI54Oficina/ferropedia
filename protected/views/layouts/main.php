<?php
$kopa_header = 'style-3';

get_template_part('library/templates/header', $kopa_header);
 ?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.min.css" >
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" >
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-theme.css" >
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datetimepicker.css" >
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" >
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/datatables/datatables.min.css"/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datetimepicker.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/js.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatables/datatables.js"></script>

<div style="padding:10px;" id="nav-admin">
<?php if(is_user_logged_in()){ ?>
<?php
$secciones= ["jugador","partido","campeonato","club","categoria"];
	foreach($secciones as $seccion){
		?>
		<div style="display:inline-block;width:200px;" class="btn-nav">
		<h3 style="text-transform:capitalize;padding-top:0;"><?php echo $seccion; ?></h3>
		<a href="<?php echo home_url().'/'.$seccion.'/create'; ?>" >Crear</a><span> / </span>
		<a href="<?php echo home_url().'/'.$seccion.'/admin'; ?>" >Administrar</a>
		<hr>
		</div>
		<?php
	}
	?>
</div>
	<?php } ?>
<div class="content-admin">
	<?php
		// echos Yii content
	     echo $content;
	?>
</div>


<script>
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Seguro que desea borrarlo?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>

<style>
#nav-admin{color:black;}

#nav-admin .btn-nav{
}
.content-admin{color:black;padding:20px;background-color:rgba(255,255,255,0.8);}
.content-admin table{color:black;}
.content-admin #sidebar{display:none;}
.content-admin .form-group{max-width:600px;}
.content-admin button, .admin-submit,[type=submit],.label-show{padding:10px;border:none;border-radius:10px;font-size:16px;min-width:100px;background-color:#a43c93;margin-top:10px;color:white;}
.form_date{margin-bottom:10px;}
.content-admin .form{max-width:600px;}
.extra-data{width:100%;}
</style>

<?php get_footer(); ?>