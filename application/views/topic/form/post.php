<main>
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div id="content">
                <div class="pull-left">
                    <div class="btn-group">
                        <a class="btn grey" href="<?= base_url('Forum/board/'.$breadcrumb[0]['id_board'].'') ?>"><?= $breadcrumb[0]['board'] ?></a>
                        <a class="btn grey on" href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                </div>
                <hr>
                <div class="body">
                    <form id="topic" method="post" action="<?= base_url('topic/processTopic') ?>" >
                        <input type="text" name="topic_title" class="form-control" placeholder="Escriba un asunto..." >
                        <div class="bbcode">
                            <div class="btn-group">
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','b');"><i class="fa fa-bold" aria-hidden="true"></i></button>
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','i');"><i class="fa fa-italic" aria-hidden="true"></i></button>
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','u');"><i class="fa fa-underline" aria-hidden="true"></i></button>
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','s');"><i class="fa fa-strikethrough" aria-hidden="true"></i></button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','left');"><i class="fa fa-align-left" aria-hidden="true"></i></button>
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','center');"><i class="fa fa-align-center" aria-hidden="true"></i></button>
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','justify');"><i class="fa fa-align-justify" aria-hidden="true"></i></button>
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','right');"><i class="fa fa-align-right" aria-hidden="true"></i></button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','img');"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','url');"><i class="fa fa-link" aria-hidden="true"></i></button>
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','quote');"><i class="fa fa-quote-right" aria-hidden="true"></i></button>
                                <button type="button" class="btn grey" onclick="addTag('topic_reply','spoiler');"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>

                            </div>
                        </div>
                        <textarea name="topic_body" id="topic_reply" style="height: 250px;margin: 8px 0 8px 0;resize: vertical;" class="form-control" placeholder="Escriba el mensaje" ></textarea>
                        <input type="hidden" value="<?= $breadcrumb[0]['id_board']; ?>" name="id_board">
                        <a href="<?= base_url('Forum/board/'.$breadcrumb[0]['id_board'].''); ?>" class="btn btn-danger pull-left">Cancelar</a>
                        <div class="btn-group pull-right">
                            <a href="#" class="btn grey">Previsualizar</a>
                            <button type="submit" class="btn btn-success">Crear tema</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</main>