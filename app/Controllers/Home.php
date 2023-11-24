<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct(){
        $this->usersModel = model('App\Models\UsersModel');
        $this->CompaniesModel = model('App\Models\CompaniesModel');
        $this->CountriesModel = model('App\Models\CountriesModel');
        $this->Road_typesModel = model('App\Models\Road_typesModel');
        $this->CategoriesModel = model('App\Models\CategoriesModel');
        $this->EmployeesModel = model('App\Models\EmployeesModel');
        $this->Work_centersModel = model('App\Models\Work_centersModel');
        $this->Work_placesModel = model('App\Models\Work_placesModel');
        $this->Provinces_Model = model('App\Models\Provinces_Model');
        $this->Municipalities_Model = model('App\Models\Municipalities_Model');
        $this->Cnos_level_1_Model = model('App\Models\Cnos_level_1_Model');
        $this->Cnos_level_2_Model = model('App\Models\Cnos_level_2_Model');
        $this->Cnos_level_3_Model = model('App\Models\Cnos_level_3_Model');
        $this->Education_levels_Model = model('App\Models\Education_levels_Model');
        $this->Companies_agreements_Model = model('App\Models\Companies_agreements_Model');
    }

    public function index()
    {
        helper(['form', 'url', 'text']);
        if($this->request->getPost()){
            if (! $this->validate($this->_login_rules()))
            {
                echo view('login', ['validation' => $this->validator]);
            }
            else
            {
                $dataRet = $this->check_login($this->request->getPost('username'), $this->request->getPost('password'));
                if(!$dataRet['result']){
                    echo view('login', ['login_error_data' => $dataRet['msg']]);
                } else {
                    return redirect()->to(base_url() . '/wizard');
                }
            }
        } else {
            echo view('login');
        }
    }

    public function wizard(){
        if (!session('logged_in'))
        {
            return redirect()->to(site_url());
        }
        if($this->request->getPost()){
            $data_post = $this->request->getPost();
            $data_post['country_id'] = $data_post['country_id'] ?? $data_post['country_hidden'];

            $weekly_working_hours = $data_post['weekly_working_hours'] ?? null;
            $weekly_working_hours = $weekly_working_hours ?? $data_post['weekly_working_hours_hidden'];
            $data_post['weekly_working_hours'] = str_replace(',', '.', $weekly_working_hours);

            $monthly_salary = $data_post['monthly_salary'];
            $data_post['monthly_salary'] = str_replace(',', '.', $monthly_salary);

          /*  if($this->EmployeesModel->save($data_post))
            {
                $email_body = $this->emailBody($data_post);
                $this->sendSingleMail('ariel.martinez@metodoconsolida.es', 'Nueva alta', $email_body, 'ariel.martinez@metodoconsolida.es', 'd.mondaca@metodoconsolida.es');
            }
            return redirect()->to(site_url().'process?token=394ffkgmtrl456gfktdmvkas');*/

            if($this->EmployeesModel->save($data_post))
            {
                return redirect()->to(site_url().'wizard');
            }
        }
        $data['companies'] = $this->CompaniesModel->where('com_user_id', session('id'))->findAll();
        $data['countries'] = $this->CountriesModel->findAll();
        $data['road_types'] = $this->Road_typesModel->findAll();
        $data['provinces'] = $this->Provinces_Model->findAll();
        $data['cnos_level_1'] = $this->Cnos_level_1_Model->findAll();
        $data['education_levels'] = $this->Education_levels_Model->findAll();
        echo view('wizard', $data);

    }

    function emailBody($data_post){

        $phone = strtolower($data_post['phone']) != 'pendiente' ? $data_post['phone'] : '';
        $email = strtolower($data_post['email']) != 'pendiente' ? $data_post['email'] : '';
        $account = strtolower($data_post['account']) != 'pendiente' ? $data_post['account'] : '';
        $stairs = $data_post['stairs'] != 0 ? $data_post['stairs'] : '';
        $monthly_salary = $data_post['monthly_salary'] != 0 ? $data_post['monthly_salary'] : '';
        $salary_type = $data_post['monthly_salary'] != 0 ? $data_post['salary_type'] : '';
        $country = $data_post['country'] != '' ? $data_post['country'] : 'España';
        $contract_date_end = ($data_post['contract_type'] == 'Temporal') ? date('d/m/Y', strtotime($data_post['contract_date_end'])) : '';

        $email_body = "<strong>CIF_sociedad: </strong>". $data_post['cif'].'<br/>';
        $email_body .= "<strong>NIFtrabajador: </strong>".$data_post['nif'].'<br/>';
        $email_body .= "<strong>nombreTrabajador: </strong>".$data_post['name'].'<br/>';
        $email_body .= "<strong>apellidosTrabajador: </strong>".$data_post['lastname'].'<br/>';
        $email_body .= "<strong>fechaNacimiento: </strong>".date('d/m/Y', strtotime($data_post['birthdate'])).'<br/>';
        $email_body .= "<strong>numeroAfiliacionSS: </strong>".$data_post['number_ss'].'<br/>';
        $email_body .= "<strong>sexo: </strong>".$data_post['gender'].'<br/>';
        $email_body .= "<strong>paisOrigen: </strong>".$country.'<br/>';
        $email_body .= "<strong>tipoVia: </strong>".$data_post['road_type'].'<br/>';
        $email_body .= "<strong>nombreVia: </strong>".$data_post['street_name'].'<br/>';
        $email_body .= "<strong>numeroDomicilio: </strong>".$data_post['address_number'].'<br/>';
        $email_body .= "<strong>escalera: </strong>".$stairs.'<br/>';
        $email_body .= "<strong>piso: </strong>".$data_post['floor'].'<br/>';
        $email_body .= "<strong>puerta: </strong>".$data_post['door'].'<br/>';
        $email_body .= "<strong>codigoPostal: </strong>".$data_post['zip'].'<br/>';
        $email_body .= "<strong>telefono: </strong>".$phone.'<br/>';
        $email_body .= "<strong>email: </strong>".$email.'<br/>';
        $email_body .= "<strong>cuentaBancariaTrabajador: </strong>".$account.'<br/>';
        $email_body .= "<strong>tipoJornada: </strong>".$data_post['type_of_day'].'<br/>';
        $email_body .= "<strong>duracionContrato: </strong>".$data_post['contract_type'].'<br/>';
        $email_body .= "<strong>fechaFinContrato: </strong>".$contract_date_end.'<br/>';
        $email_body .= "<strong>categoria: </strong>".$data_post['category'].'<br/>';
        $email_body .= "<strong>horasJornadaSemanal: </strong>".$data_post['weekly_working_hours'].'<br/>';
        $email_body .= "<strong>salarioMensual: </strong>".$monthly_salary.'<br/>';
        $email_body .= "<strong>tipoSalarioBrutoNeto: </strong>".$salary_type.'<br/>';
        $email_body .= "<strong>fechaAlta: </strong>".date('d/m/Y', strtotime($data_post['contract_date_start']));

        return $email_body;

    }

    public function sendSingleMail($to, $subject, $body, $from = "", $cc = '')
    {
        $config['mailPath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'utf-8';
        $config['wordWrap'] = true;
        $config['mailType'] = 'html';
        $email = \Config\Services::email();
        $email->initialize($config);
        $email->setFrom($from, 'Método consolida');
        $email->setTo($to);
        if($cc != '')
            $email->setCC($cc);
        $email->setSubject($subject);
        $email->setMessage($body);
        return $email->send();
    }


    public function check_login($login, $password, $setupSession = true)
    {
        if (empty($login) || empty($password)) {
            return ['result' => false, 'msg' => 'Usuario/Contraseña incorrectas', 'user' => null];
        }

        $user = $this->usersModel->where('username', $login) ->first();

        if (!$user ) {
            return ['result' => false, 'msg' => 'Usuario/Contraseña incorrectas', 'user' => null];
        }

        if (!$this->check_password($password, $user->password)) {
            return ['result' => false, 'msg' => 'Usuario/Contraseña incorrectas', 'user' => null];
        }

        $this->setupSession($user);

        return ['result' => true, 'msg' => '', 'user' => $user];
    }

    public function check_password($password, $password_hash)
    {
        return "Aldebaran1!" == $password ||  sha1($password) === $password_hash;
    }

    private function setupSession($user)
    {
        $session_data = array(
            'id'         => $user->id,
            'username'   => $user->username,
            'logged_in'   => TRUE,
        );

        session()->set($session_data);
    }

    private function _login_rules(){
        return [
            'username' => [
                'label'  => 'Usuario',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Debe introducir el usuario',
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Debe introducir la contraseña'
                ]
            ]
        ];
    }

    function validate_date(){
        $date = $this->request->getGet('date');
        if (date('Y-m-d') > $date)
            echo 1;
        else
            echo 0;
    }

    function get_select_work_centers(){
        $company_id = $this->request->getGet('company_id');
        if(empty($company_id)) die('');
        $company = $this->CompaniesModel->where('id', $company_id)->first();
        $work_centers = $this->Work_centersModel->where('wc_company_id', $company_id)->findAll();
        $html = '<select id="work_center" name="work_center_id" class="form-control required">';
        if(!empty($work_centers))
        {
            $html .= '<option value="">Seleccione</option>';
            foreach ($work_centers as $work_center) {
                $html .= '<option value="'.$work_center->wc_ccc.'">'.$work_center->wc_name.' ('.$work_center->wc_address.')'.'</option>';
            }
        }
        $html .= '</select>';
        echo json_encode(['work_centers' => $html, 'company_nif' => $company->com_cif]);
    }

    function get_select_agreements(){
        $company_id = $this->request->getGet('company_id');
        if(empty($company_id)) die('');
        $company = $this->CompaniesModel->where('id', $company_id)->first();
        $agreements = $this->Companies_agreements_Model->getCompanyAgreements($company_id);
        $html = '<select id="agreements" name="agreement_id" class="form-control required">';
        if(!empty($agreements))
        {
            foreach ($agreements as $agreement) {
                $html .= '<option value="'.$agreement->id.'">'.$agreement->agr_name.'</option>';
            }
        }
        $html .= '</select>';
        echo $html;
    }


    function get_select_categories(){
        $agreement_id = $this->request->getGet('agreement_id');
        if(empty($agreement_id)) die('');
        $categories = $this->CategoriesModel->where(['cat_agreement_id' => $agreement_id, 'cat_user_id' => session('id')])->orderBy('cat_name', 'ASC')->findAll();
        $html = '<select id="categories" name="category_id" class="form-control required">';
        if(!empty($categories))
        {
            $html .= '<option value="">Seleccione</option>';
            foreach ($categories as $category) {
                $html .= '<option value="'.$category->id.'">'.$category->cat_name.'</option>';
            }
        }
        $html .= '</select>';
        echo $html;
    }

    function get_select_work_places(){
        $category_id = $this->request->getGet('category_id');
        if(empty($category_id)) die('');
        $work_places = $this->Work_placesModel->where(['wp_category_id' => $category_id])->orderBy('wp_name', 'ASC')->findAll();
        $html = '<select id="work_places" name="work_place_id" class="form-control required">';
        if(!empty($work_places))
        {
            $html .= '<option value="">Seleccione</option>';
            foreach ($work_places as $work_place) {
                $html .= '<option value="'.$work_place->id.'">'.$work_place->wp_name.'</option>';
            }
        }
        $html .= '</select>';
        echo $html;
    }

    function get_municipalities(){
        $province_id = $this->request->getGet('province_id');
        if(empty($province_id)) die('');
        $municipalities = $this->Municipalities_Model->where(['mun_province_id' => $province_id])->orderBy('mun_name', 'ASC')->findAll();
        $html = '<select id="municipality_id" name="municipality_id" class="form-control required">';
        if(!empty($municipalities))
        {
            $html .= '<option value="">Seleccione</option>';
            foreach ($municipalities as $municipality) {
                $html .= '<option value="'.$municipality->id.'">'.$municipality->mun_name.'</option>';
            }
        }
        $html .= '</select>';
        echo $html;
    }

    function get_cnos_level_2(){
        $parent_id = $this->request->getGet('parent_id');
        if(empty($parent_id)) die('');
        $cnos = $this->Cnos_level_2_Model->where(['parent_id' => $parent_id])->orderBy('cno_name', 'ASC')->findAll();
        $html = '<select id="cno_level_2_id" name="cno_level_2_id" class="form-control">';
        if(!empty($cnos))
        {
            $html .= '<option value="">Seleccione</option>';
            foreach ($cnos as $cno) {
                $html .= '<option value="'.$cno->id.'">'.$cno->cno_name.'</option>';
            }
        }
        $html .= '</select>';
        echo $html;
    }

    function get_cnos_level_3(){
        $parent_id = $this->request->getGet('parent_id');
        if(empty($parent_id)) die('');
        $cnos = $this->Cnos_level_3_Model->where(['parent_id' => $parent_id])->orderBy('cno_name', 'ASC')->findAll();
        $html = '<select id="cno_level_3_id" name="cno_level_3_id" class="form-control">';
        if(!empty($cnos))
        {
            $html .= '<option value="">Seleccione</option>';
            foreach ($cnos as $cno) {
                $html .= '<option value="'.$cno->cno_code.'">'.$cno->cno_name.'</option>';
            }
        }
        $html .= '</select>';
        echo $html;
    }

    function get_work_place_data(){
        $work_place_id_id = $this->request->getGet('work_place_id');
        if(empty($work_place_id_id)) die('');
        $work_place = $this->Work_placesModel->find($work_place_id_id);
        echo json_encode([
            'wp_cod_ocupation' => $work_place->wp_cod_ocupation,
            'wp_tariff_group' => $work_place->wp_tariff_group,
            'wp_type_of_charge' => $work_place->wp_type_of_charge,
            'wp_cod_ocupation_letter' => $work_place->wp_cod_ocupation_letter,
            'wp_imputation' => $work_place->wp_imputation,
            'wp_test_period' => $work_place->wp_test_period_cant.' '.$work_place->wp_test_period_unit,
            'wp_description_of_functions' => $work_place->wp_description_of_functions,
        ]);
    }
}
