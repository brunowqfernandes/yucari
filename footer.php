<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yucari
 */

?>
<footer class="footer">
   <div class="container">
      <div class="flex gap-[5rem] lg:gap-[9.375rem] flex-wrap justify-center items-center">
         <div class="w-[10rem]">
            <img src="<?php echo get_template_directory_uri() ?>/assets/icons/logo.svg" alt="">
         </div>
         <div class="lg:flex-1">
            <?php
            wp_nav_menu([
               'theme_location'  => 'institutional',
               'container_class' => '',
               'container'       => 'nav',
               'menu_class'      => 'menu-primary'
            ]);
            ?>
         </div>
         <div class="w-fit">
            <ul class="flex lg:flex-row flex-col items-center lg:text-left text-center gap-4 text-white list-none pl-0">
               <li>
                  <a class="underline font-normal flex items-center" href="mailto:yucarisp@gmail.com">
                     <i class="icon icon-email"></i> yucarisp@gmail.com
                  </a>
               </li>
               <li>
                  <a class="font-normal flex items-center" href="https://www.instagram.com/yucarisp/" target="_blank">
                     <i class="icon icon-instagram"></i> @yucarisp
                  </a>
               </li>
            </ul>
         </div>
      </div>
      <div class="w-full flex justify-center lg:justify-end items-center lg:flex-row flex-col gap-4 mt-6">
         <p class="text-white text-xs">desenvolvido por:</p>
         <?php render_svg('estudio86', 'w-[2.875rem] h-10') ?>
      </div>
   </div>
</footer>
<?php
wp_footer(); ?>

</body>

</html>
