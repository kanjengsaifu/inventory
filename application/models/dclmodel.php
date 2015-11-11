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
                $query ="select a.id,a.nama,a.alias, b.nama as buyer,c.nama as dekorasi,d.dsc as size,a.satuan,e.nama as jenis,a.tgl_insert,a.tgl_update, a.tgl_delete 
                            from decal_items a
                            left join global_buyer b on a.buyer = b.id
                            left join global_dekorasi c on a.dekorasi = c.id
                            left join global_size d on a.size = d.id
                            left join global_jenis_decal e on a.jenis = e.id";
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
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'DI'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'DI'.'00001';
		}
		return $hasil;
	}
        
        public function MaxItemsCode(){
		$text = "SELECT max(item_code) as no FROM decal_items_detail";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'IT'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'IT'.'00001';
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
		$t = "SELECT GROUP_CONCAT(distinct concat('[',b.id,'-',b.nama,']') SEPARATOR ', ') as nama_decal FROM decal_phd a 
                        JOIN decal_items b on a.parent_id = b.id
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
        
        public function JmlDecalJML($id){
		$t = "SELECT sum(jml) as kw1 FROM decal_phd WHERE id_related='$id' AND deleted <> 1";
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
        
        public function JmlDecalRusak($id){
		$t = "SELECT sum(rusak) as kw2 FROM decal_phd WHERE id_related='$id' AND deleted <> 1";
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
        
        public function MaxPhDecalAdju(){
		$text = "SELECT max(id) as no FROM decal_ah";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'AH'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'AH'.'00001';
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
        
        public function loadStok(){
                    $query ="select a.id, a.nama, x.nama as buyer,
                                    coalesce(h.Tkw1_selisih_k, 0) Tkw1_selisih_k, coalesce(h.Tkw1_selisih_s, 0) Tkw1_selisih_s, coalesce(h.Tkw1_selisih_b, 0) Tkw1_selisih_b,
                                    coalesce(h.Tkw2_selisih_k, 0) Tkw2_selisih_k, coalesce(h.Tkw2_selisih_s, 0) Tkw2_selisih_s, coalesce(h.Tkw2_selisih_b, 0) Tkw2_selisih_b,
                                    coalesce(h.Tkw3_selisih_k, 0) Tkw3_selisih_k, coalesce(h.Tkw3_selisih_s, 0) Tkw3_selisih_s, coalesce(h.Tkw3_selisih_b, 0) Tkw3_selisih_b,
                                    coalesce(h.Pkw1_selisih_k, 0) Pkw1_selisih_k, coalesce(h.Pkw1_selisih_s, 0) Pkw1_selisih_s, coalesce(h.Pkw1_selisih_b, 0) Pkw1_selisih_b,
                                    coalesce(h.Pkw2_selisih_k, 0) Pkw2_selisih_k, coalesce(h.Pkw2_selisih_s, 0) Pkw2_selisih_s, coalesce(h.Pkw2_selisih_b, 0) Pkw2_selisih_b,
                                    coalesce(h.Pkw3_selisih_k, 0) Pkw3_selisih_k, coalesce(h.Pkw3_selisih_s, 0) Pkw3_selisih_s, coalesce(h.Pkw3_selisih_b, 0) Pkw3_selisih_b,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1kP,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1sP,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1bP,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2kP,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2sP,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2bP,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3kP,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3sP,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3bP,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1kT,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1sT,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end) Fokw1bT,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2kT,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2sT,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end) Fokw2bT,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3kT,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3sT,
                                    sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end) Fokw3bT,
                                    coalesce(c.Pkw1k, 0) Pkw1k, coalesce(c.Pkw1s, 0) Pkw1s, coalesce(c.Pkw1b, 0) Pkw1b,
                                    coalesce(c.Pkw2k, 0) Pkw2k, coalesce(c.Pkw2s, 0) Pkw2s, coalesce(c.Pkw2b, 0) Pkw2b,
                                    coalesce(c.Pkw3k, 0) Pkw3k, coalesce(c.Pkw3s, 0) Pkw3s, coalesce(c.Pkw3b, 0) Pkw3b,
                                    coalesce(d.Tkw1k, 0) Tkw1k, coalesce(d.Tkw1s, 0) Tkw1s, coalesce(d.Tkw1b, 0) Tkw1b,
                                    coalesce(d.Tkw2k, 0) Tkw2k, coalesce(d.Tkw2s, 0) Tkw2s, coalesce(d.Tkw2b, 0) Tkw2b,
                                    coalesce(d.Tkw3k, 0) Tkw3k, coalesce(d.Tkw3s, 0) Tkw3s, coalesce(d.Tkw3b, 0) Tkw3b,
                                    coalesce(e.Ukw1k, 0) Ukw1k, coalesce(e.Ukw1s, 0) Ukw1s, coalesce(e.Ukw1b, 0) Ukw1b,
                                    coalesce(e.Ukw2k, 0) Ukw2k, coalesce(e.Ukw2s, 0) Ukw2s, coalesce(e.Ukw2b, 0) Ukw2b,
                                    coalesce(e.Ukw3k, 0) Ukw3k, coalesce(e.Ukw3s, 0) Ukw3s, coalesce(e.Ukw3b, 0) Ukw3b,
                                    coalesce(f.Rkw1k, 0) Rkw1k, coalesce(f.Rkw1s, 0) Rkw1s, coalesce(f.Rkw1b, 0) Rkw1b,
                                    coalesce(f.Rkw2k, 0) Rkw2k, coalesce(f.Rkw2s, 0) Rkw2s, coalesce(f.Rkw2b, 0) Rkw2b,
                                    coalesce(f.Rkw3k, 0) Rkw3k, coalesce(f.Rkw3s, 0) Rkw3s, coalesce(f.Rkw3b, 0) Rkw3b,
                                    coalesce(f.RPkw1k, 0) RPkw1k, coalesce(f.RPkw1s, 0) RPkw1s, coalesce(f.RPkw1b, 0) RPkw1b,
                                    coalesce(f.RPkw2k, 0) RPkw2k, coalesce(f.RPkw2s, 0) RPkw2s, coalesce(f.RPkw2b, 0) RPkw2b,
                                    coalesce(f.RPkw3k, 0) RPkw3k, coalesce(f.RPkw3s, 0) RPkw3s, coalesce(f.RPkw3b, 0) RPkw3b,
                                    coalesce(g.Skw1kP, 0) Skw1kP, coalesce(g.Skw1sP, 0) Skw1sP, coalesce(g.Skw1bP, 0) Skw1bP,
                                    coalesce(g.Skw2kP, 0) Skw2kP, coalesce(g.Skw2sP, 0) Skw2sP, coalesce(g.Skw2bP, 0) Skw2bP,
                                    coalesce(g.Skw3kP, 0) Skw3kP, coalesce(g.Skw3sP, 0) Skw3sP, coalesce(g.Skw3bP, 0) Skw3bP,
                                    coalesce(g.Skw1kT, 0) Skw1kT, coalesce(g.Skw1sT, 0) Skw1sT, coalesce(g.Skw1bT, 0) Skw1bT,
                                    coalesce(g.Skw2kT, 0) Skw2kT, coalesce(g.Skw2sT, 0) Skw2sT, coalesce(g.Skw2bT, 0) Skw2bT,
                                    coalesce(g.Skw3kT, 0) Skw3kT, coalesce(g.Skw3sT, 0) Skw3sT, coalesce(g.Skw3bT, 0) Skw3bT
                                  from decal_items a
                                  left join global_buyer x on a.buyer = x.id
                                  left join decal_ohd b
                                    on a.id = b.id_decal_items
                                  left join
                                  (
                                    select id_decal_items, 
                                    sum( case when jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Pkw1k,
                                    sum( case when jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Pkw1s,
                                    sum( case when jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Pkw1b,
                                    sum( case when jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Pkw2k,
                                    sum( case when jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Pkw2s,
                                    sum( case when jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Pkw2b,
                                    sum( case when jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Pkw3k,
                                    sum( case when jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Pkw3s,
                                    sum( case when jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Pkw3b
                                    from decal_phd
                                    where deleted = 0
                                    group by id_decal_items
                                  ) c on a.id = c.id_decal_items
                                  left join
                                  (
                                    select id_decal_items, 
                                    sum( case when jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Tkw1k,
                                    sum( case when jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Tkw1s,
                                    sum( case when jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Tkw1b,
                                    sum( case when jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Tkw2k,
                                    sum( case when jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Tkw2s,
                                    sum( case when jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Tkw2b,
                                    sum( case when jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Tkw3k,
                                    sum( case when jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Tkw3s,
                                    sum( case when jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Tkw3b
                                    from decal_thd
                                    where deleted = 0
                                    group by id_decal_items
                                  ) d on a.id = d.id_decal_items
                                  left join
                                  (
                                    select id_decal_items, 
                                    sum( case when jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Ukw1k,
                                    sum( case when jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Ukw1s,
                                    sum( case when jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Ukw1b,
                                    sum( case when jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Ukw2k,
                                    sum( case when jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Ukw2s,
                                    sum( case when jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Ukw2b,
                                    sum( case when jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Ukw3k,
                                    sum( case when jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Ukw3s,
                                    sum( case when jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Ukw3b
                                    from decal_uhd
                                    where deleted = 0
                                    group by id_decal_items
                                  ) e on a.id = e.id_decal_items
                                  left join
                                  (
                                    select id_decal_items, 
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Rkw1k,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Rkw1s,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Rkw1b,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Rkw2k,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Rkw2s,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Rkw2b,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Rkw3k,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Rkw3s,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Rkw3b,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) RPkw1k,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) RPkw1s,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) RPkw1b,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) RPkw2k,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) RPkw2s,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) RPkw2b,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) RPkw3k,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) RPkw3s,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) RPkw3b
                                    from decal_rhd
                                    where deleted = 0
                                    group by id_decal_items
                                  ) f on a.id = f.id_decal_items
                                  left join
                                  (
                                    select id_decal_items, 
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Skw1kP,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Skw1sP,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Skw1bP,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Skw2kP,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Skw2sP,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Skw2bP,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Skw3kP,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Skw3sP,
                                    sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Skw3bP,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw1 else 0 end) Skw1kT,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw1 else 0 end) Skw1sT,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw1 else 0 end) Skw1bT,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw2 else 0 end) Skw2kT,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw2 else 0 end) Skw2sT,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw2 else 0 end) Skw2bT,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 then kw3 else 0 end) Skw3kT,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 then kw3 else 0 end) Skw3sT,
                                    sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 then kw3 else 0 end) Skw3bT
                                    from decal_shd
                                    where deleted = 0
                                    group by id_decal_items
                                  ) g on a.id = g.id_decal_items
                                  left join
                                  (
                                    select id_decal_items, 
                                    sum( case when jenis_decal = 1 then Tkw1_selisih_k else 0 end) Tkw1_selisih_k,
                                    sum( case when jenis_decal = 1 then Tkw1_selisih_s else 0 end) Tkw1_selisih_s,
                                    sum( case when jenis_decal = 1 then Tkw1_selisih_b else 0 end) Tkw1_selisih_b,
                                    sum( case when jenis_decal = 1 then Tkw2_selisih_k else 0 end) Tkw2_selisih_k,
                                    sum( case when jenis_decal = 1 then Tkw2_selisih_s else 0 end) Tkw2_selisih_s,
                                    sum( case when jenis_decal = 1 then Tkw2_selisih_b else 0 end) Tkw2_selisih_b,
                                    sum( case when jenis_decal = 1 then Tkw3_selisih_k else 0 end) Tkw3_selisih_k,
                                    sum( case when jenis_decal = 1 then Tkw3_selisih_s else 0 end) Tkw3_selisih_s,
                                    sum( case when jenis_decal = 1 then Tkw3_selisih_b else 0 end) Tkw3_selisih_b,
                                    sum( case when jenis_decal = 1 then Pkw1_selisih_k else 0 end) Pkw1_selisih_k,
                                    sum( case when jenis_decal = 1 then Pkw1_selisih_s else 0 end) Pkw1_selisih_s,
                                    sum( case when jenis_decal = 1 then Pkw1_selisih_b else 0 end) Pkw1_selisih_b,
                                    sum( case when jenis_decal = 1 then Pkw2_selisih_k else 0 end) Pkw2_selisih_k,
                                    sum( case when jenis_decal = 1 then Pkw2_selisih_s else 0 end) Pkw2_selisih_s,
                                    sum( case when jenis_decal = 1 then Pkw2_selisih_b else 0 end) Pkw2_selisih_b,
                                    sum( case when jenis_decal = 1 then Pkw3_selisih_k else 0 end) Pkw3_selisih_k,
                                    sum( case when jenis_decal = 1 then Pkw3_selisih_s else 0 end) Pkw3_selisih_s,
                                    sum( case when jenis_decal = 1 then Pkw3_selisih_b else 0 end) Pkw3_selisih_b
                                    from decal_ahd
                                    where deleted = 0
                                    group by id_decal_items
                                  ) h on a.id = h.id_decal_items
                                  where b.deleted = 0 
                                  group by a.id, a.nama, a.buyer";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getItem(){
                $query ="select distinct item from decal_items_detail order by item asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getNama(){
                $query ="select nama from decal_items order by nama asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getAlias(){
                $query ="select alias from decal_items order by alias asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function namaDesain($id){
		$t = "SELECT * FROM decal_items WHERE id='$id'";
		$d = $this->glzModel->manualQuery($t);
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
        
        public function jenisDesain($id){
		$t = "SELECT a.id,a.nama,a.alias,a.buyer,a.dekorasi,a.size,a.satuan,b.nama as jenis FROM decal_items a 
                        LEFT JOIN global_jenis_decal b on a.jenis = b.id
                        where a.id = '$id'";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jenis;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function kertas($id){
		$t = "SELECT a.id,a.nama,a.alias,a.buyer,a.dekorasi,b.dsc as size,a.satuan,a.jenis FROM decal_items a 
                        LEFT JOIN global_size b on a.jenis = b.id
                        where a.id = '$id'";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->size;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
         public function getPicProdDecal(){
                $query ="select distinct petugas from decal_phd order by petugas asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */