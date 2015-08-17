<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_json extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
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
					echo json_encode($data);
				}
			}else{
                                        $data['nama_glasir'] = '';
                                        $data['nama_alias'] = '';
					$data['satuan'] = 'Liter';
					$data['status'] = '';
				echo json_encode($data);
			}
		}else{
			header('location:'.base_url());
		}
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
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */