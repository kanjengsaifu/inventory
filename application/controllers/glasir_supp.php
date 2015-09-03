<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Glasir_supp extends CI_Controller {

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
				$where .= " AND no_prod LIKE '%$cari%' OR inputer LIKE '%$cari%'";
			}
			if(!empty($tgl)){
				$where .= " AND tgl_inp LIKE '%$tgl%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Daftar input stock supply glasir";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM glasir_ph_sp $where ";		
			$tot_hal = $this->glzModel->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/glasir_supp/index/';
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
			

			$text = "SELECT * FROM glasir_ph_sp $where 
					ORDER BY no_prod DESC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->glzModel->manualQuery($text);
			
			
			$d['content'] = $this->load->view('glasir_supp/view', $d, true);		
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

			$d['judul']="Input stock supply glasir";
			
			$no_prod    = $this->glzModel->MaxPhGlasirSupp();
			
			$d['no_prod']	= $no_prod;
                        $d['dsc']	= '';
                        $d['status']	= 2;
			
			$bm = "SELECT * FROM global_mesin where nama_bm like '%Tong%' OR nama_bm like '%Tidak Ada%'";
			$d['l_bm'] = $this->glzModel->manualQuery($bm);
                        $status = "SELECT * FROM global_status";
			$d['l_status'] = $this->glzModel->manualQuery($status);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->glzModel->manualQuery($sft);
			
			$d['content'] = $this->load->view('glasir_supp/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function status()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			$d['judul']="Status Detail Produksi Glasir";
			
			$idphdh     = $this->glzModel->MaxPhdhGlasir();
			//$tgl_inp    = date('Y-m-d h:i:s');
                        $no_prod    = $this->uri->segment(3);
			$id_glasir  = $this->uri->segment(4);
                        $batch      = $this->uri->segment(5);
                        $volume     = $this->uri->segment(6);
                        $densitas   = $this->uri->segment(7);
			
			$d['idphdh']	= $idphdh;
                        $d['no_prod']	= $no_prod;
                        $d['id_glasir']	= $id_glasir;
                        $d['batch']	= $batch;
                        $d['volume']	= $volume;
                        $d['densitas']	= $densitas;
                        			
			//$gps = "SELECT * FROM glasir_patt WHERE idgps NOT IN (SELECT idgps FROM glasir_phdh 
                                        //where noprod = '$no_prod'  AND idglasir = '$id_glasir' AND idphd = '$batch')";
                        $gps = "SELECT * FROM glasir_patt";
			$d['l_gps'] = $this->glzModel->manualQuery($gps);
                        $bm = "SELECT * FROM global_mesin";
			$d['l_bm'] = $this->glzModel->manualQuery($bm);
                        $tong = "SELECT * FROM global_tong";
			$d['l_tong'] = $this->glzModel->manualQuery($tong);
			
			$d['content'] = $this->load->view('glasir_supp/form_detail', $d, true);		
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
				//$up['tgl_plng']		= $this->app_model->tgl_sql($this->input->post('tgl_plng'));
				$up['inputer']          = $this->session->userdata('username');
                                //$up['planner']          = $this->input->post('planner');
				
				$ud['no_prod']          = $this->input->post('no_prod');
				$ud['id_glasir']        = $this->input->post('id_glasir');
                                $ud['id_bm']            = $this->input->post('id_bm');
                                $ud['id_gps']            = $this->input->post('status');
				$ud['volume']           = $this->input->post('volume');
                                $ud['densitas']         = $this->input->post('densitas');
                                $ud['inputer']          = $this->session->userdata('username');
                                $ud['dsc']              = $this->input->post('dsc');
                                $ud['shift']            = $this->input->post('shift');
                                $ud['jam']              = $this->input->post('jam');
                                $ud['tgl']              = $this->app_model->tgl_sql($this->input->post('tgl'));
                                $ud['petugas']          = $this->input->post('petugas');
				
				$id['no_prod']          = $this->input->post('no_prod');
				
				$id_d['no_prod']        = $this->input->post('no_prod');
				$id_d['id_glasir']      = $this->input->post('id_glasir');
				
				$data = $this->glzModel->getSelectedData("glasir_ph_sp",$id);
				if($data->num_rows()>0){
					$this->glzModel->updateData("glasir_ph_sp",$up,$id);
						$data = $this->glzModel->getSelectedData("glasir_phd_sp",$id_d);
						if($data->num_rows()>0){
							$this->glzModel->updateData("glasir_phd_sp",$ud,$id_d);
						}else{
                                                        $ud['tgl_insert']		= date('Y-m-d h:i:s');
							$this->glzModel->insertData("glasir_phd",$ud);
						}
					echo 'Update data Sukses';
				}else{
                                        $up['tgl_inp']		= date('Y-m-d h:i:s');
					$this->glzModel->insertData("glasir_ph_sp",$up);
                                        $ud['tgl_insert']		= date('Y-m-d h:i:s');
					$this->glzModel->insertData("glasir_phd_sp",$ud);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
        
        public function simpanStatus()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$ud['idphdh']		= $this->glzModel->MaxPhdhGlasir(); //
			$ud['tgl']		= $this->glzModel->tgl_sql($this->input->post('tgl'));
			$ud['idglasir']         = $this->input->post('idglasir'); //
			$ud['inp']              = $this->session->userdata('username'); //
			$ud['noprod']           = $this->input->post('noprod'); //
			$ud['idphd']            = $this->input->post('batch');
			$ud['volume']           = $this->input->post('volume');
                        $ud['densitas']         = $this->input->post('densitas');
                        $ud['idgps']            = $this->input->post('status');
                        $ud['idbm']             = $this->input->post('id_bm');
                        $ud['idtong']           = $this->input->post('id_tong');
                        $ud['petugas']          = $this->input->post('petugas');
                        $ud['dsc']          = $this->input->post('dsc');
			
                        $id['idphdh']           = $this->input->post('idphdh');
			$q = $this->db->get_where("glasir_phdh",$id);
			$row = $q->num_rows();
			if($row>0){
				$ud['inp_time'] = date('Y-m-d h:i:s');
				//$this->db->update("glasir_phdh",$ud,$id);
                                $this->db->insert("glasir_phdh",$ud);
				echo "Data Sukses diUpdate";
			}else{
				$ud['inp_time'] = date('Y-m-d h:i:s');
				$this->db->insert("glasir_phdh",$ud);
				echo "Data Sukses diSimpan";
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
					JOIN global_mesin as d
					ON a.id_bm=d.id_bm
					JOIN global_tong as e
					ON a.id_tong=e.id_tong
					WHERE a.no_prod='$id'";
			$d['data']= $this->glzModel->manualQuery($text);
									
			$this->load->view('glasir_supp/cetak',$d);
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
			
			$d['judul'] = "Ubah input stock supply glasir";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM glasir_ph_sp WHERE no_prod='$id'";
			$data = $this->glzModel->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['no_prod']	= $id;
                                        $d['inputer']	= $db->inputer;  
				}
			}else{
					$d['no_prod'] ='';
                                        $d['inputer']	='';
			}
			
			$bm = "SELECT * FROM global_mesin where nama_bm like '%Tong%' OR nama_bm like '%Tidak Ada%'";
			$d['l_bm'] = $this->glzModel->manualQuery($bm);
                        $status = "SELECT * FROM global_status";
			$d['l_status'] = $this->glzModel->manualQuery($status);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->glzModel->manualQuery($sft);
									
			$d['content'] = $this->load->view('glasir_supp/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function DataDetailHistory()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$noprod     = $this->input->post('noprod');
                        $idglasir   = $this->input->post('idglasir');
                        $batch      = $this->input->post('batch');
			$text = "select a.idphdh,a.noprod,a.idglasir,a.idphd,b.nama_gps,a.tgl,a.volume,a.densitas,
                                    c.id_bm,c.nama_bm,d.id_tong,d.nama_tong,a.petugas,a.dsc,a.inp,a.inp_time from glasir_phdh a
                                    join glasir_patt b on a.idgps = b.idgps join global_mesin c on a.idbm = c.id_bm 
                                    join global_tong d on a.idtong = d.id_tong
                                    where a.noprod = '$noprod' and a.idglasir = '$idglasir' and a.idphd ='$batch'";
			$d['data']= $this->glzModel->manualQuery($text);

			$this->load->view('glasir_supp/detail_history',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function DataDetail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$id = $this->input->post('kode');
			$text = "SELECT a.no_prod,a.jam,a.tgl,a.idphd,d.nama_gps,f.nama,a.id_glasir,e.nama_glasir,c.nama_bm,a.volume,a.densitas,a.petugas,a.inputer, a.dsc
                                    FROM glasir_phd_sp as a JOIN glasir_ph_sp as b ON a.no_prod=b.no_prod 
                                    JOIN glasir as e ON a.id_glasir=e.id_glasir
                                    JOIN global_mesin as c ON a.id_bm=c.id_bm 
                                    JOIN global_status as d ON a.id_gps=d.idgps
                                    JOIN global_shift as f ON a.shift=f.id WHERE a.no_prod='$id'";
			$d['data']= $this->glzModel->manualQuery($text);

			$this->load->view('glasir_supp/detail',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                        $id = $this->uri->segment(3);
			
				$this->glzModel->manualQuery("DELETE FROM glasir_phd_sp WHERE no_prod='$id'");
                                $this->glzModel->manualQuery("DELETE FROM glasir_ph_sp WHERE no_prod='$id'");
                                echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/glasir_supp'>";
			
			}			
		else{
			header('location:'.base_url());
		}
	}
        
	public function hapus_detail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				$id = $this->uri->segment(3);
                                $kode = $this->uri->segment(4);
                                $batch = $this->uri->segment(5);
                                $this->glzModel->manualQuery("DELETE FROM glasir_phd_sp WHERE no_prod='$id' AND id_glasir='$kode' AND idphd='$batch'");
                                $this->edit();
                        
		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */