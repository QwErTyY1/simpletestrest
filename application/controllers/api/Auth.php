<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

    }

    public function login()
    {

        $method = $this->input->method(TRUE);

        if ($method != "POST"){
                json_output(400,array('status' => 400,'message' => 'Bad request.'));
        }else{
            $check_auth_client = $this->RestModel->check_auth_client();

            if ($check_auth_client == true){

                $username = $this->uri->segment(4);
                $password = $this->uri->segment(5);

              $response = $this->RestModel->login($username,$password);
                json_output($response['status'],$response);

            }

        }

    }

    public function test()
    {
        $token = $this->input->post('token');
        $check_token = $this->RestModel->tokenCheck($token);
        var_dump($check_token);
    }

    public function logout()
    {
        $method = $this->input->method(TRUE);

        if($method != 'POST'){
            json_output(400,array('status' => 400,'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->RestModel->check_auth_client();
            if($check_auth_client == true){
                $response = $this->RestModel->logout();
                json_output($response['status'],$response);
            }
        }
    }

}