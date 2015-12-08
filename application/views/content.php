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
            <td width="100%" class="btn" colspan="9" style="color:#000;"><center><b>Glaze</b></center></td>
    </thead>
    <tr>
    	<td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir"><img src="<?php echo base_url();?>asset/images/item.png" /><br />
        <b>Item</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_prod"><img src="<?php echo base_url();?>asset/images/produksi.png" /><br />
        <b>BGPS</b></a>
        </td>
        <td  class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_supp"><img src="<?php echo base_url();?>asset/images/supply.png" /><br />
        <b>Supply</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_tran"><img src="<?php echo base_url();?>asset/images/pemakaian.png" /><br />
        <b>Pemakaian</b></a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_retu"><img src="<?php echo base_url();?>asset/images/retur.png" /><br />
        <b>Retur</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_opna"><img src="<?php echo base_url();?>asset/images/opname.png" /><br />
        <b>Opname</b></a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_adju"><img src="<?php echo base_url();?>asset/images/adjus.png" /><br />
        <b>Adjusment</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_scra"><img src="<?php echo base_url();?>asset/images/scrap.png" /><br />
        <b>Scrap</b></a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_lap"><img src="<?php echo base_url();?>asset/images/stock.png" /><br />
        <b>Stok</b></a>
        </td>
    </tr>
    <?php       
            }elseif($akses=='dcl')
            {
            ?>
    <thead>
            <td width="100%" class="btn" colspan="9" style="color:#000;"><center><b>Decal & Logo</b></center></td>
    </thead>
    <tr>
    	<td class="btn" align="center" width=11%"><a href="<?php echo base_url();?>index.php/decal"><img src="<?php echo base_url();?>asset/images/item.png" /><br />
        <b>Item</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_prod"><img src="<?php echo base_url();?>asset/images/produksi.png" /><br />
        <b>Produksi</a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_tran"><img src="<?php echo base_url();?>asset/images/transit.png" /><br />
        <b>Transit</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_used"><img src="<?php echo base_url();?>asset/images/pemakaian.png" /><br />
        <b>Pemakaian</a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_retu"><img src="<?php echo base_url();?>asset/images/retur.png" /><br />
        <b>Retur</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_opna"><img src="<?php echo base_url();?>asset/images/opname.png" /><br />
        <b>Opname</b></a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_adju"><img src="<?php echo base_url();?>asset/images/adjus.png" /><br />
        <b>Adjusment</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_scra"><img src="<?php echo base_url();?>asset/images/scrap.png" /><br />
        <b>Scrap</b></a>
        </td> 
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_lap"><img src="<?php echo base_url();?>asset/images/stock.png" /><br />
        <b>Stok</b></a>
        </td>
    </tr>
     <?php      
            }else{
            ?>
    <thead>
            <td width="100%" class="btn" colspan="9" style="color:#000;"><center><b>Glaze</b></center></td>
    </thead>
    <tr>
    	<td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir"><img src="<?php echo base_url();?>asset/images/item.png" /><br />
        <b>Item</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_prod"><img src="<?php echo base_url();?>asset/images/produksi.png" /><br />
        <b>BGPS</b></a>
        </td>
        <td  class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_supp"><img src="<?php echo base_url();?>asset/images/supply.png" /><br />
        <b>Supply</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_tran"><img src="<?php echo base_url();?>asset/images/pemakaian.png" /><br />
        <b>Pemakaian</b></a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_retu"><img src="<?php echo base_url();?>asset/images/retur.png" /><br />
        <b>Retur</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_opna"><img src="<?php echo base_url();?>asset/images/opname.png" /><br />
        <b>Opname</b></a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_adju"><img src="<?php echo base_url();?>asset/images/adjus.png" /><br />
        <b>Adjusment</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_scra"><img src="<?php echo base_url();?>asset/images/scrap.png" /><br />
        <b>Scrap</b></a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/glasir_lap"><img src="<?php echo base_url();?>asset/images/stock.png" /><br />
        <b>Stok</b></a>
        </td>
    </tr>
    <thead>
            <td width="100%" class="btn" colspan="9" style="color:#000;"><center><b>Decal & Logo</b></center></td>
    </thead>
    <tr>
    	<td class="btn" align="center" width=11%"><a href="<?php echo base_url();?>index.php/decal"><img src="<?php echo base_url();?>asset/images/item.png" /><br />
        <b>Item</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_prod"><img src="<?php echo base_url();?>asset/images/produksi.png" /><br />
        <b>Produksi</a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_tran"><img src="<?php echo base_url();?>asset/images/transit.png" /><br />
        <b>Transit</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_used"><img src="<?php echo base_url();?>asset/images/pemakaian.png" /><br />
        <b>Pemakaian</a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_retu"><img src="<?php echo base_url();?>asset/images/retur.png" /><br />
        <b>Retur</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_opna"><img src="<?php echo base_url();?>asset/images/opname.png" /><br />
        <b>Opname</b></a>
        </td>
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_adju"><img src="<?php echo base_url();?>asset/images/adjus.png" /><br />
        <b>Adjusment</b></a>
        </td>
        <td align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_scra"><img src="<?php echo base_url();?>asset/images/scrap.png" /><br />
        <b>Scrap</b></a>
        </td> 
        <td class="btn" align="center" width="11%"><a href="<?php echo base_url();?>index.php/decal_lap"><img src="<?php echo base_url();?>asset/images/stock.png" /><br />
        <b>Stok</b></a>
        </td>
    </tr>
    <?php    
            }
            ?>
</table> 
<?php } ?>