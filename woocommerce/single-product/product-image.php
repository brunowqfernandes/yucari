<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html'))
{
   return;
}

global $product;

$columns           = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
   'woocommerce_single_product_image_gallery_classes',
   array(
      'woocommerce-product-gallery',
      'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
      'woocommerce-product-gallery--columns-' . absint($columns),
      'images',
   )
);

?>
<div class="lg:w-5/12">
<div id="single-product-galerry" class="order-1 flex-1 single-gallery swiper">
   <!-- flex flex-col  -->
   <div class="swiper-wrapper">
      <!-- flex-row lg:flex-col -->
      <?php
      $html = '';
      if ($post_thumbnail_id)
      {
         $html .= '<div class="swiper-slide">';
         $html .= wc_get_gallery_image_html($post_thumbnail_id, true);
         $html .= '</div>';
      }
      else
      {
         $html .= '<div class="swiper-slide">';
         $html .= '<div class="woocommerce-product-gallery__image--placeholder">';
         $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
         $html .= '</div>';
         $html .= '</div>';
      }

      echo $html;

      do_action('woocommerce_product_thumbnails');
      ?>
   </div>
   <div class="swiper-button-next"></div>
   <div class="swiper-button-prev"></div>
</div>
</div>
