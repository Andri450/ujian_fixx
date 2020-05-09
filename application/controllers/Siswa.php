<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('M_soal');
	}

	public function index()
	{
		$data['jumlah'] = $this->M_soal->jumlah_soal()->result();
		$data['total_soal'] = $this->M_soal->jumlah_soal()->num_rows();

		$this->load->view('ujian',$data);
	}

	public function ujian(){

		$whr = array( 'nomor_soal' => $this->input->post('ids') );

		$data = $this->M_soal->soal($whr)->result();

		foreach ($data as $dt){

			// $val = '<p>' . $dt->soal . '</p>|<p>' . $dt->isi_a . '</p>|<p>' . $dt->isi_b . '</p>|<p>' . $dt->isi_c . '</p>|<p>' . $dt->isi_d . '</p>';

			$data['soal'] = $dt->soal;
			$data['a']    = $dt->isi_a;
			$data['b']    = $dt->isi_b;
			$data['c']    = $dt->isi_c;
			$data['d']    = $dt->isi_d;
			
			echo json_encode($data);

		}

	}

}
