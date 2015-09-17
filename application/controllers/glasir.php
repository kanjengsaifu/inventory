<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Glasir extends CI_Controller {

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
			$cari_jenis = $this->input->post('cari_jenis');
			if(!empty($cari)){
				$sess_data['cari'] = $this->input->post("txt_cari");
				$this->session->set_userdata($sess_data);
				$cari = $this->session->userdata('cari');
				$where = " WHERE id_glasir LIKE '%$cari%' OR nama_glasir LIKE '%$cari%' OR nama_alias LIKE '%$cari%'";
			}else{
				$where = ' ';
				$kata = $this->session->userdata('cari');
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Data Glasir";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM glasir $where ";		
			$tot_hal = $this->glzModel->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/glasir/index/';
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
			

			$text = "SELECT * FROM glasir $where 
					ORDER BY id_glasir ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->glzModel->manualQuery($text);
			
			
			$d['content'] = $this->load->view('glasir/view', $d, true);		
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

			$d['judul']="Data Glasir";
			
			$d['kode_glasir']   ='';
			$d['nama_glasir']   ='';
                        $d['nama_alias']     ='';
			$d['satuan']        ='Kilogram';
			$d['status']        ='';
			
			$d['content'] = $this->load->view('glasir/form', $d, true);		
			$this->load->view('home',$d);
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
			
			$d['judul'] = "Data Glasir";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM glasir WHERE id_glasir='$id'";
			$data = $this->glzModel->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['kode_glasir']   =$id;
					$d['nama_glasir']   =$db->nama_glasir;
                                        $d['nama_alias']     =$db->nama_alias;
					$d['satuan']        =$db->satuan;
					$d['status']        =$db->status;
				}
			}else{
					$d['kode_glasir']   =$id;
					$d['nama_glasir']   ='';
                                        $d['nama_alias']     ='';
					$d['satuan']        ='Liter';
					$d['hrg_beli']      ='';
					$d['status']        ='';
			}
						
			$d['content'] = $this->load->view('glasir/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(3);
			$this->glzModel->manualQuery("DELETE FROM glasir WHERE id_glasir='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/glasir'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
                $username = $this->session->userdata('username');
		if(!empty($cek)){
				
				$up['id_glasir']=$this->input->post('kode_glasir');
				$up['nama_glasir']=$this->input->post('nama_glasir');
                                $up['nama_alias']=$this->input->post('nama_alias');
				$up['satuan']=$this->input->post('satuan');
                                $up['status']=$this->input->post('status');
                                $up['inputer']=$username;
				
				$id['id_glasir']=$this->input->post('kode_glasir');
				
				$data = $this->glzModel->getSelectedData("glasir",$id);
				if($data->num_rows()>0){
                                        $up['tgl_update'] = date('Y-m-d h:i:s');
					$this->app_model->updateData("glasir",$up,$id);
					echo 'Update data Sukses';
				}else{
                                        $up['tgl_input'] = date('Y-m-d h:i:s');
					$this->app_model->insertData("glasir",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */