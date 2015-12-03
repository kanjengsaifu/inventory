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
        
        public function MaxPhGlasirSupp(){
		$text = "SELECT max(no_prod) as no FROM glasir_ph_sp";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'SG'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'SG'.'00001';
		}
		return $hasil;
	}
        
        public function MaxPhGlasirScra(){
		$text = "SELECT max(no_prod) as no FROM glasir_sh";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'SH'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'SH'.'00001';
		}
		return $hasil;
	}
        
        public function MaxPhGlasirAdju(){
		$text = "SELECT max(id) as no FROM glasir_ah";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'AH'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'SH'.'00001';
		}
		return $hasil;
	}
        
        public function MaxPeriod(){
		$text = "SELECT max(period) as no FROM glasir_ohd";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->no;
			}
		}else{
			$hasil = '1';
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
        
        public function MaxPhGlasirOpnaBgps(){
		$text = "SELECT max(no_prod) as no FROM glasir_oh";
		$data = $this->glzModel->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,5))+1;
				$hasil = 'OB'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'OB'.'00001';
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
		$t = "SELECT idphd FROM glasir_phd WHERE no_prod='$id' AND deleted <> 1";
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
		$t = "SELECT GROUP_CONCAT(concat('[',b.id_glasir,'-',b.nama_glasir,']') SEPARATOR ', ') as nama_glasir FROM glasir_phd a 
                        JOIN glasir b on a.id_glasir = b.id_glasir
                        WHERE no_prod='$id' AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_glasir;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function ProsesItemSupp($id){
		$t = "SELECT GROUP_CONCAT(concat('[',b.id_glasir,'-',b.nama_glasir,']') SEPARATOR ', ') as nama_glasir FROM glasir_phd_sp a 
                        JOIN glasir b on a.id_glasir = b.id_glasir
                        WHERE no_prod='$id'  AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_glasir;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function ProsesItemScra($id){
		$t = "SELECT GROUP_CONCAT(concat('[',b.id_glasir,'-',b.nama_glasir,']') SEPARATOR ', ') as nama_glasir FROM glasir_shd a 
                        JOIN glasir b on a.id_glasir = b.id_glasir
                        WHERE no_prod='$id'  AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_glasir;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function ProsesItemTran($id){
		$t = "SELECT GROUP_CONCAT(concat('[',b.id_glasir,'-',b.nama_glasir,']') SEPARATOR ', ') as nama_glasir FROM glasir_thd a 
                        JOIN glasir b on a.id_glasir = b.id_glasir
                        WHERE no_prod='$id' AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_glasir;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function ProsesItemRetu($id){
		$t = "SELECT GROUP_CONCAT(concat('[',b.id_glasir,'-',b.nama_glasir,']') SEPARATOR ', ') as nama_glasir FROM glasir_rhd a 
                        JOIN glasir b on a.id_glasir = b.id_glasir
                        WHERE no_prod='$id' AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_glasir;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function ProsesItemAdju($id){
		$t = "SELECT GROUP_CONCAT(concat('[',b.id_glasir,'-',b.nama_glasir,']') SEPARATOR ', ') as nama_glasir FROM glasir_ahd a 
                        JOIN glasir b on a.id_glasir = b.id_glasir
                        WHERE a.id_related='$id' AND a.deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_glasir;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function JmlGlasir($id){
		$t = "SELECT sum(1.565*((densitas-1000)/1000)*volume) as jml FROM glasir_phd WHERE no_prod='$id' AND deleted <> 1";
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
        
        public function ProsesGlasirSupp($id){
		$t = "SELECT idphd FROM glasir_phd_sp WHERE no_prod='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function ProsesGlasirScra($id){
		$t = "SELECT idphd FROM glasir_shd WHERE no_prod='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function ProsesGlasirAdju($id){
		$t = "SELECT id FROM glasir_ahd WHERE id_related='$id' AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlGlasirSupp($id){
		$t = "SELECT sum(1.565*((densitas-1000)/1000)*volume) as jml FROM glasir_phd_sp WHERE no_prod='$id' AND deleted <> 1";
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
        
        public function JmlGlasirScra($id){
		$t = "SELECT sum(1.565*((densitas-1000)/1000)*volume) as jml FROM glasir_shd WHERE no_prod='$id' AND deleted <> 1";
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
		$t = "SELECT idthd FROM glasir_thd WHERE no_prod='$id' AND deleted <> 1";
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
		$t = "SELECT sum(1.565*((densitas-1000)/1000)*volume) as jml FROM glasir_thd WHERE no_prod='$id' AND deleted <> 1";
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
		$t = "SELECT idthd FROM glasir_rhd WHERE no_prod='$id' AND deleted <> 1";
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
		$t = "SELECT sum(volume) as jml FROM glasir_rhd WHERE no_prod='$id' AND deleted <> 1";
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
        
        public function ProsesGlasirOpnaBgps($id){
		$t = "SELECT idthd FROM glasir_ohd WHERE no_prod='$id' AND area=1 AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlGlasirOpnaBgps($id){
		$t = "SELECT sum(1.565*((densitas-1000)/1000)*volume) as jml FROM glasir_ohd WHERE no_prod='$id' AND area=1 AND deleted <> 1";
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
        
        public function ProsesGlasirOpnaSply($id){
		$t = "SELECT idthd FROM glasir_ohd WHERE no_prod='$id' AND area=2 AND deleted <> 1";
		$d = $this->glzModel->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function JmlGlasirOpnaSply($id){
		$t = "SELECT sum(1.565*((densitas-1000)/1000)*volume) as jml FROM glasir_ohd WHERE no_prod='$id' AND area=2 AND deleted <> 1";
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
        
        public function CariGlasirStatus($id){
		$t = "SELECT * FROM glasir_status WHERE id='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->status;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function CariParentName($id){
		$t = "SELECT * FROM glasir WHERE id_glasir='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_glasir;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
        public function CariGlasirTglp($id){
		$t = "SELECT * FROM glasir WHERE id_glasir='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_glasir;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
        
         public function get_ldg(){
                $query ="select a.id_glasir,a.parent,a.nama_glasir,a.nama_alias,a.satuan,b.status as status,a.inputer,a.tgl_input,a.tgl_update 
                            FROM glasir a left join glasir_status b on a.status = b.id
                            WHERE a.deleted <> 1 ";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
         public function get_stok(){
                $query ="select a.id_glasir, a.nama_glasir,
										  COALESCE(h.scrap_supp, 0) scrap_supp, 	
                                COALESCE(g.adj_bgps, 0) adj_bgps, COALESCE(g.adj_sply, 0) adj_sply,
                                COALESCE(c.turun_bgps, 0) turun_bgps, coalesce(d.ditarik_supply, 0) ditarik_supply, coalesce(e.return_prod, 0) return_prod, coalesce(f.kirim_prod, 0) kirim_prod,

                                REPLACE(FORMAT((((coalesce(c.turun_bgps, 0)-(COALESCE(g.adj_bgps, 0)))) - coalesce(d.ditarik_supply, 0)),2),',','') stok_bgps,
                                REPLACE(FORMAT(((((coalesce(d.ditarik_supply, 0)-(COALESCE(g.adj_sply, 0)))+coalesce(e.return_prod, 0))) - coalesce(f.kirim_prod, 0)- coalesce(h.scrap_supp, 0)),2),',','') stok_supply,
                                
                                REPLACE(FORMAT((GREATEST(((coalesce(c.turun_bgps, 0)-(COALESCE(g.adj_bgps, 0))) - coalesce(d.ditarik_supply, 0)),',','')+
                                GREATEST((((coalesce(d.ditarik_supply, 0)-(COALESCE(g.adj_sply, 0))+coalesce(e.return_prod, 0))) - coalesce(f.kirim_prod, 0)- coalesce(h.scrap_supp, 0)),',','')),2),',','') total
                                
                        from glasir a
                        left join glasir_ohd b
                          on a.id_glasir = b.id_glasir
                        left join
                        (
                          select id_glasir, 
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') turun_bgps
                          from glasir_phd
                          where deleted = 0
                          group by id_glasir
                        ) c on a.id_glasir = c.id_glasir
                        left join
                        (
                          select id_glasir, 
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') ditarik_supply
                          from glasir_phd_sp
                          where deleted = 0
                          group by id_glasir
                        ) d on a.id_glasir = d.id_glasir
                        left join
                        (
                          select id_glasir, parent_id,
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') return_prod
                          from glasir_rhd
                          where deleted = 0
                          group by id_glasir
                        ) e on a.id_glasir = e.parent_id
                        left join
                        (
                          select id_glasir,  parent_id,
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') kirim_prod
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
                          REPLACE(FORMAT(COALESCE(sum(case when deleted <> 1 THEN (1.565*((densitas-1000)/1000)*volume) ELSE 0 END), 0),2),',','') scrap_supp
                          from glasir_shd
                          where deleted = 0
                          group by id_glasir
                        ) h on a.id_glasir = h.parent_id
                        where b.deleted = 0 
                        group by a.id_glasir";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function get_stok_status(){
                $query ="SELECT a.id_glasir,a.volume,a.densitas,a.dsc,
                            REPLACE(FORMAT(COALESCE((1.565*((a.densitas-1000)/1000)*a.volume), 0),2),',','') as bkg
                            FROM glasir_ohd a";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getPicProd(){
                $query ="select distinct petugas from glasir_phd order by petugas asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getPicSupp(){
                $query ="select distinct petugas from glasir_phd_sp order by petugas asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getPicScra(){
                $query ="select distinct petugas from glasir_shd order by petugas asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getPicAdju(){
                $query ="select distinct petugas from glasir_ahd order by petugas asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getPicTran3(){
                $query ="select distinct petugas3 from glasir_thd order by petugas3 asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getPicTran4(){
                $query ="select distinct petugas4 from glasir_thd order by petugas4 asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getPicRetu3(){
                $query ="select distinct petugas3 from glasir_rhd order by petugas3 asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
        
        public function getPicRetu4(){
                $query ="select distinct petugas4 from glasir_rhd order by petugas4 asc";
		$query_result_detail = $this->db->query($query);
                $result = $query_result_detail->result();
		return $result;
	}
	
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */