<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dclmodel extends CI_Model {

	/**
	 * @author      : Fadli Rifa'o
	 * @web         : http://itmov.wordpress.com
	 * @keterangan  : Model untuk menangani query modul glasir
	 **/
         
        public function __construct()
            {
                parent::__construct();
            }
    
        //Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
        
        //update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
        
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
        
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->glzModel->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->app_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Jan";
				break;
			case 2:
				return "Feb";
				break;
			case 3:
				return "Mar";
				break;
			case 4:
				return "Apr";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Jun";
				break;
			case 7:
				return "Jul";
				break;
			case 8:
				return "Ags";
				break;
			case 9:
				return "Sep";
				break;
			case 10:
				return "Okt";
				break;
			case 11:
				return "Nov";
				break;
			case 12:
				return "Des";
				break;
		}
	} 
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
        
        //select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
        
        public function get_ldg(){
                $query ="SELECT a.id, a.nama, a.alias,b.nama as buyer, c.dsc as material, d.dsc as forming, e.nama as shape, 
                            f.nama as item, g.dsc as dekorasi, h.nama as size, i.nama as jenis, a.satuan, a.parent, k.status
                            FROM decal_items a
                            LEFT JOIN global_buyer b ON b.id  = a.buyer
                            LEFT JOIN global_material c ON c.id  = a.material
                            LEFT JOIN global_forming d ON d.id  = a.forming
                            LEFT JOIN global_shape e ON e.id  = a.shape
                            LEFT JOIN global_items_kategori f ON f.id  = a.item
                            LEFT JOIN global_dekorasi g ON g.id  = a.dekorasi
                            LEFT JOIN global_size h ON h.id  = a.size
                            LEFT JOIN global_jenis_decal i ON i.id  = a.jenis
                            LEFT JOIN global_detail j ON j.id_related = a.id
                            LEFT JOIN glasir_status k ON j.`status` = k.id
                            WHERE j.deleted = 0
                            ORDER BY a.id";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function loadBuyer(){
		$q = $this->db->get("global_buyer");
		return $q;
	}
        
        public function loadMaterial(){
		$q = $this->db->get("global_material");
		return $q;
	}
        
        public function loadForming(){
		$q = $this->db->get("global_forming");
		return $q;
	}
        
        public function loadShape(){
		$q = $this->db->get("global_shape");
		return $q;
	}
        
        public function loadItem(){
		$q = $this->db->get("global_items_kategori");
		return $q;
	}
        
        public function loadDekorasi(){
		$q = $this->db->get("global_dekorasi");
		return $q;
	}
        
        public function loadSize(){
		$q = $this->db->get("global_size");
		return $q;
	}
        
        public function loadJenis(){
		$q = $this->db->get("global_jenis_decal");
		return $q;
	}
        
        public function MaxItemsDecal(){
		$text = "SELECT max(id) as no FROM decal_items";
		$data = $this->dclModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,1,5))+1;
				$hasil = 'D'.sprintf("%04s", $tmp);
			}
		}else{
			$hasil = 'D'.'0001';
		}
		return $hasil;
	}
        
        public function NamaLengkap($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_lengkap;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function ProsesDecal($id){
		$t = "SELECT id FROM decal_phd WHERE id_related='$id' AND deleted = 0";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function ProsesItem($id){
		$t = "SELECT GROUP_CONCAT(concat('[',b.id,'-',b.nama,']') SEPARATOR ', ') as nama_decal FROM decal_phd a 
                        JOIN decal_items b on a.id_decal_items = b.id
                        WHERE a.id_related='$id' AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_decal;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function JmlDecalKW1($id){
		$t = "SELECT sum(kw1) as kw1 FROM decal_phd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw1;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW2($id){
		$t = "SELECT sum(kw2) as kw2 FROM decal_phd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw2;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW3($id){
		$t = "SELECT sum(kw3) as kw3 FROM decal_phd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw3;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW4($id){
		$t = "SELECT sum(kw1+kw2+kw3) as kw4 FROM decal_phd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw4;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function MaxPhDecal(){
		$text = "SELECT max(id) as no FROM decal_ph";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'PH'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'PH'.'00001';
		}
		return $hasil;
	}
        
        public function CariDecalJenis($id){
		$t = "SELECT * FROM global_jenis_decal WHERE id='$id'";
		$d = $this->dclModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        //======================================================================
        
        public function ProsesDecalTran($id){
		$t = "SELECT id FROM decal_thd WHERE id_related='$id' AND deleted = 0";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function ProsesItemTran($id){
		$t = "SELECT GROUP_CONCAT(concat('[',b.id,'-',b.nama,']') SEPARATOR ', ') as nama_decal FROM decal_thd a 
                        JOIN decal_items b on a.id_decal_items = b.id
                        WHERE a.id_related='$id' AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_decal;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function JmlDecalKW1Tran($id){
		$t = "SELECT sum(kw1) as kw1 FROM decal_thd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw1;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW2Tran($id){
		$t = "SELECT sum(kw2) as kw2 FROM decal_thd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw2;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW3Tran($id){
		$t = "SELECT sum(kw3) as kw3 FROM decal_thd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw3;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW4Tran($id){
		$t = "SELECT sum(kw1+kw2+kw3) as kw4 FROM decal_thd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw4;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function MaxPhDecalTran(){
		$text = "SELECT max(id) as no FROM decal_th";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'TH'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'TH'.'00001';
		}
		return $hasil;
	}
        
        public function CariDecalJenisTran($id){
		$t = "SELECT * FROM global_jenis_decal WHERE id='$id'";
		$d = $this->dclModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        //======================================================================  
        
        public function ProsesDecalUsed($id){
		$t = "SELECT id FROM decal_uhd WHERE id_related='$id' AND deleted = 0";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function ProsesItemUsed($id){
		$t = "SELECT GROUP_CONCAT(concat('[',b.id,'-',b.nama,']') SEPARATOR ', ') as nama_decal FROM decal_uhd a 
                        JOIN decal_items b on a.id_decal_items = b.id
                        WHERE a.id_related='$id' AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_decal;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function JmlDecalKW1Used($id){
		$t = "SELECT sum(kw1) as kw1 FROM decal_uhd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw1;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW2Used($id){
		$t = "SELECT sum(kw2) as kw2 FROM decal_uhd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw2;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW3Used($id){
		$t = "SELECT sum(kw3) as kw3 FROM decal_uhd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw3;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW4Used($id){
		$t = "SELECT sum(kw1+kw2+kw3) as kw4 FROM decal_uhd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw4;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function MaxPhDecalUsed(){
		$text = "SELECT max(id) as no FROM decal_uh";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'UH'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'UH'.'00001';
		}
		return $hasil;
	}
        
        public function CariDecalJenisUsed($id){
		$t = "SELECT * FROM global_jenis_decal WHERE id='$id'";
		$d = $this->dclModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        //======================================================================
        
        public function ProsesDecalRetu($id){
		$t = "SELECT id FROM decal_rhd WHERE id_related='$id' AND deleted = 0";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function ProsesItemRetu($id){
		$t = "SELECT GROUP_CONCAT(concat('[',b.id,'-',b.nama,']') SEPARATOR ', ') as nama_decal FROM decal_rhd a 
                        JOIN decal_items b on a.id_decal_items = b.id
                        WHERE a.id_related='$id' AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_decal;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function JmlDecalKW1Retu($id){
		$t = "SELECT sum(kw1) as kw1 FROM decal_rhd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw1;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW2Retu($id){
		$t = "SELECT sum(kw2) as kw2 FROM decal_rhd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw2;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW3Retu($id){
		$t = "SELECT sum(kw3) as kw3 FROM decal_rhd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw3;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW4Retu($id){
		$t = "SELECT sum(kw1+kw2+kw3) as kw4 FROM decal_rhd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw4;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function MaxPhDecalRetu(){
		$text = "SELECT max(id) as no FROM decal_rh";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'RH'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'RH'.'00001';
		}
		return $hasil;
	}
        
        public function CariDecalJenisRetu($id){
		$t = "SELECT * FROM global_jenis_decal WHERE id='$id'";
		$d = $this->dclModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        //======================================================================
        
        public function ProsesDecalOpna($id){
		$t = "SELECT id FROM decal_ohd WHERE id_related='$id' AND deleted = 0";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function ProsesItemOpna($id){
		$t = "SELECT GROUP_CONCAT(concat('[',b.id,'-',b.nama,']') SEPARATOR ', ') as nama_decal FROM decal_ohd a 
                        JOIN decal_items b on a.id_decal_items = b.id
                        WHERE a.id_related='$id' AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_decal;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function JmlDecalKW1Opna($id){
		$t = "SELECT sum(kw1) as kw1 FROM decal_ohd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw1;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW2Opna($id){
		$t = "SELECT sum(kw2) as kw2 FROM decal_ohd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw2;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW3Opna($id){
		$t = "SELECT sum(kw3) as kw3 FROM decal_ohd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw3;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlDecalKW4Opna($id){
		$t = "SELECT sum(kw1+kw2+kw3) as kw4 FROM decal_ohd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kw4;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function MaxPhDecalOpna(){
		$text = "SELECT max(id) as no FROM decal_oh";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'OH'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'OH'.'00001';
		}
		return $hasil;
	}
        
        public function CariDecalJenisOpna($id){
		$t = "SELECT * FROM global_jenis_decal WHERE id='$id'";
		$d = $this->dclModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        //======================================================================
        
        public function loadIdentity(){
                    $query ="SELECT a.id, a.nama,b.nama as buyer
                                FROM decal_items a
                                LEFT JOIN global_buyer b ON b.id = a.buyer
                                WHERE a.deleted = 0
                                group by a.nama, a.buyer
                                order by a.nama, a.buyer";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function loadStok(){
                    $query ="SELECT  
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1kP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1sP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1bP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2kP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2sP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2bP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3kP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3sP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 3 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3bP,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1kT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1sT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw1 ELSE 0 END) as opkw1bT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2kT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2sT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw2 ELSE 0 END) as opkw2bT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 6 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3kT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 7 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3sT,
                                SUM(CASE WHEN d.jenis_decal = 1 AND d.size_kat = 8 AND d.area = 4 AND d.tgli = (select tgli from decal_ohd order by tgli asc limit 1) THEN d.kw3 ELSE 0 END) as opkw3bT
                                FROM decal_items a
                                LEFT JOIN global_buyer b ON b.id = a.buyer
                                LEFT JOIN decal_ohd d ON d.id_decal_items = a.id
                                WHERE a.deleted = 0
                                group by a.nama, a.buyer
                                order by a.nama, a.buyer";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function loadProduction(){
                    $query ="SELECT  
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 6 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw1 ELSE 0 END) as Pkw1k,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 7 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw1 ELSE 0 END) as Pkw1s,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 8 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw1 ELSE 0 END) as Pkw1b,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 6 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw2 ELSE 0 END) as Pkw2k,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 7 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw2 ELSE 0 END) as Pkw2s,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 8 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw2 ELSE 0 END) as Pkw2b,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 6 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw3 ELSE 0 END) as Pkw3k,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 7 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw3 ELSE 0 END) as Pkw3s,
                                SUM(CASE WHEN e.jenis_decal = 1 AND e.size_kat = 8 AND e.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN e.kw3 ELSE 0 END) as Pkw3b
                                FROM decal_items a LEFT JOIN global_buyer b ON b.id = a.buyer LEFT JOIN decal_phd e ON e.id_decal_items = a.id
                                WHERE a.deleted = 0 group by a.nama, a.buyer order by a.nama, a.buyer";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function loadTransit(){
                    $query ="SELECT a.id, a.nama,b.nama as buyer, 
                                SUM(CASE WHEN f.jenis_decal = 1 AND f.size_kat = 6 AND f.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN f.kw1 ELSE 0 END) as Tkw1k,
                                SUM(CASE WHEN f.jenis_decal = 1 AND f.size_kat = 7 AND f.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN f.kw1 ELSE 0 END) as Tkw1s,
                                SUM(CASE WHEN f.jenis_decal = 1 AND f.size_kat = 8 AND f.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN f.kw1 ELSE 0 END) as Tkw1b,
                                SUM(CASE WHEN f.jenis_decal = 1 AND f.size_kat = 6 AND f.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN f.kw2 ELSE 0 END) as Tkw2k,
                                SUM(CASE WHEN f.jenis_decal = 1 AND f.size_kat = 7 AND f.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN f.kw2 ELSE 0 END) as Tkw2s,
                                SUM(CASE WHEN f.jenis_decal = 1 AND f.size_kat = 8 AND f.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN f.kw2 ELSE 0 END) as Tkw2b,
                                SUM(CASE WHEN f.jenis_decal = 1 AND f.size_kat = 6 AND f.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN f.kw3 ELSE 0 END) as Tkw3k,
                                SUM(CASE WHEN f.jenis_decal = 1 AND f.size_kat = 7 AND f.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN f.kw3 ELSE 0 END) as Tkw3s,
                                SUM(CASE WHEN f.jenis_decal = 1 AND f.size_kat = 8 AND f.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN f.kw3 ELSE 0 END) as Tkw3b
                                FROM decal_items a LEFT JOIN global_buyer b ON b.id = a.buyer LEFT JOIN decal_thd f ON f.id_decal_items = a.id
                                WHERE a.deleted = 0 group by a.nama, a.buyer order by a.nama, a.buyer";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function loadUsed(){
                    $query ="SELECT a.id, a.nama,b.nama as buyer, 
                                SUM(CASE WHEN g.jenis_decal = 1 AND g.size_kat = 6 AND g.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN g.kw1 ELSE 0 END) as Ukw1k,
                                SUM(CASE WHEN g.jenis_decal = 1 AND g.size_kat = 7 AND g.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN g.kw1 ELSE 0 END) as Ukw1s,
                                SUM(CASE WHEN g.jenis_decal = 1 AND g.size_kat = 8 AND g.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN g.kw1 ELSE 0 END) as Ukw1b,
                                SUM(CASE WHEN g.jenis_decal = 1 AND g.size_kat = 6 AND g.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN g.kw2 ELSE 0 END) as Ukw2k,
                                SUM(CASE WHEN g.jenis_decal = 1 AND g.size_kat = 7 AND g.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN g.kw2 ELSE 0 END) as Ukw2s,
                                SUM(CASE WHEN g.jenis_decal = 1 AND g.size_kat = 8 AND g.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN g.kw2 ELSE 0 END) as Ukw2b,
                                SUM(CASE WHEN g.jenis_decal = 1 AND g.size_kat = 6 AND g.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN g.kw3 ELSE 0 END) as Ukw3k,
                                SUM(CASE WHEN g.jenis_decal = 1 AND g.size_kat = 7 AND g.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN g.kw3 ELSE 0 END) as Ukw3s,
                                SUM(CASE WHEN g.jenis_decal = 1 AND g.size_kat = 8 AND g.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN g.kw3 ELSE 0 END) as Ukw3b
                                FROM decal_items a LEFT JOIN global_buyer b ON b.id = a.buyer LEFT JOIN decal_uhd g ON g.id_decal_items = a.id
                                WHERE a.deleted = 0 group by a.nama, a.buyer order by a.nama, a.buyer";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function loadReturn(){
                    $query ="SELECT a.id, a.nama,b.nama as buyer, 
                                SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 6 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw1 ELSE 0 END) as Rkw1k,
                                SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 7 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw1 ELSE 0 END) as Rkw1s,
                                SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 8 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw1 ELSE 0 END) as Rkw1b,
                                SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 6 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw2 ELSE 0 END) as Rkw2k,
                                SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 7 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw2 ELSE 0 END) as Rkw2s,
                                SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 8 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw2 ELSE 0 END) as Rkw2b,
                                SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 6 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw3 ELSE 0 END) as Rkw3k,
                                SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 7 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw3 ELSE 0 END) as Rkw3s,
                                SUM(CASE WHEN h.jenis_decal = 1 AND h.size_kat = 8 AND h.tgli BETWEEN '2015-10-12 14:00:00' AND '2015-11-11 18:00:00' THEN h.kw3 ELSE 0 END) as Rkw3b
                                FROM decal_items a LEFT JOIN global_buyer b ON b.id = a.buyer LEFT JOIN decal_rhd h ON h.id_decal_items = a.id
                                WHERE a.deleted = 0 group by a.nama, a.buyer order by a.nama, a.buyer";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */