<?php
add_action('after_setup_theme', 'blankslate_setup');
function blankslate_setup()
{
    load_theme_textdomain('blankslate', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'blankslate')));
}
add_action('wp_enqueue_scripts', 'blankslate_load_scripts');
function blankslate_load_scripts()
{
    wp_enqueue_style('blankslate-style', get_stylesheet_uri());
    wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/custom.css');
    wp_enqueue_style('font-lato-css', 'https://fonts.googleapis.com/css?family=Lato&display=swap');
    wp_enqueue_style('font-poppins-css', 'https://fonts.googleapis.com/css?family=Poppins&display=swap');

    wp_enqueue_script('jquery');
}
add_action('wp_footer', 'blankslate_footer_scripts');
function blankslate_footer_scripts()
{
    ?>
    <script>
        jQuery(document).ready(function($) {
            var deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass("ios");
                $("html").addClass("mobile");
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </script>
<?php
}
add_filter('document_title_separator', 'blankslate_document_title_separator');
function blankslate_document_title_separator($sep)
{
    $sep = '|';
    return $sep;
}
add_filter('the_title', 'blankslate_title');
function blankslate_title($title)
{
    if ($title == '') {
        return '...';
    } else {
        return $title;
    }
}
add_filter('the_content_more_link', 'blankslate_read_more_link');
function blankslate_read_more_link()
{
    if (!is_admin()) {
        return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">...</a>';
    }
}
add_filter('excerpt_more', 'blankslate_excerpt_read_more_link');
function blankslate_excerpt_read_more_link($more)
{
    if (!is_admin()) {
        global $post;
        return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">...</a>';
    }
}
add_filter('intermediate_image_sizes_advanced', 'blankslate_image_insert_override');
function blankslate_image_insert_override($sizes)
{
    unset($sizes['medium_large']);
    return $sizes;
}
add_action('widgets_init', 'blankslate_widgets_init');
function blankslate_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar Widget Area', 'blankslate'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('wp_head', 'blankslate_pingback_header');
function blankslate_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
function blankslate_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
function blankslate_custom_pings($comment)
{
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter('get_comments_number', 'blankslate_comment_count', 0);
function blankslate_comment_count($count)
{
    if (!is_admin()) {
        global $id;
        $get_comments = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

function get_about()
{
    $templates = array();
    $templates[] = 'about.php';

    locate_template($templates, true);
}
function get_projects()
{
    $templates = array();
    $templates[] = 'projects.php';

    locate_template($templates, true);
}
function get_testimonials()
{
    $templates = array();
    $templates[] = 'testimonials.php';

    locate_template($templates, true);
}

function get_services()
{
    $templates = array();
    $templates[] = 'services.php';

    locate_template($templates, true);
}

function get_latestnews()
{
    $templates = array();
    $templates[] = 'latestnews.php';

    locate_template($templates, true);
}

function get_counter()
{
    $templates = array();
    $templates[] = 'counter.php';

    locate_template($templates, true);
}

function get_ourteam()
{
    $templates = array();
    $templates[] = 'ourteam.php';

    locate_template($templates, true);
}

function get_contactus()
{
    $templates = array();
    $templates[] = 'contactus.php';

    locate_template($templates, true);
}

function get_singleheader()
{
    $templates = array();
    $templates[] = 'singleheader.php';

    locate_template($templates, true);
}

/**
 * Font Awesome Kit Setup
 * 
 * This will add your Font Awesome Kit to the front-end, the admin back-end,
 * and the login screen area.
 */
if (!function_exists('fa_custom_setup_kit')) {
    function fa_custom_setup_kit($kit_url = '')
    {
        foreach (['wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts'] as $action) {
            add_action(
                $action,
                function () use ($kit_url) {
                    wp_enqueue_script('font-awesome-kit', $kit_url, [], null);
                }
            );
        }
    }
}

fa_custom_setup_kit('https://kit.fontawesome.com/26e6f3a379.js');

include(get_stylesheet_directory() . '/includes/customizer.php');


function wpmu_create_post_type_projects() {
	$labels = array( 
		'name' => __( 'Projects', 'wpmu' ),
		'singular_name' => __( 'Project', 'wpmu' ),
		'add_new' => __( 'New Project', 'wpmu' ),
		'add_new_item' => __( 'Add New Project', 'wpmu' ),
		'edit_item' => __( 'Edit Project', 'wpmu' ),
		'new_item' => __( 'New Project', 'wpmu' ),
		'view_item' => __( 'View Project', 'wpmu' ),
		'search_items' => __( 'Search Projects', 'wpmu' ),
		'not_found' =>  __( 'No Projects Found', 'wpmu' ),
		'not_found_in_trash' => __( 'No Projects found in Trash', 'wpmu' ),
	);
	$args = array(
		'labels' => $labels,
		'has_archive' => false,
        'public' => true,
        'menu_icon' => 'dashicons-images-alt',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'projects' ),
		'supports' => array(
			'title', 
			'thumbnail', 
		)
	);
	register_post_type( 'project', $args );
} 
add_action( 'init', 'wpmu_create_post_type_projects' );

function wpmu_create_post_type_testimonials() {
	$labels = array( 
		'name' => __( 'Testimonials', 'wpmu' ),
		'singular_name' => __( 'Testimonial', 'wpmu' ),
		'add_new' => __( 'New Testimonial', 'wpmu' ),
		'add_new_item' => __( 'Add New Testimonial', 'wpmu' ),
		'edit_item' => __( 'Edit Testimonial', 'wpmu' ),
		'new_item' => __( 'New Testimonial', 'wpmu' ),
		'view_item' => __( 'View Testimonial', 'wpmu' ),
		'search_items' => __( 'Search Testimonials', 'wpmu' ),
		'not_found' =>  __( 'No Testimonials Found', 'wpmu' ),
		'not_found_in_trash' => __( 'No Testimonials found in Trash', 'wpmu' ),
	);
	$args = array(
		'labels' => $labels,
		'has_archive' => false,
        'public' => true,
        'menu_icon' => 'dashicons-businessman',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'testimonials' ),
		'supports' => array(
			'title', 
            'thumbnail', 
            'editor'
		)
	);
	register_post_type( 'testimonial', $args );
} 
add_action( 'init', 'wpmu_create_post_type_testimonials' );

function wpmu_create_post_type_news() {
	$labels = array( 
		'name' => __( 'News', 'wpmu' ),
		'singular_name' => __( 'News', 'wpmu' ),
		'add_new' => __( 'New News', 'wpmu' ),
		'add_new_item' => __( 'Add New News', 'wpmu' ),
		'edit_item' => __( 'Edit News', 'wpmu' ),
		'new_item' => __( 'New News', 'wpmu' ),
		'view_item' => __( 'View News', 'wpmu' ),
		'search_items' => __( 'Search News', 'wpmu' ),
		'not_found' =>  __( 'No News Found', 'wpmu' ),
		'not_found_in_trash' => __( 'No News found in Trash', 'wpmu' ),
	);
	$args = array(
		'labels' => $labels,
		'has_archive' => false,
        'public' => true,
        'menu_icon' => 'dashicons-welcome-write-blog',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'news' ),
		'supports' => array(
			'title', 
            'thumbnail', 
            'editor'
		)
	);
	register_post_type( 'news', $args );
} 
add_action( 'init', 'wpmu_create_post_type_news' );

function remove_from_admin_bar($wp_admin_bar) {
    if ( ! is_admin() ) {
        $wp_admin_bar->remove_node('search');
    } 
    $wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'remove_from_admin_bar');

add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
 
function add_my_post_types_to_query( $query ) {
    if ( $query->is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'project' ) );
    return $query;
}
register_nav_menus( array( 'main-footer' => esc_html__( 'Main Footer', 'Illdy-clone' ) ) );