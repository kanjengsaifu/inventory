<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Decal extends CI_Controller {

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
                $query = "SELECT a.id,a.nama,a.alias, b.nama as buyer,c.dsc as dekorasi,d.dsc as size,a.satuan,e.nama as jenis,a.deleted,a.tgl_insert,a.tgl_update,a.tgl_delete
                                    FROM decal_items a
                                    left join global_buyer b on a.buyer = b.id
                                    left join global_dekorasi c on a.dekorasi = c.id
                                    left join global_size d on a.size = d.id
                                    left join global_jenis_decal e on a.jenis = e.id where a.deleted = 0";
                if (isset($_GET['id']))
                {
                        $pagenum = $_GET['pagenum'];
                        $pagesize = $_GET['pagesize'];
                        $start = $pagenum * $pagesize;
                        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM decal_items_detail WHERE parent_id='" .$_GET['id'] . "'";
                        $query .= " LIMIT $start, $pagesize";
                        $result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
                        $sql = "SELECT FOUND_ROWS() AS `found_rows`;";
                        $rows = mysql_query($sql);
                        $rows = mysql_fetch_assoc($rows);
                        $total_rows = $rows['found_rows'];	
                        if (isset($_GET['sortdatafield']))
                        {
                                $sortfield = $_GET['sortdatafield'];
                                $sortorder = $_GET['sortorder'];

                                if ($sortfield != NULL)
                                {		
                                        if ($sortorder == "desc")
                                        {
                                                $query = "SELECT * FROM decal_items_detail WHERE parent_id='" .$_GET['id'] . "' ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
                                        }
                                        else if ($sortorder == "asc")
                                        {
                                                $query = "SELECT * FROM decal_items_detail WHERE parent_id='" .$_GET['id'] . "' ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
                                        }			
                                        $result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
                                }
                        }
                        // get data and store in a json array
                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                $decal_items_detail[] = array(
                                        'item_code' => $row['item_code'],
                                        'parent_id' => $row['parent_id'],
                                        'item' => $row['item'],
                                        'isi_motif' => $row['isi_motif'],
                                        'warna' => $row['warna'],
                                        'position' => $row['position']
                                  );
                        }
                    $data[] = array(
                       'TotalRows' => $total_rows,
                           'Rows' => $decal_items_detail
                        );
                        echo json_encode($data);    	
                }
                else
                {
                        $pagenum = $_GET['pagenum'];
                        $pagesize = $_GET['pagesize'];
                        $start = $pagenum * $pagesize;
                        $query = "SELECT SQL_CALC_FOUND_ROWS a.id,a.nama,a.alias, b.nama as buyer,c.dsc as dekorasi,d.dsc as size,a.satuan,e.nama as jenis,a.deleted,a.tgl_insert,a.tgl_update,a.tgl_delete
                                    FROM decal_items a
                                    left join global_buyer b on a.buyer = b.id
                                    left join global_dekorasi c on a.dekorasi = c.id
                                    left join global_size d on a.size = d.id
                                    left join global_jenis_decal e on a.jenis = e.id  where a.deleted = 0 LIMIT $start, $pagesize";
                        $result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
                        $sql = "SELECT FOUND_ROWS() AS `found_rows`;";
                        $rows = mysql_query($sql);
                        $rows = mysql_fetch_assoc($rows);
                        $total_rows = $rows['found_rows'];
                        if (isset($_GET['sortdatafield']))
                        {
                                $sortfield = $_GET['sortdatafield'];
                                $sortorder = $_GET['sortorder'];

                                if ($sortfield != NULL)
                                {		
                                        if ($sortorder == "desc")
                                        {
                                                $query = "SELECT a.id,a.nama,a.alias, b.nama as buyer,c.dsc as dekorasi,d.dsc as size,a.satuan,e.nama as jenis,a.deleted,a.tgl_insert,a.tgl_update,a.tgl_delete
                                                            FROM decal_items a
                                                            left join global_buyer b on a.buyer = b.id
                                                            left join global_dekorasi c on a.dekorasi = c.id
                                                            left join global_size d on a.size = d.id
                                                            left join global_jenis_decal e on a.jenis = e.id  where a.deleted = 0" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
                                        }
                                        else if ($sortorder == "asc")
                                        {
                                                $query = "SELECT a.id,a.nama,a.alias, b.nama as buyer,c.dsc as dekorasi,d.dsc as size,a.satuan,e.nama as jenis,a.deleted,a.tgl_insert,a.tgl_update,a.tgl_delete
                                                            FROM decal_items a
                                                            left join global_buyer b on a.buyer = b.id
                                                            left join global_dekorasi c on a.dekorasi = c.id
                                                            left join global_size d on a.size = d.id
                                                            left join global_jenis_decal e on a.jenis = e.id  where a.deleted = 0" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
                                        }			
                                        $result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
                                }
                        }
                        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                $decal_items[] = array(
                                        'id' => $row['id'],
                                        'nama' => $row['nama'],
                                        'buyer' => $row['buyer'],
                                        'dekorasi' => $row['dekorasi'],
                                        'size' => $row['size'],
                                        'satuan' => $row['satuan'],
                                        'jenis' => $row['jenis']
                                  );
                        }
                    $data[] = array(
                       'TotalRows' => $total_rows,
                           'Rows' => $decal_items
                        );
                        echo json_encode($data);
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
                        $item_code    = $this->dclModel->MaxItemsCode();
			$d['id']	= $id;
                        $d['item_code']	= $item_code;
			$d['satuan']        ='sheet';
			$d['nama']              = '';
                        $d['alias']             = '';
                        $d['item']             = '';
                        $d['position']             = '';
                        $d['isi_motif']             = '';
                        $d['warna']             = '';
			
			$d['content'] = $this->load->view('decal/form', $d, true);		
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
			$text = "select * from decal_items_detail where parent_id = '$id' AND deleted = 0";
			$d['data']= $this->dclModel->manualQuery($text);

			$this->load->view('decal/detail',$d);
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
			$d['judul'] = "Ubah data decal";
			$id    = $this->uri->segment(3);
			$main  = "select * from decal_items where id = '$id'";
			$data1 = $this->dclModel->manualQuery($main);
			if($data1->num_rows() > 0){
				foreach($data1->result() as $db){
					$d['id']                = $id;
					$d['nama']              = $db->nama;
                                        $d['alias']             = $db->alias;
					$d['buyer']             = $db->buyer;
                                        $d['dekorasi']          = $db->dekorasi;
					$d['size']              = $db->size;
					$d['satuan']            = $db->satuan;
                                        $d['jenis']             = $db->jenis;
                                        $d['status']            = $db->status;
                                        $item_code              = $this->dclModel->MaxItemsCode();
                                        $d['id']                = $id;
                                        $d['item_code']         = $item_code;
                                        $d['item']              = '';
                                        $d['position']          = '';
                                        $d['isi_motif']         = '';
                                        $d['warna']             = '';
				}
			}else{
					$d['id']                = $id;
                                        $d['item_code']             = '';
					$d['nama']              = '';
                                        $d['alias']             = '';
					$d['buyer']             = '';
                                        $d['dekorasi']          = '';
					$d['size']              = '';
					$d['satuan']            = 'sheet';
                                        $d['jenis']             = '';
                                        $d['status']            = '';
                                        $d['item']              = '';
                                        $d['position']          = '';
                                        $d['isi_motif']         = '';
                                        $d['warna']             = '';
			}
						
			$d['content'] = $this->load->view('decal/form', $d, true);		
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
			
			$d['judul'] = "Ubah data decal";
                      
			$id = $this->uri->segment(3);
                        $item_code = $this->uri->segment(4);
			$text = "select * from decal_items_detail where parent_id = '$id' and item_code = '$item_code'";
			$data = $this->dclModel->manualQuery($text);
                        
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
                                        $d['item_code']             = $item_code;
					$d['item']              = $db->item;
                                        $d['position']          = $db->position;
                                        $d['isi_motif']         = $db->isi_motif;
                                        $d['warna']             = $db->warna;
                                            $main  = "select * from decal_items where id = '$id'";
                                            $data1 = $this->dclModel->manualQuery($main);
                                            if($data1->num_rows() > 0){
                                                    foreach($data1->result() as $db){
                                                            $d['id']                = $id;
                                                            $d['nama']              = $db->nama;
                                                            $d['alias']             = $db->alias;
                                                            $d['buyer']             = $db->buyer;
                                                            $d['dekorasi']          = $db->dekorasi;
                                                            $d['size']              = $db->size;
                                                            $d['satuan']            = $db->satuan;
                                                            $d['jenis']             = $db->jenis;
                                                            $d['status']            = $db->status;
                                                    }
                                            }else{
                                                            $d['id']                = $id;
                                                            $d['item_code']         = '';
                                                            $d['nama']              = '';
                                                            $d['alias']             = '';
                                                            $d['buyer']             = '';
                                                            $d['dekorasi']          = '';
                                                            $d['size']              = '';
                                                            $d['satuan']            = 'sheet';
                                                            $d['jenis']             = '';
                                                            $d['status']            = '';
                                                            $d['item']              = '';
                                                            $d['position']          = '';
                                                            $d['isi_motif']         = '';
                                                            $d['warna']             = '';
                                            }
				}
			}else{
					$d['item']              = '';
                                        $d['position']          = '';
                                        $d['isi_motif']         = '';
                                        $d['warna']             = '';
                                        
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
                                $tgl_deleted = date('Y-m-d h:i:s');
                                $this->dclModel->manualQuery("UPDATE decal_items_detail SET deleted = 1,tgl_delete = '$tgl_deleted' WHERE parent_id='$id'");
                                $this->dclModel->manualQuery("UPDATE decal_items SET deleted = 1,tgl_delete = '$tgl_deleted' WHERE id='$id'");
                                echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/decal'>";			
		}else{
			header('location:'.base_url());
		}
	}
        
	public function hapus_detail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){                        
                                $id = $this->uri->segment(3);
                                $item_code = $this->uri->segment(4);
                                $tgl_deleted = date('Y-m-d h:i:s');
                                $this->dclModel->manualQuery("UPDATE decal_items_detail SET deleted = 1,tgl_delete = '$tgl_deleted' WHERE parent_id='$id' AND item_code='$item_code'");
                                $this->edit();
                        
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
                                $up['nama']		= $this->input->post('nama');
                                $up['alias']		= $this->input->post('alias');
                                $up['jenis']		= $this->input->post('jenis');
                                $up['buyer']		= $this->input->post('buyer');
                                $up['dekorasi']		= $this->input->post('dekorasi');
                                $up['size']		= $this->input->post('size');
                                $up['satuan']		= $this->input->post('satuan');
                                $up['status']		= $this->input->post('status');
				
                                $ud['parent_id']        = $this->input->post('id');
                                $ud['item_code']        = $this->input->post('item_code');
				$ud['item']             = $this->input->post('item');
				$ud['position']         = $this->input->post('position');
				$ud['isi_motif']        = $this->input->post('isi_motif');
                                $ud['warna']            = $this->input->post('warna');
                                $ud['inputer']          = $this->session->userdata('username');
				
				$id['id']               = $this->input->post('id');
                                $idx                    = $this->input->post('id');
				
				$id_d['parent_id']     = $this->input->post('id');
                                $id_d['item_code']     = $this->input->post('item_code');
				
				$data = $this->dclModel->getSelectedData("decal_items",$id);
				$itemx             = $this->input->post('item');
				if($data->num_rows()>0){
                                                $this->dclModel->updateData("decal_items",$up,$id);
						$data = $this->dclModel->getSelectedData("decal_items_detail",$id_d);
						if($data->num_rows()>0){
                                                        $ud['tgl_update']   = date('Y-m-d h:i:s');
														$this->dclModel->updateData("decal_items_detail",$ud,$id_d);
                                                        echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/decal/edit/$idx'>";
                                                        echo 'Update data Sukses';
						}else{
													if(!empty($$itemx)){		
                                                        $ud['tgl_insert']   = date('Y-m-d h:i:s');
														$this->dclModel->insertData("decal_items_detail",$ud);
                                                        echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/decal/edit/$idx'>";
                                                        echo 'Simpan data Sukses';
													}
													echo 'Update data Sukses';
						}
				}else{
                                        $up['tgl_insert']		= date('Y-m-d h:i:s');
					$this->dclModel->insertData("decal_items",$up);
                                        $ud['tgl_insert']                = date('Y-m-d h:i:s');
					$this->dclModel->insertData("decal_items_detail",$ud);
                                        echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/decal/edit/$idx'>";
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
        
        public function getItem()
	{
                $this->load->model('dclModel');
		$data['data_passed'] = $this->dclModel->getItem();

		if ($data['data_passed']){

			#convert data array passed into json
			echo json_encode($data['data_passed']);
			//echo $data['data_passed'];

		}
	}
        
        public function getNama()
	{
                $this->load->model('dclModel');
		$data['data_passed'] = $this->dclModel->getNama();

		if ($data['data_passed']){

			#convert data array passed into json
			echo json_encode($data['data_passed']);
			//echo $data['data_passed'];

		}
	}
        
        public function getAlias()
	{
                $this->load->model('dclModel');
		$data['data_passed'] = $this->dclModel->getAlias();

		if ($data['data_passed']){

			#convert data array passed into json
			echo json_encode($data['data_passed']);
			//echo $data['data_passed'];

		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */