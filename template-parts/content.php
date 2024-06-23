<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yucari
 */

$product = null;
$produc_single_class = '';

if (is_product())
{
   $product = wc_get_product(get_the_ID());
   $produc_single_class = 'hidden lg:block';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <header class="entry-header <?php echo $produc_single_class; ?>">
      <div>
         <?php
         if (is_singular() && !is_product()) :
            the_title('<h1 class="entry-title">', '</h1>');
         endif;
         if (is_product() && !empty($product))
         {
         ?>
            <h1 class="entry-title"><?php the_title() ?>
               <span class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>"><?php echo $product->get_price_html(); ?></span>
            </h1>
         <?php }
         ?>
      </div>
      <?php


      if ('post' === get_post_type()) :
      ?>
         <div class="entry-meta">
            <?php
            yucari_posted_on();
            yucari_posted_by();
            ?>
         </div><!-- .entry-meta -->
      <?php endif; ?>
   </header><!-- .entry-header -->

   <?php yucari_post_thumbnail(); ?>

   <div class="entry-content">
      <?php
      the_content(
         sprintf(
            wp_kses(
               /* translators: %s: Name of current post. Only visible to screen readers */
               __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'yucari'),
               array(
                  'span' => array(
                     'class' => array(),
                  ),
               )
            ),
            wp_kses_post(get_the_title())
         )
      );

      wp_link_pages(
         array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'yucari'),
            'after'  => '</div>',
         )
      );
      ?>
   </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
