<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package yucari
 */

get_header();
?>

<main id="primary" class="site-main">

   <section class="error-404 not-found h-[100vh] w-full flex flex-col items-center justify-center bg-yellow-100">
      <header class="page-header">
         <h1 class="page-title text-black text-4xl font-bold"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'yucari'); ?></h1>
      </header><!-- .page-header -->

      <div class="page-content flex flex-col justify-center items-center">
         <h1 class="text-[9.375rem] font-bold text-black">404</h1>
         <a href="<?php echo get_home_url() ?>" class="bg-[#841027] text-white py-2 px-5 max-auto">Go home</a>
      </div><!-- .page-content -->
   </section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
