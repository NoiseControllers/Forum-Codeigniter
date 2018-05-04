<html>
<head>
    <meta charset="utf-8">
    <title>Registro: Redby</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets/js/process.js'); ?>"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
    <script src="https://unpkg.com/promise-polyfill@7.1.0/dist/promise.min.js"></script>
</head>
<body>
<div class="login">
    <form id="register" method="post" action="<?= base_url('Register/process'); ?>">
        <h2>¡Registrate!</h2>

        <input type="text" name="nick" placeholder="NickName" />
        <input type="password" name="passwd" placeholder="*****" />
        <input type="password" name="conf_passwd" placeholder="*****" />
        <input type="email" name="email" placeholder="Corréo Electronico" />
        <input type="submit" value="Registrarse" />
    </form>
</div>
<script>
    var base_url = "<?= base_url(); ?>";
</script>
</body>
</html>