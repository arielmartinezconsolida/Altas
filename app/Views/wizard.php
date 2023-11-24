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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <style>
        .select2-container .select2-selection--single{
            height: 45px;
            padding-top: 7px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b{
            margin-top: 6px;
        }
        .select2{
            width: 100% !important;
        }
    </style>

</head>

<body class="layout_2">

<div id="preloader">
    <div data-loader="circle-side"></div>
</div>

<div id="loader_form">
    <div data-loader="circle-side-2"></div>
</div>

<header>
    <div class="container-fluid">
        <a href="<?=site_url() ?>">
            <img src="<?=getenv('IMG') ?>LOGO-Metodo-consolida-300.png" alt="Metodo consolida"  class="d-none d-md-inline">
            <img src="<?=getenv('IMG') ?>LOGO-Metodo-consolida-300.png" alt="Metodo consolida"  class="d-inline d-md-none">
        </a>
    </div>

</header>


<div class="container-fluid">
    <div id="form_container">
        <div class="row justify-content-center">
            <div class="col-lg-12 form_container">
                <div id="wizard_container">
                    <div id="top-wizard">
                        <div id="progressbar"></div>
                    </div>

                    <form id="wrapped" method="post" action="<?=site_url() ?>wizard">
                        <input id="website" name="website" type="text" value="">

                        <div id="middle-wizard">

                            <!--Pantalla 1-->
                            <div class="step add_top_10 mt-30-desktop">
                                <h3 class="main_question"><i class="arrow_right"></i>Datos de la empresa</h3>
                                <!--EMPRESAS-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="company_id">Empresa <small class="text-danger">*</small></label>
                                            <?php if(!empty($companies)) { ?>
                                                <select id="company_id" name="company_id" class="form-control required">
                                                    <option value="">Seleccione sociedad</option>
                                                <?php foreach ($companies as $company) { ?>
                                                     <option value="<?=$company->id ?>"><?=$company->com_name ?></option>
                                                <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!--CONVENIOS-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="work_center">Convenio <small class="text-danger">*</small></label>
                                            <div class="agreements_container">
                                                <select disabled id="agreement" name="agreement" class="form-control required">
                                                    <option value="">Seleccione antes la empresa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--CENTROS DE TRABAJO-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                                <label for="work_center">Centros de trabajo <small class="text-danger">*</small></label>
                                                <div class="work_centers_container">
                                                    <select disabled id="work_center" name="work_center_id" class="form-control required">
                                                        <option value="">Seleccione antes la empresa</option>
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- NIF -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="nif">NIF <small class="text-danger">*</small></label>
                                            <input readonly type="text" name="nif" id="nif" class="form-control required">
                                        </div>
                                    </div>
                                </div>
                                <!-- CCC -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="wc_ccc">CCC <small class="text-danger">*</small></label>
                                            <input readonly type="text" name="ccc" id="wc_ccc" class="form-control required">
                                        </div>
                                    </div>
                                </div>

                                <h3 class="main_question mt-30"><i class="arrow_right"></i>Datos del trabajador</h3>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Nombre <small class="text-danger">*</small></label>
                                            <input type="text" name="name" id="name" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Apellidos <small class="text-danger">*</small></label>
                                            <input type="text" name="lastname" id="lastname" class="form-control required">
                                        </div>
                                        <p><strong>Fecha de nacimiento <small class="text-danger">*</small></strong></p>
                                        <div class="form-group">
                                            <input type="date" name="birthdate" id="birthdate" class="form-control required">
                                        </div>
                                        <p><strong>Seleccione tipo de documento <small class="text-danger">*</small></strong></p>
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
                                            <label for="employee_nif">Introduzca el documento <small class="text-danger">*</small></label>
                                            <input type="text" name="employee_nif" id="employee_nif" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="country">País de origen <small class="text-danger">*</small></label>
                                            <?php if(!empty($countries)) { ?>
                                                <select id="country" name="country_id" class="form-control required">
                                                    <option value="">País de origen</option>
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value="<?=$country->id ?>"><?=$country->cou_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="number_ss">Número seguridad social (12 dígitos) <small class="text-danger">*</small></label>
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
                                            <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="ej: 666666666" maxlength="9" minlength="9"  type="text" name="phone" id="phone" class="form-control">
                                        </div>
                                        <p><strong>Sexo <small class="text-danger">*</small></strong></p>
                                        <div class="form-group">
                                            <label class="container_radio version_2">Hombre
                                                <input type="radio" name="gender" value="hombre" class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="container_radio version_2">Mujer
                                                <input type="radio" name="gender" value="mujer" class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="civil_status">Estado civil <small class="text-danger">*</small></label>
                                            <select id="civil_status" name="civil_status" class="form-control required">
                                                <option value="">Seleccione</option>
                                                <option value="1">Soltero/a</option>
                                                <option value="2">Casado/a</option>
                                                <option value="3">Separado/a</option>
                                                <option value="4">Divorciado/a</option>
                                                <option value="5">Viudo/a</option>
                                                <option value="6">Religioso/a</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--Pantalla 2-->
                            <div class="step add_top_10">
                                <h3 class="main_question"><i class="arrow_right"></i>Dirección personal</h3>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">

                                            <label for="province_id">Provincias <small class="text-danger">*</small></label>
                                            <?php if(!empty($companies)) { ?>
                                                <select id="province_id" name="province_id" class="form-control required">
                                                    <option value="">Seleccione provincia</option>
                                                    <?php foreach ($provinces as $province) { ?>
                                                        <option value="<?=$province->id ?>"><?=$province->pro_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="display: none" class="municipalities_container_label" for="municipality_id">Municipios <small class="text-danger">*</small></label>
                                    <div class="municipalities_container"></div>
                                </div>
                                <div class="form-group">
                                    <label for="road_type">Tipo de vía</label>
                                    <?php if(!empty($road_types)) { ?>
                                        <select id="road_type" name="road_type" class="form-control">
                                            <option value="">Seleccione el tipo de via</option>
                                            <?php foreach ($road_types as $road_type) { ?>
                                                <option value="<?=$road_type->road_name ?>"><?=$road_type->road_name ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="street_name">Nombre de vía</label>
                                    <input type="text" name="street_name" id="street_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address_number">Número de domicilio</label>
                                    <input type="text" name="address_number" id="address_number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="stairs">Escalera</label>
                                    <input type="text" maxlength="3" name="stairs" id="stairs" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="floor">Piso</label>
                                    <input type="text" maxlength="3" name="floor" id="floor" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="door">Puerta</label>
                                    <input type="text" maxlength="3" name="door" id="door" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="zip">CP</label>
                                    <input minlength="5" maxlength="5" type="text" name="zip" id="zip" class="form-control">
                                </div>
                            </div>
                            <!-- /step-->

                            <!--Pantalla 3-->
                            <div class="step">
                                <h3 class="main_question"><i class="arrow_right"></i>Datos del contrato</h3>
                                <div class="form-group">
                                    <label for="category">Categoría <small class="text-danger">*</small></label>
                                    <div class="categories_container"></div>
                                </div>
                                <div style="display: none" class="form-group category_selected_container">
                                    <label for="category_selected">Categoría seleccionada <small class="text-danger">*</small></label>
                                    <input class="form-control required" id="category_selected" type="text" name="category_selected" value=""/>
                                </div>
                                <div class="form-group">
                                    <label style="display: none" class="work_places_container_label" for="category">Puestos de trabajo <small class="text-danger">*</small></label>
                                    <div class="work_places_container"></div>
                                </div>
                                <div style="display: none" class="form-group work_place_selected_container">
                                    <label for="work_place_selected">Puesto de trabajo seleccionado <small class="text-danger">*</small></label>
                                    <input class="form-control required" id="work_place_selected" type="text" name="work_place_selected" value=""/>
                                </div>

                                <div class="row cnos_container" style="display: none">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group cno_level_1_container">
                                            <label for="cno_level_1_id">Nivel 1</label>
                                            <?php if(!empty($cnos_level_1)) { ?>
                                                <select id="cno_level_1_id" name="cno_level_1_id" class="form-control">
                                                    <option value="">Seleccione</option>
                                                    <?php foreach ($cnos_level_1 as $cno_level_1) { ?>
                                                        <option value="<?=$cno_level_1->id ?>"><?=$cno_level_1->cno_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group cno_level_2_container">
                                            <label for="cno_level_2">Nivel 2</label>
                                            <div class="cno_level_2_select_container">
                                                <select id="cno_level_2" disabled="disabled" class="form-control">
                                                    <option>Seleccione nivel 1</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group cno_level_3_container">
                                            <label for="cno_level_3">Nivel 3</label>
                                            <div class="cno_level_3_select_container">
                                                <select id="cno_level_3" disabled="disabled" class="form-control">
                                                    <option>Seleccione nivel 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label for="wp_cod_ocupation">CNO <small class="text-danger">*</small></label> <small class="float-right"><a class="btn_change_cno" href="javascript:">Cambiar</a></small>
                                            <input type="text" name="cod_ocupation" id="wp_cod_ocupation" class="form-control required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="wp_tariff_group">Grupo de tarifa <small class="text-danger">*</small></label>
                                            <input type="text" name="tariff_group" id="wp_tariff_group" class="form-control required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="wp_type_of_charge">Tipo de cobro <small class="text-danger">*</small></label>
                                            <input type="text" name="type_of_charge" id="wp_type_of_charge" class="form-control required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="wp_cod_ocupation_letter">Código de ocupación TGSS </label> <small class="float-right"><a class="btn_change_code_ocupation" href="javascript:">Cambiar</a></small>
                                            <input type="text" name="cod_ocupation_letter" id="wp_cod_ocupation_letter" class="form-control">
                                        </div>
                                    </div>
                                    <div style="display: none" class="codes_container col-lg-4">
                                        <div class="form-group">
                                            <label for="cod_ocupations">Códigos</label> <small class="float-right"><a data-toggle="modal" data-target="#codesModal" class="" href="javascript:">Más info</a></small>
                                            <select disabled name="cod_ocupations" id="cod_ocupations" class="form-control">
                                                <option value="">Seleccione</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                                <option value="G">G</option>
                                                <option value="H">H</option>
                                                <option value="I">I</option>
                                                <option value="V">V</option>
                                                <option value="W">W</option>
                                                <option value="X">X</option>
                                                <option value="Y">Y</option>
                                                <option value="Z">Z</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="wp_test_period">Periodo de prueba <small class="text-danger">*</small></label> <small class="float-right"><a class="btn_change_test_period" href="javascript:">Cambiar</a></small>
                                            <input type="text" name="test_period" id="wp_test_period" class="form-control required">
                                        </div>
                                    </div>
                                    <div style="display: none" class="cant_container col-lg-3">
                                        <div class="form-group">
                                            <label for="cant">Cant</label>
                                            <select disabled name="cant" id="cant" class="form-control">
                                                <option value=""></option>
                                                <?php for($i=1;$i<=30;$i++){ ?>
                                                    <option value="<?=$i ?>"><?=$i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="display: none" class="units_container col-lg-3">
                                        <div class="form-group">
                                            <label for="unit">Unidad</label>
                                            <select disabled name="unit" id="unit" class="form-control">
                                                <option value=""></option>
                                                <option value="Dias">Días</option>
                                                <option value="Semanas">Semanas</option>
                                                <option value="Meses">Meses</option>
                                                <option value="Años">Años</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="wp_imputation">Imputación </label>
                                            <input readonly type="text" name="imputation" id="wp_imputation" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="wp_description_of_functions">Descripción de funciones <small class="text-danger">*</small></label>
                                            <input type="text" name="description_of_functions" id="wp_description_of_functions" class="form-control required">
                                        </div>
                                    </div>
                                </div>

                                <p><label>Tipo contrato <small class="text-danger">*</small></label></p>
                                <div class="form-group">
                                    <label class="container_radio version_2">Indefinido
                                        <input checked type="radio" name="contract_type" value="indefinido" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="contract_date_start">Fecha inicio contrato <small class="text-danger">*</small></label><span class="error error_contract_date_start" style="display: none">La fecha del contrato no puede ser antes de hoy</span>
                                    <input  type="date"  name="contract_date_start" id="contract_date_start" class="form-control ">
                                </div>
                                <p><label>Tipo de jornada <small class="text-danger">*</small></label></p>
                                <div class="form-group">
                                    <label class="container_radio version_2 type_of_day_full">Completa
                                        <input type="radio" name="type_of_day" value="completa" class="">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container_radio version_2 type_of_day_partial">Parcial
                                        <input type="radio" name="type_of_day" value="parcial" class="">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="weekly_working_hours">Horas semanales</label>
                                    <input type="number" name="weekly_working_hours" id="weekly_working_hours" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="monthly_salary">Salario mensual</label>
                                    <input type="number" name="monthly_salary" id="monthly_salary" class="form-control">
                                </div>
                                <div class="salary_type_container" style="display: block">
                                    <p><label>Tipo de salario</label></p>
                                    <div class="form-group">
                                        <label class="container_radio version_2">Bruto
                                            <input  class="salary_type" type="radio" name="salary_type" value="bruto">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container_radio version_2">Neto
                                            <input  class="salary_type" type="radio" name="salary_type" value="neto">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group cno_level_1_container">
                                    <label for="education_level_id">Nivel educativo</label>
                                    <?php if(!empty($education_levels)) { ?>
                                        <select id="education_level_id" name="education_level_id" class="form-control">
                                            <option value="">Seleccione</option>
                                            <?php foreach ($education_levels as $education_level) { ?>
                                                <option value="<?=$education_level->id ?>"><?=$education_level->el_education_level ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- /step-->

                            <div class="submit step" id="end">
                                <div class="summary text-center">
                                    <div class="wrapper">
                                        <h3>¡Ya lo tenemos todo!</h3>
                                        <p>Da clic en Enviar para comenzar con el proceso de alta. Puedes realizar el seguimiento en el Panel Lourdes.</p>
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
                        <div id="sending-form" style="display: none">
                            <div class="row">
                                <div class="col-12 text-center"><h4>Enviando datos...</h4></div>
                            </div>
                        </div>
                        <!-- /bottom-wizard -->
                        <input name="weekly_working_hours_hidden" type="hidden" value="" id="weekly_working_hours_hidden"/>
                        <input type="hidden" name="country_hidden" id="country_hidden" value=""/>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>

    var step = 1;
    /*  Wizard */
    $(function($) {


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
        });

        $('#phone').on('keypress', function(e) {
            if (e.which == 32){
                return false;
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
            $("#country").val('77');
            $("#country").attr('disabled', true);
            $('#country_hidden').val('77');
        });
        $(".nie").click(function(){
            $("#country").val('');
            $("#country").attr('disabled', false);
        });

        $(".type_of_day_full").click(function(){
            $("#weekly_working_hours").removeClass('required');
            $("#weekly_working_hours").val(40);
            $("#weekly_working_hours").attr('disabled', true);
            $("#weekly_working_hours_hidden").val(40);
        });
        $(".type_of_day_partial").click(function(){
            $("#weekly_working_hours").addClass('required');
            $("#weekly_working_hours").attr('disabled', false);
            $("#weekly_working_hours").val('');
            $("#weekly_working_hours_hidden").val('');
        });


        

        $("#contract_date_start").change(function(){
            validate_date_contract();
        });
        $("#contract_date_start").focusout(function(){
            validate_date_contract();
        });

        $(".backward").click(function(){
            step = step - 1;
            $(".forward").fadeIn()
        });

        $(".forward").click(function(){
                step = step + 1;
                if(step == 3 && $("#contract_date_start").val() != ''){
                    validate_date_contract();
                }
        });

        $(".submit").click(function(){
            $("#bottom-wizard").hide();
            $("#sending-form").fadeIn();
        });

        function validate_date_contract(){
            var url = "<?php echo site_url() ?>home/validate_date?date=" + $("#contract_date_start").val()
            $.ajax({url: url, success: function(result){
                    if(result == '1'){
                        $(".error_contract_date_start").fadeIn()
                        $(".forward").fadeOut()
                    } else {
                        $(".error_contract_date_start").fadeOut()
                        $(".forward").fadeIn()
                    }

                }});
        }


        $("#company_id").change(function(){
            var url = "<?php echo site_url() ?>home/get_select_work_centers?company_id=" + $("#company_id").val()
            $.ajax({url: url, success: function(result){
                var response = JSON.parse(result);
                $(".work_centers_container").html(response.work_centers);
                $('#work_center').select2();
                $("#nif").val(response.company_nif);
                $("#work_center").change(function(){
                    var ccc = $(this).val();
                    $("#wc_ccc").val(ccc);
                });
            }});
            var url = "<?php echo site_url() ?>home/get_select_agreements?company_id=" + $("#company_id").val()
            $.ajax({url: url, success: function(result){
                    $(".agreements_container").html(result);
                    get_categories();
                }});
        });

        get_municipalities();

        $('#company_id').select2();
        $('#province_id').select2();
        $('#road_type').select2();
        $('#education_level_id').select2();

        $(".btn_change_cno").click(function(){
            $(".cnos_container").toggle();
        });

        $(".btn_change_code_ocupation").click(function(){
            $("#cod_ocupations").removeAttr('disabled')
            $(".codes_container").fadeIn();
        });

        $(".btn_change_test_period").click(function(){
            $("#cant").removeAttr('disabled')
            $("#unit").removeAttr('disabled')
            $(".cant_container").fadeIn();
            $(".units_container").fadeIn();
        });

        $("#cod_ocupations").change(function(){
            $("#wp_cod_ocupation_letter").val($(this).val());
        });

        $("#cant, #unit").change(function(){
            $("#wp_test_period").val($("#cant").val() + ' ' + $("#unit").val());
        });

        $("#wp_tariff_group").on("input", function() {
            var tariff = $(this).val();
            if(tariff <= 7)
                var type_of_charge = 'Mensual';
            else var type_of_charge = 'Diario';
            $("#wp_type_of_charge").val(type_of_charge);
        });


        get_cnos_level_2();


        //validate_salary_type();



    });


    function get_categories(){
        var url = "<?php echo site_url() ?>home/get_select_categories?agreement_id=" + $("#agreements").val()
        $.ajax({url: url, success: function(result){
                $(".categories_container").html(result);
                $("#categories").change(function(){
                    get_work_places($(this).val())
                    $("#category_selected").val($(this).find('option:selected').text());
                    $(".category_selected_container").fadeIn();
                });
        }});
    }



    function get_work_places(category_id){
        var url = "<?php echo site_url() ?>home/get_select_work_places?category_id=" + category_id;
        $.ajax({url: url, success: function(result){
                $(".work_places_container").html(result);
                $(".work_places_container_label").fadeIn();
                get_work_place_data();
            }});
    }

    function get_work_place_data(){
        $("#work_places").change(function(){
            $("#work_place_selected").val($(this).find('option:selected').text());
            $(".work_place_selected_container").fadeIn();
            var url = "<?php echo site_url() ?>home/get_work_place_data?work_place_id=" + $(this).val();
            $.ajax({url: url, success: function(result){
                    var response = JSON.parse(result);
                    $("#wp_cod_ocupation").val(response.wp_cod_ocupation);
                    $("#wp_tariff_group").val(response.wp_tariff_group);
                    $("#wp_type_of_charge").val(response.wp_type_of_charge);
                    $("#wp_cod_ocupation_letter").val(response.wp_cod_ocupation_letter);
                    $("#wp_imputation").val(response.wp_imputation);
                    $("#wp_test_period").val(response.wp_test_period);
                    $("#wp_description_of_functions").val(response.wp_description_of_functions);

            }});
        })
    }

    function get_municipalities(){
        $("#province_id").change(function(){
            var url = "<?php echo site_url() ?>home/get_municipalities?province_id=" + $(this).val();
            $.ajax({url: url, success: function(result){
                    $(".municipalities_container").html(result);
                    $('#mun_code').select2();
                    $(".municipalities_container_label").fadeIn();
            }});
        })
    }

    function get_cnos_level_2(){
        $("#cno_level_1_id").change(function(){
            var url = "<?php echo site_url() ?>home/get_cnos_level_2?parent_id=" + $(this).val();
            $.ajax({url: url, success: function(result){
                    $(".cno_level_2_select_container").html(result);
                    get_cnos_level_3();
            }});
        })
    }

    function get_cnos_level_3(){
        $("#cno_level_2_id").change(function(){
            var url = "<?php echo site_url() ?>home/get_cnos_level_3?parent_id=" + $(this).val();
            $.ajax({url: url, success: function(result){
                    $(".cno_level_3_select_container").html(result);
                    $("#cno_level_3_id").change(function(){
                        $("#wp_cod_ocupation").val($("#cno_level_3_id").val());
                    })
                }});
        })
    }

    


</script>
<div class="modal fade" id="codesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ocupación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Comentarios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>A</td>
                            <td>Personal en trabajos exclusivos de oficina</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>B</td>
                            <td>Tipo de cotización para todos los trabajadores que
                                deban desplazarse habitualmente durante su jornada
                                laboral, siempre por razón de la ocupación o la actividad
                                económica no corresponda un tipo superior.
                                Representantes Comercio</td>
                            <td>Solo para liquidaciones
                                complementarias anteriores al 2010
                                Obligatorio para liquidaciones
                                posteriores a 09/2015</td>
                        </tr>
                        <tr>
                            <td>C</td>
                            <td>Trabajadores en periodo de baja por incapacidad
                                temporal y otras situaciones con suspensión de la
                                relación laboral con obligación de cotizar</td>
                            <td>Solo para liquidaciones
                                complementarias anteriores al 2010</td>
                        </tr>
                        <tr>
                            <td>D</td>
                            <td>Personal de oficios en instalaciones y reparaciones en
                                edificios, obras y trabajos de construcción en general</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>E</td>
                            <td>Conductores de vehículo automóvil de transporte de
                                pasajeros en general (taxis, automóviles, autobuses,
                                etc) y de transporte de mercancías que tengan una
                                capacidad de carga útil no superior a 3,5 Tm</td>
                            <td>Solo para liquidaciones
                                complementarias anteriores al 2013</td>
                        </tr>
                        <tr>
                            <td>F</td>
                            <td>Conductores de vehículo automóvil de transporte de
                                mercancías que tengan una capacidad de carga útil
                                superior a 3,5 Tm</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>G</td>
                            <td>Personal de limpieza en general. Limpieza de edificios y
                                de todo tipo de establecimientos. Limpieza de calles</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>H</td>
                            <td>Vigilantes, guardas, guardas jurados y personal de
                                seguridad</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>I</td>
                            <td>Personal de vuelo</td>
                            <td>Solo para liquidaciones
                                complementarias anteriores al 2008</td>
                        </tr>
                        <tr>
                            <td>V</td>
                            <td>Grupo segundo de cotización al Régimen Especial del
                                Mar</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>W</td>
                            <td>Grupo tercero de cotización al Régimen Especial del
                                Mar</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>X</td>
                            <td>Carga y descarga; estiba y desestiba</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Y</td>
                            <td>Trabajos habituales en interior de minas</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Z</td>
                            <td>Dependientes. Cajeros</td>
                            <td>Solo para liquidaciones
                                complementarias anteriores al 2010</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>