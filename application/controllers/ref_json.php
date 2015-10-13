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
        
        public function DataDecal(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari= $this->input->post('cari');
			if(empty($cari)){
				$text = "SELECT a.id, a.nama, a.alias, a.satuan, a.parent, a.jenis, b.nama as buyer, c.nama as shape FROM decal_items a
                                            LEFT JOIN global_buyer b ON b.id = a.buyer
                                            LEFT JOIN global_shape c ON c.id = a.shape
                                            group by a.nama, a.buyer
                                            order by a.nama, a.buyer";
			}else{
				$text = "SELECT a.id, a.nama, a.alias, a.satuan, a.parent, a.jenis, b.nama as buyer, c.nama as shape FROM decal_items a
                                            LEFT JOIN global_buyer b ON b.id = a.buyer
                                            LEFT JOIN global_shape c ON c.id = a.shape
                                            WHERE a.id LIKE '%$cari%' OR a.nama LIKE '%$cari%' OR a.alias LIKE '%$cari%'
                                            group by a.nama, a.buyer
                                            order by a.nama, a.buyer";
			}
			$d['data'] = $this->dclModel->manualQuery($text);
			
			$this->load->view('data_decal',$d);
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
        
        public function InfoDecal()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('kode');
			$text = "SELECT * FROM decal_items WHERE id='$kode'";
			$tabel = $this->dclModel->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['nama_decal'] = $t->nama;
					echo json_encode($data);
				}
			}else{
                                        $data['nama_decal'] = '';
				echo json_encode($data);
			}
		}else{
			header('location:'.base_url());
		}
	}
        
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */