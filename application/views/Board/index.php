<main>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="category">

                    <div class="bar" style="background-color:#F8CB79;"></div>
                    <?php foreach ($boards AS $board){ ?>

                    <div class="board">
                        <div class="icon" style="background-image: url('<?= base_url('assets/img/icon.png'); ?>');"></div>
                        <div class="info">
							<span>
								<a href="#"><?= $board['name']; ?></a>
								<br>
								<p class="description"><?= $board['description']; ?></p>
							</span>
                        </div>
                        <div class="pull-right">
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</main>