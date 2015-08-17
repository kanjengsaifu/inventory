<p>Hai, Selamat datang <b><?php echo $this->session->userdata('nama_lengkap');?></b> di Manajeman <b><?php echo $nama_program;?></b></p>
<br />
<?php 
if($this->session->userdata('level')=='01'){
?>
<table class="list" width="100%">
	<thead>
    <td class="btn" colspan="6" style="color:#000;"><center><b>CONTROL PANEL</b></center></td>
    </thead>
    <tr>
    	<td class="btn" align="center" width="20%"><a href="<?php echo base_url();?>index.php/glasir"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Item Glasir</b></a>
        </td>
        <td align="center" width="20%"><a href="<?php echo base_url();?>index.php/pembelian"><img src="<?php echo base_url();?>asset/images/lelang.png" /><br />
        <b>Produksi Glasir</b></a>
        </td>
        <td  class="btn" align="center" width="20%"><a href="<?php echo base_url();?>index.php/penjualan"><img src="<?php echo base_url();?>asset/images/surat_keputusan.png" /><br />
        <b>Transaksi Glasir</b></a>
        </td>
		<td align="center" width="20%"><a href="<?php echo base_url();?>index.php/supplier"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Penyesuaian Stok Glasir</b></a>
        </td>
        <td class="btn" align="center" width="20%"><a href="<?php echo base_url();?>index.php/lap_barang"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Stok Glasir</b></a>
        </td>
	</tr>       
</table> 
<?php } ?>