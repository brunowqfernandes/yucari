<?php

/**
 * Template Name: Cadastro
 */

get_header();

?>

<main>
   <div class="container lg:pt-[10rem] pt-[5rem] mb-[15rem]">
      <div id="login-form" class="max-w-[35rem] m-auto">
         <h2 class="text-sm text-[#0C030F] uppercase w-full block pb-6 mb-6 border-b border-[#0C030F] leading-none">
            Cadastro
         </h2>
         <form x-data id="registerForm" action="<?php echo wp_login_url(); ?>" method="post" class="flex flex-col gap-6">
            <div class="grid lg:grid-cols-2 gap-2">

               <p>
                  <label for="billing_first_name" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     Nome&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="text" class="w-full bg-transparent" name="billing_first_name" id="billing_first_name" autocomplete="given-name" required>
               </p>

               <p>
                  <label for="billing_last_name" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     Sobrenome&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="text" class="w-full bg-transparent" name="billing_last_name" id="billing_last_name" autocomplete="family-name" required>
               </p>

               <p>
                  <label for="billing_email" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     Endereço de e-mail&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="email" class="w-full bg-transparent" name="billing_email" id="billing_email" autocomplete="new-email" required>
               </p>

               <p>
                  <label for="password" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     Senha&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="password" class="w-full bg-transparent" name="password" id="password" autocomplete="new-password" maxlength="15" required>
               </p>

               <p>
                  <label for="billing_phone" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     Celular&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="tel" class="w-full bg-transparent" name="billing_phone" id="billing_phone" autocomplete="tel" maxlength="15" required x-mask="(99) 99999-9999">
               </p>

               <p>
                  <label for="billing_cpf" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     CPF&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="tel" class="w-full bg-transparent" name="billing_cpf" id="billing_cpf" maxlength="14" required x-mask="999.999.999-99">
               </p>

               <p>
                  <label for="billing_postcode" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     CEP&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="tel" class="w-full bg-transparent" name="billing_postcode" id="billing_postcode" autocomplete="postal-code" maxlength="9" required onchange="setAddress(this.value)" x-mask="99999-999">
               </p>

               <p>
                  <label for="billing_address_1" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     Endereço&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="text" class="w-full bg-transparent" name="billing_address_1" id="billing_address_1" required>
               </p>

               <p>
                  <label for="billing_number" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     Número&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="text" class="w-full bg-transparent" name="billing_number" id="billing_number" required>
               </p>

               <p>
                  <label for="billing_address_2" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     Complemento
                  </label>
                  <input type="text" class="w-full bg-transparent" name="billing_address_2" id="billing_address_2" autocomplete="address-line2">
               </p>

               <p>
                  <label for="billing_neighborhood" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     Bairro&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="text" class="w-full bg-transparent" name="billing_neighborhood" id="billing_neighborhood" required>
               </p>

               <p>
                  <label for="billing_city" class="w-full block text-sm text-[#0C030F] !mb-1 leading-none">
                     Cidade&nbsp;<abbr class="text-[#841027]" title="obrigatório">*</abbr>
                  </label>
                  <input type="text" class="w-full bg-transparent" name="billing_city" id="billing_city" autocomplete="address-level2" required>
               </p>

               <input type="hidden" class="w-full bg-transparent" name="billing_state" id="billing_state" required>

            </div>
            <p>
               <input type="submit" value="CADASTRAR" class="w-full py-6 px-6 leading-none text-sm uppercase text-white bg-[#841027] cursor-pointer">
            </p>
         </form>
      </div>
      <p id="dataResponse" class="hidden mx-auto w-fit py-2 px-4 border border-[#0C030F] mt-6"></p>
   </div>
</main>

<?php

get_footer();
