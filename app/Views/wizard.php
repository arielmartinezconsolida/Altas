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

</head>

<body class="layout_2">

<div id="preloader">
    <div data-loader="circle-side"></div>
</div><!-- /Preload -->

<div id="loader_form">
    <div data-loader="circle-side-2"></div>
</div><!-- /loader_form -->

<header>
    <div class="container-fluid">
        <a href="#"><img src="<?=getenv('IMG') ?>LOGO-Metodo-consolida-300.png" alt=""  class="d-none d-md-inline"><img src="<?=getenv('IMG') ?>LOGO-Metodo-consolida-300.png" alt=""  class="d-inline d-md-none"></a>
    </div>
    <!-- /container -->
</header>
<!-- /Header -->

<div class="container-fluid">
    <div id="form_container">
        <div class="row justify-content-center">
            <div class="col-lg-12 form_container">
                <div id="wizard_container">
                    <div id="top-wizard">
                        <div id="progressbar"></div>
                    </div>
                    <!-- /top-wizard -->
                    <form id="wrapped" method="post" action="<?=site_url() ?>wizard">
                        <input id="website" name="website" type="text" value="">
                        <!-- Leave for security protection, read docs for details -->
                        <div id="middle-wizard">

                            <div class="step add_top_10 mt-30-desktop">
                                <h3 class="main_question"><i class="arrow_right"></i>Datos de la empresa</h3>
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="form-group">
                                            <label for="cif">Sociedad</label>
                                            <?php if(!empty($companies)) { ?>
                                                <select id="cif" name="cif" class="form-control required">
                                                    <option value="">Seleccione sociedad</option>
                                                <?php foreach ($companies as $company) { ?>
                                                     <option value="<?=$company->com_cif ?>"><?=$company->com_name ?></option>
                                                <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                                <h3 class="main_question mt-30"><i class="arrow_right"></i>Datos del trabajador</h3>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" name="name" id="name" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Apellidos</label>
                                            <input type="text" name="lastname" id="lastname" class="form-control required">
                                        </div>
                                        <p><strong>Fecha de nacimiento</strong></p>
                                        <div class="form-group">
                                            <input type="date" name="birthdate" id="birthdate" class="form-control required">
                                        </div>
                                        <p><strong>Seleccione tipo de documento</strong></p>
                                        <div class="form-group">
                                            <label class="container_radio version_2 dni">DNI
                                                <input type="radio" name="document_type" value="dni" class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="container_radio version_2 nie">NIE
                                                <input type="radio" name="document_type" value="nie" class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="nif">Introduzca el documento</label>
                                            <input type="text" name="nif" id="nif" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="country">País de origen</label>
                                            <?php if(!empty($countries)) { ?>
                                                <select id="country" name="country" class="form-control required">
                                                    <option value="">País de origen</option>
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value="<?=$country->cou_name ?>"><?=$country->cou_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="number_ss">Número seguridad social (12 dígitos)</label>
                                            <input minlength="12" maxlength="12" type="text" name="number_ss" id="number_ss" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="account">Cuenta bancaria</label>
                                            <input type="text" name="account" id="account" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Teléfono (9 dígitos)</label>
                                            <input maxlength="9" minlength="9"  type="text" name="phone" id="phone" class="form-control">
                                        </div>
                                        <p><strong>Sexo</strong></p>
                                        <div class="form-group">
                                            <label class="container_radio version_2">Hombre
                                                <input type="radio" name="gender" value="h" class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="container_radio version_2">Mujer
                                                <input type="radio" name="gender" value="m" class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /step-->

                            <div class="step add_top_10">
                                <h3 class="main_question"><i class="arrow_right"></i>Dirección personal</h3>
                                <div class="form-group">
                                    <label for="road_type">Tipo de vía</label>
                                    <?php if(!empty($road_types)) { ?>
                                        <select id="road_type" name="road_type" class="form-control required">
                                            <option value="">Seleccione el tipo de via</option>
                                            <?php foreach ($road_types as $road_type) { ?>
                                                <option value="<?=$road_type->road_name ?>"><?=$road_type->road_name ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="street_name">Nombre de vía</label>
                                    <input type="text" name="street_name" id="street_name" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label for="address_number">Número de domicilio</label>
                                    <input type="text" name="address_number" id="address_number" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label for="zip">CP</label>
                                    <input minlength="5" maxlength="5" type="text" name="zip" id="zip" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label for="stairs">Escalera</label>
                                    <input type="text" maxlength="3" name="stairs" id="stairs" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label for="floor">Piso</label>
                                    <input type="text" maxlength="3" name="floor" id="floor" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label for="door">Puerta</label>
                                    <input type="text" maxlength="3" name="door" id="door" class="form-control required">
                                </div>

                            </div>
                            <!-- /step-->

                            <div class="step">
                                <h3 class="main_question"><i class="arrow_right"></i>Datos del contrato</h3>
                                <div class="form-group">
                                    <label for="category">Categoría</label>
                                    <?php if(!empty($categories)) { ?>
                                        <select id="category" name="category" class="form-control required">
                                            <option value="">Seleccione categoría</option>
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?=$category->cat_name ?>"><?=$category->cat_name ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                                <p><label>Tipo contrato</label></p>
                                <div class="form-group">
                                    <label class="container_radio version_2">Indefinido
                                        <input checked type="radio" name="contract_type" value="indefinido" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="contract_date_start">Fecha inicio contrato</label>
                                    <input type="date" min="<?=date('d-m-Y') ?>" name="contract_date_start" id="contract_date_start" class="form-control required">
                                </div>

                                <p><label>Tipo de jornada</label></p>
                                <div class="form-group">
                                    <label class="container_radio version_2 type_of_day_full">Completa
                                        <input type="radio" name="type_of_day" value="completa" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container_radio version_2 type_of_day_partial">Parcial
                                        <input type="radio" name="type_of_day" value="parcial" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="weekly_working_hours">Horas semanales</label>
                                    <input type="number" name="weekly_working_hours" id="weekly_working_hours" class="form-control required">
                                </div>

                                <div class="form-group">
                                    <label for="monthly_salary">Salario mensual</label>
                                    <input type="number" name="monthly_salary" id="monthly_salary" class="form-control">
                                </div>
                                <div class="salary_type_container" style="display: none">
                                    <p><label>Tipo de salario</label></p>
                                    <div class="form-group">
                                        <label class="container_radio version_2">Bruto
                                            <input type="radio" name="salary_type" value="bruto">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container_radio version_2">Neto
                                            <input type="radio" name="salary_type" value="neto">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>


                            </div>
                            <!-- /step-->

                            <div class="submit step" id="end">
                                <div class="summary text-center">
                                    <div class="wrapper">
                                        <h3>¡Ya lo tenemos todo!</h3>
                                        <p>Da click en Enviar para comenzar con el proceso de alta. Recibirás un email o un SMS con el resultado al concluirlo</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /step last-->

                        </div>
                        <!-- /middle-wizard -->
                        <div id="bottom-wizard">
                            <button type="button" name="backward" class="backward">Anterior</button>
                            <button type="button" name="forward" class="forward">Siguiente</button>
                            <button type="submit" name="process" class="submit">Enviar</button>
                        </div>
                        <!-- /bottom-wizard -->
                        <input type="hidden" value="" id="weekly_working_hours_hidden"/>
                    </form>
                </div>
                <!-- /Wizard container -->
            </div>
        </div><!-- /Row -->
    </div><!-- /Form_container -->
</div>
<!-- /container -->

<footer class="footer_in clearfix">
    <div class="container">
        <p>© <?=date('Y') ?> Método consolida</p>
    </div>
</footer>
<!-- /footer -->

<div class="cd-overlay-nav">
    <span></span>
</div>
<!-- /cd-overlay-nav -->
<div class="cd-overlay-content">
    <span></span>
</div>
<!-- /cd-overlay-content -->

<!-- COMMON SCRIPTS -->
<script src="<?=getenv('JS') ?>jquery-3.6.0.min.js"></script>
<script src="<?=getenv('JS') ?>common_scripts.min.js"></script>
<script src="<?=getenv('JS') ?>velocity.min.js"></script>
<script src="<?=getenv('JS') ?>common_functions.js"></script>

<script>
    /*  Wizard */
    jQuery(function($) {
        "use strict";
        $('form#wrapped').attr('action', '<?=site_url() ?>wizard');
        $("#wizard_container").wizard({
            stepsWrapper: "#wrapped",
            submit: ".submit",
            unidirectional: false,
            beforeSelect: function(event, state) {
                if (!state.isMovingForward)
                    return true;
                var inputs = $(this).wizard('state').step.find(':input');
                return !inputs.length || !!inputs.valid();
            }
        }).validate({
            errorPlacement: function(error, element) {
                if (element.is(':radio') || element.is(':checkbox')){
                    error.insertBefore(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        //  progress bar
        $("#progressbar").progressbar();
        $("#wizard_container").wizard({
            afterSelect: function(event, state) {
                $("#progressbar").progressbar("value", state.percentComplete);
                $("#location").text("" + state.stepsComplete + " of " + state.stepsPossible + " completed");
            }
        });

        $(".dni").click(function(){
            $("#country").val('España');
        });
        $(".nie").click(function(){
            $("#country").val('');
        });

        $(".type_of_day_full").click(function(){
            $("#weekly_working_hours").val(40);
            $("#weekly_working_hours").fadeOut();
            $("#weekly_working_hours_hidden").val(40);
        });
        $(".type_of_day_partial").click(function(){
            $("#weekly_working_hours").fadeIn();
            $("#weekly_working_hours").val('');
            $("#weekly_working_hours_hidden").val('');
        });

        $("#monthly_salary").change(function(){
            if($("#monthly_salary").val() != ''){
                $(".salary_type_container").fadeIn();
            } else {
                $(".salary_type_container").fadeOut();
            }
        });


    });




</script>
</body>
</html>