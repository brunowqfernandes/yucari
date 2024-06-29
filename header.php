<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
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

$class_count = $numero_produtos_carrinho <= 99 ? 'text-xs' : 'text-[0.625rem]';

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
   <meta charset="<?php bloginfo('charset'); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="profile" href="https://gmpg.org/xfn/11">

   <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
   <?php wp_body_open(); ?>

   <header class="header" x-data="{menuMobile: false}">
      <section class="ambassadors ambassadors--css-only absolute top-0 left-0">
         <div class="ambassadors__bottom large-heading">
            <div class="ambassador large-heading">
               <p class="text-white text-2xl tracking-[4px] font-light space">
                  Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500.Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500. Frete Grátis acima de R$500.
               </p>
            </div>
         </div>
      </section>

      <div class="container">
         <div class="flex gap-10 lg:gap-[4.75rem] 3xl:gap-[9.375rem] justify-center items-center">
            <div class="w-[10rem]">
               <?php the_custom_logo() ?>
            </div>
            <div class="flex-1 lg:flex hidden">
               <?php
               wp_nav_menu([
                  'theme_location'  => 'menu-1',
                  'container_class' => '',
                  'container'       => 'nav',
                  'menu_class'      => 'menu-primary'
               ]);
               ?>
            </div>
            <div class="w-[10rem]">
               <ul class="flex gap-8 lg:gap-4 justify-end list-none pl-0 mb-0 invert [.body-home_&]:invert-0">
                  <li class="lg:flex hidden">
                     <a href="<?php echo home_url() . '?s=' ?>">
                        <?php render_svg('search'); ?>
                     </a>
                  </li>
                  <li class="lg:flex hidden">
                     <?php $my_account_url = get_permalink(get_option('woocommerce_myaccount_page_id')); ?>
                     <a href="<?= $my_account_url ?>">
                        <?php render_svg('user'); ?>
                     </a>
                  </li>
                  <li>
                     <button class="relative adfy__show-woofc" href="<?= wc_get_cart_url() ?>">
                        <?php render_svg('shopping-cart'); ?>
                        <?php if (!empty($numero_produtos_carrinho)) : ?>
                           <span class="absolute w-5 h-5 bg-purple-900 text-white bottom-0 right-0 -mb-2.5 -mr-2.5 rounded-full flex items-center justify-center <?php echo $class_count ?>"><?php echo $numero_produtos_carrinho; ?></span>
                        <?php endif; ?>
                     </button>
                  </li>
                  <li class="lg:hidden">
                     <button @click="menuMobile = true" class="text-purple-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                     </button>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <div :class="{'-mr-0': menuMobile === true, '-mr-[100vw]': menuMobile === false}" class="menu-mobile lg:hidden w-full h-full fixed -mr-[100vw] bg-purple-900 text-white top-0 right-0 transition-all animate-duration-300 z-[999]">
         <button @click="menuMobile = false" class="absolute top-0 right-0 m-4 p-2 text-white rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
         </button>

         <?php
         wp_nav_menu([
            'theme_location'  => 'menu-1',
            'container_class' => '',
            'container'       => 'nav',
            'menu_class'      => 'menu-primary-mobile'
         ]);
         ?>

         <ul class="flex gap-4 justify-center mt-8">
            <li>
               <a href="<?php echo home_url() . '?s=' ?>">
                  <?php render_svg('search'); ?>
               </a>
            </li>
            <li>
               <?php $my_account_url = get_permalink(get_option('woocommerce_myaccount_page_id')); ?>
               <a href="<?= $my_account_url ?>">
                  <?php render_svg('user'); ?>
               </a>
            </li>
         </ul>
      </div>
   </header>
