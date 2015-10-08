<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/decal/tambah">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
</a>
<a href="<?php echo base_url();?>index.php/decal">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div id="gird" style="float:left; width:100%;">
<script type="text/javascript">
    $(document).ready(function () {
    // prepare the data
    var source ={
        datatype: "json",
        datafields: [
                        { name: 'id' },
                        { name: 'jenis' },
                        { name: 'buyer' },
                        { name: 'nama' },
                        { name: 'alias' },
                        { name: 'item' },
                        { name: 'dekorasi' },
                        { name: 'shape' }
        ],
        url: '<?php echo base_url().'index.php/decal/ldg'?>'
    };
    $("#jqxgrid").jqxGrid({
        width: '100%',
        height: 480,
        source: source,
        editable: true,
        pagesize: 15,
        pageable: true,
        sortable: true,
        columnsresize: true,
        filterable: true,
        showtoolbar: true,
        showstatusbar: true,
        statusbarheight: 25,
        pagesizeoptions: ['15', '30', '90', '100'],
        columns: [
                        { text: 'ID', datafield: 'id', width: 60 },
                        { text: 'Jenis', datafield: 'jenis', width: 100 },
                        { text: 'Buyer', datafield: 'buyer', width: 200 },
                        { text: 'Nama Decal', datafield: 'nama', width: 200 },
                        { text: 'Nama Alias', datafield: 'alias', width: 100 },
                        { text: 'Item', datafield: 'item', width: 200 },
                        { text: 'Dekorasi', datafield: 'dekorasi', width: 100 },
                        { text: 'Shape', datafield: 'shape', width: 160 }
        ]
    });
});
</script>
<div id="jqxgrid"></div>
</div>
</div>