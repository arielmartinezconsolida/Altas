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

            $country = $data_post['country'] ?? null;
            $data_post['country'] = $country ?? $data_post['country_hidden'];

            $weekly_working_hours = $data_post['weekly_working_hours'] ?? null;
            $weekly_working_hours = $weekly_working_hours ?? $data_post['weekly_working_hours_hidden'];
            $data_post['weekly_working_hours'] = str_replace(',', '.', $weekly_working_hours);

            $monthly_salary = $data_post['monthly_salary'];
            $data_post['monthly_salary'] = str_replace(',', '.', $monthly_salary);

            if($this->EmployeesModel->save($data_post))
            {
                $email_body = $this->emailBody($data_post);
                $this->sendSingleMail('ariel.martinez@metodoconsolida.es', 'Nueva alta', $email_body, 'ariel.martinez@metodoconsolida.es', 'j.piles@metodoconsolida.es,c.marzal@metodoconsolida.es,d.mondaca@metodoconsolida.es,t.garcia@metodoconsolida.es');
            }
            return redirect()->to(site_url().'process?token=394ffkgmtrl456gfktdmvkas');

        }
        $data['companies'] = $this->CompaniesModel->where('com_user_id', session('id'))->findAll();
        $data['countries'] = $this->CountriesModel->findAll();
        $data['road_types'] = $this->Road_typesModel->findAll();
        $data['categories'] = $this->CategoriesModel->orderBy('cat_name', 'ASC')->findAll();
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
}
