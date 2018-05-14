 <main style="margin-top:8px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="head" style="background-image: url('<?= base_url('uploads/users/profile/'.$user[0]['img_header'].''); ?>');">
                        <div id="overlay">
                            <div id="account">
                                <div id="avatar" style="background-image:url('<?= base_url('uploads/users/avatars/'.$user[0]['avatar'].''); ?>');"></div>
                            </div>
                            <div id="name">
                                <?= $user[0]['nick']; ?>
                            </div>
                            <button id="like" data-id="<?= $user[0]['id']; ?>" class="btn btn-danger pull-right"><i class="fa fa-heart" aria-hidden="true"></i> <span id="totalLikes"><?= $totalLikes[0]; ?></span></button>
                            <div class='heart-animation-1'></div>
                            <div class='heart-animation-2'></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col-md-6">
                    <div id="info-usuario">
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= (is_null($user[0]['location'])) ? "Desconocida " : $user[0]['location']; ?></li>
                            <li class="list-group-item"><i class="fa fa-clock-o" aria-hidden="true"></i> Miembro desde hace <?= timespan($user[0]['date_registered'],time(),1); ?></li>
                            <li class="list-group-item"><i class="fa fa-tag" aria-hidden="true"></i> <?= $user[0]['group_name']; ?></li>
                            <li class="list-group-item"><i class="fa fa-comments-o" aria-hidden="true"></i> <?= $totalMessages[0]['totalMessages']; ?> mensajes publicados en el foro</li>
                            <li class="list-group-item"><i class="fa fa-book" aria-hidden="true"></i> <?= $totalTopics[0]['totalTopics']; ?> temas en el foro</li>
                            <li class="list-group-item"><i class="fa fa-heartbeat" aria-hidden="true"></i> Última conexión hace <?= timespan($user[0]['last_login'],time(),1); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="border-bottom: 2px solid #b19cd9;">Ultima actividad <i class="fa fa-comment pull-right" aria-hidden="true"></i></div>
                        <ul class="list-group">
                            <?php
                                foreach($last_activity as $activity){
                                    echo '<li class="list-group-item"><a href="'.base_url('Forum/topic/'.$activity['id_topic'].'/'.strtolower(url_title(convert_accented_characters($activity['title'])))).'">'.$activity['title'].'</a> hace '.timespan($activity['poster_time'],time(),1).'</li>';
                                }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </main>