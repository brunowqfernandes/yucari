<?php

if (!defined('ABSPATH'))
{
   exit;
}

add_filter('woocommerce_checkout_fields', 'bx_stock_remove_checkout_fields');
function bx_stock_remove_checkout_fields($fields)
{
   $fields['billing']['billing_last_name']['required'] = false;
   $fields['billing']['billing_cellphone']['required'] = false;

   unset($fields['billing']['billing_phone']);

   $exclude_fields = ["billing_persontype", "billing_company", "billing_cnpj"];
   // $exclude_fields = ["billing_first_name", "billing_persontype", "billing_company", "billing_cnpj", "billing_cpf"];

   if (is_user_logged_in())
   {
      $current_user = wp_get_current_user();
      $user_id = $current_user->ID;

      foreach ($fields['billing'] as $field_key => $_fieldset)
      {
         if (isset($fields['billing'][$field_key]['type']) && $fields['billing'][$field_key]['type'] === 'select')
         {
            $fields['billing'][$field_key]['class'] = ['form-holder', 'form-holder-select'];
         }
         else
         {
            $fields['billing'][$field_key]['class'] = ['form-holder'];
         }

         $get_fieldset = 'get_' . $field_key;

         if (method_exists(WC()->customer, $get_fieldset))
         {
            $billing_field_val = WC()->customer->$get_fieldset();
            if (!empty($billing_field_val) && !in_array($field_key, $exclude_fields))
            {
               if ($fields['billing'][$field_key]['required'] === true)
                  $fields['billing'][$field_key]['class'] = array('!hidden');
            }
         }

         switch ($field_key)
         {
            case 'billing_last_name':
               $fields['billing'][$field_key]['class'] = array('!hidden');
               break;
            case 'billing_postcode':
               $fields['billing'][$field_key]['class'] = array('!hidden');
               break;
            case 'billing_address_1':
               $fields['billing'][$field_key]['class'] = array('!hidden');
               break;
            case 'billing_address_2':
               $fields['billing'][$field_key]['class'] = array('!hidden');
               break;
            case 'billing_number':
               $fields['billing'][$field_key]['class'] = array('!hidden');
               break;
            case 'billing_neighborhood':
               $fields['billing'][$field_key]['class'] = array('!hidden');
               break;
            case 'billing_city':
               $fields['billing'][$field_key]['class'] = array('!hidden');
               break;
            case 'billing_state':
               $fields['billing'][$field_key]['class'] = array('!hidden');
               break;
            case 'billing_cellphone':
               $fields['billing'][$field_key]['class'] = array('!hidden');
               break;
            case 'bx_address_selected':
               $fields['billing'][$field_key]['class'] = array('!hidden');
               break;
         }

         if (!empty(get_user_meta($user_id, $field_key, true)))
         {
            if (!in_array($field_key, $exclude_fields))
               $fields['billing'][$field_key]['class'] = array('!hidden');
         }
      }
   }

   return $fields;
}
