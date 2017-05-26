<?php

$kopa_layout = array(
    'blog-2' => array(
        'title'      => __( 'Blog 2', 'newsmaxx' ),
        'thumbnails' => 'blog-2.png',
        'positions'  => array(
            'position_1',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12'
        ),
    ),
    'blog-1' => array(
        'title'      => __( 'Blog 1', 'newsmaxx' ),
        'thumbnails' => 'blog-1.png',
        'positions'  => array(
            'position_1',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12'
        ),
    ),
    'page' => array(
        'title'      => __( 'Page', 'newsmaxx' ),
        'thumbnails' => 'page.png',
        'positions'  => array(
            'position_5',
            'position_9',
            'position_10',
            'position_11',
            'position_12'
        ),
    ),
    'page-full-width' => array(
        'title'      => __( 'Page Full Width', 'newsmaxx' ),
        'thumbnails' => 'page-full-width.png',
        'positions'  => array(
            'position_9',
            'position_10',
            'position_11',
            'position_12'
        ),
    ),
    'single' => array(
        'title'      => __( 'Single', 'newsmaxx' ),
        'thumbnails' => 'single.png',
        'positions'  => array(
            'position_5',
            'position_9',
            'position_10',
            'position_11',
            'position_12'
        ),
    ),
    'error-404' => array(
        'title' => __( '404 Page', 'newsmaxx' ),
        'thumbnails' => 'error-404.png',
        'positions'  => array(
            'position_5',
            'position_9',
            'position_10',
            'position_11',
            'position_12'
        ),
    ),
);

$kopa_sidebar_position = array(
    'position_1'  => array( 'title' => __( 'Widget Area 1', 'newsmaxx' ) ),
    'position_2'  => array( 'title' => __( 'Widget Area 2', 'newsmaxx' ) ),
    'position_3'  => array( 'title' => __( 'Widget Area 3', 'newsmaxx' ) ),
    'position_4'  => array( 'title' => __( 'Widget Area 4', 'newsmaxx' ) ),
    'position_5'  => array( 'title' => __( 'Widget Area 5', 'newsmaxx' ) ),
    'position_6'  => array( 'title' => __( 'Widget Area 6', 'newsmaxx' ) ),
    'position_7'  => array( 'title' => __( 'Widget Area 7', 'newsmaxx' ) ),
    'position_8'  => array( 'title' => __( 'Widget Area 8', 'newsmaxx' ) ),
    'position_9'  => array( 'title' => __( 'Widget Area 9', 'newsmaxx' ) ),
    'position_10' => array( 'title' => __( 'Widget Area 10', 'newsmaxx' ) ),
    'position_11' => array( 'title' => __( 'Widget Area 11', 'newsmaxx' ) ),
    'position_12' => array( 'title' => __( 'Widget Area 12', 'newsmaxx' ) ),
);

$kopa_template_hierarchy = array(
    'home'       => array(
        'title'  => __( 'Home', 'newsmaxx' ),
        'layout' => array('blog-1', 'blog-2')
    ),
    'post'       => array(
        'title'  => __( 'Post', 'newsmaxx' ),
        'layout' => array('single')
    ),
    'page'       => array(
        'title'  => __( 'Page', 'newsmaxx' ),
        'layout' => array('page', 'page-full-width')
    ),
    'taxonomy'   => array(
        'title'  => __( 'Taxonomy', 'newsmaxx' ),
        'layout' => array('blog-1', 'blog-2')
    ),
    'search'     => array(
        'title'  => __( 'Search', 'newsmaxx' ),
        'layout' => array('blog-1', 'blog-2')
    ),
    'archive'    => array(
        'title'  => __( 'Archive', 'newsmaxx' ),
        'layout' => array('blog-1', 'blog-2')
    ),
    'tag' => array(
        'title'  => __( 'Tag', 'newsmaxx' ),
        'layout' => array('blog-1', 'blog-2')
    ),
    '_404'    => array(
        'title'  => __( '404', 'newsmaxx' ),
        'layout' => array('page')
    )
);

define('KOPA_INIT_VERSION', 'newsmaxx-setting-version-01');
define('KOPA_LAYOUT', serialize($kopa_layout));
define('KOPA_SIDEBAR_POSITION', serialize($kopa_sidebar_position));
define('KOPA_TEMPLATE_HIERARCHY', serialize($kopa_template_hierarchy));

function kopa_initial_database() {
    $kopa_is_database_setup = get_option('kopa_is_database_setup');
    if ($kopa_is_database_setup !== KOPA_INIT_VERSION) {
        $kopa_setting = array(
            'home' => array(
                'layout_id' => 'blog-1',
                'sidebars'  => array(
                    'blog-1' => array(
                        'position_1' => '',
                        'position_5' => 'sidebar_5',
                        'position_6' => 'sidebar_6',
                        'position_7' => 'sidebar_7',
                        'position_8' => 'sidebar_8',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    ),
                    'blog-2' => array(
                        'position_1' => '',
                        'position_5' => 'sidebar_5',
                        'position_6' => 'sidebar_6',
                        'position_7' => 'sidebar_7',
                        'position_8' => 'sidebar_8',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    )
                )
            ),
            'post' => array(
                'layout_id' => 'single',
                'sidebars'  => array(
                    'single' => array(
                        'position_5' => 'sidebar_5',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    )
                )
            ),
            'page' => array(
                'layout_id' => 'page',
                'sidebars'  => array(
                    'page' => array(
                        'position_5' => 'sidebar_5',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    ),
                    'page-full-width' => array(
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    )
                )
            ),
            'taxonomy' => array(
                'layout_id' => 'blog-1',
                'sidebars'  => array(
                    'blog-1' => array(
                        'position_5' => 'sidebar_5',
                        'position_6' => 'sidebar_6',
                        'position_7' => 'sidebar_7',
                        'position_8' => 'sidebar_8',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    ),
                    'blog-2' => array(
                        'position_5' => 'sidebar_5',
                        'position_6' => 'sidebar_6',
                        'position_7' => 'sidebar_7',
                        'position_8' => 'sidebar_8',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    )
                )
            ),
            'search' => array(
                'layout_id' => 'blog-1',
                'sidebars'  => array(
                    'blog-1' => array(
                        'position_5' => 'sidebar_5',
                        'position_6' => 'sidebar_6',
                        'position_7' => 'sidebar_7',
                        'position_8' => 'sidebar_8',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    ),
                    'blog-2' => array(
                        'position_5' => 'sidebar_5',
                        'position_6' => 'sidebar_6',
                        'position_7' => 'sidebar_7',
                        'position_8' => 'sidebar_8',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    )
                )
            ),
            'archive' => array(
                'layout_id' => 'blog-1',
                'sidebars'  => array(
                    'blog-1' => array(
                        'position_5' => 'sidebar_5',
                        'position_6' => 'sidebar_6',
                        'position_7' => 'sidebar_7',
                        'position_8' => 'sidebar_8',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    ),
                    'blog-2' => array(
                        'position_5' => 'sidebar_5',
                        'position_6' => 'sidebar_6',
                        'position_7' => 'sidebar_7',
                        'position_8' => 'sidebar_8',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    )
                )
            ),
            'tag' => array(
                'layout_id' => 'blog-1',
                'sidebars'  => array(
                    'blog-1' => array(
                        'position_5' => 'sidebar_5',
                        'position_6' => 'sidebar_6',
                        'position_7' => 'sidebar_7',
                        'position_8' => 'sidebar_8',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    ),
                    'blog-2' => array(
                        'position_5' => 'sidebar_5',
                        'position_6' => 'sidebar_6',
                        'position_7' => 'sidebar_7',
                        'position_8' => 'sidebar_8',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    )
                )
            ),
            '_404' => array(
                'layout_id' => 'error-404',
                'sidebars'  => array(
                    'error-404' => array(
                        'position_5' => 'sidebar_5',
                        'position_9' => 'sidebar_9',
                        'position_10' => 'sidebar_10',
                        'position_11' => 'sidebar_11',
                        'position_12' => 'sidebar_12'
                    )
                )
            ),
        );

        $kopa_sidebar = array(
            array(
                'sidebar_key' => 'sidebar_0',
                'sidebar_name' => __( '-- None --', 'newsmaxx' ),
                'sidebar_des' => __( 'Hiden sidebar', 'newsmaxx' )
            ),
            array(
                'sidebar_key' => 'sidebar_5',
                'sidebar_name' => __( 'Sidebar Top', 'newsmaxx' ),
                'sidebar_des' => __( 'Display articles by group such as Entertainment, New media, etc', 'newsmaxx' )
            ),
            array(
                'sidebar_key' => 'sidebar_6',
                'sidebar_name' => __( 'Sidebar Center Left', 'newsmaxx' ),
                'sidebar_des' => __( 'Display the list of categories', 'newsmaxx' )
            ),
            array(
                'sidebar_key' => 'sidebar_7',
                'sidebar_name' => __( 'Sidebar Center Right', 'newsmaxx' ),
                'sidebar_des' => __( 'Display the list of archives', 'newsmaxx' )
            ),
            array(
                'sidebar_key' => 'sidebar_8',
                'sidebar_name' => __( 'Sidebar Bottom', 'newsmaxx' ),
                'sidebar_des' => __( 'Display the list of tags, new gallery and the articles ordered by ramdom, popular, comment', 'newsmaxx' )
            ),
            array(
                'sidebar_key' => 'sidebar_9',
                'sidebar_name' => __( 'Footer 1', 'newsmaxx' ),
                'sidebar_des' => __( 'Show feedburner email subscription', 'newsmaxx' )
            ),
            array(
                'sidebar_key' => 'sidebar_10',
                'sidebar_name' => __( 'Footer 2', 'newsmaxx' ),
                'sidebar_des' => __( 'Show recent tweets', 'newsmaxx' )
            ),
            array(
                'sidebar_key' => 'sidebar_11',
                'sidebar_name' => __( 'Footer 3', 'newsmaxx' ),
                'sidebar_des' => __( 'Show photos on flickr', 'newsmaxx' )
            ),
            array(
                'sidebar_key' => 'sidebar_12',
                'sidebar_name' => __( 'Footer 4', 'newsmaxx' ),
                'sidebar_des' => __( 'Show contact info', 'newsmaxx' )
            )
        );
        update_option('kopa_setting', $kopa_setting);
        update_option('kopa_sidebar', $kopa_sidebar);
        update_option('kopa_is_database_setup', KOPA_INIT_VERSION);
    }
}

/* Register widget areas */
add_action( 'widgets_init', 'kopa_sidebars_init' );

function kopa_sidebars_init() {
    $kopa_sidebar = get_option('kopa_sidebar');

    if ( empty( $kopa_sidebar ) || ! is_array( $kopa_sidebar ) ) {
        return;
    }
    foreach ($kopa_sidebar as $key => $value) {
        if ( '-- None --' === $value['sidebar_name'] ) {
            continue;
        }
        $sidebar_args = array(
            'name'          => $value['sidebar_name'],
            'description'   => isset($value['sidebar_des']) ? $value['sidebar_des'] : '',
            'id'            => $value['sidebar_key'],
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        );

        register_sidebar( $sidebar_args );
    }
}
