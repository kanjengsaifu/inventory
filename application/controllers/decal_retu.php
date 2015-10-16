<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Decal_retu extends CI_Controller {

	/**
	 * @author      : Mpod Schuzatcky    
	 * @web         : http://itmov.wordpress.com
	 * @keterangan  : Controller halaman decal retur
	 **/
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			$tgl = $this->dclModel->tgl_sql($this->input->post('cari_tgl'));
			
                        $where = " WHERE a.id_related <>'' AND a.deleted <> 1";
			if(!empty($cari)){
				$where .= " AND a.id_related LIKE '%$cari%' OR a.inputer LIKE '%$cari%' OR a.id_decal_items LIKE '%$cari%' OR b.nama LIKE '%$cari%' AND a.deleted = 0";
			}
			if(!empty($tgl)){
				$where .= " AND a.tgl_input LIKE '%$tgl%' AND a.deleted = 0";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Daftar input retur decal";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT a.id_related,a.tgl_input, a.id_decal_items, b.nama, a.inputer
                                    FROM decal_rhd a
                                    LEFT JOIN decal_items b ON b.id = a.id_decal_items
                                $where ";
                        
			$tot_hal = $this->dclModel->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/decal_retu/index/';
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
			

			$text = "SELECT a.id_related,a.tgl_input, a.id_decal_items, b.nama, a.inputer
                                    FROM decal_rhd a
                                    LEFT JOIN decal_items b ON b.id = a.id_decal_items
                                        $where
                                        GROUP BY a.id_related
					ORDER BY a.id_related DESC
					LIMIT $limit OFFSET $offset";
                        
			$d['data'] = $this->dclModel->manualQuery($text);
			
			
			$d['content'] = $this->load->view('decal_retu/view', $d, true);		
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

			$d['judul']="Input retur decal";
			
			$id         = $this->dclModel->MaxPhDecalRetu();
			
			$d['id']                = $id;
                        $d['batch']             = '';
                        $d['no_po']             = '';
                        $d['id_decal_items']	= '';
                        $d['nama_decal']        = '';
                        $d['nama_decal']        = '';
                        $d['tgli']              = '';
                        $d['jam']               = '';
                        $d['jenis_decal']       = 0;
                        $d['shift']             = 1;
                        $d['id_bm']             = 1;
                        $d['size_kertas']       = 0;
                        $d['size_kat']          = 0;
                        $d['warna']             = '';
                        $d['komposisi']         = '';
                        $d['kw1']               = '';
                        $d['kw2']               = '';
                        $d['kw3']               = '';
                        $d['petugas']           = '';
                        $d['penerima']          = '';
                        
                        $jd = "SELECT * FROM global_jenis_decal";
			$d['l_jd'] = $this->dclModel->manualQuery($jd);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->dclModel->manualQuery($sft);
                        $uk = "SELECT * FROM global_size where nama like '%decal_size_paper%' OR nama like '%Tidak Ada%'";
			$d['l_uk'] = $this->dclModel->manualQuery($uk);
                        $ul = "SELECT * FROM global_size where nama like '%decal_size_kat%' OR nama like '%Tidak Ada%'";
			$d['l_ul'] = $this->dclModel->manualQuery($ul);
                        $mpr = "SELECT * FROM global_mesin where jns_bm like '%glasir%' or jns_bm like '%Tidak ada%' order by nama_bm desc";
			$d['l_mpr'] = $this->glzModel->manualQuery($mpr);
			
			$d['content'] = $this->load->view('decal_retu/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				$up['id']		= $this->input->post('id');
				$up['inputer']          = $this->session->userdata('username');
				
				$ud['id_related']       = $this->input->post('id');
				$ud['no_po']            = $this->input->post('no_po');
				$ud['id_decal_items']   = $this->input->post('id_decal_items');
                                $ud['shift']            = $this->input->post('shift');
                                $ud['jam']              = $this->input->post('jam');
                                $ud['id_bm']            = $this->input->post('id_bm');
                                $ud['jenis_decal']      = $this->input->post('jenis_decal');
                                $ud['size_kertas']      = $this->input->post('size_kertas');
                                $ud['size_kat']         = $this->input->post('size_kat');
                                $ud['komposisi']        = $this->input->post('komposisi');
                                $ud['warna']            = $this->input->post('warna');
                                $ud['petugas']          = $this->input->post('petugas');
                                $ud['penerima']         = $this->input->post('penerima');
                                $ud['kw1']              = $this->input->post('kw1');
                                $ud['kw2']              = $this->input->post('kw2');
                                $ud['kw3']              = $this->input->post('kw3');
                                $ud['tgli']             = $this->dclModel->tgl_sql($this->input->post('tgli'));
                                $ud['inputer']          = $this->session->userdata('username');
				
				$id['id']               = $this->input->post('id');
				
				$id_d['id_related']     = $this->input->post('id');
				$id_d['id_decal_items'] = $this->input->post('id_decal_items');
                                $id_d['id']             = $this->input->post('batch');
				
				$data = $this->dclModel->getSelectedData("decal_rh",$id);
				if($data->num_rows()>0){
                                                $this->dclModel->updateData("decal_rh",$up,$id);
						$data = $this->dclModel->getSelectedData("decal_rhd",$id_d);
						if($data->num_rows()>0){
                                                        $ud['tgl_update']   = date('Y-m-d h:i:s');
							$this->dclModel->updateData("decal_rhd",$ud,$id_d);
                                                        echo 'Update data Sukses';
						}else{
                                                        $ud['tgl_input']   = date('Y-m-d h:i:s');
							$this->dclModel->insertData("decal_rhd",$ud);
                                                        echo 'Simpan data Sukses';
						}
				}else{
                                        $up['tgl_input']		= date('Y-m-d h:i:s');
					$this->dclModel->insertData("decal_rh",$up);
                                        $ud['tgl_input']                = date('Y-m-d h:i:s');
					$this->dclModel->insertData("decal_rhd",$ud);
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
			$data = $this->dclModel->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['no_prod']	= $id;
					$d['tgl_plng']	= $this->dclModel->tgl_indo($db->tgl_plng);
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
			$d['data']= $this->dclModel->manualQuery($text);
									
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
			
			$d['judul'] = "Ubah input retur decal";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM decal_rh WHERE id='$id'";
			$data = $this->dclModel->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['id']	= $id;
                                        $d['batch']             = '';
                                        $d['no_po']             = '';
                                        $d['id_decal_items']	= '';
                                        $d['nama_decal']        = '';
                                        $d['tgli']              = '';
                                        $d['jam']               = '';
                                        $d['id_bm']             = '';
                                        $d['jenis_decal']       = '';
                                        $d['shift']             = 1;
                                        $d['size_kertas']       = 0;
                                        $d['size_kat']          = 1;
                                        $d['warna']             = '';
                                        $d['komposisi']         = '';
                                        $d['kw1']               = '';
                                        $d['kw2']               = '';
                                        $d['kw3']               = '';
                                        $d['petugas']           = '';
                                        $d['penerima']          = '';
				}
			}else{
					$d['id'] =$id;
                                        $d['batch']             = '';
                                        $d['no_po']             = '';
                                        $d['id_decal_items']	= '';
                                        $d['nama_decal']        = '';
                                        $d['tgli']              = '';
                                        $d['jam']               = '';
                                        $d['id_bm']               = '';
                                        $d['jenis_decal']       = '';
                                        $d['shift']             = 1;
                                        $d['size_kertas']       = 0;
                                        $d['size_kat']          = 1;
                                        $d['warna']             = '';
                                        $d['komposisi']         = '';
                                        $d['kw1']               = '';
                                        $d['kw2']               = '';
                                        $d['kw3']               = '';
                                        $d['penerima']          = '';
                                        $d['petugas']           = '';
			}
                        
                        $jd = "SELECT * FROM global_jenis_decal";
			$d['l_jd'] = $this->dclModel->manualQuery($jd);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->dclModel->manualQuery($sft);
                        $uk = "SELECT * FROM global_size where nama like '%decal_size_paper%' OR nama like '%Tidak Ada%'";
			$d['l_uk'] = $this->dclModel->manualQuery($uk);
                        $ul = "SELECT * FROM global_size where nama like '%decal_size_kat%' OR nama like '%Tidak Ada%'";
			$d['l_ul'] = $this->dclModel->manualQuery($ul);
                        $mpr = "SELECT * FROM global_mesin where jns_bm like '%glasir%' or jns_bm like '%Tidak ada%' order by nama_bm desc";
			$d['l_mpr'] = $this->glzModel->manualQuery($mpr);
									
			$d['content'] = $this->load->view('decal_retu/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function editDetail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Ubah input retur decal";
			
			$id = $this->uri->segment(3);
                        $id_decal_items = $this->uri->segment(4);
                        $batch = $this->uri->segment(5);
			$text = "SELECT a.id as batch,a.shift,a.size_kertas,a.size_kat,a.id_related,a.no_po,a.id_decal_items,e.nama,TIME_FORMAT(a.jam,'%H:%i') as jam,i.nama as jenis,
                                    a.tgli,a.warna,a.id_bm,a.id_bm,a.komposisi,e.nama as decal_item,c.nama_bm,a.kw1,a.kw2,a.kw3,a.petugas,a.inputer, a.jenis_decal,a.penerima
                                    FROM decal_rhd as a
                                    LEFT JOIN decal_rh as b ON a.id_related=b.id 
                                    LEFT JOIN decal_items as e ON e.id=a.id_decal_items
                                    LEFT JOIN global_mesin as c ON a.id_bm=c.id_bm
                                    LEFT JOIN global_shift as f ON a.shift=f.id
                                    LEFT JOIN global_size as g ON g.id=a.size_kertas 
                                    LEFT JOIN global_size as h ON h.id=a.size_kat
                                    LEFT JOIN global_jenis_decal as i ON i.id=a.jenis_decal
                                    WHERE a.id_related = '$id' AND a.id = '$batch' AND id_decal_items = '$id_decal_items'";
			$data = $this->dclModel->manualQuery($text); 
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['id']                = $id;
                                        $d['batch']             = $db->batch;
                                        $d['no_po']             = $db->no_po;
                                        $d['id_decal_items']	= $db->id_decal_items;
                                        $d['nama_decal']        = $db->nama;
                                        $d['tgli']              = $this->dclModel->tgl_sql($db->tgli);
                                        $d['jam']               = $db->jam;
                                        $d['id_bm']             = $db->id_bm;
                                        $d['jenis_decal']       = $db->jenis_decal;
                                        $d['shift']             = $db->shift;
                                        $d['size_kertas']       = $db->size_kertas;
                                        $d['size_kat']          = $db->size_kat;
                                        $d['warna']             = $db->warna;
                                        $d['komposisi']         = $db->komposisi;
                                        $d['kw1']               = $db->kw1;
                                        $d['kw2']               = $db->kw2;
                                        $d['kw3']               = $db->kw3;
                                        $d['petugas']           = $db->petugas;
                                        $d['penerima']          = $db->penerima;
				}
			}else{
					$d['id'] =$id;
                                        $d['batch']             = '';
                                        $d['no_po']             = '';
                                        $d['id_decal_items']	= '';
                                        $d['nama_decal']        = '';
                                        $d['nama_decal']        = '';
                                        $d['tgli']              = '';
                                        $d['jam']               = '';
                                        $d['id_bm']             = '';
                                        $d['jenis_decal']       = '';
                                        $d['shift']             = '';
                                        $d['size_kertas']       = '';
                                        $d['size_kat']          = '';
                                        $d['warna']             = '';
                                        $d['komposisi']         = '';
                                        $d['kw1']               = '';
                                        $d['kw2']               = '';
                                        $d['kw3']               = '';
                                        $d['petugas']           = '';
                                        $d['penerima']          = '';
			}
                        
                        $jd = "SELECT * FROM global_jenis_decal";
			$d['l_jd'] = $this->dclModel->manualQuery($jd);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->dclModel->manualQuery($sft);
                        $uk = "SELECT * FROM global_size where nama like '%decal_size_paper%' OR nama like '%Tidak Ada%'";
			$d['l_uk'] = $this->dclModel->manualQuery($uk);
                        $ul = "SELECT * FROM global_size where nama like '%decal_size_kat%' OR nama like '%Tidak Ada%'";
			$d['l_ul'] = $this->dclModel->manualQuery($ul);
                        $mpr = "SELECT * FROM global_mesin where jns_bm like '%glasir%' or jns_bm like '%Tidak ada%' order by nama_bm desc";
			$d['l_mpr'] = $this->glzModel->manualQuery($mpr);
									
			$d['content'] = $this->load->view('decal_retu/form', $d, true);		
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
			$text = "SELECT a.id as batch,a.id_related,a.no_po,a.id_decal_items,e.nama,f.nama as shift ,TIME_FORMAT(a.jam,'%H:%i') as jam,i.nama as jenis, g.dsc as size_kertas, h.dsc as size_kat,
                                    a.tgli,a.warna,c.jns_bm,a.komposisi,e.nama as decal_item,a.kw1,a.kw2,a.kw3,a.petugas,a.penerima,a.inputer
                                    FROM decal_rhd as a 
                                    LEFT JOIN decal_rh as b ON a.id_related=b.id 
                                    LEFT JOIN decal_items as e ON e.id=a.id_decal_items
                                    LEFT JOIN global_mesin as c ON c.id_bm=a.id_bm
                                    LEFT JOIN global_shift as f ON a.shift=f.id
                                    LEFT JOIN global_size as g ON g.id=a.size_kertas 
                                    LEFT JOIN global_size as h ON h.id=a.size_kat
                                    LEFT JOIN global_jenis_decal as i ON i.id=a.jenis_decal
                                    WHERE a.id_related='$id' AND a.deleted = 0";
			$d['data']= $this->dclModel->manualQuery($text);

			$this->load->view('decal_retu/detail',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                    
                                $id = $this->uri->segment(3);
                                $tgl_deleted = date('Y-m-d h:i:s');
                                $this->dclModel->manualQuery("UPDATE decal_rhd SET deleted = 1,tgl_delete = '$tgl_deleted' WHERE id_related='$id'");
                                $this->dclModel->manualQuery("UPDATE decal_rh SET deleted = 1,tgl_delete = '$tgl_deleted' WHERE id='$id'");
                                echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/decal_retu'>";			
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
                                $tgl_deleted = date('Y-m-d h:i:s');
                                $this->dclModel->manualQuery("UPDATE decal_rhd SET deleted = 1,tgl_delete = '$tgl_deleted' WHERE id_related='$id' AND id_decal_items='$kode' AND id='$batch'");
                                $this->edit();
                        
		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */