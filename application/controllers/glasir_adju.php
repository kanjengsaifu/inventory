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
                                $inputer                = $this->session->userdata('username');
				$petugas                = $this->input->post('petugas');
                                $periode                = $this->input->post('periode');
                                $tgli                   = $this->app_model->tgl_sql($this->input->post('tgli'));
                                $jam                    = $this->input->post('jam');
				$shift                  = $this->input->post('shift');
                                $tgl_start              = $this->app_model->tgl_sql($this->input->post('tgl_start'));
                                $jam_start              = $this->input->post('jam_start');
                                $tgl_end                = $this->app_model->tgl_sql($this->input->post('tgl_end'));
                                $jam_end                = $this->input->post('jam_end');
                                $start                  = "2015-01-01 18:00:00";
                                $end                    = $this->app_model->tgl_sql($this->input->post('tgl_end')).' '.$this->input->post('jam_end');
				
				$idx['id']               = $this->input->post('id');
				
				$data = $this->glzModel->getSelectedData("glasir_ah",$idx);
				if($data->num_rows()>0){
                                               echo 'Adjusment Sudah ada';
				}else{
                                        $tgl_input		        = date('Y-m-d h:i:s');
                                        $up['tgl_input']		= date('Y-m-d h:i:s');
                                        $this->glzModel->insertData("glasir_ah",$up);
                                        $sql = "insert into glasir_ahd (id, id_glasir, id_related, inputer, petugas, periode, tgli, jam, shift, deleted, tgl_start, tgl_end, jam_start, jam_end,tgl_input, tgl_update, tgl_delete, 
								bgps_system, bgps_opname, bgps_selisih, sply_system, sply_opname, sply_selisih)
select NULL,a.id_glasir, '$id', '$inputer', '$petugas', $periode, '$tgli', '$jam', $shift, 0, '$tgl_start', '$tgl_end', '$jam_start', '$jam_end', '$tgl_input', '0000-00-00 00:00:00',	'0000-00-00 00:00:00',
                                REPLACE(FORMAT(((coalesce(c.turun_bgps, 0)-(coalesce(g.adj_bgps, 0))))-coalesce(d.ditarik_supply, 0),2),',','') bgps_system,
                                REPLACE(FORMAT(COALESCE(sum(CASE WHEN b.area=1 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = '$periode' THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END), 0),2),',','') as bgps_opname,
                                REPLACE(FORMAT(((coalesce(c.turun_bgps, 0)-(coalesce(g.adj_bgps, 0))))-coalesce(d.ditarik_supply, 0)-
                                COALESCE(sum(CASE WHEN b.area=1 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = '$periode' THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END), 0),2),',','') as bgps_selisih,
                                
                                REPLACE(FORMAT((((coalesce(d.ditarik_supply, 0)-(coalesce(g.adj_sply, 0)))+coalesce(e.return_prod, 0))) - (coalesce(f.kirim_prod, 0) + coalesce(h.scrap_supp, 0)),2),',','') sply_system,
                                REPLACE(FORMAT(COALESCE(sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = '$periode' THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END), 0),2),',','') as sply_opname,
                                REPLACE(FORMAT((((coalesce(d.ditarik_supply, 0)-(coalesce(g.adj_sply, 0)))+coalesce(e.return_prod, 0))) - (coalesce(f.kirim_prod, 0) + coalesce(h.scrap_supp, 0))-
                                COALESCE(sum(CASE WHEN b.area=2 AND b.deleted <> 1 AND b.inspected = 1 AND b.period = '$periode' THEN (1.565*((b.densitas-1000)/1000)*b.volume) ELSE 0 END), 0),2),',','') as sply_selisih
                                   
                        from glasir a
                        left join glasir_ohd b
                          on a.id_glasir = b.id_glasir
                        left join
                        (
                          select id_glasir, 
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 AND tgl_combine between '$start' AND '$end' THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') turun_bgps
                          from glasir_phd
                          where deleted = 0
                          group by id_glasir
                        ) c on a.id_glasir = c.id_glasir
                        left join
                        (
                          select id_glasir, 
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 AND tgl_combine between '$start' AND '$end' THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') ditarik_supply
                          from glasir_phd_sp
                          where deleted = 0
                          group by id_glasir
                        ) d on a.id_glasir = d.id_glasir
                        left join
                        (
                          select id_glasir, parent_id, 
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 AND tgl_combine between '$start' AND '$end' THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') return_prod
                          from glasir_rhd
                          where deleted = 0
                          group by id_glasir
                        ) e on a.id_glasir = e.parent_id
                        left join
                        (
                          select id_glasir, parent_id,
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 AND tgl_combine between '$start' AND '$end' THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') kirim_prod
                          from glasir_thd
                          where deleted = 0
                          group by id_glasir
                        ) f on a.id_glasir = f.parent_id
                        left join
                        (
                          select id_glasir, 
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (bgps_system-bgps_opname) ELSE 0 END), 0),2),',','') adj_bgps,
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (sply_system-sply_opname) ELSE 0 END), 0),2),',','') adj_sply
                          from glasir_ahd
                          where deleted = 0
                          group by id_glasir
                        ) g on a.id_glasir = g.id_glasir
                        left join
                        (
                          select id_glasir,  parent_id,
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 AND tgl_combine between '$start' AND '$end' THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') scrap_supp
                          from glasir_shd
                          where deleted = 0
                          group by id_glasir
                        ) h on a.id_glasir = h.parent_id
                        where b.deleted = 0 
                        group by a.id_glasir";
                                        $this->db->query($sql);
                                        echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/glasir_adju/edit/$id'>";
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
                                        $d['petugas']	= '';
                                        $d['periode']	= '';
                                        $d['tgli']	= '';
                                        $d['jam']	= '';
                                        $d['shift']	= '';
                                        $d['tgl_start']	= '';
                                        $d['jam_start']	= '';
                                        $d['tgl_end']	= '';
                                        $d['jam_end']	= '';
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
		$data['data_passed'] = $this->glzModel->getPicAdju();

		if ($data['data_passed']){

			#convert data array passed into json
			echo json_encode($data['data_passed']);
			//echo $data['data_passed'];

		}
	}
        
        public function getPeriod()
	{
                $this->load->model('glzModel');
		$data['data_passed'] = $this->glzModel->getPicAdju();

		if ($data['data_passed']){

			#convert data array passed into json
			echo json_encode($data['data_passed']);
			//echo $data['data_passed'];

		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */