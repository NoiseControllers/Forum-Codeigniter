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
        let topicUrl = $('#cancel').attr('href');

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

                if (false === response.success) {
                    toastr.error(response.value);
                    return false;
                }

                toastr.success(response.value);
                $('button[type=submit]').attr('disabled','disabled');
                setTimeout(function(){
                    window.location = decodeURI(topicUrl);
                }, 2000);

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

       console.log(id_topic+'/'+url);

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
                       url: url,
                        data: "id_topic="+id_topic,
                        cache: false,
                        dataType: 'json',
                        success: function (response) {
                           console.log(response);
                            if (true === response.success){
                                swal("¡Cerrado!", response.value, "success");
                                setTimeout( function () {
                                    location.reload();
                                }, 2000);
                                return false;
                            }
                            toastr.error(response.value);
                        },
                        error: function () {
                            toastr.error('No se puede completar tu solicitud en este momento. Vuelva a intentarlo más tarde...');
                        }
                    });
                }
            });
    });

    $('form#reply').submit(function (e) {
       e.preventDefault();

       let msg = $('textarea#topic_reply').val();
       let url = $(this).attr('action');
       let topicUrl = $('textarea#topic_reply + a').attr('href');

       if ( '' == msg) {
           toastr.error('No puedes dejar un comentario vacio.');
           return false;
       }

       $.ajax ({
           type: 'POST',
           url: url,
           data: new FormData(this),
           contentType: false,
           cache: false,
           processData:false,
           dataType: 'json',
           success: function (response) {
                console.log(response);
               if (false === response.success) {
                   toastr.error(response.value);
                   return false;
               }

               toastr.success(response.value);
               $('button[type=submit]').attr('disabled','disabled');
               setTimeout(function(){
                   window.location = decodeURI(topicUrl);
               }, 2000);

           },
           error: function () {
               toastr.error('No se puede completar tu solicitud en este momento. Vuelva a intentarlo más tarde...');
           }

       })

    });

});

function addTag(e, t) {
    let n = document.getElementById(e),
        a = "[" + t + "]",
        o = "[/" + t + "]";
    if (document.selection) {
        n.focus();
        var s = document.selection.createRange();
        s.text = a + s.text + o
    } else if (n.selectionStart || "0" == n.selectionStart) {
        let r = n.value.substring(0, n.selectionStart);
        if (o) {
            let c = r + a + n.value.substring(n.selectionStart, n.selectionEnd);
            n.value = c + o + n.value.substring(n.selectionEnd, n.textLength), setCaretPosition(n, c.length)
        } else n.value = r + a + n.value.substring(n.selectionStart, n.textLength), setCaretPosition(n, r.length + a.length)
    } else n.value = a + o, setCaretPosition(n, a.length + o.length)
}
function setCaretPosition(e, t) {
    if (null != e)
        if (e.createTextRange) {
            var i = e.createTextRange();
            i.move("character", t), i.select()
        } else e.selectionStart ? (e.focus(), e.setSelectionRange(t, t)) : e.focus()
}

function toggleSpoiler(btn)
{
    let txt_show = $(btn).attr('data-text-show');
    let txt_hide = $(btn).attr('data-text-hide');
    let div = $(btn).next();

    if (div.attr('style') == 'display: none;') {
        div.css('display','block');
        $(btn).text(txt_hide);
    }else{
        div.css('display','none');
        $(btn).text(txt_show);
    }
}