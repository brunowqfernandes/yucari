<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package yucari
 */

get_header();
?>

<main id="primary" class="site-main">

   <?php if (have_posts()) : ?>

      <div class="container woocommerce">
         <header class="page-header">
            <div>
               <h1 class="entry-title pt-[3.75rem]">
                  <?php
                  /* translators: %s: search query. */
                  printf(esc_html__('Search Results for: %s', 'yucari'), '<span class="normal-case">' . get_search_query() . '</span>');
                  ?>
               </h1>
               <div>
                  <?php get_search_form() ?>
               </div>
            </div>
         </header><!-- .page-header -->
         <ul class="products columns-3">
         <?php
         /* Start the Loop */
         while (have_posts()) :
            the_post();

            /**
             * Run the loop for the search to output the results.
             * If you want to overload this in a child theme then include a file
             * called content-search.php and that will be used instead.
             */
            wc_get_template_part('content', 'product');

         endwhile;



      else :

         get_template_part('template-parts/content', 'none');

      endif;
         ?>
         </ul>
         <?php

         global $wp_query;

         $big = 999999999;

         echo paginate_links(array(
            'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'  => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total'   => $wp_query->max_num_pages,
         )); ?>
      </div>

</main><!-- #main -->

<?php

get_footer();
