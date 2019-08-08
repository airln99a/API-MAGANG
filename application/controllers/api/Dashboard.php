<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Dashboard extends CI_Controller{
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    public function __construct(){
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('Dashboard_model','cak');
    }
    //-----------------------------------------------------------------------------------------//
                                        //GET Target Dashboard//
    //-----------------------------------------------------------------------------------------//
    public function target_get() {
        $nip = $this->get('nip');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            $check_auth_client = $this->mm->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->mm->auth();
        if($response['status'] == 200 && $nip != null){
            $nip = $this->cak->getTarget($nip);
            json_output($response['status'],$nip);
        } else {
            $nip = $this->cak->getTarget();
        }
        
        if($nip){
            $this->response([
                'status' => true,
                'data'   => $nip
            ], 200);
        } else{
            $this->response([
                'status'  => false,
                'message' => 'Maaf, ID tidak ditemukan !'
            ], 404);
                }
            }
        }
    }
    //-----------------------------------------------------------------------------------------//
                                        //GET Realisasi Dashboard//
    //-----------------------------------------------------------------------------------------//

    public function realisasi_get() {
        $nip = $this->get('nip');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            $check_auth_client = $this->mm->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->mm->auth();
        if($response['status'] == 200 && $nip != null){
            $nip = $this->cak->getRealisasi($nip);
            json_output($response['status'],$nip);
        } else {
            $nip = $this->cak->getRealisasi();
        }
        if($nip === null){
            $nip = $this->cak->getRealisasi();
        } else {
            $nip = $this->cak->getRealisasi($nip);
        }
        
        if($nip){
            $this->response([
                'status' => true,
                'data'   => $nip
            ], 200);
        } else{
            $this->response([
                'status'  => false,
                'message' => 'Maaf, ID tidak ditemukan !'
            ], 404);
                }
            }
        }
    }
    //-----------------------------------------------------------------------------------------//
                                    //GET Capaian Target Dashboard//
    //-----------------------------------------------------------------------------------------//



    //-----------------------------------------------------------------------------------------//
                            //GET Capaian Aktifitas Tiap Bulan Dashboard//
    //-----------------------------------------------------------------------------------------//
}
