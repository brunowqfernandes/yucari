<?php

/**
 * Template Name: About
 */


get_header();

?>

<main>
   <div class="container pt-12">
      <h1 class="text-[1rem] text-purple-900 mb-8 uppercase">
         <?php the_title(); ?>
      </h1>
      <?php if (have_rows('sobre')) :
         while (have_rows('sobre')) :
            the_row();

            $texto  = get_sub_field('texto');
            $imagem = get_sub_field('imagem');
            $src    = $imagem['url'];
      ?>
            <div class="flex gap-8 items-end flex-wrap">
               <div class="w-full lg:w-1/2">
                  <img class="w-full h-auto aspect-video" src="<?php echo $src ?>" alt="">
               </div>
               <div class="w-full lg:flex-1">
                  <p class="italic font-thin text-[#4E4E4E] pb-6 border-b border-[#4E4E4E] uppercase">
                     <?php echo $texto ?>
                  </p>
               </div>
            </div>
      <?php
         endwhile;
      endif; ?>
   </div>
   <?php

   $image_scroll = get_field('image_scroll');
   $src_scroll = $image_scroll['url'] ?? '';

   ?>
   <div class="relative pb-[18.75rem] overflow-hidden">
      <section class="scrolling-container">
         <div class="image-animation-hero m-auto text-center absolute -left-[100vw] top-[5rem] z-0" style="background-image: url(<?php echo $src_scroll ?>);">
         </div>
      </section>
   </div>
</main>

<?php

get_footer();
