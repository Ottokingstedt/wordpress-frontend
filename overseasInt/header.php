<?php

/**
 * The template for displaying the header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155350513-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-155350513-1');
    </script>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="Sign language and visual accessibility specialists - Overseas Interpreting provides tailor-made communication solutions for deaf academics and professionals." />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:locale" content="en_GB" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Overseas Interpreting" />
    <meta property="og:url" content="http://www.overseasinterpreting.com/" />
    <meta property="og:site_name" content="Overseas Interpreting" />
    <meta name="description" content="We are sign language experts with the capacity and passion to provide tailor-made interpreting services for sign language professionals. Every solution caters to the unique demands and preferences of our clients and we pride ourselves on designing services to maximise access using the highest level professionals in the field.">
    <title>Overseas Interpreting <?php if (is_front_page()) {
                                    } else {
                                        echo "- ";
                                        wp_title('');
                                    } ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/favicon-16x16.png">
    <link rel="manifest" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/site.webmanifest">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="splash">
        <div class="splash__img-container">
            <img class="fade-in" src="<?php the_field('logo') ?>" alt="loading screen" style="width: 500px;">
        </div>
    </div>
    <div data-url="<?php echo home_url('/'); ?>">
        <header id="header">
            <!-- Option navbar #1 -->
            <div class="header-container">
                <div class="nav-bar" id="navbar">
                    <div class="brand">
                        <span id="logo" style="position: sticky;">
                            <?php get_template_part('template-parts/content', 'logo') ?>
                        </span>
                    </div>
                    <div class="nav-list">
                        <div class="hamburger">
                            <div class="bar">
                            </div>
                        </div>
                        <ul class="nav-active">
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="mailto: office@overseasinterpreting.com"><?php get_template_part('template-parts/content', 'mail') ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <section id=hero>
            <div class="hero-container">
                <?php if (get_field('video_background')) : ?>
                    <video autoplay loop muted plays-inline class="background-clip">
                        <source src="<?php the_field('video_background'); ?>" type="video/mp4">
                    <?php endif; ?>
                    </video>

    <div class="acc-container">
                <div class="theme">
                <div class="tool">
                            <span>Toggle High Contrast</span>
                </div>
                    <label class="dark-toggle">
                        <input type="checkbox">
                        <div class="dark-toggle__switch" tabindex="0">
                            <?php get_template_part('template-parts/content', 'darktoggle')?>
                        </div>
                    </label>
                    </div>
                    <hr>
                    <div class="acc-btn">
                        <div class="tool">
                            <span>Toggle Large Font Size</span>
                        </div>
                        <button class="accessibility" type="type" onclick="tsw_demo_change_font_size();">
                        <span style="font-size: small;">A</span><span style="font-size: large;">A</span>
                        </button>
                    </div>
        </div>
    </div>
</section>