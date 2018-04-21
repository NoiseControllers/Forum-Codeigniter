<main>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">

                <div class="submenu">
                    <div class="container-fluid">
                        <a class="btn" href="<?= base_url('Profile/Settings'); ?>">Cuenta</a>
                        <a class="btn active" href="<?= base_url('Profile/Settings/avatar'); ?>">Perfil</a>
                    </div>

                </div>

            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="color: #b19cd9;border-bottom: 1.5px solid #b19cd9;">Avatar <i class="fa fa-address-book pull-right" aria-hidden="true"></i></div>
                        <div class="panel-body">
                            <form method="post" id="uploadAvatar" action="<?= base_url('profile/Settings/processUploadAvatar'); ?>" enctype="multipart/form-data">
                                <input type="file" accept="image/*" name="userfile" style="margin: 0 auto 8px auto;">
                                <button type="submit" class="btn indigo" style="width:100%;">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    Subir una imagen (selecciona el archivo arriba)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="color: #836953;border-bottom: 1.5px solid #836953;">Cabecera <i class="fa fa-picture-o pull-right" aria-hidden="true"></i></div>
                        <div class="panel-body">
                            <form method="post" id="uploadHead" action="<?= base_url('profile/Settings/processUploadHead'); ?>" enctype="multipart/form-data">
                                <input type="file" accept="image/*" name="userfile" style="margin: 0 auto 8px auto;">
                                <button type="submit" class="btn indigo" style="width:100%;">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    Subir una imagen (selecciona el archivo arriba)
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img id="img_header" src="<?= base_url('uploads/users/profile/'.$user['img_header']); ?>" style="max-height:100px; width:100%;">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>