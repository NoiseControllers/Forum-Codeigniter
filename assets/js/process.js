$(function() {

    $("form#login").on("submit", function(e) {
        e.preventDefault();

        var nick = $.trim($("[name=nick]").val());
        var passwd = $("[name=passwd]").val();
        var url = $(this).attr('action');

        var formData = {
            'nick'      :   nick,
            'passwd'    :   passwd
        }

        if(nick != '' && passwd != ''){

            $.ajax({
                type : "POST",
                url : url,
                data : formData,
                beforeSend : function() {

                },
                success : function(response) {
                    console.log(response);
                    var object = $.parseJSON(response);


                    if(object.hasOwnProperty('nick')){
                        toastr.info(object.nick, '¡Oops!');
                    }

                    if(object.hasOwnProperty('passwd')){
                        toastr.info(object.passwd, '¡Oops!');
                    }

                    if(object.login !== true){
                        toastr.error('Datos Incorrectos.', '¡Oops!');
                    }else{
                        toastr.success('Bienvenido :)', '¡Sesion Iniciada!');
                    }
                }
            });

        }else{
            toastr.info('Has dejado campos en blanco', '¡Oops!');
        }


       //End-Form-login
    });

    $("form#register").on("submit", function(e){

        $('input').removeClass('error-input');
        $('p.error-msg').remove();

        e.preventDefault();
        var nick = $.trim($("[name=nick]").val());
        var passwd = $("[name=passwd]").val();
        var conf_passwd = $("[name=conf_passwd]").val();
        var email = $("[name=email]").val();

        var url = $(this).attr('action');

        var formData = {
            'nick'          : nick,
            'passwd'        : passwd,
            'conf_passwd'   : conf_passwd,
            'email'         : email
        }

        if(nick == '' || passwd == '' || email == ''){
            toastr.info('Has dejado campos en blanco', '¡Oops!');
        }else if(passwd != conf_passwd){
            toastr.info('Las contraseñas no coinciden', '¡Oops!');
        }else{
            $.ajax({
                type : "POST",
                url : url,
                data : formData,
                success : function(response) {
                    var object = $.parseJSON(response);
                    console.log(object);

                    if(object.hasOwnProperty('nick')){
                        $("[name=nick]").addClass('error-input').after('<p class="error-msg">'+object.nick+'</p>');
                    }
                    if(object.hasOwnProperty('passwd')){
                        $("[name=passwd]").addClass('error-input').after('<p class="error-msg">'+object.passwd+'</p>');
                    }
                    if(object.hasOwnProperty('email')){
                        $("[name=email]").addClass('error-input').after('<p class="error-msg">'+object.email+'</p>');
                    }

                    if(object.register == true){
                        swal({
                            type: 'success',
                            title: '¡Completado!',
                            text: 'Te has registrado correctamente'

                        })
                    }else{
                        toastr.error('Hubo un error y no se pudo completar el registro.', '¡Oops!');
                    }
                }
            });
        }

    });

    $( "#like" ).click(function(e) {

        var id = $(this).attr('data-id');

        $.ajax({
            type : "GET",
            url : base_url+"profile/likes/set/"+id,
            data : id,
            success : function(response) {
                var object = $.parseJSON(response);
                switch(true) {
                    case true === object.success:
                        console.log(object.values);
                        $("#totalLikes").html(object.totalLikes);
                        break;
                    case false === object.success:
                        toastr.error(object.values, '¡Oops!');
                        break;
                    default:
                        alert(object.values);
                }
            }
        });
    });

    //Settings
    $("form#setting").on("submit", function(e){
        e.preventDefault();

       let email = $.trim($("[name=account_email]").val());
       let gender = $("[name=account_gender]").val();
       let location = $("[name=account_location]").val();

        let url = $(this).attr('action');

        let formData = {
            'email'         : email,
            'gender'        : gender,
            'location'      : location,
        }

        if ('' === email){
            toastr.error('El correo no puede estar en blanco.','Error');
            return false;
        }

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: 'json',
            success : function (res) {
                console.log(res);
               if (true === res.success) {
                    toastr.success(res.value);
                } else {
                    toastr.error(res.value, '¡Oops!');
                }
            },
            error: function (res) {
                toastr.error('El servidor no devolvio lo esperado...','Error');
            }
        });
    });

    $("form#settingPasswd").on("submit", function (e) {
       e.preventDefault();

       let url              = $(this).attr('action');
       let passwd_current   = $("[name=passwd_current]").val();
       let passwd_new       = $("[name=passwd_new]").val();
       let conf_passwd_new  = $("[name=conf_passwd_new]").val();

       let formData = {
           'current_passwd' : passwd_current,
           'new_passwd'     : passwd_new,
           'conf_passwd'    : conf_passwd_new
       };

       if ('' === passwd_current || '' === passwd_new || '' === conf_passwd_new ) {
           toastr.error('La/s contraseña/as no puede/n estar en blanco.','Campos en blanco!');
           return false;
       }else if (passwd_new !== conf_passwd_new) {
           toastr.error('La confirmacion de contraseña no coincide','¡¡Contraseñas incorrectas!!');
           return false;
       }

       $.ajax({
           type: "POST",
           url: url,
           data: formData,
           dataType: 'json',

           success: function (res) {
               console.log(res);
               if (true === res.success) {
                   toastr.success(res.value);
               }else{
                   toastr.error(res.value);
               }
           },
           error: function (res) {
               toastr.error('No se puede completar tu solicitud en este momento. Vuelva a intentarlo más tarde...');
           },
       });

    });

    $("form#uploadAvatar").on("submit", function(e) {
       e.preventDefault();
       $(".avatar.img-thumbnail").removeClass('animated jackInTheBox');
       let url = $(this).attr('action');

       $.ajax({
           type: "POST",
           url: url,
           data: new FormData(this),
           contentType: false,
           cache: false,
           processData:false,
           dataType: 'json',
           success: function (res) {
               console.log(res);
               if (true === res.success) {
                   toastr.success(res.value);
                   $(".avatar.img-thumbnail").addClass('animated hinge');
                   setTimeout(function() {
                       $(".avatar.img-thumbnail").removeClass('animated hinge').attr('src',res.img).addClass('animated jackInTheBox');
                   }, 1800);
                   return false;
               }
               toastr.error(res.value);
           },
           error: function () {
               toastr.error('No se puede completar tu solicitud en este momento. Vuelva a intentarlo más tarde...');
           }
       });
        this.reset();
    });

    $("form#uploadHead").on("submit", function (e) {
       e.preventDefault();

       $("#img_header").removeClass('animated flash');

       let url = $(this).attr('action');
       console.log(url);
       $.ajax({
          type: 'post',
          url: url,
          data: new FormData(this),
          contentType: false,
          cache: false,
           processData: false,
           dataType: 'json',
           success: function (res) {
              console.log(res);
               if (true === res.success) {
                   toastr.success(res.value);
                   $("#img_header").attr('src',res.img).addClass('animated flash');
                   return false;
               }
               toastr.error(res.value);
           },
           error: function () {
               toastr.error('No se puede completar tu solicitud en este momento. Vuelva a intentarlo más tarde...');
           }
       });

       this.reset();

    });


});
