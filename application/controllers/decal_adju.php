<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Decal_adju extends CI_Controller {

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

			
			$d['judul']="Daftar input stock adjusment decal";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT a.id_related,a.tgl_input, a.id_decal_items, b.nama, a.inputer
                                    FROM decal_ohd a
                                    LEFT JOIN decal_items b ON b.id = a.id_decal_items
                                $where ";
                        
			$tot_hal = $this->dclModel->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/decal_adju/index/';
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
                                    FROM decal_ohd a
                                    LEFT JOIN decal_items b ON b.id = a.id_decal_items
                                        $where
                                        GROUP BY a.id_related
					ORDER BY a.id_related DESC
					LIMIT $limit OFFSET $offset";
                        
			$d['data'] = $this->dclModel->manualQuery($text);
			
			
			$d['content'] = $this->load->view('decal_adju/view', $d, true);		
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

			$d['judul']="Input stock adjusment decal";
			
			$id         = $this->dclModel->MaxPhDecalOpna();
			
			$d['id']                = $id;
                        $d['batch']             = '';
                        $d['area']             = '';
                        $d['id_decal_items']	= '';
                        $d['nama_decal']        = '';
                        $d['nama_decal']        = '';
                        $d['tgli']              = '';
                        $d['jam']               = '';
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
			
                        $jd = "SELECT * FROM global_jenis_decal";
			$d['l_jd'] = $this->dclModel->manualQuery($jd);
			$area = "SELECT * FROM global_area where nama like '%Decal%' OR nama like '%Tidak Ada%' ";
			$d['l_area'] = $this->dclModel->manualQuery($area);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->dclModel->manualQuery($sft);
                        $uk = "SELECT * FROM global_size where nama like '%decal_size_paper%' OR nama like '%Tidak Ada%'";
			$d['l_uk'] = $this->dclModel->manualQuery($uk);
                        $ul = "SELECT * FROM global_size where nama like '%decal_size_kat%' OR nama like '%Tidak Ada%'";
			$d['l_ul'] = $this->dclModel->manualQuery($ul);
			
			$d['content'] = $this->load->view('decal_adju/form', $d, true);		
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
				$ud['area']            = $this->input->post('area');
				$ud['id_decal_items']   = $this->input->post('id_decal_items');
                                $ud['shift']            = $this->input->post('shift');
                                $ud['jam']              = $this->input->post('jam');
                                $ud['jenis_decal']      = $this->input->post('jenis_decal');
                                $ud['size_kertas']      = $this->input->post('size_kertas');
                                $ud['size_kat']         = $this->input->post('size_kat');
                                $ud['komposisi']        = $this->input->post('komposisi');
                                $ud['warna']            = $this->input->post('warna');
                                $ud['petugas']          = $this->input->post('petugas');
                                $ud['kw1']              = $this->input->post('kw1');
                                $ud['kw2']              = $this->input->post('kw2');
                                $ud['kw3']              = $this->input->post('kw3');
                                $ud['tgli']             = $this->dclModel->tgl_sql($this->input->post('tgli'));
                                $ud['inputer']          = $this->session->userdata('username');
				
				$id['id']               = $this->input->post('id');
				
				$id_d['id_related']     = $this->input->post('id');
				$id_d['id_decal_items'] = $this->input->post('id_decal_items');
                                $id_d['id']             = $this->input->post('batch');
				
				$data = $this->dclModel->getSelectedData("decal_oh",$id);
				if($data->num_rows()>0){
                                                $this->dclModel->updateData("decal_oh",$up,$id);
						$data = $this->dclModel->getSelectedData("decal_ohd",$id_d);
						if($data->num_rows()>0){
                                                        $ud['tgl_update']   = date('Y-m-d h:i:s');
							$this->dclModel->updateData("decal_ohd",$ud,$id_d);
                                                        echo 'Update data Sukses';
						}else{
                                                        $ud['tgl_input']   = date('Y-m-d h:i:s');
							$this->dclModel->insertData("decal_ohd",$ud);
                                                        echo 'Simpan data Sukses';
						}
				}else{
                                        $up['tgl_input']		= date('Y-m-d h:i:s');
					$this->dclModel->insertData("decal_oh",$up);
                                        $ud['tgl_input']                = date('Y-m-d h:i:s');
					$this->dclModel->insertData("decal_ohd",$ud);
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
			
			$d['judul'] = "Form Order adjusment Glasir";
			
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
			
			$d['judul'] = "Ubah input adjusment decal";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM decal_oh WHERE id='$id'";
			$data = $this->dclModel->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['id']	= $id;
                                        $d['batch']             = '';
                                        $d['area']             = '';
                                        $d['id_decal_items']	= '';
                                        $d['nama_decal']        = '';
                                        $d['tgli']              = '';
                                        $d['jam']               = '';
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
				}
			}else{
					$d['id'] =$id;
                                        $d['batch']             = '';
                                        $d['area']             = '';
                                        $d['id_decal_items']	= '';
                                        $d['nama_decal']        = '';
                                        $d['tgli']              = '';
                                        $d['jam']               = '';
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
			}
			
                        $jd = "SELECT * FROM global_jenis_decal";
			$d['l_jd'] = $this->dclModel->manualQuery($jd);
			$area = "SELECT * FROM global_area where nama like '%Decal%' OR nama like '%Tidak Ada%' ";
			$d['l_area'] = $this->dclModel->manualQuery($area);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->dclModel->manualQuery($sft);
                        $uk = "SELECT * FROM global_size where nama like '%decal_size_paper%' OR nama like '%Tidak Ada%'";
			$d['l_uk'] = $this->dclModel->manualQuery($uk);
                        $ul = "SELECT * FROM global_size where nama like '%decal_size_kat%' OR nama like '%Tidak Ada%'";
			$d['l_ul'] = $this->dclModel->manualQuery($ul);
									
			$d['content'] = $this->load->view('decal_adju/form', $d, true);		
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
			
			$d['judul'] = "Ubah input stock adjusment";
			
			$id = $this->uri->segment(3);
                        $id_decal_items = $this->uri->segment(4);
                        $batch = $this->uri->segment(5);
			$text = "SELECT a.id as batch,a.shift,a.size_kertas,a.size_kat,a.id_related,a.id_decal_items,e.nama,TIME_FORMAT(a.jam,'%H:%i') as jam,i.nama as jenis,
                                    a.tgli,a.area,a.jenis_decal,a.warna,a.komposisi,e.nama as decal_item,a.kw1,a.kw2,a.kw3,a.petugas,a.inputer
                                    FROM decal_ohd as a
                                    LEFT JOIN decal_oh as b ON a.id_related=b.id 
                                    LEFT JOIN decal_items as e ON e.id=a.id_decal_items
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
                                        $d['area']              = $db->area;
                                        $d['id_decal_items']	= $db->id_decal_items;
                                        $d['nama_decal']        = $db->nama;
                                        $d['tgli']              = $this->dclModel->tgl_sql($db->tgli);
                                        $d['jam']               = $db->jam;
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
				}
			}else{
					$d['id'] =$id;
                                        $d['batch']             = '';
                                        $d['area']              = '';
                                        $d['id_decal_items']	= '';
                                        $d['nama_decal']        = '';
                                        $d['nama_decal']        = '';
                                        $d['tgli']              = '';
                                        $d['jam']               = '';
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
			}
			
                        $jd = "SELECT * FROM global_jenis_decal";
			$d['l_jd'] = $this->dclModel->manualQuery($jd);
			$area = "SELECT * FROM global_area where nama like '%Decal%' OR nama like '%Tidak Ada%' ";
			$d['l_area'] = $this->dclModel->manualQuery($area);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->dclModel->manualQuery($sft);
                        $uk = "SELECT * FROM global_size where nama like '%decal_size_paper%' OR nama like '%Tidak Ada%'";
			$d['l_uk'] = $this->dclModel->manualQuery($uk);
                        $ul = "SELECT * FROM global_size where nama like '%decal_size_kat%' OR nama like '%Tidak Ada%'";
			$d['l_ul'] = $this->dclModel->manualQuery($ul);
									
			$d['content'] = $this->load->view('decal_adju/form', $d, true);		
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
			$text = "SELECT a.id as batch,a.id_related,a.id_decal_items,e.nama,f.nama as shift ,TIME_FORMAT(a.jam,'%H:%i') as jam,i.nama as jenis, g.dsc as size_kertas, h.dsc as size_kat,
                                    a.tgli,c.nama as area,a.warna,a.komposisi,e.nama as decal_item,a.kw1,a.kw2,a.kw3,a.petugas,a.inputer
                                    FROM decal_ohd as a 
                                    LEFT JOIN decal_oh as b ON a.id_related=b.id 
                                    LEFT JOIN global_area as c ON c.id=a.area 
                                    LEFT JOIN decal_items as e ON e.id=a.id_decal_items
                                    LEFT JOIN global_shift as f ON a.shift=f.id
                                    LEFT JOIN global_size as g ON g.id=a.size_kertas 
                                    LEFT JOIN global_size as h ON h.id=a.size_kat
                                    LEFT JOIN global_jenis_decal as i ON i.id=a.jenis_decal
                                    WHERE a.id_related='$id' AND a.deleted = 0";
			$d['data']= $this->dclModel->manualQuery($text);

			$this->load->view('decal_adju/detail',$d);
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
                                $this->dclModel->manualQuery("UPDATE decal_ohd SET deleted = 1,tgl_delete = '$tgl_deleted' WHERE id_related='$id'");
                                $this->dclModel->manualQuery("UPDATE decal_oh SET deleted = 1,tgl_delete = '$tgl_deleted' WHERE id='$id'");
                                echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/decal_adju'>";			
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
                                $this->dclModel->manualQuery("UPDATE decal_ohd SET deleted = 1,tgl_delete = '$tgl_deleted' WHERE id_related='$id' AND id_decal_items='$kode' AND id='$batch'");
                                $this->edit();
                        
		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */