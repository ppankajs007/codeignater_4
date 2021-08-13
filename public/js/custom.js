$(document).ready(function () {

  const base_url = $('meta[name=base_url]').attr('content');

  var phone = $('.phone').val(); 

  $('#register-form').validate({

    onkeyup:false,

    rules: {

       first_name: {

        required: true,

      },

      last_name: {

        required: true,

      },

      username: {

        required: true,

      },

      email: {


        required: function(element){ if($('#cons').val()==0) { if( $('.email').val()==''){ return true; }else{ return false;  } } else { return false; }},

        email: function(element){ if( $('.email').val()=='' && $('.phone').val()=='' ){ return true; }else{ return false; } },

        remote:`${base_url}/admin/checkEmailExist`

      },

      phone:{

      	required: function(element){ if( $('.email').val()=='' && $('.phone').val()=='' ){ return true; }else{ return false; } },

        remote:`${base_url}/admin/existPhone`

      },

      password: {

        required: true,

        minlength: 5

      },

      confirmpassword: {

        required: true,

        equalTo:"#password"

      },

      otp: {

        required: function(element){ if( $('.email').val()=='' && $('.phone').val()!='' ){ return true; }else{ return false; } },

      }

    },

    messages: {

      first_name: {

        required: "Please enter a first name",

      },

      last_name: {

        required: "Please enter a last name",

      },

      username: {

        required: "Please enter a username",

      },

      email: {

        //required: "Please enter a email address",

        email: "Please enter a vaild email address",

        remote: "Email is already taken."

      },

      phone:{

      	required: "Please enter a phone number",

        remote: "Phone is already taken."

      },

      password: {

        required: "Please provide a password",

        minlength: "Your password must be at least 5 characters long"

      },

      confirmpassword:{

      	required: "Please enter confirm password",

        equalTo:"Password is not match"

      }

    },

    errorElement: 'span',

    errorPlacement: function (error, element) {

      error.addClass('invalid-feedback');

      element.closest('.input-group').append(error);

    },

    highlight: function (element, errorClass, validClass) {

      $(element).addClass('is-invalid');

    },

    unhighlight: function (element, errorClass, validClass) {

      $(element).removeClass('is-invalid');

    },

    submitHandler: function () {

      //if( $('.email').val()=='' && $('.phone').val()!='' ){
	  /*if( $('.phone').val()!='' ){

          $('.otpInput').show();

      }else{*/
		$('.otpInput').show();

        if (grecaptcha.getResponse()) {

          $('#register-form')[0].submit();

        } else {

          $('#RecaptchaError').show();

        }  

      //}

      

    	

    }

  });



  $( ".phone" ).keypress(function(evt) {

    var charCode = (evt.which) ? evt.which : event.keyCode

    if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;

    return true;

  });



  $('.phone').blur(function(){

      var phone = $(this).val();

      if( phone == '' || $(this).hasClass('is-invalid') ){

            $('.otpInput').hide();

      }else{

            $('.otpInput').show();

      }

  });



  $(document).on('click','.sendOtp',function(){

      var phone = $('.phone').val();

      $.get(`${base_url}/admin/generateOtp?phone=${phone}`, 

             function(data){

              if( !data ){

                  $('.otpInput').hide();

              }else{

                  alert(data);  

              }

      });

  })



   $(document).on('keyup','.forgetPhone',function(){

        $('.email').val('');

    })

    $(document).on('keyup','.forgetEmail',function(){

        $('.phone').val('');

    })



    $(document).on('click','.forgetPassByPhone',function(e){

          e.preventDefault();

          var otp = $('.otpPass').val();

          var phone = $('.phonePass').val();

          if( otp !='' ){

              $.ajax({

                  url:`${base_url}/admin/forgetByOtp`,

                  method:'POST',

                  data:{otp:otp,phone:phone},

                  error:function(error){

                    console.log( error );

                  },

                  success:function(data){



                      if( data != '' ){

                        $('.passwordInput').html("");

                        $('.passwordInput').html(data);

                        $('.otpPass').prop('readonly','readonly');

                        $('.forgetPassByPhone').addClass('resetPasswordByPhone');

                        $('.resetPasswordByPhone').removeClass('forgetPassByPhone');

                      }else{

                        swallPopup('error','Otp is wrong');

                      }

                      

                  }

              })

          }else{

            swallPopup('error','Required Otp Input');

          }

    });



    $(document).on('click','.resetPasswordByPhone',function(e){

          e.preventDefault();

          var otp = $('.otpPass').val();

          var phone = $('.phonePass').val();

          var password = $('.new_password').val();

          var conpassword = $('.confirm_password').val();

          if( password !='' && conpassword !='' && phone !='' && otp != ''  ){

              if( password == conpassword  ){

                  $.ajax({

                    url:`${base_url}/admin/resetPasswordByotp`,

                    method:'POST',

                    data:{otp:otp,phone:phone,password:password,conpassword:conpassword},

                    error:function(error){

                      console.log( error );

                    },

                    success:function(data){

                      var dataMessage = JSON.parse(data);

                        if( !data.error ){

                          swallPopup('success',dataMessage.message);

                            window.location.href=`${base_url}`

                        }else{

                          swallPopup('error',dataMessage.message);

                        }

                    }

                  })  

              }else{

                swallPopup('error','Password Not match');

              }

          }else{

            swallPopup('error','Required All Fileds');

          }

    });



    const swallPopup = (type,msg) => {

        const Toast = Swal.mixin({

              toast: true,

              position: 'top-end',

              showConfirmButton: false,

              timer: 3000

            })

             Toast.fire({

              icon: `${type}`,

              title: `${msg}`

            })

    }



});



