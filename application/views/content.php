<p>Hai, Selamat datang <b><?php echo $this->session->userdata('nama_lengkap');?></b> di Manajeman <b><?php echo $nama_program;?></b></p>
<br />
<?php 
if($this->session->userdata('level')=='01'){
?>
<table class="list" width="100%">
	<thead>
    <td class="btn" colspan="7" style="color:#000;"><center><b>CONTROL PANEL</b></center></td>
    </thead>
    <tr>
    	<td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Item Glasir</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_prod"><img src="<?php echo base_url();?>asset/images/lelang.png" /><br />
        <b>Produksi Glasir</b></a>
        </td>
        <td  class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_tran"><img src="<?php echo base_url();?>asset/images/surat_keputusan.png" /><br />
        <b>Pemakaian Glasir</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_retu"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Pengembalian Glasir</b></a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_opna"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Stock Opname Glasir</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_stoc"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Stock Glasir</b></a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_rule"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Prosedur & IK Glasir</b></a>
        </td>
        </td>
        </td>
	</tr> 
     <tr>
    	<td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/saggar"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Item Saggar</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/saggar_prod"><img src="<?php echo base_url();?>asset/images/lelang.png" /><br />
        <b>Produksi Saggar</b></a>
        </td>
        <td  class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/saggar_tran"><img src="<?php echo base_url();?>asset/images/surat_keputusan.png" /><br />
        <b>Pemakaian Saggar</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/saggar_retu"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Pengembalian Saggar</b></a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/saggar_opna"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Stock Opname Saggar</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/saggar_stok"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Stock Saggar</b></a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/saggar_rule"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Prosedur & IK Saggar</b></a>
        </td>
        </td>
        </td>
	</tr>
</table> 
<?php } ?>