<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_json extends CI_Controller {

	/**
	 * @author      : Mpod Schuzatcky    
	 * @web         : http://itmov.wordpress.com
	 * @keterangan  : Controller halaman master glasir
	 **/
        
        public function DataGlasir(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari= $this->input->post('cari');
			if(empty($cari)){
				$text = "SELECT * FROM glasir";
			}else{
				$text = "SELECT * FROM glasir WHERE id_glasir LIKE '%$cari%' OR nama_glasir LIKE '%$cari%' OR nama_alias LIKE '%$cari%'";
			}
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('data_glasir',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function DataDecal(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari= $this->input->post('cari');
                        $buyer= $this->input->post('buyer');
                        $jenis= $this->input->post('jenis');
                        $size= $this->input->post('size');
                        $dekorasi= $this->input->post('dekorasi');
			if(!empty($buyer)){
                                if(empty($buyer)){
                                $buyerx = '';
                                }else{
                                    $buyerx = "b.nama LIKE '%$buyer%'";
                                }
                                if(empty($cari)){
                                    $carix = '';
                                }else{
                                    $carix ="AND a.nama LIKE '%$cari%'";
                                }
                                if(empty($jenis)){
                                    $jenisx = '';
                                }else{
                                    $jenisx = "AND e.nama LIKE '%$jenis%'";
                                }
                                if(empty($size)){
                                    $sizex = '';
                                }else{
                                    $sizex = "AND c.dsc LIKE '%$size%'";
                                }
                                if(empty($dekorasi)){
                                    $dekorasix = '';
                                }else{
                                    $dekorasix = "AND d.dsc LIKE '%$dekorasi%'";
                                }
				$text1 = "SELECT a.id, a.nama, a.alias, d.dsc as dekorasi, c.dsc as size, a.satuan, a.jenis, e.nama as nama_jenis, b.nama as buyer FROM decal_items a
                                            LEFT JOIN global_buyer b ON b.id = a.buyer
                                            LEFT JOIN global_size c ON c.id = a.size
                                            LEFT JOIN global_dekorasi d ON d.id = a.dekorasi
                                            LEFT JOIN global_jenis_decal e ON e.id = a.jenis
                                            WHERE $buyerx $carix $jenisx $sizex $dekorasix
                                            order by a.id, a.buyer,a.nama";
                                $text2 = "select * from decal_items_detail";
			}elseif(!empty($cari)){
                                if(empty($buyer)){
                                $buyerx = '';
                                }else{
                                    $buyerx = "AND b.nama LIKE '%$buyer%'";
                                }
                                if(empty($cari)){
                                    $carix = '';
                                }else{
                                    $carix ="a.nama LIKE '%$cari%'";
                                }
                                if(empty($jenis)){
                                    $jenisx = '';
                                }else{
                                    $jenisx = "AND e.nama LIKE '%$jenis%'";
                                }
                                if(empty($size)){
                                    $sizex = '';
                                }else{
                                    $sizex = "AND c.dsc LIKE '%$size%'";
                                }
                                if(empty($dekorasi)){
                                    $dekorasix = '';
                                }else{
                                    $dekorasix = "AND d.dsc LIKE '%$dekorasi%'";
                                }
				$text1 = "SELECT a.id, a.nama, a.alias, d.dsc as dekorasi, c.dsc as size, a.satuan, a.jenis, e.nama as nama_jenis, b.nama as buyer FROM decal_items a
                                            LEFT JOIN global_buyer b ON b.id = a.buyer
                                            LEFT JOIN global_size c ON c.id = a.size
                                            LEFT JOIN global_dekorasi d ON d.id = a.dekorasi
                                            LEFT JOIN global_jenis_decal e ON e.id = a.jenis
                                            WHERE $buyerx $carix $jenisx $sizex $dekorasix
                                            order by a.id, a.buyer,a.nama";
                                $text2 = "select * from decal_items_detail";
			}elseif(!empty($jenis)){
                                if(empty($buyer)){
                                $buyerx = '';
                                }else{
                                    $buyerx = "AND b.nama LIKE '%$buyer%'";
                                }
                                if(empty($cari)){
                                    $carix = '';
                                }else{
                                    $carix ="AND a.nama LIKE '%$cari%'";
                                }
                                if(empty($jenis)){
                                    $jenisx = '';
                                }else{
                                    $jenisx = "e.nama LIKE '%$jenis%'";
                                }
                                if(empty($size)){
                                    $sizex = '';
                                }else{
                                    $sizex = "AND c.dsc LIKE '%$size%'";
                                }
                                if(empty($dekorasi)){
                                    $dekorasix = '';
                                }else{
                                    $dekorasix = "AND d.dsc LIKE '%$dekorasi%'";
                                }
				$text1 = "SELECT a.id, a.nama, a.alias, d.dsc as dekorasi, c.dsc as size, a.satuan, a.jenis, e.nama as nama_jenis, b.nama as buyer FROM decal_items a
                                            LEFT JOIN global_buyer b ON b.id = a.buyer
                                            LEFT JOIN global_size c ON c.id = a.size
                                            LEFT JOIN global_dekorasi d ON d.id = a.dekorasi
                                            LEFT JOIN global_jenis_decal e ON e.id = a.jenis
                                            WHERE $jenisx $buyerx $carix $sizex $dekorasix
                                            order by a.id, a.buyer,a.nama";
                                $text2 = "select * from decal_items_detail";
			}elseif(!empty($size)){
                                if(empty($buyer)){
                                $buyerx = '';
                                }else{
                                    $buyerx = "AND b.nama LIKE '%$buyer%'";
                                }
                                if(empty($cari)){
                                    $carix = '';
                                }else{
                                    $carix ="AND a.nama LIKE '%$cari%'";
                                }
                                if(empty($jenis)){
                                    $jenisx = '';
                                }else{
                                    $jenisx = "AND e.nama LIKE '%$jenis%'";
                                }
                                if(empty($size)){
                                    $sizex = '';
                                }else{
                                    $sizex = "c.dsc LIKE '%$size%'";
                                }
                                if(empty($dekorasi)){
                                    $dekorasix = '';
                                }else{
                                    $dekorasix = "AND d.dsc LIKE '%$dekorasi%'";
                                }
				$text1 = "SELECT a.id, a.nama, a.alias, d.dsc as dekorasi, c.dsc as size, a.satuan, a.jenis, e.nama as nama_jenis, b.nama as buyer FROM decal_items a
                                            LEFT JOIN global_buyer b ON b.id = a.buyer
                                            LEFT JOIN global_size c ON c.id = a.size
                                            LEFT JOIN global_dekorasi d ON d.id = a.dekorasi
                                            LEFT JOIN global_jenis_decal e ON e.id = a.jenis
                                            WHERE $sizex $jenisx $buyerx $carix $dekorasix
                                            order by a.id, a.buyer,a.nama";
                                $text2 = "select * from decal_items_detail";
			}elseif(!empty($dekorasi)){
                                if(empty($buyer)){
                                $buyerx = '';
                                }else{
                                    $buyerx = "AND b.nama LIKE '%$buyer%'";
                                }
                                if(empty($cari)){
                                    $carix = '';
                                }else{
                                    $carix ="AND a.nama LIKE '%$cari%'";
                                }
                                if(empty($jenis)){
                                    $jenisx = '';
                                }else{
                                    $jenisx = "AND e.nama LIKE '%$jenis%'";
                                }
                                if(empty($size)){
                                    $sizex = '';
                                }else{
                                    $sizex = "AND c.dsc LIKE '%$size%'";
                                }
                                if(empty($dekorasi)){
                                    $dekorasix = '';
                                }else{
                                    $dekorasix = "d.dsc LIKE '%$dekorasi%'";
                                }
				$text1 = "SELECT a.id, a.nama, a.alias, d.dsc as dekorasi, c.dsc as size, a.satuan, a.jenis, e.nama as nama_jenis, b.nama as buyer FROM decal_items a
                                            LEFT JOIN global_buyer b ON b.id = a.buyer
                                            LEFT JOIN global_size c ON c.id = a.size
                                            LEFT JOIN global_dekorasi d ON d.id = a.dekorasi
                                            LEFT JOIN global_jenis_decal e ON e.id = a.jenis
                                            WHERE $dekorasix $sizex $jenisx $buyerx $carix 
                                            order by a.id, a.buyer,a.nama";
                                $text2 = "select * from decal_items_detail";
			}else{
                                $text1 = "SELECT a.id, a.nama, a.alias, d.dsc as dekorasi, c.dsc as size, a.satuan, a.jenis, e.nama as nama_jenis, b.nama as buyer FROM decal_items a
                                            LEFT JOIN global_buyer b ON b.id = a.buyer
                                            LEFT JOIN global_size c ON c.id = a.size
                                            LEFT JOIN global_dekorasi d ON d.id = a.dekorasi
                                            LEFT JOIN global_jenis_decal e ON e.id = a.jenis
                                            order by a.id, a.buyer,a.nama";
                                $text2 = "select * from decal_items_detail";
			}
			$d['data'] = $this->dclModel->manualQuery($text1);
                        $d['item'] = $this->dclModel->manualQuery($text2);
			
			$this->load->view('data_decal',$d);
		}else{
			header('location:'.base_url());
		}
	}
        
        public function DataTglp(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari= $this->input->post('cari');
			if(empty($cari)){
				//$text = "SELECT * FROM glasir_phd";
			}else{
				$text = "SELECT * FROM glasir_phd WHERE id_glasir = '$cari'";
			}
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('data_tglp',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function InfoGlasir()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('kode');
			$text = "SELECT * FROM glasir WHERE id_glasir='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['nama_glasir'] = $t->nama_glasir;
                                        $data['nama_alias'] = $t->nama_alias;
                                        $data['parent'] = $t->parent;
					$data['satuan'] = $t->satuan;
					$data['status'] = $t->status;
                                        $data['nama_alias'] = $t->nama_alias;
					echo json_encode($data);
				}
			}else{
                                        $data['nama_glasir'] = '';
                                        $data['nama_alias'] = '';
                                        $data['parent'] = '';
					$data['satuan'] = 'Kilogram';
					$data['status'] = '';
                                        $data['nama_alias'] = '';
				echo json_encode($data);
			}
		}else{
			header('location:'.base_url());
		}
	}
        
        public function InfoDecal()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('kode');
			$text = "SELECT * FROM decal_items WHERE id='$kode'";
			$tabel = $this->dclModel->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['nama_decal'] = $t->nama;
					echo json_encode($data);
				}
			}else{
                                        $data['nama_decal'] = '';
				echo json_encode($data);
			}
		}else{
			header('location:'.base_url());
		}
	}
        
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */