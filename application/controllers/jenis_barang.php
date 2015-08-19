<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jenis_barang extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman profil
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
			
			$d['judul']="Jenis Barang";
			
			$d['content']= $this->load->view('jenis_barang/view',$d,true);
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url().'index.php/login');
		}
	}
	
	public function view()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
			$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
			$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_jenis'; //ieu ku field
			$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
			$cari = isset($_POST['cari']) ? mysql_real_escape_string($_POST['cari']) : '';
			
			$offset = ($page-1) * $rows;
			
			$where = " WHERE jenis LIKE '%$cari%'"; //
			
			$text = "SELECT * FROM jenis_barang
				$where 
				ORDER BY $sort $order
				LIMIT $rows OFFSET $offset";
			
			$result = array();
			$result['total'] = $this->db->query("SELECT * FROM jenis_barang")->num_rows();
			$row = array();	
			
			$criteria = $this->db->query($text);
			
			foreach($criteria->result_array() as $data)
			{	
				$row[] = array(
					'id_jenis'=>$data['id_jenis'],
					'jenis'=>$data['jenis']
				);
			}
			$result=array_merge($result,array('rows'=>$row));
			echo  json_encode($result);
		}else{
			header('location:'.base_url().'index.php/login');
		}
	}
	
	public function simpan()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				$id['id_jenis'] = $this->input->post('id_jenis');
				
				$up['id_jenis'] = $this->input->post('id_jenis');
				$up['jenis'] = $this->input->post('jenis');	
				
				$hasil = $this->app_model->getSelectedData("jenis_barang",$id);
				$row = $hasil->num_rows();
				if($row>0){
					$this->app_model->updateData("jenis_barang",$up,$id);
					echo "Data sukses diubah";
				}else{
					$this->app_model->insertData("jenis_barang",$up);
					echo "Data sukses disimpan";
				}
		}else{
				header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				$id['id_jenis'] = $this->input->post('id'); //
				
				$hasil = $this->app_model->getSelectedData("jenis_barang",$id); //
				$row = $hasil->num_rows();
				if($row>0){
					$this->app_model->deleteData("jenis_barang",$id);
					echo "Data sukses dihapus";
				}
		}else{
				header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */