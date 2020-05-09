<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_soal extends CI_Model {

	function jumlah_soal(){
        $this->db->select('nomor_soal');
        $this->db->from('tb_soal');
        $hasil = $this->db->get();
        return $hasil;
    }

    function soal($whr){
        $this->db->select('*');
        $this->db->from('tb_soal');
        $this->db->where($whr);
        $hasil = $this->db->get();
        return $hasil;
    }

}
