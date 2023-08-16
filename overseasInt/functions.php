<?php

function register_my_menus()
{
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu')
        )
    );
}

add_action('init', 'register_my_menus');

add_theme_support('post-thumbnails');


function starter_scripts()
{
    wp_enqueue_style('owlTheme', get_template_directory_uri() . '/css/owl.theme.default.min.css', null, null);
    wp_enqueue_style('owl', get_template_directory_uri() . '/css/owl.carousel.min.css', null, null);
    wp_enqueue_style('style', get_stylesheet_uri(), array(), time());
    wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css', array(), time());
    wp_enqueue_script('loading', get_template_directory_uri() . '/js/loading.js', array('jquery'), time(), true);
    wp_enqueue_script('mouseMover', get_template_directory_uri() . '/js/mouseMover.js', array('jquery'), time(), true);

    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', null, null, true);
    wp_enqueue_script('jquery');

    wp_enqueue_script('topojson', 'https://unpkg.com/topojson@3.0.2/dist/topojson.min.js', '', '', true);
    wp_enqueue_script('d3', 'https://unpkg.com/d3@5.9.7/dist/d3.min.js', '', '', true);
    // wp_enqueue_script('owlcar', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '1.1.1', true);
    // wp_enqueue_script('functions', get_template_directory_uri() . '/js/darkmode.js', array(), time());
    wp_enqueue_script('functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), time(), true);
    wp_localize_script('functions', 'site', array(
        'siteurl' => get_site_url(),
        'theme_path' => get_template_directory_uri(),
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}

add_action('wp_enqueue_scripts', 'starter_scripts');

/**
 * add cookie consent
 */
function enqueue_cookie_consent_assets() {
    wp_enqueue_style( 'cookie-consent-css', 'https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.1/cookieconsent.min.css' );
    wp_enqueue_script( 'cookie-consent-js', 'https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.1/cookieconsent.min.js', array(), null, false );
}
add_action( 'wp_enqueue_scripts', 'enqueue_cookie_consent_assets' );

/**
 * AJAX nopriv
 */
add_action('wp_ajax_load-single-post', 'prefix_ajax_single_post');
add_action('wp_ajax_nopriv_load-single-post', 'prefix_ajax_single_post');

function prefix_ajax_single_post()
{
    $pid = (int)filter_input(INPUT_GET, 'pID', FILTER_SANITIZE_NUMBER_INT);
    if ($pid > 0) {
        global $post;
        $post = get_post($pid);
        setup_postdata($post);
        printf('<div class="pop" data-post-permalink="%s" id="single-post post-%d">', get_the_permalink($post), $pid);
        get_template_part('template-parts/content', 'profile');
        echo '</div>';
    }
    exit();
}

function remove_editor()
{
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);
        switch ($template) {
            case 'content-landing.php':
                remove_post_type_support('page', 'editor');
                break;
            default:
                break;
        }
    }
}

add_action('init', 'remove_editor');

function my_acf_admin_head()
{
?>
    <style type="text/css">
        .acf-flexible-content .layout .acf-fc-layout-handle {
            /*background-color: #00B8E4;*/
            background-color: #202428;
            color: #eee;
        }

        .acf-repeater.-row>table>tbody>tr>td,
        .acf-repeater.-block>table>tbody>tr>td {
            border-top: 2px solid #202428;
        }

        .acf-repeater .acf-row-handle {
            vertical-align: top !important;
            padding-top: 16px;
        }

        .acf-repeater .acf-row-handle span {
            font-size: 20px;
            font-weight: bold;
            color: #202428;
        }


        .acf-repeater .acf-row-handle .acf-icon.-minus {
            top: 30px;
        }
    </style>
<?php
}

add_action('wp_body_open', 'my_add_dark_mode_checker', 5);

function my_add_dark_mode_checker()
{?>
    <script>
        // (function() {
        //     const darkMode = localStorage.darkMode === 'true';
        //     if (darkMode) {
        //         document.querySelector('body').classList.add('is-dark');

        //         // activate the toggle
        //         document.addEventListener('DOMContentLoaded', () => {
        //             const $toggles = document.querySelectorAll('.dark-toggle input[type="checkbox"]');
        //             $toggles.forEach(($toggle) => {
        //                 $toggle.checked = true;
        //             });
        //         });
        //     }
        // })();
    </script>

<?php }

add_action('acf/input/admin_head', 'my_acf_admin_head');


function remove_menus()
{
   remove_menu_page('edit-comments.php');          //Comments
    // remove_menu_page('tools.php');                  //Tools
   // remove_menu_page('options-general.php');        //Settings
}
add_action('admin_menu', 'remove_menus');
// add_filter('acf/settings/show_admin', '__return_false');


// Global site tag (gtag.js) - Google Analytics
function add_google_analytics() {
    ?> 
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6F371C2W1K"></script>
    <script>
        var popup;
        window.addEventListener('load', function(){
            window.cookieconsent.initialise({
                type:'opt-in',
                theme: 'classic',
                palette:{
                    popup: {
                        background: "#000",
                        text: "#fff"
                    },
                    button: {
                        background: "#fff",
                        text: "#000"
                    }
                },
                onInitialise: function(status){
                    if(status == cookieconsent.status.allow) setCookie();
                },
                onStatusChange: function(status){
                    if(this.hasConsented()) setCookie();
                    else deleteCookies(this.options.cookie.name);
                }
            });
        });

        window.dataLayer = window.dataLayer || [];
        function gtag() {dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-CBPL27BQ5D', {'anonymize_ip': true});

        function setCookie(){
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = "https://www.googletagmanager.com/gtag/js?id=G-6F371C2W1K";
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        }; 

        function deleteCookies(cookieconsent_name){
            var keep = [cookieconsent_name, "DYNSRV"];

            document.cookie.split(';').forEach(function(c){
                c = c.split('=')[0].trim();
                if (!~keep.indexOf(c))
                document.cookie = c + '=;' + 'expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/';
            });
        };
    </script>
    <?php
}

add_action('wp_head', 'add_google_analytics', 99);

@ini_set( 'upload_max_size' , '512M' );
@ini_set( 'post_max_size', '512M');
@ini_set( 'max_execution_time', '300' );

// add acf blocks

function register_acf_block_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_blocks',
        'title' => 'Block Fields',
        'fields' => array(
            // Add your fields here
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/block-name', // Replace 'block-name' with your actual block name
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'register_acf_block_fields');

function register_acf_grid_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_grid',
        'title' => 'Grid Fields',
        'fields' => array(
            // Add your fields here
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-name.php', // Replace 'template-name.php' with your actual page template file
                ),
            ),
        ),
    ));
}

add_action('acf/init', 'register_acf_grid_fields');

function enable_gif_featured_images($data, $postarr){
    if(isset($data['post_mime_type']) && $data['post_mime_type'] === 'image/gif'){
        $data['sizes'] = array();
    }
    return $data;
}
add_filter('wp_generate_attachment', 'enable_gif_featured_images', 10, 2);

function display_acf_gallery($content){
    if(is_singular('post')){
        ob_start();
        $gallery = get_field('gallery');
        if($gallery){
            echo '<div class="post-gallery">';
            foreach($gallery as $image){
                echo '<img src="' . esc_url($image['sizes']['thumbnail']) . '" alt="' . esc_attr($image['alt']) . '">';
            }
            echo '</div>';
        }
        $acf_gallery = ob_get_clean();
        $content .= $acf_gallery;
    }
    return $content;
}

add_filter('the_content', 'display_acf_gallery');

function custom_hover_image_shortcode($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'post_id' => get_the_ID(),
        'hover_image' => '',
        'default_image' => '',
    ), $atts);

    // Get the post ID
    $post_id = $atts['post_id'];

    // Get the hover image URL from ACF shortcode field
    $hover_image_url = get_field('hover_image_url_shortcode_field'); // Replace with your ACF shortcode field name

    // Get the default image URL from ACF shortcode field
    $default_image_url = get_field('default_image_url_shortcode_field'); // Replace with your ACF shortcode field name

    // If hover_image attribute is provided, use it instead of ACF field value
    if (!empty($atts['hover_image'])) {
        $hover_image_url = $atts['hover_image'];
    }

    // Generate a unique ID for the img element
    $img_id = 'playOnHover-' . $post_id;

    // Output the HTML for the image with hover functionality
    ob_start();
    ?>
    <div class="img">
            <img id="<?php echo $img_id; ?>" src="<?php echo $default_image_url; ?>" loop="false" />
    </div>
    <?php
    $html = ob_get_clean();

    // Generate the inline JavaScript code
    $js_code = "
    <script>
    (function() {
        var img = document.getElementById('$img_id');
        if (img) {
            img.addEventListener('mouseleave', function () {
                var imageUrl = img.src;
                img.src = '';
                img.setAttribute('src', '$default_image_url');
            }, false);
            img.addEventListener('mouseover', function () {
                img.setAttribute('src', '$hover_image_url');
            }, false);
        }
    })();

    function GifReset() {
        var img = document.getElementById('$img_id');
        if (img) {
            img.addEventListener('mouseleave', function () {
                var imageUrl = img.src;
                img.src = '';
                img.setAttribute('src', '$default_image_url');
            }, false);
            img.addEventListener('mouseover', function () {
                img.setAttribute('src', '$hover_image_url');
            }, false);
        }
    }
    </script>
    ";

    // Enqueue the inline JavaScript code
    wp_add_inline_script('jquery', $js_code);

    return $html;
}
add_shortcode('custom_hover_image', 'custom_hover_image_shortcode');

?>