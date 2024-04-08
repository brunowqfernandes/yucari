<?php

if (!defined('ABSPATH')) exit;

if (!function_exists('render_svg'))
{
   function render_svg($file, $classes = '', $echo = true)
   {
      $file        = str_replace('.svg', '', $file);
      $file        = path_resolve(['assets', 'icons', "{$file}.svg"]);
      $svg_file    = get_theme_file_path($file);
      $svg_content = '';

      if (file_exists($svg_file))
      {
         $svg_content = file_get_contents($svg_file);

         if (!empty($classes))
         {
            $classes = trim($classes);

            if (stripos($svg_content, 'class="'))
            {
               $svg_content = str_replace('class="', 'class="' . $classes . ' ', $svg_content);
            }
            else
            {
               $svg_content = str_replace('<svg ', '<svg class="' . $classes . '" ', $svg_content);
            }
         }

         $svg_content = str_replace('<svg ', '<svg aria-hidden="true" ', $svg_content);
      }

      if ($echo)
      {
         echo $svg_content;
      }
      else
      {
         return $svg_content;
      }
   }
}

function path_resolve($paths)
{
   if (!is_array($paths))
   {
      trigger_error(esc_attr__('Primeiro argumento precisa ser um array.', 'bx-essentials'), E_USER_ERROR);
   }

   return implode(DIRECTORY_SEPARATOR, $paths);
}
