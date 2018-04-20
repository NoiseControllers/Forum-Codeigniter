<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css'); ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/all.css'); ?>">
		<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>
    <body>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="<?= base_url(); ?>"><img src="<?= base_url('assets/img/logo.png'); ?>" alt="logo"></a>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <?php if(!$this->session->userdata('id')){ ?>

                        <a class="btn btn-success" href="<?= base_url('login'); ?>">Ingresar</a>
                        <a class="btn btn-info" href="<?= base_url('register'); ?>">Registrarse</a>

                    <?php }else{ ?>

                        <!-- USUARIO LOGGIN -->
                        <img src="<?= base_url('uploads/users/avatars/').$this->session->userdata('avatar'); ?>" class="avatar img-thumbnail" alt="*">
                        <ul class="reset">
                            <li class="user">Hola <?= $this->session->userdata('nick'); ?></li>
                            <li><a href="<?= base_url('User/profile/'.$this->session->nick); ?>">Perfil</a></li>
                            <li><a href="<?= base_url('Profile/Settings'); ?>">Configuración del perfil</a></li>
                            <li><a href="<?= base_url('User/logout'); ?>">Salir</a></li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
