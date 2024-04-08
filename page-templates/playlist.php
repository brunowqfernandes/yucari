<?php

/**
 * Template Name: Playlist
 */


get_header();

?>

<main>
   <div class="container lg:py-[6.25rem] py-[5rem]">
      <h1 class="lg:text-[3.5rem] text-5xl text-purple-900 mb-12 uppercase">
         <?php the_title(); ?>
      </h1>
      <?php if (have_rows('playlist')) :
         while (have_rows('playlist')) :
            the_row();

            $playlist_spotify  = get_sub_field('playlist_spotify');
            $imagem = get_sub_field('imagem');
            $src    = $imagem['url'];
      ?>
            <div class="flex gap-8 flex-wrap">
               <div class="w-full lg:w-1/2">
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/4lwXZO38kUyFMTZqcEH9AF?utm_source=generator" width="100%" height="554" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
               </div>
               <div class="w-full lg:flex-1">
                  <img class="max-w-full h-auto" src="<?php echo $src ?>" alt="">
               </div>
            </div>
      <?php
         endwhile;
      endif; ?>
   </div>
   </div>
</main>

<?php

get_footer();
