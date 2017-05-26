<?php
get_header();
global $kopa_setting;
$sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
$kopa_layout = unserialize(KOPA_LAYOUT);
$kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
?>

<div class="wrapper clearfix">

    <div class="main-col pull-left">

        <?php kopa_breadcrumb();?>
        <!-- breadcrumb -->
        <section class="elements-box">
            <?php get_template_part( 'library/templates/loop', 'page' ); ?>
        </section>
    </div>
    <!-- main-col -->
    <div class="clear"></div>

</div>
<!-- wrapper -->
<?php get_footer(); ?>
