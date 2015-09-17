<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_json extends CI_Controller {

	/**
	 * @author      : Mpod Schuzatcky    
	 * @web         : http://itmov.wordpress.com
	 * @keterangan  : Controller halaman master glasir
	 **/
        
        public function DataGlasir(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari= $this->input->post('cari');
			if(empty($cari)){
				$text = "SELECT * FROM glasir";
			}else{
				$text = "SELECT * FROM glasir WHERE id_glasir LIKE '%$cari%' OR nama_glasir LIKE '%$cari%' OR nama_alias LIKE '%$cari%'";
			}
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('data_glasir',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function DataTglp(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari= $this->input->post('cari');
			if(empty($cari)){
				//$text = "SELECT * FROM glasir_phd";
			}else{
				$text = "SELECT * FROM glasir_phd WHERE id_glasir = '$cari'";
			}
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('data_tglp',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function InfoGlasir()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('kode');
			$text = "SELECT * FROM glasir WHERE id_glasir='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['nama_glasir'] = $t->nama_glasir;
                                        $data['nama_alias'] = $t->nama_alias;
					$data['satuan'] = $t->satuan;
					$data['status'] = $t->status;
                                        $data['s_supply'] = $t->s_supply;
                                        $data['s_bgps'] = $t->s_bgps;
                                        $data['nama_alias'] = $t->nama_alias;
					echo json_encode($data);
				}
			}else{
                                        $data['nama_glasir'] = '';
                                        $data['nama_alias'] = '';
					$data['satuan'] = 'Kilogram';
					$data['status'] = '';
                                        $data['s_supply'] = '';
                                        $data['s_bgps'] = '';
                                        $data['nama_alias'] = '';
				echo json_encode($data);
			}
		}else{
			header('location:'.base_url());
		}
	}
        
        public function CariNoSJ(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(kodebeli) as no FROM h_beli";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,5,5))+1;
				$hasil = 'BL'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'BL'.'00001';
		}
		return $hasil;
	}
	
	public function InfoSupplier()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('kode');
			$text = "SELECT * FROM supplier WHERE kode_supplier='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['nama_supplier'] = $t->nama_supplier;
					$data['alamat'] = $t->alamat;
					echo json_encode($data);
				}
			}else{
				$data['nama_supplier'] = '';
				$data['alamat'] = '';
				echo json_encode($data);
			}
		}else{
			header('location:'.base_url());
		}
	}
	
	public function DataBarang(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari= $this->input->post('cari');
			if(empty($cari)){
				$text = "SELECT * FROM barang";
			}else{
				$text = "SELECT * FROM barang WHERE kode_barang LIKE '%$cari%' OR nama_barang LIKE '%$cari%'";
			}
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('data_barang',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */