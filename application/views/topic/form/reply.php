<main>
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div id="content">
                <div class="pull-left">
                    <div class="btn-group">
                        <a class="btn grey" href="<?= base_url('Forum/topic/'.$topic[0]['id_topic'].'/'.strtolower(url_title(convert_accented_characters($topic[0]['title'])))); ?>"><?= $topic[0]['title']; ?></a>
                        <a class="btn grey on" href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                </div>
                <hr>
                <div class="body">
                    <form id="reply" method="post" action="<?= base_url('topic/reply/'.$topic[0]['id_topic'].'') ?>" >
                        <div class="bbcode">
                            <div class="btn-group">
                                <button class="btn grey" onclick="addTag('topic_reply','b');"><i class="fa fa-bold" aria-hidden="true"></i></button>
                                <button class="btn grey"><i class="fa fa-italic" aria-hidden="true"></i></button>
                                <button class="btn grey"><i class="fa fa-underline" aria-hidden="true"></i></button>
                                <button class="btn grey"><i class="fa fa-strikethrough" aria-hidden="true"></i></button>
                            </div>
                            <div class="btn-group">
                                <button class="btn grey"><i class="fa fa-align-center" aria-hidden="true"></i></button>
                                <button class="btn grey"><i class="fa fa-align-justify" aria-hidden="true"></i></button>
                                <button class="btn grey"><i class="fa fa-align-left" aria-hidden="true"></i></button>
                                <button class="btn grey"><i class="fa fa-align-right" aria-hidden="true"></i></button>
                            </div>
                            <div class="btn-group">
                                <button class="btn grey"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                                <button class="btn grey"><i class="fa fa-link" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <textarea name="topic_body" id="topic_reply" style="height: 250px;margin: 8px 0 8px 0;resize: vertical;" class="form-control" placeholder="Escriba el mensaje" ><?php if(array_key_exists('quote',$topic)) echo $topic['quote']; ?></textarea>
                        <a href="<?= base_url('Forum/topic/'.$topic[0]['id_topic'].'/'.$topic[0]['title'].''); ?>" class="btn btn-danger pull-left">Cancelar</a>
                        <div class="btn-group pull-right">
                            <a href="#" class="btn grey">Previsualizar</a>
                            <button type="submit" class="btn btn-success">Responder</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</main>