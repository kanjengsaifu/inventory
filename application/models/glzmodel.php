<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Glzmodel extends CI_Model {

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
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
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
        
        public function MaxPhGlasir(){
		$text = "SELECT max(no_prod) as no FROM glasir_ph";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'PG'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'PG'.'00001';
		}
		return $hasil;
	}
        
        public function MaxPhGlasirTran(){
		$text = "SELECT max(no_prod) as no FROM glasir_th";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'TG'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'TG'.'00001';
		}
		return $hasil;
	}
        
        public function MaxPhGlasirRetu(){
		$text = "SELECT max(no_prod) as no FROM glasir_rh";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'RG'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'RG'.'00001';
		}
		return $hasil;
	}
        
        public function MaxPhdhGlasir(){
		$text = "SELECT max(idphdh) as no FROM glasir_phdh";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'HG'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'HG'.'00001';
		}
		return $hasil;
	}
        
        public function ProsesGlasir($id){
		$t = "SELECT idphd FROM glasir_phd WHERE no_prod='$id'";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlGlasir($id){
		$t = "SELECT sum(volume) as jml FROM glasir_phd WHERE no_prod='$id'";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function ProsesGlasirTran($id){
		$t = "SELECT idthd FROM glasir_thd WHERE no_prod='$id'";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlGlasirTran($id){
		$t = "SELECT sum(volume) as jml FROM glasir_thd WHERE no_prod='$id'";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function ProsesGlasirRetu($id){
		$t = "SELECT idrhd FROM glasir_rhd WHERE no_prod='$id'";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlGlasirRetu($id){
		$t = "SELECT sum(volume) as jml FROM glasir_rhd WHERE no_prod='$id'";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function NewStatus($noprod,$idglasir,$batch){
		$t = "SELECT b.nama_gps FROM glasir_phdh a
                        join glasir_patt b on a.idgps = b.idgps
                        where a.noprod = '$noprod' and a.idglasir = '$idglasir' and a.idphd = '$batch'
                        ORDER BY a.idphdh DESC LIMIT 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_gps;
			}
		}else{
			$hasil = 'Tidak ada status';
		}
		return $hasil;
	}
        
        public function CountStatus($noprod,$idglasir,$batch){
		$t = "SELECT count(*) as count FROM glasir_phdh a
                        join glasir_patt b on a.idgps = b.idgps
                        where noprod = '$noprod' and idglasir = '$idglasir' and idphd = '$batch'";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->count;
			}
		}else{
			$hasil = 'Tidak ada status';
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
	
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */