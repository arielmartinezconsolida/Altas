<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Metodo consolida">
    <meta name="author" content="Metodo consolida">
    <title>Método consolida</title>
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- BASE CSS -->
    <link href="<?=getenv('CSS') ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?=getenv('CSS') ?>menu.css" rel="stylesheet">
    <link href="<?=getenv('CSS') ?>style.css" rel="stylesheet">
    <link href="<?=getenv('CSS') ?>vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="<?=getenv('CSS') ?>custom.css" rel="stylesheet">

    <!-- MODERNIZR MENU -->
    <script src="<?=getenv('JS') ?>modernizr.js"></script>
    <style>
        input{
            margin: 10px 0;
        }
    </style>
</head>

<body class="layout_2">
<header>
    <div class="container-fluid">
        <a href="#"><img src="<?=getenv('IMG') ?>LOGO-Metodo-consolida-300.png" alt=""  class="d-none d-md-inline"><img src="<?=getenv('IMG') ?>LOGO-Metodo-consolida-300.png" alt=""  class="d-inline d-md-none"></a>
    </div>
</header>
<div class="container-fluid">
    <div id="form_container">
        <div class="row justify-content-center" style="min-height: 500px">
            <div class="col-12 col-md-4"></div>
            <div class="col-12 col-md-4">
                <form method="post" class="form-horizontal form-simple" action="<?=site_url() ?>">
                    <h5 class="mt-30">Introduzca sus datos de acceso</h5>
                    <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input  value="<?=set_value('username') ?>" type="text" class="form-control form-control-lg input-lg"  placeholder="Usuario" name="username">
                        <div class="form-control-position">
                            <i class="ft-user"></i>
                        </div>
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input value="<?=set_value('password') ?>" type="password" class="form-control form-control-lg input-lg"  placeholder="Contraseña" name="password">
                        <div class="form-control-position">
                            <i class="fa fa-key"></i>
                        </div>
                    </fieldset>
                    <?php if(isset($validation)) echo $validation->listErrors('errors_list') ?>
                    <?php if(isset($login_error_data)) { ?>
                        <div class="alert bg-danger text-white">
                            <?php echo $login_error_data ?>
                        </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Entrar</button>

                </form>
                <div>
                    <p class="text-center mt-3">
                        Estimado cliente, las altas que se ingresen en el formulario, serán procesadas en los siguiente horarios:
                        09:00, 11:00, 13:00 y 17:00 hrs de lunes a viernes (días laborales)
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4"></div>
        </div><!-- /Row -->
    </div><!-- /Form_container -->
</div>
<!-- /container -->

<footer class="footer_in clearfix">
    <div class="container">
        <p>© <?=date('Y') ?> Método consolida</p>
    </div>
</footer>
<script src="<?=getenv('JS') ?>jquery-3.6.0.min.js"></script>
</body>
</html>