<?php

/**
 * Template Name: Login
 */

get_header();

?>

<main>
   <div class="container lg:pt-[10rem] pt-[5rem] mb-[15rem]">
      <div id="login-form" class="max-w-[35rem] m-auto">
         <h2 class="text-sm text--[#0C030F] uppercase w-full block pb-6 mb-6 border-b border-[#0C030F] leading-none">
            Login
         </h2>
         <form id="loginForm" action="<?php echo wp_login_url(); ?>" method="post" class="flex flex-col gap-6">
            <div class="flex flex-col gap-2">
               <p>
                  <label class="w-full block text-sm text--[#0C030F] mb-1 leading-none" for="username">E-mail:</label>
                  <input class="w-full bg-transparent" type="text" name="log" id="username" required>
               </p>

               <p>
                  <label class="w-full block text-sm text--[#0C030F] mb-1 leading-none" for="password">Senha:</label>
                  <input class="w-full bg-transparent" type="password" name="pwd" id="password" required>
               </p>
            </div>
            <p>
               <a class="text-[#841027] text-sm leading-none underline" href="<?php echo home_url('minha-conta/lost-password') ?>">Esqueci minha senha</a>
            </p>
            <p>
               <input type="submit" value="FAZER LOGIN" class="w-full py-6 px-6 leading-none text-sm uppercase text-white bg-[#841027] cursor-pointer">
            </p>
            <p>
               <a href="<?php echo home_url('cadastro') ?>" class="w-full py-6 px-6 leading-none text-sm uppercase text-[#0C030F] bg-transparent cursor-pointer border border-[#0C030F] block text-center" href="">CADASTRAR</a>
            </p>
         </form>
      </div>
      <p id="dataResponse" class="hidden mx-auto w-fit py-2 px-4 border border-[#0C030F] mt-6"></p>
   </div>
</main>

<?php

get_footer();
