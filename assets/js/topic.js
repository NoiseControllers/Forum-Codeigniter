$(function() {

    $("form#topic").on("submit", function(e) {
        e.preventDefault();

        $('input,textarea').removeClass('error-input');
        $('div.alert').remove();

        var action = $(this).attr('action');
        var title = $("[name=topic_title]").val();
        var body = $("[name=topic_body]").val();

        var formData = {
            'title_post'   :   title,
            'body_post'    :   body,
            'id_board'     : $("[name=id_board]").val()
        }

        if(title == ''){
            $('[name=topic_title]').addClass('error-input').before('<div class="alert alert-danger">El campo asunto esta en blanco.</div>');
        }

        if(body == ''){
            $('[name=topic_body]').addClass('error-input').before('<div class="alert alert-danger">El campo Mensaje esta en blanco.</div>');
            return false;
        }

        $.ajax({
            type : "POST",
            url : action,
            data : formData,
            success : function(response) {
                console.log(response);
                var object = $.parseJSON(response);

                if(object.hasOwnProperty('title')){
                    $('[name=topic_title]').addClass('error-input').before('<div class="alert alert-danger">'+title+'</div>');
                }
                if(object.hasOwnProperty('message')){
                    $('[name=topic_body]').addClass('error-input').before('<div class="alert alert-danger">'+message+'</div>');
                }

                if(object.error != true){
                    swal("¡Buen trabajo!", "Se publico con exito.", "success");
                    setTimeout(function(){
                        window.location = object.url;
                    }, 3000);

                }else{
                    swal("Ooops!", "Hubo un error y no se pudo publicar su tema...", "danger");
                }

            }
        });

    });

    $('form#topicEdit').submit(function( e ) {
        e.preventDefault();
        let action = $(this).attr('action');

        $.ajax({
            type: "POST",
            url: action,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            success: function (response) {
                console.log(response);

                if (true === response.success) {
                    toastr.success(response.value);
                    return false;
                }
                toastr.error(response.value);
            },
            error: function () {
                toastr.error('No se puede completar tu solicitud en este momento. Vuelva a intentarlo más tarde...');
            }

        });

    });

    $("#closeTopic").click(function (e) {
       e.preventDefault();

       let id_topic = $(this).attr('data-id');
       let url = $(this).attr('href');

        swal({
            title: "¿Esta seguro?",
            text: "Una vez el topic este cerrado, no hay vuelta atras.",
            icon: "warning",
            dangerMode: true,
            buttons: ["Cancelar", "Cerrar Tema"],
        })
            .then(willDelete => {
                if (willDelete) {

                    $.ajax({
                       type: "POST",
                       action: url,
                        data: "id_topic="+id_topic,
                        success: function (response) {
                           console.log(response);
                            /*if (true === object.success){
                                swal("¡Cerrado!", object.value, "success");
                                return false;
                            }
                            toastr.error(response.value);*/
                        },
                        error: function () {
                            toastr.error('No se puede completar tu solicitud en este momento. Vuelva a intentarlo más tarde...');
                        }
                    });
                }
            });

    });

});