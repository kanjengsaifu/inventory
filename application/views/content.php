<p>Hai, Selamat datang <b><?php echo $this->session->userdata('nama_lengkap');?>-<?php echo $this->session->userdata('hak_akses');?></b> di Manajeman <b><?php echo $nama_program;?></b></p>
<br />
<?php 
if($this->session->userdata('level')=='01'){
?>
<table class="list" width="100%">
    <?php 
            $akses = $this->session->userdata('hak_akses');
            $user = $this->session->userdata('username');
            if($akses=='glz'){
            ?>
	<thead>
            <td width="100%" class="btn" colspan="7" style="color:#000;"><center><b>GLAZE</b></center></td>
        </thead>
    <tr>
    	<td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Item</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_prod"><img src="<?php echo base_url();?>asset/images/lelang.png" /><br />
        <b>BGPS</b></a>
        </td>
        <td  class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_supp"><img src="<?php echo base_url();?>asset/images/surat_keputusan.png" /><br />
        <b>Supply</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_tran"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Pemakaian</b></a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_retu"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Retur</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_opna"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Stok Opname</b></a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_lap"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Stok</b></a>
        </td>
        </td>
        </td>
    </tr>
    <?php       
            }elseif($akses=='dcl')
            {
            ?>
        <thead>
            <td width="100%" class="btn" colspan="7" style="color:#000;"><center><b>Decal & Logo</b></center></td>
        </thead>
    <tr>
    	<td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/decal"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Item</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/decal_prod"><img src="<?php echo base_url();?>asset/images/lelang.png" /><br />
        <b>Produksi</a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/decal_tran"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Pemakaian</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/decal_retu"><img src="<?php echo base_url();?>asset/images/lelang.png" /><br />
        <b>Retur</a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/decal_opna"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Stock Opname</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/decal_adju"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Adjustment</b></a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/decal_lap"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Stok</b></a>
        </td>
        </td>
        </td>
    </tr>
     <?php      
            }else{
            ?>
    <thead>
            <td width="100%" class="btn" colspan="7" style="color:#000;"><center><b>GLAZE</b></center></td>
        </thead>
    <tr>
    	<td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Item</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_prod"><img src="<?php echo base_url();?>asset/images/lelang.png" /><br />
        <b>BGPS</b></a>
        </td>
        <td  class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_supp"><img src="<?php echo base_url();?>asset/images/surat_keputusan.png" /><br />
        <b>Supply</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_tran"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Pemakaian</b></a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_retu"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Retur</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_opna"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Stok Opname</b></a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_lap"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Stok</b></a>
        </td>
        </td>
        </td>
    </tr>
    <thead>
            <td width="100%" class="btn" colspan="7" style="color:#000;"><center><b>Decal & Logo</b></center></td>
        </thead>
    <tr>
    	<td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Item</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_prod"><img src="<?php echo base_url();?>asset/images/lelang.png" /><br />
        <b>Produksi</a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Pemakaian</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_prod"><img src="<?php echo base_url();?>asset/images/lelang.png" /><br />
        <b>Retur</a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir"><img src="<?php echo base_url();?>asset/images/admin_.png" /><br />
        <b>Stock Opname</b></a>
        </td>
        <td align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_opna"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>05-Adjustment</b></a>
        </td>
        <td class="btn" align="center" width="14%"><a href="<?php echo base_url();?>index.php/glasir_lap"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>06-Stok</b></a>
        </td>
        </td>
        </td>
    </tr>
    <?php    
            }
            ?>
</table> 
<?php } ?>