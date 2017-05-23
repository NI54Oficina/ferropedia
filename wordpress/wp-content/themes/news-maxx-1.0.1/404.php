<?php
    get_header();
    $kopa_setting = kopa_get_template_setting();
    $sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
?>
<div class="wrapper clearfix">

    <div class="main-col pull-left">
        <?php kopa_breadcrumb(); ?>
        <!-- breadcrumb -->
        <section class="error-404 clearfix">
            <div class="left-col">
                <p><?php _e( '404', 'newsmaxx' ); ?></p>
            </div><!--left-col-->
            <div class="right-col">
                <h1<?php _e( 'Page not found...', 'newsmaxx' ); ?></h1>
                <p><?php _e( "We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of these options:", 'newsmaxx' ); ?></p>
                <ul class="arrow-list">
                    <li><a href="javascript: history.go(-1);"><?php _e( 'Go back to previous page', 'newsmaxx' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Go to homepage', 'newsmaxx' ); ?></a></li>
                </ul>
            </div><!--right-col-->
        </section><!--error-404-->
    </div>
    <!-- main-col -->

    <div class="sidebar widget-area-2 pull-left">
        <?php
        if ( is_active_sidebar( $sidebars[$kopa_position[0]] ) ) {
            dynamic_sidebar($sidebars[$kopa_position[0]]);
        }
        ?>
    </div>
    <!-- widget-area-2 -->

    <div class="clear"></div>

</div>
<!-- wrapper -->
<?php get_footer(); ?>
