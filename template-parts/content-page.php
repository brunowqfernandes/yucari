<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yucari
 */


$numero_produtos_carrinho = '0';

if (class_exists('WooCommerce'))
{
   $numero_produtos_carrinho = WC()->cart->get_cart_contents_count();
}

if ($numero_produtos_carrinho > 99)
{
   $numero_produtos_carrinho = '99+';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php
   if (is_cart())
   {
   ?>
      <header class="entry-header">
         <h1 class="entry-title mb-10">
            <span class="uppercase"><?php the_title() ?></span>
            <span class="!font-normal">
               <?php

               $cart_itens = sprintf(
                  _n(
                     '(%s item)',
                     '(%s itens)',
                     $numero_produtos_carrinho,
                     'englishpass'
                  ),
                  sprintf('%02d', $numero_produtos_carrinho)
               );

               if ($numero_produtos_carrinho == 0)
               {
                  $cart_itens = '(VAZIO)';
               }

               echo $cart_itens;
               ?>
            </span>
         </h1>
         <a class="text-[2rem] mb-10" href="<?php echo get_permalink(wc_get_page_id('shop')) ?>"><?php esc_html_e('VOLTAR PARA A LOJA', 'yucari') ?></a>
      </header>
   <?php
   }
   else
   {
   ?>
      <header class="entry-header">
         <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
      </header><!-- .entry-header -->
   <?php } ?>
   <?php yucari_post_thumbnail(); ?>

   <div class="entry-content">
      <?php
      the_content();

      wp_link_pages(
         array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'yucari'),
            'after'  => '</div>',
         )
      );
      ?>
   </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
