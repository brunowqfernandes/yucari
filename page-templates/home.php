<?php

/**
 * Template Name: Home
 */


get_header();

?>

<main>
   <?php if (have_rows('hero')) : ?>
      <?php while (have_rows('hero')) : the_row();
         $background = get_sub_field('background');
         $bg_src     = $background['sizes']['large'] ?? '';
         $logo       = get_sub_field('logo');
         $logo_src   = $logo['sizes']['large'] ?? '';

         $shop_page_url = get_permalink(wc_get_page_id('shop'));
      ?>
      <style>
         @media (max-width: 560px) {
            section.hero {
               background-image: url('<?php echo get_sub_field('background_mobile') ?>')
            }
         }
      </style>
         <section class="hero scrolling-container" style="background-image: url(<?php echo $bg_src ?>);">
            <div class="image-animation-hero m-auto text-center absolute -left-[100vw] top-1/2 -translate-y-1/2 z-0" style="background-image: url(<?php echo $logo_src ?>);">
            </div>
            <div class="flex justify-center items-center absolute left-4 bottom-4">
               <a class="text-lg leading-none bg-[#841027] text-[#FCF9EA] py-4 px-8 flex justify-center items-center w-[20rem] max-w-full" href="<?php echo esc_url($shop_page_url) ?>">Shop</a>
            </div>
         </section>
      <?php endwhile; ?>
   <?php endif; ?>

   <!-- <?php if (have_rows('last_drop')) : ?>
      <?php while (have_rows('last_drop')) : the_row();
         $title    = get_sub_field('title');
         $products = get_sub_field('products');
         $link     = get_sub_field('link');

      ?>
         <section class="last-drop lg:py-[6.25rem] py-[5rem]">
            <div class="container">
               <?php
               $args = array(
                  'post_type'      => 'product',
                  'post__in'       => $products,
                  'posts_per_page' => -1,
                  'orderby'        => 'date',
                  'order'          => 'DESC',
               );

               $query = new WP_Query($args);

               if ($query->have_posts()) :
               ?>
                  <div id="swiper-ultimmo-drop" class="swiper woocommerce overflow-hidden">
                     <ul class="swiper-wrapper products">
                        <?php
                        while ($query->have_posts()) : $query->the_post();
                           echo '<div class="swiper-slide">';
                           wc_get_template_part('content', 'product');
                           echo '</div>';
                        endwhile;

                        ?>
                     </ul>
                     <div class="swiper-pagination"></div>
                  </div>
               <?php
                  wp_reset_postdata();
               endif;
               ?>
            </div>
            <?php if ($link) : ?>
               <div class="flex justify-center items-center mt-12">
                  <a class="text-lg leading-none bg-[#841027] text-[#FCF9EA] py-4 px-8 flex justify-center items-center w-[20rem] max-w-full" href="<?php echo $link['url'] ?>">
                     <?php echo $link['title'] ?>
                  </a>
               </div>
            <?php endif; ?>
         </section>
      <?php endwhile; ?>
   <?php endif; ?>

   <?php if (have_rows('collection')) : ?>
      <?php while (have_rows('collection')) : the_row();
         $video    = get_sub_field('video');
         $logo       = get_sub_field('logo');
         $logo_src   = $logo['sizes']['large'] ?? '';
         $link     = get_sub_field('link');

      ?>
         <section class="collection lg:pb-[6.25rem] pb-[5rem] bg-yellow-100 scrolling-container scrolling-container ">
            <div class="container relative">
               <?php

               if (isiPhone())
               { ?>
                  <video id="homeVideo" class="m-auto w-full max-w-[19.6875rem] h-auto relative z-10" autoplay loop muted playsinline controls="true">

                     <source src="<?php echo $video['url'] ?>" type="video/mp4">

                     Seu navegador não suporta a tag de vídeo.

                  </video>
               <?php }
               else
               { ?>
                  <video id="homeVideo" class="m-auto w-full max-w-[19.6875rem] h-auto relative z-10" autoplay loop muted>

                     <source src="<?php echo $video['url'] ?>" type="video/mp4">

                     Seu navegador não suporta a tag de vídeo.

                  </video>
               <?php } ?>
               <div class="image-animation m-auto text-center absolute -left-[100vw] top-1/2 -translate-y-1/2 z-0" style="background-image: url(<?php echo $logo_src ?>);">
               </div>
            </div>

         </section>
      <?php endwhile; ?>
   <?php endif; ?> -->
</main>

<?php

get_footer();
