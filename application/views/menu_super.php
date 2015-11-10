<?php 
            $akses = $this->session->userdata('hak_akses');
            $user = $this->session->userdata('username');
            if($akses=='glz'){
            ?>
<div title="Master" data-options="iconCls:'icon-tip'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    </li>
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir">GLZ-Item</a>
    </li>
    </ul>
    </div>
</div>
<div title="Transaksi" data-options="iconCls:'icon-tip'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir_prod">GLZ-BGPS</a>
    </li>
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir_supp">GLZ-Supply</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_tran">GLZ-Pemakaian</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_retu">GLZ-Retur</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_opna">GLZ-Opname</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_adju">GLZ-Adjusment</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_scra">GLZ-Scrap</a>
    </li>
    </ul>
    </div>
</div>
<div title="Laporan" data-options="iconCls:'icon-print'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/glasir_lap">GLZ-Stok</a></span>
    </li>
    </ul>
    </div>
</div>
<div title="Grafik" data-options="iconCls:'icon-grafik'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/glasir_lap">GLZ-Akurasi</a></span>
    </li>
    </ul>
    </div>
</div>
<?php       
            }elseif($akses=='dcl')
            {
            ?>
<div title="Master" data-options="iconCls:'icon-tip'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    </li>
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/decal">DCL-Item</a>
    </li>
    </ul>
    </div>
</div>
<div title="Transaksi" data-options="iconCls:'icon-tip'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/decal_prod">DCL-Produksi</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_tran">DCL-Transit</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_used">DCL-Pemakaian</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_retu">DCL-Retur</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_opna">DCL-Opname</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_adju">DCL-Adjusment</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_scra">DCL-Scrap</a>
    </li>
    </ul>
    </div>
</div>
<div title="Laporan" data-options="iconCls:'icon-print'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/decal_lap">DCL-Stok</a></span>
    </li>
    </ul>
    </div>
</div>
<div title="Grafik" data-options="iconCls:'icon-grafik'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/decal_lap">DCL-Akurasi</a></span>
    </li>
    </ul>
    </div>
</div>
<?php      
            }else{
            ?>
<div title="Master" data-options="iconCls:'icon-tip'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li data-options="iconCls:'icon-surat_perintah'">
    <a href="<?php echo base_url();?>index.php/pengguna">Pengguna</a>
    </li>
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/decal">DCL-Item</a>
    </li>
    </li>
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir">GLZ-Item</a>
    </li>
    </ul>
    </div>
</div>
<div title="Transaksi" data-options="iconCls:'icon-tip'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir_prod">GLZ-BGPS</a>
    </li>
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir_supp">GLZ-Supply</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_tran">GLZ-Pemakaian</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_retu">GLZ-Retur</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_opna">GLZ-Opname</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_adju">GLZ-Adjusment</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_scra">GLZ-Scrap</a>
    </li>
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/decal_prod">DCL-Produksi</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_tran">DCL-Transit</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_used">DCL-Pemakaian</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_retu">DCL-Retur</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_opna">DCL-Opname</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_adju">DCL-Adjusment</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_scra">DCL-Scrap</a>
    </li>
    </ul>
    </div>
</div>
<div title="Laporan" data-options="iconCls:'icon-print'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/decal_lap">DCL-Stok</a></span>
    </li>
    <li>
    <span><a href="<?php echo base_url();?>index.php/glasir_lap">GLZ-Stok</a></span>
    </li>
    </ul>
    </div>
</div>
<div title="Grafik" data-options="iconCls:'icon-grafik'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/decal_lap">DCL-Akurasi</a></span>
    </li>
    <li>
    <span><a href="<?php echo base_url();?>index.php/glasir_lap">GLZ-Akurasi</a></span>
    </li>
    </ul>
    </div>
</div>
<?php    
            }
            ?>