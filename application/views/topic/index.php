<main>
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div id="content">
                <div class="btn-group">
                    <a href="<?= base_url('Forum/board/'.$breadcrumb[0]['id_board'].'') ?>" class="btn btn-default grey"><?= $breadcrumb[0]['board']; ?></a>
                    <a id="url_topic" href="<?= base_url('Forum/topic/'.$replies[0]['id_topic'].'/'.strtolower(url_title(convert_accented_characters($replies[0]['title'])))); ?>" class="btn btn-default grey on"><?= $replies[0]['title']; ?></a>
                </div>
                <div class="btn-group pull-right">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
                <div class="btn-group pull-right">
                    <a class="btn indigo" href="<?= base_url('Forum/reply/'.$replies[0]['id_topic'].''); ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i><span> Responder</span></a>
                </div>
                <?php foreach($replies as $reply){ ?>
                <div class="message">
                    <div class="account">
                        <div class="avatar" style="background-image:url('<?= base_url('uploads/users/avatars/'.$reply['avatar']); ?>');"></div>
                        <div class="nick">
                            <span><h1><a href="<?= base_url('User/profile/'.$reply['author']); ?>"><?= $reply['author']; ?></a></h1></span>
                        </div>
                        <div class="box" style="background-color:#A4A4A4;">Usuario</div>
                        <div class="box" style="color:#000;"><i class="fa fa-comments" aria-hidden="true"></i> 2.150</div>
                    </div>
                    <div class="body">
                        <button class="btn btn-default grey pull-left"><i class="fa fa-clock-o" aria-hidden="true"></i> Hace <?= timespan($reply['poster_time'],time(),1); ?></button>
                        <button class="btn btn-default grey pull-left disabled <?= (0 == $reply['modified_time']) ? 'hidden' : 'show'; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Hace <?= timespan($reply['modified_time'],time(),1); ?></button>
                        <a href="<?= base_url('Forum/reply/'.$reply['id_topic'].'/'.$reply['id_msg'].''); ?>" class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i></a>
                        <a href="<?= base_url('Forum/edit/'.$reply['id_msg']); ?>" class="btn btn-warning pull-right"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                        <?php if ($reply === reset($replies)) { ?>
                            <a href="<?= base_url('Topic/closeTopic'); ?>" id="closeTopic" data-id="<?= $reply['id_topic']; ?>" class="btn indigo pull-right"><i class="fa fa-times" aria-hidden="true"></i></a>
                        <?php } ?>
                        <a href="" class="btn btn-danger pull-right"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </div>
                    <div class="body text">
                        <?= nl2br($reply['body']); ?>
                    </div>
                </div>
                <?php } ?>
            </div>


        </div>
        <div class="col-md-1"></div>
    </div>
</main>