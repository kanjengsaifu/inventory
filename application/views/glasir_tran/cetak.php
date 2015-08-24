<style type="text/css">
*{
font-family: Arial;
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm;
}
table.grid{
width:20.99cm ;
font-size: 12px;
border-collapse:collapse;
}
table.grid th{
	padding:5px;
}
table.grid th{
background: #F0F0F0;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
text-align:center;
border:1px solid #000;
}
table.grid tr td{
	padding:2px;
	border-bottom:0.2mm solid #000;
	border:1px solid #000;
}
h1{
font-size: 18px;
}
h2{
font-size: 14px;
}
h3{
font-size: 12px;
}
p {
font-size: 10px;
}
center {
	padding:8px;
}
.atas{
display: block;
width:20.99cm ;
margin:0px;
padding:0px;
}
.kanan tr td{
	font-size:12px;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
width:20.99cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:20.99cm ;
font-size:13px;
}
.page {
width:20.99cm ;
font-size:12px;
padding:10px;
}

</style>
<?php

$kiri = '<h1>'.$instansi.'</h1>';
$kiri .= '<p>'.$alamat_instansi.'</p>';

$kanan = "<table class='kanan' width='100%'>
		  <tr>
		  	<td>No. Produksi</td>
			<td width='5'>:</td>
			<td><b>$no_prod</b></td>
		  </tr>
                  <tr>
		  	<td>No. Order</td>
			<td width='5'>:</td>
			<td><b>$no_po</b></td>
		  </tr>
		  <tr>
		  	<td>Tanggal Planning</td>
			<td width='5'>:</td>
			<td>$tgl_plng</td>
		  </tr>
		  <tr>
		  	<td>Planner</td>
			<td width='5'>:</td>
			<td>$planner</td>
		  </tr>
		  </table>";
function myheader($kiri,$kanan,$judul){
?>
<div class="atas">
<table width="100%">
<tr>
	<td width="60%" valign="top">
   		<?php echo $kiri;?>
    </td>
	<td width="40%" valign="top">
    	<?php echo $kanan;?>
    </td>
</tr>    
</table>
<center><h1><?php echo $judul;?></h1></center>
</div>
<table class="grid" width="100%">
	<tr>
    	<th width="5%">No</th>
        <th width="12%">No. Produksi</th>
        <th width="10%">Id. Glasir</th>
        <th width="15%">Status Glasir</th>
        <th width="8%">Volume (ltr)</th>
        <th width="5%">Densitas</th>
        <th width="15%">Ball Mill</th>
        <th width="10%">Tong</th>
        <th width="10%">Petugas</th>
        <th width="10%">Inputer</th>
	</tr>        
<?php
}
function myfooter(){	
	echo "</table>";
}
	$g_total=0;
	$no=1;
	$page =1;
	foreach($data->result_array() as $r){
	$total = $r['volume'];
	if(($no%25) == 1){
   	if($no > 1){
        myfooter();
        echo "<div class=\"pagebreak\" align='right'>
		<div class='page' align='center'>Hal - $page</div>
		</div>";
		$page++;
  	}
   	myheader($kiri,$kanan,$judul);
	}
	?>
    <tr>
    	<td align="center"><?php echo $no;?></td>
        <td align="center"><?php echo $r['no_prod'];?></td>
        <td align="center"><?php echo $r['id_glasir'];?></td>
        <td align="center"><?php echo $r['nama_gps'];?></td>
        <td align="right"><?php echo number_format($r['volume']);?></td>
        <td align="right"><?php echo number_format($r['densitas']);?></td>
        <td align="center"><?php echo $r['nama_bm'];?></td>
        <td align="center"><?php echo $r['nama_tong'];?></td>
        <td align="center"><?php echo $r['petugas'];?></td>
        <td align="center"><?php echo $r['inputer'];?></td>
    </tr>
    <?php
	$no++;
	$g_total = $g_total+$total;
	}
	echo "<tr>
			<td colspan='4' align='center'>Total</td>
			<td align='right'>".number_format($g_total)."</td>
              </tr>
              <tr>
			<td colspan='7' align='center' style='border-left-color: #FFFFFF; border-top-color: #FFFFFF; border-bottom-color: #FFFFFF'></td>
			<td align='center'>Dibuat</td>
                        <td align='center'>Disetujui</td>
                        <td align='center'>Diterima</td>
              </tr>
              <tr>
			<td colspan='7' align='center' style='border-left-color: #FFFFFF; border-top-color: #FFFFFF; border-bottom-color: #FFFFFF'></td>
			<td align='center' height='60px'></td>
                        <td align='center'></td>
                        <td align='center'></td>
              </tr>
              <tr>
			<td colspan='7' align='center' style='border-left-color: #FFFFFF; border-top-color: #FFFFFF; border-bottom-color: #FFFFFF'></td>
			<td align='center'>Planner</td>
                        <td align='center'>Mgr. PPIC</td>
                        <td align='center'>Pelaksana</td>
              </tr>
              <tr>
			<td colspan='7' align='center' style='border-left-color: #FFFFFF; border-top-color: #FFFFFF; border-bottom-color: #FFFFFF'></td>
			<td align='center'>xx.xx.xx</td>
                        <td colspan='2' align='center'>No. xxx.F.PPIC.REVISI-0</td>
                        
              </tr>
            ";
myfooter();	
	echo "</table>";
	echo "<div class='page' align='center'>Hal - ".$page."</div>";
?>