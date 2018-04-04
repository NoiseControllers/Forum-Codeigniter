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

});