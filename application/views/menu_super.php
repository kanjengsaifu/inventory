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
    <a href="<?php echo base_url();?>index.php/glasir">Item</a>
    </li>
    </ul>
    </div>
</div>
<div title="Transaksi" data-options="iconCls:'icon-tip'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir_prod">BGPS</a>
    </li>
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir_supp">Supply</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_tran">Pemakaian</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_retu">Retur</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_opna">Stock Opname</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_opna">Adjusment</a>
    </li>
    </ul>
    </div>
</div>
<div title="Laporan" data-options="iconCls:'icon-print'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/glasir_lap">Stok</a></span>
    </li>
    </ul>
    </div>
</div>
<div title="Grafik" data-options="iconCls:'icon-grafik'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/glasir_lap">Akurasi Data</a></span>
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
    <a href="<?php echo base_url();?>index.php/decal">Item Decal</a>
    </li>
    </ul>
    </div>
</div>
<div title="Transaksi" data-options="iconCls:'icon-tip'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/decal_prod">Produksi</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_tran">Transit</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_used">Pemakaian</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_retu">Retur</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_opna">Stock Opname</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_adju">Adjusment</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/decal_scra">Pemusnahan</a>
    </li>
    </ul>
    </div>
</div>
<div title="Laporan" data-options="iconCls:'icon-print'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/glasir_lap">Stok</a></span>
    </li>
    </ul>
    </div>
</div>
<div title="Grafik" data-options="iconCls:'icon-grafik'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/glasir_lap">Akurasi Data</a></span>
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
    </li>
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir">Item Glasir</a>
    </li>
    </ul>
    </div>
</div>
<div title="Transaksi" data-options="iconCls:'icon-tip'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir_prod">01-BGPS Glasir</a>
    </li>
    <li data-options="iconCls:'icon-surat_keputusan'">
    <a href="<?php echo base_url();?>index.php/glasir_supp">02-Supply Glasir</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_tran">03-Pemakaian Glasir</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_retu">04-Retur Glasir</a>
    </li>
    <li data-options="iconCls:'icon-surat_keluar'">
    <a href="<?php echo base_url();?>index.php/glasir_opna">05-Stock Opname Glasir</a>
    </li>
    </ul>
    </div>
</div>
<div title="Laporan" data-options="iconCls:'icon-print'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/glasir_lap">Stok Glasir</a></span>
    </li>
    </ul>
    </div>
</div>
<div title="Grafik" data-options="iconCls:'icon-grafik'" style="overflow:auto;padding:5px 0px;">
    <div title="TreeMenu" data-options="iconCls:'icon-search'" style="padding:0px;">
    <ul class="easyui-tree">
    <li>
    <span><a href="<?php echo base_url();?>index.php/glasir_lap">Stok Glasir</a></span>
    </li>
    </ul>
    </div>
</div>
<?php    
            }
            ?>