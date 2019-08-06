<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyModel extends CI_Model {

    var $client_service = "api-magang";
    var $auth_key       = "geomedia";

    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        }
    }

    public function login($username,$password)
    {
        $q  = $this->db->select('password,nip')->from('skp_pns')->where('username',$username)->get()->row();
        if($q == ""){
            return array('status' => 204,'message' => 'Username not found.');
        } else {
            $hashed_password = $q->password;
            $nip             = $q->nip;
            if (md5($hashed_password, crypt($password, $hashed_password))) {
               $token = crypt(substr( md5(rand()), 0, 7));
               $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
               $this->db->trans_start();
               $this->db->update('skp_pns',array('token' => $token,'expired_at' => $expired_at));
               $this->db->where('nip',$username);
               if ($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error.');
               } else {
                  $this->db->trans_commit();
                  return array('status' => 200,'message' => 'Successfully login.','nip' => $nip, 'token' => $token);
               }
            } else {
               return array('status' => 204,'message' => 'Wrong password.');
            }
        }
    }

    public function logout()
    {
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $this->db->where('token',$token)->delete('skp_pns');
        return array('status' => 200,'message' => 'Successfully logout & deleted token');
    }

    public function auth()
    {
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $q  = $this->db->select('expired_at')->from('skp_pns')->where('token',$token)->get()->row();
        if($q == ""){
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        } else {
            if($q->expired_at < date('Y-m-d H:i:s')){
                return json_output(401,array('status' => 401,'message' => 'Your session has been expired.'));
            } else {
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('token',$token)->update('skp_pns',array('expired_at' => $expired_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }

}
