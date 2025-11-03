<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-svh bg-white text-slate-900 antialiased'); ?>>
  <a class="skip-link sr-only focus:not-sr-only" href="#main">Skip to content</a>
  <header class="border-b">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
      <div class="font-bold"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></div>
      <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'container' => false,
          'menu_class' => 'flex gap-4',
          'fallback_cb' => false
        ]);
      ?>
    </div>
  </header>
