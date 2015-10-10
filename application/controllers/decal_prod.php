<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Decal_prod extends CI_Controller {

	/**
	 * @author      : Mpod Schuzatcky    
	 * @web         : http://itmov.wordpress.com
	 * @keterangan  : Controller halaman master decal
	 **/
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			$d['judul']="Item Decal";
			$d['content'] = $this->load->view('decal/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function ldg()
	{
                $this->load->model('dclModel');
		$data['data_passed'] = $this->dclModel->get_ldg();

		if ($data['data_passed']){

			#convert data array passed into json
			echo json_encode($data['data_passed']);
			//echo $data['data_passed'];

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

			$d['judul']="Data Decal";
			$id    = $this->dclModel->MaxItemsDecal();
			$d['id']	= $id;
			$d['satuan']        ='pcs';
			$d['nama']              = '';
                        $d['alias']             = '';
			
			$d['content'] = $this->load->view('decal/form', $d, true);		
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
			$d['judul'] = "Data Decal";
			$id    = $this->uri->segment(3);
			$main  = "SELECT a.id, a.nama, a.alias, a.buyer, a.material, a.forming, a.shape, b.status,b.deleted,
                            a.item, a.dekorasi, a.size, a.jenis, a.satuan, a.parent
                            FROM decal_items a
                            LEFT JOIN global_detail b ON b.id_related = a.id
                            WHERE b.deleted = 0 AND a.id = '$id'
                            ORDER BY a.id";
			$data1 = $this->dclModel->manualQuery($main);
			if($data1->num_rows() > 0){
				foreach($data1->result() as $db){
					$d['id']                = $id;
					$d['nama']              = $db->nama;
                                        $d['alias']             = $db->alias;
					$d['buyer']             = $db->buyer;
					$d['material']          = $db->material;
                                        $d['forming']           = $db->forming;
					$d['shape']             = $db->shape;
                                        $d['item']              = $db->item;
                                        $d['dekorasi']          = $db->dekorasi;
					$d['size']              = $db->size;
					$d['satuan']            = $db->satuan;
                                        $d['jenis']             = $db->jenis;
                                        $d['status']            = $db->status;
				}
			}else{
					$d['id']                = $id;
					$d['nama']              = '';
                                        $d['alias']             = '';
					$d['buyer']             = '';
					$d['material']          = '';
                                        $d['forming']           = '';
					$d['shape']             = '';
                                        $d['item']              = '';
                                        $d['dekorasi']          = '';
					$d['size']              = '';
					$d['satuan']            = 'pcs';
                                        $d['jenis']             = '';
                                        $d['status']            = '';
			}
						
			$d['content'] = $this->load->view('decal/form', $d, true);		
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
			$this->glzModel->manualQuery("UPDATE global_detail SET deleted = 1 WHERE id_related='$id' AND tabel = 'decal_items'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/decal'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
                $username = $this->session->userdata('username');
		if(!empty($cek)){
				$up['id']=$this->input->post('id');
				$up['nama']=$this->input->post('nama');
                                $up['alias']=$this->input->post('alias');
				$up['buyer']=$this->input->post('buyer');
                                $up['material']=$this->input->post('material');
                                $up['forming']=$this->input->post('forming');
				$up['shape']=$this->input->post('shape');
                                $up['item']=$this->input->post('item');
				$up['dekorasi']=$this->input->post('dekorasi');
                                $up['size']=$this->input->post('size');
                                $up['satuan']=$this->input->post('satuan');
				$up['jenis']=$this->input->post('jenis');
                                
                                $ud['id_related']=$this->input->post('id');
                                $ud['tabel']='decal_items';
                                $ud['inputer']=$username;
                                $ud['image']='none.png';
                                $ud['status']=$this->input->post('status');
				
				$id['id']=$this->input->post('id');
                                
                                $id_d['id_related']     = $this->input->post('id');
				$id_d['tabel']          = 'decal_items';
				
				$data = $this->dclModel->getSelectedData("decal_items",$id);
				if($data->num_rows()>0){
                                        $ud['tgl_update'] = date('Y-m-d h:i:s');
					$this->dclModel->updateData("decal_items",$up,$id);
                                        $this->dclModel->updateData("global_detail",$ud,$id_d);
					echo 'Update data Sukses';
				}else{
                                        $ud['tgl_input'] = date('Y-m-d h:i:s');
					$this->dclModel->insertData("decal_items",$up);
                                        $this->dclModel->insertData("global_detail",$ud);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */