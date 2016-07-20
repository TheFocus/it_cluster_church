<?php
add_action( 'after_setup_theme', 'team_setup' );
function team_setup()
{
load_theme_textdomain( 'team', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );
add_theme_support( 'html5', array( 'search-form' ) );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'team' ), 'footer-menu' => __( 'Footer Menu', 'team' ) )
);
}
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
add_theme_support( 'woocommerce' );
}
add_action( 'wp_enqueue_scripts', 'team_load_scripts' );
function team_load_scripts()
{
wp_enqueue_style( 'team-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
wp_register_script( 'team-videos', get_template_directory_uri() . '/js/videos.js' );
wp_enqueue_script( 'team-videos' );
}
add_action( 'wp_head', 'team_print_custom_scripts', 99 );
function team_print_custom_scripts()
{
if ( !is_admin() ) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
$("#wrapper").vids();
});
</script>
<?php
}
}
add_filter( 'document_title_separator', 'team_document_title_separator' );
function team_document_title_separator( $sep ) {
$sep = "|";
return $sep;
}
add_filter( 'the_title', 'team_title' );
function team_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_action( 'widgets_init', 'team_widgets_init' );
function team_widgets_init()
{
register_sidebar( array (
'name' => __( 'Header Widget Area', 'team' ),
'id' => 'header-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array (
'name' => __( 'Footer Widget Area', 'team' ),
'id' => 'footer-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'team' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'comment_form_before', 'team_enqueue_comment_reply_script' );
function team_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
function team_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'team_comment_count', 0 );
function team_comment_count( $count ) {
if ( ! is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}
define( 'NO_HEADER_TEXT', true );
function team_customizer( $wp_customize ) {
$wp_customize->add_setting(
'team_link_color',
array(
'default' => '#ee581d',
'sanitize_callback' => 'sanitize_hex_color',
'transport' => 'postMessage'
)
);
$wp_customize->add_control(
new WP_Customize_Color_Control(
$wp_customize,
'link_color',
array(
'label' => __( 'Link Color', 'team' ),
'section' => 'colors',
'settings' => 'team_link_color'
)
)
);
$wp_customize->add_setting(
'team_header_color',
array(
'default' => '#ee581d',
'sanitize_callback' => 'sanitize_hex_color',
'transport' => 'postMessage'
)
);
$wp_customize->add_control(
new WP_Customize_Color_Control(
$wp_customize,
'header_color',
array(
'label' => __( 'Header Text Color', 'team' ),
'section' => 'colors',
'settings' => 'team_header_color'
)
)
);
$wp_customize->add_section(
'team_fonts',
array(
'title' => 'Fonts',
'priority' => 200
)
);
$wp_customize->add_setting(
'team_header_font',
array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport' => 'postMessage'
)
);
$wp_customize->add_control(
new WP_Customize_Control(
$wp_customize,
'header_font',
array(
'label' => __( 'Header Text Font', 'team' ),
'section' => 'team_fonts',
'settings' => 'team_header_font'
)
)
);
$wp_customize->get_panel( 'nav_menus' )->active_callback = '__return_false';
}
add_action( 'customize_register', 'team_customizer', 20 );
function team_customizer_css() {
?>
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=<?php echo esc_html( ucwords( str_replace( ' ', '+', get_theme_mod( 'team_header_font' ) ) ) ); ?>);
a{color:<?php echo esc_html( get_theme_mod( 'team_link_color' ) ); ?>}
h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{font-family:"<?php echo esc_html( ucwords( str_replace( '+', ' ', get_theme_mod( 'team_header_font' ) ) ) ); ?>";color:<?php echo esc_html( get_theme_mod( 'team_header_color' ) ); ?>}
</style>
<?php
}
add_action( 'wp_head', 'team_customizer_css' );
function team_customizer_preview() {
wp_enqueue_script(
'team-theme-customizer',
get_template_directory_uri() . '/js/customizer.js',
array( 'jquery', 'customize-preview' ),
'0.3.0',
true
);
}
add_action( 'customize_preview_init', 'team_customizer_preview' );
function team_customizer_fonts_preview() {
wp_enqueue_style( 'team-google-fonts', 'https://fonts.googleapis.com/css?family=' . esc_html( ucwords( str_replace( ' ', '+', get_theme_mod( 'team_header_font' ) ) ) ) . '' );
}
add_action( 'customize_preview_init', 'team_customizer_fonts_preview' );