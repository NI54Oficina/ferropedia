<?php
get_header();
global $kopa_setting;
$sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
$kopa_layout = unserialize(KOPA_LAYOUT);
$kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
?>

<div class="wrapper clearfix">

    <div class="main-col pull-left">

        <?php kopa_breadcrumb(); ?>
        <!-- breadcrumb -->

        <section class="entry-list">
            <?php get_template_part( 'library/templates/loop', 'blog-2' ); ?>
        </section>
        <!-- entry-list -->

    </div>
    <!-- main-col -->

    <div class="sidebar widget-area-2 pull-left">
        <?php
        if ( is_active_sidebar( $sidebars[$kopa_position[0]] ) ) {
            dynamic_sidebar($sidebars[$kopa_position[0]]);
        }
        ?>

        <div class="widget-area-7 pull-left">

            <?php
            if ( is_active_sidebar( $sidebars[$kopa_position[1]] ) ) {
                dynamic_sidebar($sidebars[$kopa_position[1]]);
            }
            ?>

        </div>
        <!-- widget-area-7 -->

        <div class="widget-area-8 pull-left">

            <?php
            if ( is_active_sidebar( $sidebars[$kopa_position[2]] ) ) {
                dynamic_sidebar($sidebars[$kopa_position[2]]);
            }
            ?>

        </div>
        <!-- widget-area-8 -->

        <div class="clear"></div>

        <?php
        if ( is_active_sidebar( $sidebars[$kopa_position[3]] ) ) {
            dynamic_sidebar($sidebars[$kopa_position[3]]);
        }
        ?>

    </div>
    <!-- widget-area-2 -->

    <div class="clear"></div>

</div>
<!-- wrapper -->

<?php get_footer();?>