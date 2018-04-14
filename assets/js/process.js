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

});