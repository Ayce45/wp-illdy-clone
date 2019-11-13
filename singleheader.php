<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width" />
    <?php wp_head();
    do_action('wpmu_in_header');
    $color_scheme1 = get_option('wpmu_color1');
    $color_scheme2 = get_option('wpmu_color2');
    $color_scheme3 = get_option('wpmu_color3');
?></head>

<body <?php body_class(); ?>>

<style>
        :root {
            --main: <?= $color_scheme1; ?>;
            --secondary: <?= $color_scheme2; ?>;
            --thirdary: <?= $color_scheme3; ?>;
        }
    </style>

    <header style="background: url(<?= get_theme_file_uri() ?>/img/front-page-header.webp);
">
        <div class="top-header">
            <img src="<?= get_theme_file_uri() ?>/img/logo.webp" class="logo">
            <nav>
                <?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
            </nav>
        </div>
    </header>