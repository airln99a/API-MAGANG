<?php
defined ('BASEPATH') OR exit ('No direct script access allowed') ;

class Log_Aktivitas_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAktivitas($nip)
    {
        if( $nip != null)   {
            $this->db->select("log_id,akt_tanggal,bk_id,bk_nama_kegiatan,akt_catatan,akt_output,akt_start,akt_end,akt_satuan,akt_waktu,akt_keterangan,id_tkerja,akt_status",FALSE);
            $this->db->from('log_aktivitas');
            $this->db->join('skp_pns', 'skp_pns.nip = log_aktivitas.nip ');
            $this->db->join('log_masteraktivitas', ' log_masteraktivitas.bk_id= log_aktivitas.akt_idkegiatan');
            $this->db->where('log_aktivitas.nip',$nip);
            $this->db->limit(5, 10);
            return $this->db->get()->result_array();
        } 
        else{
            echo "Not Found";
}
}
    public function getAktivitasSearch($nip, $masukan)
    {
        if ($nip != null && $masukan != null){
            
            $this->db->select("log_id,akt_tanggal,bk_id,bk_nama_kegiatan,akt_catatan,akt_output,akt_start,akt_end,akt_satuan,akt_waktu,akt_keterangan,id_tkerja,akt_status",FALSE);
            $this->db->from('log_aktivitas');
            $this->db->join('skp_pns', 'skp_pns.nip = log_aktivitas.nip ');
            $this->db->join('log_masteraktivitas', ' log_masteraktivitas.bk_id= log_aktivitas.akt_idkegiatan');
            $this->db->where('log_aktivitas.nip',$nip);    
            $this->db->where("bk_nama_kegiatan ILIKE '%$masukan%' ");
            return $this->db->get()->result_array();
        }
    }
    public function getAktivitasAll()
    {
            $this->db->select('log_id,bk_nama_kegiatan,akt_satuan');
            $this->db->from('log_aktivitas');
            $this->db->join('skp_pns', 'skp_pns.nip = log_aktivitas.nip ');
            $this->db->join('log_masteraktivitas', ' log_masteraktivitas.bk_id= log_aktivitas.akt_idkegiatan');
            // $this->db->limit(5, 10);
            return $this->db->get()->result_array();
    }
    public function getTanggalBefore($nip,$before)
    {
            $this->db->select('log_id,akt_tanggal,bk_nama_kegiatan,akt_output,akt_start,akt_end,akt_waktu,akt_status');
            $this->db->from('log_aktivitas');
            $this->db->join('skp_pns', 'skp_pns.nip = log_aktivitas.nip ');
            $this->db->join('log_masteraktivitas', ' log_masteraktivitas.bk_id= log_aktivitas.akt_idkegiatan');
            $this->db->where('log_aktivitas.akt_tanggal <=  ', $before);
            $this->db->where('log_aktivitas.nip',$nip);
            return $this->db->get()->result_array();
    }
    public function getTanggalAfter($nip,$after)
    {
            $this->db->select('log_id,akt_tanggal,bk_nama_kegiatan,akt_output,akt_start,akt_end,akt_waktu,akt_status');
            $this->db->from('log_aktivitas');
            $this->db->join('skp_pns', 'skp_pns.nip = log_aktivitas.nip ');
            $this->db->join('log_masteraktivitas', ' log_masteraktivitas.bk_id= log_aktivitas.akt_idkegiatan');
            $this->db->where('log_aktivitas.akt_tanggal >= ', $after);
            $this->db->where('log_aktivitas.nip',$nip);
            return $this->db->get()->result_array();
    }
    public function getTanggalBetween($nip,$before,$after)
    {
            $this->db->select('log_id,akt_tanggal,bk_nama_kegiatan,akt_output,akt_start,akt_end,akt_waktu,akt_status');
            $this->db->from('log_aktivitas');
            $this->db->join('skp_pns', 'skp_pns.nip = log_aktivitas.nip ');
            $this->db->join('log_masteraktivitas', ' log_masteraktivitas.bk_id= log_aktivitas.akt_idkegiatan');
            $this->db->where('log_aktivitas.akt_tanggal <=  ', $before);
            $this->db->where('log_aktivitas.akt_tanggal >= ', $after);
            $this->db->where('log_aktivitas.nip',$nip);
            return $this->db->get()->result_array();
    }
    public function deleteAktivitas($log_id)
    {
        $this->db->delete('log_aktivitas', ['log_id' => $log_id]);
        return $this->db->affected_rows();
    }
    public function createAktivitas($data)
    {
        $this->db->insert('log_aktivitas',$data);
        return $this->db->affected_rows();
    }
    public function updateAktivitas($data, $log_id)
    {
        $this->db->update('log_aktivitas', $data, ['log_id' => $log_id]);
        return $this->db->affected_rows();
    }
}
