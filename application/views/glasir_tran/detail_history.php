<script type="text/javascript">
$(function() {
	$("#dataTable tr:even").addClass("stripe1");
	$("#dataTable tr:odd").addClass("stripe2");
	$("#dataTable tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
</script>
<style type="text/css">
.stripe1 {
    background-color:#FBEC88;
}
.stripe2 {
    background-color:#FFF;
}
.highlight {
	-moz-box-shadow: 1px 1px 2px #fff inset;
	-webkit-box-shadow: 1px 1px 2px #fff inset;
	box-shadow: 1px 1px 2px #fff inset;		  
	border:             #aaa solid 1px;
	background-color: #fece2f;
}
</style>
<table id="dataTable" width="100%">
<tr>
    <th style="font-size:12px">No</th>
    <th style="font-size:12px">Kode</th>
    <th style="font-size:12px">Status</th>
    <th style="font-size:12px">Volume (ltr)</th>
    <th style="font-size:12px">Densitas</th>
    <th style="font-size:12px">Ball Mill</th>
    <th style="font-size:12px">Tong</th>
    <th style="font-size:12px">PIC</th>
    <th style="font-size:12px">Keterangan</th>
    <th style="font-size:12px">Inputer</th>
    <th style="font-size:12px">Waktu Input</th>
</tr>
<?php
	if($data->num_rows()>0){
		//$g_total=0;
               // $h_total=0;
		$no =1;
		foreach($data->result_array() as $db){  
		//$total = $db['volume'];
                //$totald = $db['densitas'];
                $pembagi = $no;
		?>    
    	<tr>
            <td align="center" width="20" style="font-size:10px"><?php echo $no; ?></td>
            <td align="center" width="60" style="font-size:10px"><?php echo $db['idphdh']; ?></td>
            <td align="left" style="font-size:10px"><?php echo $db['tgl']; ?> | <?php echo $db['nama_gps']; ?></td>
            <td align="right" width="80" style="font-size:10px"><?php echo number_format($db['volume']); ?></td>
            <td align="right" width="80" style="font-size:10px"><?php echo number_format($db['densitas']); ?></td>
            <td align="center" width="100" style="font-size:10px">[<?php echo $db['id_bm']; ?>] - <?php echo $db['nama_bm']; ?></td>
            <td align="center" width="80" style="font-size:10px">[<?php echo $db['id_tong']; ?>] - <?php echo $db['nama_tong']; ?></td>
            <td align="center" width="70" style="font-size:10px"><?php echo $db['petugas']; ?></td>
            <td align="left" width="210" style="font-size:10px"><?php echo $db['dsc']; ?></td>
            <td align="center" width="70" style="font-size:10px"><?php echo $db['inp']; ?></td>
            <td align="center" width="100" style="font-size:10px"><?php echo $db['inp_time']; ?></td>
    </tr>
    <?php
		$no++;
		//$g_total=$g_total+$total;
                //$h_total=$h_total+$totald;
		}
	}else{
		//$g_total=0;
               // $h_total=0;
	?>
    	<tr>
        	<td colspan="8" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
<tr>
        <?php 
        //if ($g_total==0 and $h_total==0){
            //$sip = 0;
            //$xip = 0;
        //}else{
           // $sip = $g_total/$pembagi;
            //$xip = $h_total/$pembagi;
        //}
        ?>
</tr>    
</table>