<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class RestModel extends CI_Model
{

    var $client_service = "frontend-client";
    var $auth_key       = "simplerestapi";

    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);

        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        }
    }

    public function login($username, $password)
    {

        $dataIdPass = $this->db
            ->select('password,id')
            ->from('users')
            ->where('username',$username)
            ->get()
            ->row();

        if ($dataIdPass == ""){
            return array('status' => 204,'message' => 'Username not found.');
        } else {

            $hashPass = $dataIdPass->password;
            $user_id  = $dataIdPass->id;
            /*____________________________________*/
        }

        if (md5($password) == $hashPass){

            $last_login = date('Y-m-d H:i:s');
            $token = random_string ( 'md5' ,  10 );
            $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
            $this->db->trans_start();
            $this->db->where('id',$user_id)->update('users',array('last_login' => $last_login));
            $this->db->insert('users_authentication',array('user_id' => $user_id,'token' => $token,'expired_at' => $expired_at));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return array('status' => 500,'message' => 'Internal server error.');
            } else {
                $this->db->trans_commit();
                return array('status' => 200,'message' => 'Successfully login.','id' => $user_id, 'token' => $token);
            }

        }else {
            echo "Wrong password";
            exit();
            return array('status' => 204,'message' => 'Wrong password.');
        }

    }

    public function tokenCheck($token)
    {

        $data = $this->db
            ->select('token')
            ->from('users_authentication')
            ->where('token',$token)
            ->get()
            ->row();

        return $data;

    }

    public function logout()
    {

        $user_id = $this->input->get_request_header('User-Id', TRUE);
        $token = $this->input->get_request_header('Authorization', TRUE);

        $this->db->where('user_id', $user_id)->where('token',$token)->delete('users_authentication');
        return array('status' => 200,'message' => 'Successfully logout.');
    }

    public function auth()
    {

        $user_id = $this->input->get_request_header('User-Id', TRUE);
        $token = $this->input->get_request_header('Authorization', TRUE);

        $expired_at = $this->db->select('expired_at')
            ->from('users_authentication')
            ->where('user_id', $user_id)
            ->where('token', $token)
            ->get()->row();

        if ($expired_at == ""){
            return json_output(401, array('status' => 401,'message' => 'Unauthorized.'));
        } else{
            if ($expired_at < date('Y-m-d H:i:s')){
                return json_output(401,array('status' => 401,'message' => 'Your session has been expired.'));
            }else{
                $update_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('user_id',$user_id)->where('token',$token)->update('users_authentication',array('expired_at' => $expired_at,'updated_at' => $update_at));
                return array('status' => 200,'message' => 'Authorized.');

            }
        }
    }

    public function users_all_data()
    {
        return $this->db->select('username,name,last_login')->from('users')->order_by('id','desc')->get()->result();
    }

    public function user_detail_data($user_id = null)
    {
        $this->db->select('username,name,created_at')->from('users');

        if ($user_id != null){
            $this->db->where('id',$user_id);
        }
        return   $this->db->order_by('id','desc')
            ->get()->row();
    }

    public function user_create_data($data)
    {

        if (!empty($data['password'])){
            $data['password'] = md5($data['password']);
            $data['created_at'] = date('Y-m-d H:i:s');
        }

         return  $this->db->insert('users', $data);

    }

    public function user_update_data($data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $user_id = $this->input->get_request_header('User-Id', TRUE);
        $this->db->where('id',$user_id)->update('users',$data);
        return array('status' => 200,'message' => 'Data has been updated.');

    }




}