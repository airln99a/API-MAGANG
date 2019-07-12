<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
 
class Tugas_Tambahan_SKP extends CI_Controller{
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    public function __construct(){
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('Realisasi_SKP_model','rskp');
    }
    //Method Get
    public function index_get() {
        $id_skp = $this->get('id_skp');
        if($id_skp === null){
            $rskp = $this->rskp->getTambahanSKP();
        } else {
            $rskp = $this->rskp->getTambahanSKP($id_skp);
        }
        
        if($rskp){
            $this->response([
                'status' => true,
                'data' => $rskp
            ], 200);
        } else{
            $this->response([
                'status' => false,
                'message' => 'Maaf, ID tidak ditemukan !'
            ], 404);
        }
    }
    //Method Delete
    public function index_delete() {
        $id_skp = $this->delete('id_skp');

        if($id_skp === null){
            $this->response([
                'status' => false,
                'data' => 'Maaf, masukkan ID terlebih dahulu !'
            ], 400);
        } else{
            if( $this->akt->deleteTambahanSKP($id_skp) > 0){
                //ok
                $this->response([
                    'status' => true,
                    'id_skp' => $id_skp,
                    'message' => 'Pegawai dengan ID tersebut berhasil dihapus !'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'data' => 'Maaf, ID tidak ditemukan !'
                ], 400);
            }
        }
    }
    //Method Post
    public function index_post() {
        $data = [
            'id_uraian_tambahan' => $this->post('id_uraian_tambahan'),
            'id_skp' => $this->post('id_skp'),
            'uraian_tambahan'     => $this->post('uraian_tambahan'),
            'tgl_uraiantambahan' => $this->post('tgl_uraiantambahan')
        ];
        if ($this->rskp->createTambahanSKP($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Tambahan Realisasi baru telah dibuat !'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'data' => 'Maaf, Data Tambahan Realisasi baru gagal dibuat !'
            ], 400);
        }
    }
    //Method Put
    public function index_put(){
        $id_skp = $this->put('id_skp');

        $data = [
            'id_skp' => $this->put('id_skp'),
            'uraian_tambahan'     => $this->post('uraian_tambahan')
        ];

        if ($this->rskp->updateTambahanSKP($data, $id_skp) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Tambahan berhasil diedit !'
            ], 400);
        } else {
            $this->response([
                'status' => false,
                'data' => 'Maaf, Data Tambahan gagal diupdate !'
            ], 404);
        }
    }
}