/*--------------------------------------------------contactForm--------------------------------------------------*/
$(function(){
    const name = document.getElementsByName('name')[0];
    const userEmail = document.getElementsByName('email')[0];
    const message = document.getElementsByName('message')[0];
    const find_us = document.getElementsByName('find-us')[0];
    const formAlert = document.querySelector(".emailFormAlert");
    const contactForm = $('.contact');
    const isValid = validateEmailForm();


    $('.submit-btn').click(function (event) {
        event.preventDefault();
        //reszta

        if(isValid===true) {
          const sendEmail = $.ajax({
                type: "POST",
                url: "../resources/php/send-script.php",
                dataType : 'json',
                data: {
                  'userEmail' : userEmail.value,
                  'name' : name.value,
                  'message' : message.value,
                }
              });

            sendEmail.fail(function(error) {
                formAlert.innerHTML='Coś poszło nie tak :( '+error.responseText;
            });
            sendEmail.done(function(response){
                formAlert.innerHTML=response.text;
            });
        }
      });

      function validateEmailForm() {
    if(userEmail.validity.valid===false){
        $(userEmail).attr("placeholder", "Podaj poprawny email");
    }
    else if (name.validity.valueMissing){
        $(name).attr("placeholder", "Podaj poprawnye imię");
    }
    else if (message.validity.valueMissing){
        $(message).attr("placeholder", "Napisz coś!");
    }
    else return true;
    }



  });














