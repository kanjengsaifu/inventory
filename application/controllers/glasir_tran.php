<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Glasir_tran extends CI_Controller {

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
				$where .= " AND a.no_prod LIKE '%$cari%' OR a.inputer LIKE '%$cari%' OR a.id_glasir LIKE '%$cari%' OR b.nama_glasir LIKE '%$cari%'";
			}
			if(!empty($tgl)){
				$where .= " AND a.tgl_insert LIKE '%$tgl%' OR a.tgl LIKE '%$tgl%' OR a.tglp LIKE '%$tgl%' OR a.tglb LIKE '%$tgl%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Daftar Pemakaian Glasir";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT b.nama_glasir, a.tgl_insert,a.no_prod,a.inputer,a.id_glasir,a.tgl,a.tglp,a.tglb FROM glasir_thd a 
                                join glasir b on a.id_glasir = b.id_glasir
                                $where ";		
			$tot_hal = $this->glzModel->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/glasir_tran/index/';
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
			

			$text = "SELECT b.nama_glasir, a.tgl_insert,a.no_prod,a.inputer,a.id_glasir,a.tgl,a.tglp,a.tglb FROM glasir_thd a 
                                        join glasir b on a.id_glasir = b.id_glasir
                                        $where
                                        GROUP BY a.no_prod
					ORDER BY a.no_prod DESC
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->glzModel->manualQuery($text);
			
			
			$d['content'] = $this->load->view('glasir_tran/view', $d, true);		
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

			$d['judul']="Order Transaksi Glasir";
			
			$no_prod    = $this->glzModel->MaxPhGlasirTran();
			//$tgl_inp    = date('d-m-Y  h:i:s');
			
			$d['no_prod']	= $no_prod;
                        $d['tgl_plng']	= '';
                        $d['planner']	= '';
			
			$gps = "SELECT * FROM global_buyer";
			$d['l_byr'] = $this->glzModel->manualQuery($gps);
                        $bm = "SELECT * FROM global_delivery";
			$d['l_dlv'] = $this->glzModel->manualQuery($bm);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->glzModel->manualQuery($sft);
                        $mpr = "SELECT * FROM global_mesin where jns_bm like '%glasir%'";
			$d['l_mpr'] = $this->glzModel->manualQuery($mpr);
			
			$d['content'] = $this->load->view('glasir_tran/form', $d, true);		
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
			
			$d['content'] = $this->load->view('glasir_tran/form_detail', $d, true);		
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
				//$up['no_po']            = $this->input->post('no_po');
				$up['inputer']          = $this->session->userdata('username');
                                //$up['planner']          = $this->input->post('planner');
				
				$ud['no_prod']          = $this->input->post('no_prod');
				$ud['id_glasir']        = $this->input->post('id_glasir');
                                $ud['dsc']              = $this->input->post('dsc');
                                $ud['petugas1']         = $this->input->post('petugas1');
                                $ud['petugas2']         = $this->input->post('petugas2');
                                $ud['tgl']              = $this->app_model->tgl_sql($this->input->post('tgl'));
                                $ud['tglp']             = $this->glzModel->tgl_sql($this->input->post('tglp'));
                                $ud['tglb']             = $this->glzModel->tgl_sql($this->input->post('tglb'));
                                $ud['jam']              = $this->input->post('jam');
                                $ud['shift']            = $this->input->post('shift');
                                $ud['id_bm']            = $this->input->post('id_bm');
                                $ud['volume']           = $this->input->post('volume');
                                $ud['densitas']         = $this->input->post('densitas');
                                $ud['vsc']              = $this->input->post('vsc');
                                $ud['ddri']             = $this->input->post('ddri');
                                $ud['petugas3']         = $this->input->post('petugas3');
                                $ud['petugas4']         = $this->input->post('petugas4');
                                $ud['inputer']          = $this->session->userdata('username');
				
				$id['no_prod']          = $this->input->post('no_prod');
				
				$id_d['no_prod']        = $this->input->post('no_prod');
				$id_d['id_glasir']      = $this->input->post('id_glasir');
				
				$data = $this->glzModel->getSelectedData("glasir_th",$id);
				if($data->num_rows()>0){
                                                $this->glzModel->updateData("glasir_th",$up,$id);
						$data = $this->glzModel->getSelectedData("glasir_thd",$id_d);
						if($data->num_rows()>0){
							$this->glzModel->updateData("glasir_thd",$ud,$id_d);
						}else{
                                                        $ud['tgl_insert']		= date('Y-m-d h:i:s');
							$this->glzModel->insertData("glasir_thd",$ud);
						}
					echo 'Update data Sukses';
				}else{
                                        $up['tgl_inp']		= date('Y-m-d h:i:s');
					$this->glzModel->insertData("glasir_th",$up);
                                        $ud['tgl_insert']		= date('Y-m-d h:i:s');
					$this->glzModel->insertData("glasir_thd",$ud);
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
					JOIN global_mesin as d
					ON a.id_bm=d.id_bm
					JOIN global_tong as e
					ON a.id_tong=e.id_tong
					WHERE a.no_prod='$id'";
			$d['data']= $this->glzModel->manualQuery($text);
									
			$this->load->view('glasir_tran/cetak',$d);
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
					$d['tgl']	= $this->glzModel->tgl_str($db->tgl);
                                        $d['tgl_inp']	= $db->tgl_inp;
                                        $d['inputer']	= $db->inputer;
				}
			}else{
					$d['no_prod'] =$id;
					$d['tgl']	='';
                                        $d['tgl_inp']	='';
                                        $d['inputer']	='';
			}
			
			$gps = "SELECT * FROM global_buyer";
			$d['l_byr'] = $this->glzModel->manualQuery($gps);
                        $bm = "SELECT * FROM global_delivery";
			$d['l_dlv'] = $this->glzModel->manualQuery($bm);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->glzModel->manualQuery($sft);
                        $mpr = "SELECT * FROM global_mesin where jns_bm like '%glasir%'";
			$d['l_mpr'] = $this->glzModel->manualQuery($mpr);
									
			$d['content'] = $this->load->view('glasir_tran/form', $d, true);		
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
			$text = "SELECT a.no_prod,a.idthd,d.nama as shift,a.tgl,a.jam,a.id_glasir,b.nama_glasir,c.nama_bm,a.volume,a.densitas,a.vsc,a.dsc,a.petugas1,a.petugas2,a.petugas3,a.petugas4,a.inputer
                                    FROM glasir_thd a
                                    JOIN glasir b ON a.id_glasir = b.id_glasir
                                    JOIN global_mesin c ON a.id_bm = c.id_bm
                                    JOIN global_shift d ON a.shift = d.id WHERE a.no_prod='$id'";
			$d['data']= $this->glzModel->manualQuery($text);

			$this->load->view('glasir_tran/detail',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                                $id = $this->uri->segment(3);
                                $this->glzModel->manualQuery("DELETE FROM glasir_thd WHERE no_prod='$id'");
                                $this->glzModel->manualQuery("DELETE FROM glasir_th WHERE no_prod='$id'");
                                echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/glasir_tran'>";
			
						
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
                                $batch = $this->uri->segment(5);
                                $this->glzModel->manualQuery("DELETE FROM glasir_thd WHERE no_prod='$id' AND id_glasir='$kode' AND idthd='$batch'");
                                $this->edit();
		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */