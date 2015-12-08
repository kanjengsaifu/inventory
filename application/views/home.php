<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Halaman Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow">
<meta http-equiv="Copyright" content="Deddy Rusdiansyah">
<meta name="author" content="Deddy Rusdiansyah">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/layout.css">
<link href="<?php echo base_url();?>asset/css/fonts/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/metro-gray/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/smoothness/jquery-ui-1.7.2.custom.css">

<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/js/clock.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/datagrid-filter.js"></script>

<!--datepicker-->
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.datepicker-id.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.datepicker.js"></script>

<!--Polling-->
<script type="text/javascript" src="<?php echo base_url();?>asset/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/js/exporting.js"></script>

<!-- notifikasi -->
<script type="text/javascript" src="<?php echo base_url();?>asset/js/notifikasi.js"></script>

<!--datagrid_export-->
<link rel="stylesheet" href="<?php echo base_url();?>asset/jqwidgets/styles/jqx.base.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxcheckbox.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.selection.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.edit.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.columnsresize.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.filter.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxdata.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxdata.export.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.export.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.storage.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.aggregates.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.pager.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/demos.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxpanel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxinput.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxdatetimeinput.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxcombobox.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxcalendar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxtooltip.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/jqxgrid.grouping.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jqwidgets/globalization/globalize.js"></script>
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

</head>
    <body onLoad="goforit()" style="height: 100%">
<div width="20%" class="header" style="height:100px; width: 100% ;background:white;padding:2px;margin:0;">	
		<div style="float:left; padding:0px; margin:0px;">
        <img src='<?php echo base_url();?>asset/images/logo_koperasi_85.png' style="padding:0; margin:0;" width="76" height="71">
        </div>
        <div class="judul" style="float:left; line-height:3px; margin-top:0px; padding:2px 5px;">
        <h2><?php echo $instansi;?></h2>
      <p><b><?php echo $usaha;?></b></p>
      <p><?php echo $alamat_instansi;?></p>
      </div>
		<div style="float:right; line-height:3px; text-align:center;">
        <br /><br />
        <h3><?php echo $nama_program;?></h3>
        <p>.:: Decal-Glaze-Saggar ::.</p>
        </div>
	</div>	
	
	<div class="panel-header" fit="true" style="height:21px;padding-top:1px;padding-right:20px">
		<div style="float:left;">
			<a style="color:#000000;" href="<?php echo base_url();?>index.php/home" class="easyui-linkbutton" data-options="plain:true" iconCls="icon-home">Home</a>
            <a style="color:#000000;" href="<?php echo base_url();?>index.php/login/logout" class="easyui-linkbutton" data-options="plain:true" iconCls="icon-logout">Logout</a>
		</div>
		<div style="float:right; padding-top:5px;">
			<?php echo $this->app_model->CariNamaPengguna();?> &rarr;
            <span id="clock"></span>		
		</div>
	</div>
	<!-- awal kiri -->
    <div id="kiri" style="float:left;">
    	<div id="Profil" class="easyui-panel" title="Profil Pengguna" style="float:left;width:130px;height:90px;padding:5px;">
        <a href="<?php echo base_url();?>index.php/foto" title="Edit Foto">
        <img style="float:left;padding:2px;" src="<?php echo base_url();?>asset/foto_profil/<?php echo $this->app_model->CariFotoPengguna();?>" width="50" height="50" align="middle" />
        </a>
        <p style="line-height:15px;">
        <b><?php echo $this->app_model->CariNamaPengguna();?></b><br />
        <a href="<?php echo base_url();?>index.php/profil">Edit Profil</a>
        </p>
        </div>		
        <div class="easyui-accordion" style="float:left;width:130px;">
        	<?php
			if($this->session->userdata('level')=='01'){
        		echo $this->load->view('menu_super');
			}elseif($this->session->userdata('level')=='02'){
				echo $this->load->view('menu_admin');
			}else{
				echo $this->load->view('menu_user');
			}
			?>
		</div>
	</div>       
    <div id="tt" class="easyui-tabs" >
        <div title="<?php echo $judul;?>" style="padding:10px">
		<?php echo $content;?>	
        </div>
    </div>	
			

<div class="panel-header" fit="true" style="height:20px;text-align:center;">	    
Copyright &copy; <?php echo $instansi;?> <?php echo date("Y"); ?>.
</div>
</body>
</html>
