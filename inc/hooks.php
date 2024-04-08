<?php

if (!defined('ABSPATH'))
{
   exit; // Exit if accessed directly
}

add_filter('woocommerce_product_get_image', 'add_custom_woocommerce_loop_thumbnail', 10, 999);
function add_custom_woocommerce_loop_thumbnail($html, $post_id)
{

   $product = wc_get_product($post_id);
   $thumbnail_url = get_the_post_thumbnail_url($product->get_id(), 'full');
   if ($thumbnail_url)
   {
      $html = '<img src="' . esc_url($thumbnail_url) . '" alt="" class="woocommerce-loop-product__image" />';
   }

   $gallery_image_ids = $product->get_gallery_image_ids();

   if ($gallery_image_ids)
   {
      $first_gallery_image_id = $gallery_image_ids[0];

      $large_gallery_image_url = wp_get_attachment_image_src($first_gallery_image_id, 'full');
      if ($large_gallery_image_url)
      {
         $html .= '<img src="' . esc_url($large_gallery_image_url[0]) . '" alt="" class="woocommerce-loop-product__image transition-opacity duration-500 opacity-0 group-hover:opacity-100 absolute inset-0 bg-black" />';
      }
   }

   return '<a clas="block" href="' . get_permalink() . '"><div class="group relative">' . $html . '</div></a>';
}


add_filter('woocommerce_product_tabs', 'remove_tabs_single_product', 10, 999);

function remove_tabs_single_product($tabs)
{
   return [];
}

function custom_related_products_args($args)
{
   $args['posts_per_page'] = 3; // Define o número de produtos relacionados que serão exibidos
   return $args;
}
add_filter('woocommerce_output_related_products_args', 'custom_related_products_args');
