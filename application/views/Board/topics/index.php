<main>
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div id="content">
                <div class="btn-group">
                    <a href="<?= base_url(); ?>" class="btn btn-default grey"><?= $breadcrumb[0]['categoria']; ?></a>
                    <a href="<?= base_url('Forum/board/'.$breadcrumb[0]['id_board'].''); ?>" class="btn btn-default grey on"><?= $breadcrumb[0]['board']; ?></a>
                </div>
                <div class="btn-group pull-right">
                    <a href="#" class="btn grey" style="padding: 9px 12px;"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
                <div class="btn-group pull-right">
                    <a class="btn indigo" href="<?= base_url('Forum/post/'.$breadcrumb['0']['id_board'].''); ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i><span> Nuevo tema</span></a>
                </div>

                <?php foreach($topics as $topic){ ?>

                <div class="topic">
                    <div class="box">
                        <?php echo $topic['locked'] != 0 ? "<i class=\"fa fa-lock fa-2x\" aria-hidden=\"true\"></i>" : ""; ?>
                        <a href="<?= base_url('Forum/topic/'.$topic['id_topic'].'/'.strtolower(url_title(convert_accented_characters($topic['title']))).''); ?>"><?= $topic['title']; ?></a>
                        <br/>
                        <div class="description">
                            <p>hace <?= timespan($topic['time_topic'],time(),1); ?> por <a href="#"><em style="font-size:14px;"><?= $topic['author']; ?></em></a>.</p>
                        </div>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-default small" href="#">Último mensaje por <?= $topic['last_user_msg']; ?></a><br>
                        <div class="pull-right">
                            <div class="btn btn-default small disabled right"><i class="fa fa-envelope" aria-hidden="true"></i> 46</div>
                            <div class="btn btn-default small disabled"><i class="fa fa-clock-o" aria-hidden="true"></i> hace <?= timespan($topic['last_poster_msg'],time(),1); ?></div>
                        </div>

                    </div>
                </div>
                <?php } ?>

            </div>


        </div>
        <div class="col-md-1"></div>
    </div>
</main>