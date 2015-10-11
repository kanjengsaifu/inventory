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
				$hasil = 'PD'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'PD'.'00001';
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
        
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */