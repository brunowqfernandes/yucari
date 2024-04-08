document.addEventListener('DOMContentLoaded', function () {
   const loginForm = document.getElementById('loginForm');

   if (loginForm) {
      loginForm.addEventListener('submit', function (event) {
         event.preventDefault();

         let formData = new FormData(loginForm);
         formData.append('action', 'login_ajax_callback');
         formData.append('_ajax_nonce', ajax.ajaxNonce);
         fetch(ajax.ajaxUrl, {
            method: 'POST',
            body: formData,
         })
            .then((response) => response.json())
            .then((data) => {
               if (data.hasOwnProperty('data')) {
                  var mensagem = data.data.message;
                  var dataResponse = document.getElementById('dataResponse');
                  if (dataResponse) {
                     dataResponse.innerHTML = mensagem;
                     dataResponse.classList.remove('hidden');
                     dataResponse.classList.add('block')
                     setTimeout(function () {
                        dataResponse.classList.add('hidden');
                        dataResponse.classList.remove('block')
                     }, 5000);
                  }
               }
               if (data.hasOwnProperty('success')) {
                  if (data.success === true) {
                     var loginForm = document.getElementById('loginForm');

                     if (loginForm) {
                        loginForm.reset();
                     }

                     window.location.href = ajax.homeUrl + '/minha-conta/'
                  }
               }
            })
            .catch((error) => {
               console.error('Ocorreu um erro:', error);
            });
      });
   }

   const registerForm = document.getElementById('registerForm');

   if (registerForm) {
      registerForm.addEventListener('submit', function (event) {
         event.preventDefault();

         let formData = new FormData(registerForm);
         formData.append('action', 'register_ajax_callback');
         formData.append('_ajax_nonce', ajax.ajaxNonce);
         fetch(ajax.ajaxUrl, {
            method: 'POST',
            body: formData,
         })
            .then((response) => response.json())
            .then((data) => {
               if (data.hasOwnProperty('data')) {
                  var mensagem = data.data.message;
                  var dataResponse = document.getElementById('dataResponse');
                  if (dataResponse) {
                     dataResponse.innerHTML = mensagem;
                     dataResponse.classList.remove('hidden');
                     dataResponse.classList.add('block')
                     setTimeout(function () {
                        dataResponse.classList.add('hidden');
                        dataResponse.classList.remove('block')
                     }, 5000);
                  }
               }
               if (data.hasOwnProperty('success')) {
                  if (data.success === true) {
                     var registerForm = document.getElementById('registerForm');

                     if (registerForm) {
                        registerForm.reset();
                     }

                     window.location.href = ajax.homeUrl + '/entrar/'
                  }
               }
            })
            .catch((error) => {
               console.error('Ocorreu um erro:', error);
            });
      });
   }

   var ultimmo_drop = new Swiper('#swiper-ultimmo-drop', {
      slidesPerView: 1,
      spaceBetween: 30,
      navigation: {
         nextEl: '.swiper-button-next',
         prevEl: '.swiper-button-prev',
      },
      pagination: {
         el: '.swiper-pagination',
         clickable: true,
      },
      breakpoints: {
         768: {
            slidesPerView: 3,
         }
      }
   });

   var homeVideo = document.getElementById('homeVideo');

   if (homeVideo) {
      // Inicia o vídeo mutado e com volume 0
      homeVideo.muted = true;
      // homeVideo.volume = 0;
      homeVideo.play();

      // // Função para ajustar o volume
      // function ajustarVolume() {
      //    var videoOffsetTop = document.querySelector('.collection').offsetTop;
      //    var videoHeight = document.querySelector('.collection').offsetHeight;
      //    var windowHeight = window.innerHeight;

      //    var scrollPosition = window.scrollY;
      //    // homeVideo.muted = false;
      //    homeVideo.volume = 0.5

      //    if (console.log(scrollPosition >= videoOffsetTop - windowHeight && scrollPosition <= videoOffsetTop + videoHeight)) {
      //       var progresso = (scrollPosition - (videoOffsetTop - windowHeight)) / videoHeight;
      //       var novoVolume = progresso;

      //       // if (novoVolume > 1) {
      //       //    novoVolume = 1;
      //       // }

      //       homeVideo.muted = false;
      //       // homeVideo.volume = novoVolume;
      //    }
      // }

      // Adiciona um ouvinte de evento para o evento de rolagem
      // window.addEventListener('scroll', ajustarVolume);
   }
});

function setAddress(cep) {
   if (!cep) {
      return
   }

   if (cep.length !== 9) {
      return
   }

   const cep_clear = cep.replace(/-/g, '')

   let api_url = 'https://viacep.com.br/ws/' + cep_clear + '/json/'

   fetch(api_url)
      .then((response) => response.json())
      .then((data) => {
         console.log(data)
         if (!data.hasOwnProperty('erro')) {
            document.querySelector('[name="billing_postcode"]').value = data.cep
            document.querySelector('[name="billing_address_1"]').value = data.logradouro
            document.querySelector('[name="billing_neighborhood"]').value = data.bairro
            document.querySelector('[name="billing_city"]').value = data.localidade
            document.querySelector('[name="billing_state"]').value = data.uf
         }
      })
      .catch((error) => {
         console.error('Ocorreu um erro:', error);
      });
}

function phoneMask(input) {
   return input.length > 14 ? '(99) 99999-9999' : '(99) 9999-9999'
}

document.addEventListener('DOMContentLoaded', function () {
   function verificarAltura() {
      var wrapper = document.querySelector('.woocommerce-billing-fields__field-wrapper');

      if (!wrapper) {
         return
      }

      var billingFields = document.querySelector('.woocommerce-billing-fields');

      if (wrapper.clientHeight === 0) {
         billingFields.classList.add('hidden');
      }
   }

   verificarAltura();
});
