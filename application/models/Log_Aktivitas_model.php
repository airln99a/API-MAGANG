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
        $year = '';
        $month = '';
        if( $nip != null)   {
            $this->db->select('log_id,akt_tanggal,bk_nama_kegiatan,akt_output,akt_start,akt_end,akt_waktu,akt_status');
            $this->db->from('log_aktivitas');
            $this->db->join('skp_pns', 'skp_pns.nip = log_aktivitas.nip ');
            $this->db->join('log_masteraktivitas', ' log_masteraktivitas.bk_id= log_aktivitas.akt_idkegiatan');
            $this->db->where('log_aktivitas.akt_tanggal',$year);
            // $this->db->where('log_aktivitas.akt_tanggal',$month);
            $this->db->where('log_aktivitas.nip',$nip);
            return $this->db->get()->result_array();
            // $this->db->select('log_id,akt_tanggal,bk_nama_kegiatan,akt_output,akt_start,akt_end,akt_waktu,akt_status');
			// $this->db->from('log_aktivitas');
            // $this->db->join('skp_pns', 'skp_pns.nip = log_aktivitas.nip ');
            // $this->db->join('log_masteraktivitas', ' log_masteraktivitas.bk_id= log_aktivitas.akt_idkegiatan');
            // return $this->db->get()->result();
        } else{
            echo "Error Dude";
                    // $this->db->select('log_id,akt_tanggal,bk_nama_kegiatan,akt_output,akt_start,akt_end,akt_waktu,akt_status');
                    // $this->db->from('log_aktivitas');
                    // $this->db->join('skp_pns', 'skp_pns.nip = log_aktivitas.nip ');
                    // $this->db->join('log_masteraktivitas', ' log_masteraktivitas.bk_id= log_aktivitas.akt_idkegiatan');
                    // $this->db->where('EXTRACT(YEAR FROM akt_tanggal) = 2018 AND EXTRACT(MONTH FROM akt_tanggal) = 12');
                    // return $this->db->get()->result_array();
            // $this->db->select('log_id,akt_tanggal,bk_nama_kegiatan,akt_output,akt_start,akt_end,akt_waktu,akt_status');
            // $this->db->join('skp_pns', 'skp_pns.nip = log_aktivitas.nip ');
            // $this->db->join('log_masteraktivitas', ' log_masteraktivitas.bk_id= log_aktivitas.akt_idkegiatan');
            // return $this->db->get_where('log_aktivitas',['log_id' => $log_id])->result_array();
        // } elseif()  {
        //     $this->db->select(*);
        //     $this->db->from('log_aktivitas');
        //     $this->db->where('EXTRACT('YEAR FROM akt_tanggal') = 2018 AND EXTRACT('MONTH FROM akt_tanggal') = 12')
        //     // select * from log_aktivitas where EXTRACT(YEAR FROM akt_tanggal) = 2018 AND EXTRACT(MONTH FROM akt_tanggal) = 12
         }
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