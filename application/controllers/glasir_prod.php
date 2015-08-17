<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Glasir_prod extends CI_Controller {

	/**
	 * @author      : Mpod Schuzatcky    
	 * @web         : http://itmov.wordpress.com
	 * @keterangan  : Controller halaman master glasir
	 **/
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			$tgl = $this->glzModel->tgl_sql($this->input->post('cari_tgl'));
			
                        $where = " WHERE no_prod<>''";
			if(!empty($cari)){
				$where .= " AND no_prod LIKE '%$cari%' OR no_po LIKE '%$cari%'";
			}
			if(!empty($tgl)){
				$where .= " AND tgl_plng='$tgl'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Daftar Produksi Glasir";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM glasir_ph $where ";		
			$tot_hal = $this->glzModel->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/glasir_prod/index/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['next_link'] = 'Lanjut &raquo;';
			$config['prev_link'] = '&laquo; Kembali';
			$config['last_link'] = '<b>Terakhir &raquo; </b>';
			$config['first_link'] = '<b> &laquo; Pertama</b>';
			$this->pagination->initialize($config);
			$d["paginator"] =$this->pagination->create_links();
			$d['hal'] = $offset;
			

			$text = "SELECT * FROM glasir_ph $where 
					ORDER BY no_prod DESC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->glzModel->manualQuery($text);
			
			
			$d['content'] = $this->load->view('glasir_prod/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			$d['judul']="Order Produksi Glasir";
			
			$no_prod    = $this->glzModel->MaxPhGlasir();
			$tgl_inp    = date('d-m-Y');
                        $inputer    = $this->session->userdata('username');
			
			$d['no_prod']	= $no_prod;
                        $d['no_po']	= '';
			$d['tgl_inp']	= $tgl_inp;
                        $d['tgl_plng']	= '';
                        $d['inputer']	= $inputer;
                        $d['planner']	= '';
			
			$gps = "SELECT * FROM glasir_patt";
			$d['l_gps'] = $this->glzModel->manualQuery($gps);
                        $bm = "SELECT * FROM bm";
			$d['l_bm'] = $this->glzModel->manualQuery($bm);
                        $tong = "SELECT * FROM tong";
			$d['l_tong'] = $this->glzModel->manualQuery($tong);
			
			$d['content'] = $this->load->view('glasir_prod/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				$up['no_prod']		= $this->input->post('no_prod');
				$up['tgl_plng']		= $this->app_model->tgl_sql($this->input->post('tgl_plng'));
				$up['no_po']            = $this->input->post('no_po');
				$up['inputer']          = $this->session->userdata('username');
                                $up['planner']          = $this->input->post('planner');
				
				$ud['no_prod']          = $this->input->post('no_prod');
				$ud['id_glasir']        = $this->input->post('id_glasir');
				$ud['idgps']            = $this->input->post('status');
				$ud['volume']           = $this->input->post('volume');
                                $ud['densitas']         = $this->input->post('densitas');
                                $ud['id_bm']            = $this->input->post('id_bm');
                                $ud['id_tong']          = $this->input->post('id_tong');
                                $ud['petugas']          = $this->input->post('petugas');
                                $ud['inputer']          = $this->session->userdata('username');
				
				$id['no_prod']          = $this->input->post('no_prod');
				
				$id_d['no_prod']        = $this->input->post('no_prod');
				$id_d['id_glasir']      = $this->input->post('id_glasir');
				
				$data = $this->glzModel->getSelectedData("glasir_ph",$id);
				if($data->num_rows()>0){
					$this->glzModel->updateData("glasir_ph",$up,$id);
						$data = $this->glzModel->getSelectedData("glasir_phd",$id_d);
						if($data->num_rows()>0){
							$this->glzModel->updateData("glasir_phd",$ud,$id_d);
						}else{
                                                        $ud['tgl_insert']		= date('Y-m-d h:i:s');
							$this->glzModel->insertData("glasir_phd",$ud);
						}
					echo 'Update data Sukses';
				}else{
                                        $up['tgl_inp']		= date('Y-m-d h:i:s');
					$this->glzModel->insertData("glasir_ph",$up);
					$this->glzModel->insertData("glasir_phd",$ud);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Form Order Produksi Glasir";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM glasir_ph WHERE no_prod='$id'";
			$data = $this->glzModel->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['no_prod']	= $id;
					$d['tgl_plng']	= $this->glzModel->tgl_indo($db->tgl_plng);
					$d['no_po']	= $db->no_po;
                                        $d['planner']	= $db->planner;
				}
			}else{
					$d['no_prod']		=$id;
					$d['tgl_plng']	='';
					$d['no_po']	='';
                                        $d['planner']	='';
			}
			
			$text = "SELECT a.no_prod,a.id_glasir,c.nama_gps,a.volume,a.densitas,
					d.nama_bm,e.nama_tong,a.petugas,a.inputer
					FROM glasir_phd as a 
					JOIN glasir_ph as b
					ON a.no_prod=b.no_prod
					JOIN glasir_patt as c
					ON a.idgps=c.idgps
					JOIN bm as d
					ON a.id_bm=d.id_bm
					JOIN tong as e
					ON a.id_tong=e.id_tong
					WHERE a.no_prod='$id'";
			$d['data']= $this->glzModel->manualQuery($text);
									
			$this->load->view('glasir_prod/cetak',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Ubah Order Produksi Glasir";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM glasir_ph WHERE no_prod='$id'";
			$data = $this->glzModel->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['no_prod']	= $id;
					$d['tgl_plng']	= $this->glzModel->tgl_str($db->tgl_plng);
                                        $d['tgl_inp']	= $this->glzModel->tgl_str($db->tgl_inp);
					$d['no_po']	= $db->no_po;
                                        $d['inputer']	= $db->inputer;
                                        $d['planner']	= $db->planner;  
				}
			}else{
					$d['no_prod'] =$id;
					$d['tgl_plng']	='';
                                        $d['tgl_inp']	='';
					$d['no_po']	='';
                                        $d['inputer']	='';
                                        $d['planner']	='';
			}
			
			$gps = "SELECT * FROM glasir_patt";
			$d['l_gps'] = $this->glzModel->manualQuery($gps);
                        $bm = "SELECT * FROM bm";
			$d['l_bm'] = $this->glzModel->manualQuery($bm);
                        $tong = "SELECT * FROM tong";
			$d['l_tong'] = $this->glzModel->manualQuery($tong);
									
			$d['content'] = $this->load->view('glasir_prod/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function DataDetail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$id = $this->input->post('kode');
			$text = "SELECT a.no_prod,a.id_glasir,c.nama_gps,a.volume,a.densitas,
					d.nama_bm,e.nama_tong,a.petugas,a.inputer
					FROM glasir_phd as a 
					JOIN glasir_ph as b
					ON a.no_prod=b.no_prod
					JOIN glasir_patt as c
					ON a.idgps=c.idgps
					JOIN bm as d
					ON a.id_bm=d.id_bm
					JOIN tong as e
					ON a.id_tong=e.id_tong
					WHERE a.no_prod='$id'";
			$d['data']= $this->glzModel->manualQuery($text);

			$this->load->view('glasir_prod/detail',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(3);
			$this->glzModel->manualQuery("DELETE FROM glasir_phd WHERE no_prod='$id'");
			$this->glzModel->manualQuery("DELETE FROM glasir_ph WHERE no_prod='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/glasir_prod'>";			
		}else{
			header('location:'.base_url());
		}
	}
        
	public function hapus_detail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(3);
			$kode = $this->uri->segment(4);
			$this->glzModel->manualQuery("DELETE FROM glasir_phd WHERE no_prod='$id' AND id_glasir='$kode'");
			
			$this->edit();
		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */