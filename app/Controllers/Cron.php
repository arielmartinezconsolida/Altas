<?php

namespace App\Controllers;

class Cron extends BaseController
{
    function __construct(){
        $this->EmployeesModel = model('App\Models\EmployeesModel');
    }

    public function index()
    {
        if(!isset($_GET['token']) || $_GET['token'] != '394ffkgmtrl456gfktdmvkas') return false;
        $access_token = $this->getToken();
        $this->processQueue($access_token);
    }

    private function getToken(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://account.uipath.com/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "grant_type" : "refresh_token",
            "client_id" : "8DEv1AMNXczW3y4U15LL3jYf62jK93n5",
            "refresh_token" : "9qbKWTyjjTJ413KdpReqlA5RRtdArZXUVtxjlH3hOpdWw"
        }',
            CURLOPT_HTTPHEADER => array(
                'X-UIPATH-TenantName: DefaultTenant',
                'Content-Type: application/json',
                'Cookie: __cf_bm=oQEGqBxe3UU8pfdBe2re1n8vxoqY1NqRkgDo6YMC0kk-1662443216-0-AQycUWXGZA4oIJ83riIC+VXr+lZ70jSKLzEGpZF7xJMrbKGl4/EHufbaV33dy8CLps4X52GbHTbKfnXOKBGiJ1k=; did=s%3Av0%3A9a4ac530-288b-11ed-baa2-33d364ba4180.q6yWrRSQoot6F2d89759bWvYQR4jxsFDT8CXIRreUxc; did_compat=s%3Av0%3A9a4ac530-288b-11ed-baa2-33d364ba4180.q6yWrRSQoot6F2d89759bWvYQR4jxsFDT8CXIRreUxc'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        return $response->access_token;
    }

    private function processQueue($access_token){
        $employees_not_processed = $this->EmployeesModel->getNotProcessed();
        if(!empty($employees_not_processed))
            foreach ($employees_not_processed as $employee_not_processed) {
                $this->addItemQueue($access_token, $employee_not_processed);
                $this->EmployeesModel->setProcessed($employee_not_processed['id']);
            }
    }

    function addItemQueue($access_token, $employee_not_processed){

        $curl = curl_init();
        $phone = strtolower($employee_not_processed['phone']) != 'pendiente' ? $employee_not_processed['phone'] : '';
        $email = strtolower($employee_not_processed['email']) != 'pendiente' ? $employee_not_processed['email'] : '';
        $account = strtolower($employee_not_processed['account']) != 'pendiente' ? $employee_not_processed['account'] : '';
        $stairs = $employee_not_processed['stairs'] != 0 ? $employee_not_processed['stairs'] : '';
        $monthly_salary = $employee_not_processed['monthly_salary'] != 0 ? $employee_not_processed['monthly_salary'] : '';
        $salary_type = $employee_not_processed['monthly_salary'] != 0 ? $employee_not_processed['salary_type'] : '';
        $country = $employee_not_processed['country'] != '' ? $employee_not_processed['country'] : 'España';
        $contract_date_end = ($employee_not_processed['contract_type'] == 'Temporal') ? date('d/m/Y', strtotime($employee_not_processed['contract_date_end'])) : '';
        $Reference = date('d-m-Y').' '.$employee_not_processed['name'];
        $datetime = new DateTime('tomorrow');
        $date =  $datetime->format('Y-m-d');
        //"DeferDate": "'.$today.'T14:19:56.4407392Z",
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://cloud.uipath.com/mtodoconsolida/DefaultTenant/odata/Queues/UiPathODataSvc.AddQueueItem',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                          "itemData": {
                            "DeferDate": "'.$date.'T14:19:56.4407392Z",
                            "DueDate": "'.$date.'T14:19:56.4407392Z",
                            "Priority": "Normal",
                            "Name": "GEES_002_020_AltasA3",
                            "SpecificContent": {
                              "type": "cron",
                              "CIF_sociedad": "'.$employee_not_processed['cif'].'",
                              "NIFtrabajador": "'.$employee_not_processed['nif'].'",
                              "nombreTrabajador": "'.$employee_not_processed['name'].'",
                              "apellidosTrabajador": "'.$employee_not_processed['lastname'].'",
                              "fechaNacimiento": "'.date('d/m/Y', strtotime($employee_not_processed['birthdate'])).'",
                              "numeroAfiliacionSS": "'.$employee_not_processed['number_ss'].'",
                              "sexo": "'.$employee_not_processed['gender'].'",
                              "paisOrigen": "'.$country.'",
                              "tipoVia": "'.$employee_not_processed['road_type'].'",
                              "nombreVia": "'.$employee_not_processed['steet_name'].'",
                              "numeroDomicilio": "'.$employee_not_processed['address_number'].'",
                              "escalera": "'.$stairs.'",
                              "piso": "'.$employee_not_processed['floor'].'",
                              "puerta": "'.$employee_not_processed['door'].'",
                              "codigoPostal": "'.$employee_not_processed['zip'].'",
                              "telefono": "'.$phone.'",
                              "email": "'.$email.'",
                              "cuentaBancariaTrabajador": "'.$account .'",
                              "tipoJornada": "'.$employee_not_processed['type_of_day'].'",
                              "duracionContrato": "'.$employee_not_processed['contract_type'].'",
                              "fechaFinContrato": "'.$contract_date_end.'",
                              "categoria": "'.$employee_not_processed['category'].'",
                              "horasJornadaSemanal": "'.$employee_not_processed['weekly_working_hours'].'",
                              "salarioMensual": "'.$monthly_salary.'",
                              "tipoSalarioBrutoNeto": "'.$salary_type.'",
                              "fechaAlta": "'.date('d/m/Y', strtotime($employee_not_processed['contract_date_start'])).'"
                            },
                            "Reference": "'.$Reference.'"
                          }
                        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-UIPATH-TenantName: DefaultTenant',
                'X-UIPATH-OrganizationUnitId: 3795158',
                'Authorization: Bearer '.$access_token
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }


}
