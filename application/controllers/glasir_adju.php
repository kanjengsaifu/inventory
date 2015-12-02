<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Glasir_adju extends CI_Controller {

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
			
                        $where = " WHERE deleted <> 1";
			if(!empty($cari)){
				$where .= " AND id_related LIKE '%$cari%' OR periode LIKE '%$cari%' AND c.deleted <> 1";
			}
			if(!empty($tgl)){
				$where .= " AND tgli LIKE '%$tgl%' OR tgl_start LIKE '%$tgl%' OR tgl_end LIKE '%$tgl%' AND c.deleted <> 1";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Daftar input penyesuaian glasir";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM glasir_ahd a 
                                $where ";		
			$tot_hal = $this->glzModel->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/glasir_adju/index/';
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
			

			$text = "SELECT * FROM glasir_ahd a 
                                        $where
                                        GROUP BY id_related
					ORDER BY id_related DESC
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->glzModel->manualQuery($text);
			
			
			$d['content'] = $this->load->view('glasir_adju/view', $d, true);		
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

			$d['judul']="Input penyesuaian glasir";
			
			$id    = $this->glzModel->MaxPhGlasirAdju();
                        $periode    = $this->glzModel->MaxPeriod();
			
			$d['id']	= $id;
                        $d['petugas']	= '';
                        $d['periode']	= $periode;
                        $d['tgli']	= '';
                        $d['jam']	= '';
                        $d['shift']	= '';
                        $d['tgl_start']	= '';
                        $d['jam_start']	= '';
                        $d['tgl_end']	= '';
                        $d['jam_end']	= '';
                        
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->glzModel->manualQuery($sft);
			
			$d['content'] = $this->load->view('glasir_adju/form', $d, true);		
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
				
				$id                     = $this->input->post('id');
				$petugas                = $this->input->post('petugas');
                                $periode                = $this->input->post('periode');
                                $tgli                   = $this->app_model->tgl_sql($this->input->post('tgli'));
                                $jam                    = $this->input->post('jam');
				$shift                  = $this->input->post('shift');
                                $tgl_start              = $this->app_model->tgl_sql($this->input->post('tgl_start'));
                                $jam_start              = $this->input->post('jam_start');
                                $tgl_end                = $this->app_model->tgl_sql($this->input->post('tgl_end'));
                                $jam_end                = $this->input->post('jam_end');
				
				$id['id']               = $this->input->post('id');
				
				$data = $this->glzModel->getSelectedData("glasir_ah",$id);
				if($data->num_rows()>0){
                                                $this->glzModel->updateData("glasir_ah",$up,$id);
						$data = $this->glzModel->getSelectedData("glasir_ahd",$id_d);
						if($data->num_rows()>0){
							$this->glzModel->updateData("glasir_ahd",$ud,$id_d);
                                                        echo 'Update data Sukses';
						}else{
                                                        $ud['tgl_insert']		= date('Y-m-d h:i:s');
							$this->glzModel->insertData("glasir_ahd",$ud);
                                                        echo 'Simpan data Sukses';
						}
				}else{
                                        $tgl_input		        = date('Y-m-d h:i:s');
                                        $up['tgl_input']		= date('Y-m-d h:i:s');
                                        $this->glzModel->insertData("glasir_ah",$up);
                                        $sql = "insert into decal_ohd (id,id_group,id_related,parent_id, item_code, isi_motif,jml,rusak,shift,id_bm,id_bmt,tgli,jam,petugas,inputer,
                                                        tgl_input,tgl_update,tgl_delete,deleted)
                                                        select NULL,'$id_groupx','$idx',parent_id,item_code,isi_motif,isi_motif*$jmlx,0,'$shiftx','$id_bmx','$id_bmtx','$tglix','$jamx','$petugasx','$inputerx',
                                                        '$tgl_inputx','0000-00-00 00:00:00','0000-00-00 00:00:00',0 from decal_items_detail where parent_id = '$parent_idx'";
                                        $this->db->query($sql);
                                        echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/decal_adju/edit/$idx'>";
                                        echo 'Simpan data Sukses';		
				}
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
			
			$d['judul'] = "Ubah input penyesuaian glasir";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM glasir_ah WHERE id='$id'";
			$data = $this->glzModel->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['id']	= $id;
                                        $d['petugas']	= $db->petugas;
                                        $d['periode']	= $db->periode;
                                        $d['tgli']	= $db->tgli;
                                        $d['jam']	= $db->jam;
                                        $d['shift']	= $db->shift;
                                        $d['tgl_start']	= $db->tgl_start;
                                        $d['jam_start']	= $db->jam_start;
                                        $d['tgl_end']	= $db->tgl_end;
                                        $d['jam_end']	= $db->jam_end;
				}
			}else{
					$d['no_prod'] =$id;
                                        $d['batch']	='';
                                        $d['petugas']	= '';
                                        $d['parent']	= '';
                                        $d['dsc']	= '';
                                        $d['tgl']	= '';
                                        $d['jam']	= '';
                                        $d['shift']	= '';
                                        $d['id_glasir']	= '';
                                        $d['tglp']	= '';
                                        $d['tglb']	= '';
                                        $d['id_bm']	= '';
                                        $d['status']	= '';
                                        $d['volume']	= '';
                                        $d['densitas']	= '';
			}
			
                        $bm = "SELECT * FROM global_mesin where nama_bm like '%Tong%' OR nama_bm like '%Tidak Ada%'";
			$d['l_bm'] = $this->glzModel->manualQuery($bm);
                        $status = "SELECT * FROM global_status";
			$d['l_status'] = $this->glzModel->manualQuery($status);
                        $sft = "SELECT * FROM global_shift";
			$d['l_sft'] = $this->glzModel->manualQuery($sft);
			$d['content'] = $this->load->view('glasir_adju/form', $d, true);		
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
			$text = "SELECT a.no_prod,TIME_FORMAT(a.jam,'%H:%i') as jam,a.tglb,a.tglp,d.nama_gps as status,a.tgl,a.idphd,d.nama_gps,f.nama,a.id_glasir,e.nama_glasir,c.nama_bm,a.volume,a.densitas,a.petugas,a.inputer, a.dsc
                                    FROM glasir_ahd as a JOIN glasir_ah as b ON a.no_prod=b.no_prod 
                                    JOIN glasir as e ON a.id_glasir=e.id_glasir
                                    JOIN global_mesin as c ON a.id_bm=c.id_bm 
                                    JOIN global_status as d ON a.id_gps=d.idgps
                                    JOIN global_shift as f ON a.shift=f.id WHERE a.no_prod='$id' AND a.deleted <> 1";
			$d['data']= $this->glzModel->manualQuery($text);

			$this->load->view('glasir_adju/detail',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                        $id = $this->uri->segment(3);
                                $this->glzModel->manualQuery("UPDATE glasir_ahd SET deleted = 1 WHERE no_prod='$id'");
                                $this->glzModel->manualQuery("UPDATE glasir_ahd SET deleted = 1  WHERE no_prod='$id'");
                                echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/glasir_adju'>";
			
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
                                $this->glzModel->manualQuery("UPDATE glasir_ahd SET deleted = 1 WHERE no_prod='$id' AND id_glasir='$kode' AND idphd='$batch'");
                                $this->edit();
                        
		}else{
			header('location:'.base_url());
		}
	}
        
        public function getPicAdju()
	{
                $this->load->model('glzModel');
		$data['data_passed'] = $this->glzModel->getPicScra();

		if ($data['data_passed']){

			#convert data array passed into json
			echo json_encode($data['data_passed']);
			//echo $data['data_passed'];

		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */