<?php

defined('ABSPATH') || exit;

global $product;

$attribute_keys  = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="variations_form cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
   <?php do_action('woocommerce_before_variations_form'); ?>

   <?php if (empty($available_variations) && false !== $available_variations) : ?>
      <p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?></p>
   <?php else : ?>
      <table class="variations" cellspacing="0" role="presentation">
         <tbody>
            <?php foreach ($attributes as $attribute_name => $options) : ?>
               <tr>
                  <?php if (strtolower($attribute_name) === 'tamanho') { ?>
                     <th class="label">
                        <label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>">
                           <?php echo 'SELECIONAR O ' . wc_attribute_label($attribute_name); ?>
                        </label>
                     </th>
                  <?php } else { ?>
                     <th class="label">
                        <label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>">
                           <?php echo wc_attribute_label($attribute_name); ?>
                        </label>
                     </th>
                  <?php } ?>
                  <td class="value">
                     <?php
                     if (strtolower($attribute_name) === 'tamanho') {
                        $i = 0;

                        foreach ($options as $option) {
                           $i++;

                           // Verifica se a variação específica possui estoque ou está ativa
                           $variation_id = $product->get_matching_variation(array('attribute_' . sanitize_title($attribute_name) => $option));
                           $variation = wc_get_product($variation_id);

                           $is_in_stock = $variation && $variation->is_in_stock();
                           $is_active = $variation && $variation->is_purchasable();

                           $disabled = (!$is_in_stock || !$is_active) ? 'disabled' : '';
                           $selected = isset($_REQUEST['attribute_' . sanitize_title($attribute_name)]) && wc_selected($option, $_REQUEST['attribute_' . sanitize_title($attribute_name)], false);

                           echo '<div>
                           <input id="' . $i . '-' . sanitize_title($attribute_name) . '" type="radio" name="attribute_' . sanitize_title($attribute_name) . '" value="' . esc_attr($option) . '" ' . checked($selected, true, false) . ' ' . $disabled . '>
                           <label for="' . $i . '-' . sanitize_title($attribute_name) . '" class="' . $disabled . '">' . esc_html($option) . '</label>
                           </div>';
                        }

                        wc_dropdown_variation_attribute_options(
                           array(
                              'options'   => $options,
                              'attribute' => $attribute_name,
                              'product'   => $product,
                           )
                        );
                        echo '<style>#tamanho{display:none!important}</style>';
                     } else {
                        wc_dropdown_variation_attribute_options(
                           array(
                              'options'   => $options,
                              'attribute' => $attribute_name,
                              'product'   => $product,
                           )
                        );
                     }

                     echo end($attribute_keys) === $attribute_name ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__('Clear', 'woocommerce') . '</a>')) : '';
                     ?>
                  </td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
      <?php do_action('woocommerce_after_variations_table'); ?>

      <div class="single_variation_wrap">
         <?php
         do_action('woocommerce_before_single_variation');
         do_action('woocommerce_single_variation');
         do_action('woocommerce_after_single_variation');
         ?>
      </div>
   <?php endif; ?>

   <?php do_action('woocommerce_after_variations_form'); ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>
