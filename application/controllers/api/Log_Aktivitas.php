<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Log_Aktivitas extends CI_Controller{
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    public function __construct(){
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('Log_Aktivitas_model','akt');
        $this->load->model('MyModel','mm');
        // $check_auth_client = $this->mm->check_auth_client();
        // if($check_auth_client == true){
        //     $response = $this->mm->auth();
        // if($response['status'] == 200){
        // json_output($response['status']);
        // } else {
        // json_output(400,array(
        //     'status' => 400,
        //     'message' => 'Bad request.'));
        //     }
        // }
    }
    //-----------------------------------------------------------------------------------------//
                                            //Method GET//
                                //Get by nip,year, month & Get all//
    //-----------------------------------------------------------------------------------------//
    public function index_get() {
        $nip = $this->get('nip');
        $year = $this->get('year');
        $month = $this->get('month');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            $check_auth_client = $this->mm->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->mm->auth();
        if($response['status'] == 200 && $nip != null){
            $akt = $this->akt->getAktivitas($nip,$year,$month);
            json_output($response['status'],$akt);
        } else {
            $akt = $this->akt->getAktivitas();
        }
        
        if($akt){
            $this->response([
                'status' => true,
                'data'   => $akt
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
    public function aktifitas_get() {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            $check_auth_client = $this->mm->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->mm->auth();
        if($response['status'] == 200){
            $akt = $this->akt->getAktivitasAll();
            json_output($response['status'],$akt);
        }
        if($akt){
            $this->response([
                'status' => true,
                'data'   => $akt
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
                                            //MENU AKTIFITAS//
                                    //Method Before,After,Between//
    //-----------------------------------------------------------------------------------------//
    public function before_get() {
        $nip = $this->get('nip');
        $before = $this->get('before');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            $check_auth_client = $this->mm->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->mm->auth();
        if($response['status'] == 200 && $nip != null){
            $akt = $this->akt->getTanggalBefore($nip,$before);
            json_output($response['status'],$akt);
        }       
        
        if($akt){
            $this->response([
                'status' => true,
                'data'   => $akt
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
    public function after_get() {
        $nip = $this->get('nip');
        $after = $this->get('after');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            $check_auth_client = $this->mm->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->mm->auth();
        if($response['status'] == 200  && $nip != null ){
            $akt = $this->akt->getTanggalAfter($nip,$after);
            json_output($response['status'],$akt);
        }
        
        if($akt){
            $this->response([
                'status' => true,
                'data'   => $akt
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
    public function between_get() {
        $nip = $this->get('nip');
        $before = $this->get('before');
        $after = $this->get('after');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            $check_auth_client = $this->mm->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->mm->auth();
        if($response['status'] == 200  && $nip != null ){
            $akt = $this->akt->getTanggalBetween($nip,$before,$after);
            json_output($response['status'],$akt);
        }
        
        if($akt){
            $this->response([
                'status' => true,
                'data'   => $akt
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
                                            //Method DELETE//
                                          //DELETE by log_id//
    //-----------------------------------------------------------------------------------------//
    public function index_delete() {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            $check_auth_client = $this->mm->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->mm->auth();
        if($response['status'] == 200  && $log_id != null ){
            $log_id = $this->delete('log_id');
            json_output($response['status'],$akt);
        }
        
        if($log_id === null){
            $this->response([
                'status' => false,
                'data'   => 'Maaf, masukkan ID terlebih dahulu !'
            ], 400);
        } else{
            if( $this->akt->deleteAktivitas($log_id) > 0){
                //ok
                $this->response([
                    'status' => true,
                    'log_id' => $log_id,
                    'message'=> 'ID tersebut berhasil dihapus !'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'data'   => 'Maaf, ID tidak ditemukan !'
                ], 400);
                    }
                }
            }   
        }
    }
    //-----------------------------------------------------------------------------------------//
                                            //Method POST//
    //-----------------------------------------------------------------------------------------//
    public function index_post() {
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
                    $data = [
                        'log_id'        => $this->post('log_id'),
                        'akt_tanggal'   => $this->post('akt_tanggal'),
                        'akt_idkegiatan'=> $this->post('akt_idkegiatan'),
                        'akt_catatan'   => $this->post('akt_catatan'),
                        'akt_output'    => $this->post('akt_output'),
                        'akt_start'     => $this->post('akt_start'),
                        'akt_end'       => $this->post('akt_end')
                    ];
        if ($this->akt->createAktivitas($data) > 0) {
            $this->response([
                'status'  => true,
                'message' => 'Data baru telah dibuat !'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'data'   => 'Maaf, Data baru gagal dibuat !'
            ], 400);
                        }
                    }
                }
            }
        }
    //-----------------------------------------------------------------------------------------//
                                            //Method PUT//
                                        //EDIT data by log_id//
    //-----------------------------------------------------------------------------------------//
    public function index_put(){
        $log_id = $this->put('log_id');

        $data = [
            'log_id'        => $this->put('log_id'),
            'akt_tanggal'   => $this->put('akt_tanggal'),
            'akt_idkegiatan'=> $this->put('akt_idkegiatan'),
            'akt_catatan'   => $this->put('akt_catatan'),
            'akt_output'    => $this->put('akt_output'),
            'akt_start'     => $this->put('akt_start'),
            'akt_end'       => $this->put('akt_end')
        ];

        if ($this->akt->updateAktivitas($data, $log_id) > 0) {
            $this->response([
                'status'  => true,
                'message' => 'Data berhasil diedit !'
            ], 400);
        } else {
            $this->response([
                'status' => false,
                'data'   => 'Maaf, Data gagal diupdate !'
            ], 404);
        }
    }
}