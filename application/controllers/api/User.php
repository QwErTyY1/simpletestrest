<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $method = $this->input->method(TRUE);

        if ($method != "GET"){
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }else{
            $check_auth_client = $this->RestModel->check_auth_client();
            if ($check_auth_client == true){
                $response = $this->RestModel->auth();
                if ($response['status'] == 200){
                    $resp = $this->RestModel->users_all_data();
                    json_output($response['status'], $resp);

                }
            }
        }

    }

    public function user_detail($id)
    {

        $method = $this->input->method(TRUE);

        if ($method != 'GET' || $this->uri->segment(4) == '' || is_numeric($this->uri->segment(4)) == FALSE){
            json_output(400,array('status' => 400,'message' => 'Bad request.'));
        }else{
            $check_auth_client = $this->RestModel->check_auth_client();
            if ($check_auth_client == true){
                $response = $this->RestModel->auth();
                if ($response['status'] == 200){
                    $resp = $this->RestModel->user_detail_data($id);
                    json_output($response['status'], $resp);

                }
            }
        }

    }

    public function user_create()
    {
        $method = $this->input->method(TRUE);
        $message = [];
        $status = null;

        if ($method != 'POST'){
            json_output(400,array('status' => 400, 'message' => 'Bad request.'));
        }else{
            $check_auth_client = $this->RestModel->check_auth_client();
            if ($check_auth_client == true){

                $params = $this->input->post();

                if ($params["username"] == "" && $params["password"] =="" && $params["name"] == ""){
                    $status = 400;
                    $message = array('status' => 400,'message' =>  'Username, password & email can\'t empty');
                } else {
                    $resp = $this->RestModel->user_create_data($params);
                    if ($resp){
                        $status = 201;
                        $message = array('status' => 201, 'message' => 'Welcome new USER.');
                    }
                }
            }
        }
        json_output($status,$message);
    }



    public function user_update()
    {
        $method = $this->input->method(TRUE);


        if ($method != 'PUT'){
            json_output(400,array('status' => 400,'message' => 'Bad request.'));
        }else{
            $check_auth_client = $this->RestModel->check_auth_client();
            if ($check_auth_client == true){
                $response = $this->RestModel->auth();
                $respStatus = $response['status'];
                if ($response['status'] == 200){

                    $params = json_decode($this->input->raw_input_stream, TRUE);

                    if (empty($params)){
                        $respStatus = 400;
                        $resp = array('status' => 400,'message' =>  'Username, password & email can\'t empty');
                    } else {
                        $resp = $this->RestModel->user_update_data($params);
                    }
                    json_output($respStatus,$resp);
                }
            }
        }

    }

}