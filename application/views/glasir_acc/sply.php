<div style='float: left;'>
    <input type="button" value="Export to Excel" id='excelExport' />
</div>
<div id="gird" style="float:left; width:100%;">
<script type="text/javascript">
    $(document).ready(function () {
    // prepare the data
    var source ={
        datatype: "json",
        datafields: [
                        { name: 'id_glasir' , type: 'string' },
                        { name: 'nama_glasir' , type: 'string' },
                        { name: 'P1' , type: 'number' }, 
                        { name: 'P2' , type: 'number' }, 
                        { name: 'P3' , type: 'number' },
                        { name: 'P4' , type: 'number' },
                        { name: 'status' , type: 'string' },
        ],
        url: '<?php echo base_url().'index.php/glasir/loadAccSply'?>'
    };
    
    var cellsrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                if (value < 20) {
                    return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + value + '</span>';
                }
                else {
                    return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #008000;">' + value + '</span>';
                }
            }
    
    $("#jqxgrid").jqxGrid({
        width: '100%',
        height: 490,
        source: source, 
        pagesize: 14,
        pageable: true,
        sortable: true,
        columnsresize: true,
        filterable: true,
        showtoolbar: true,
        showstatusbar: true,
        showaggregates: true,
        statusbarheight: 25,
        pagesizeoptions: ['13', '30', '90', '100'],
        columns: [
                        { text: 'Kode',  pinned: true, align: 'center', datafield: 'id_glasir', width: 50 },
                        { text: 'Nama',  pinned: true, align: 'center', datafield: 'nama_glasir', width: 201 },
                        { text: 'Periode 1',  columngroup: 'stg',cellsformat: 'c2', align: 'rigt', cellsrenderer: cellsrenderer, cellsalign: 'right', datafield: 'P1', width: 80 },
                        { text: 'Periode 2',  columngroup: 'stg',cellsformat: 'c2', align: 'rigt', cellsrenderer: cellsrenderer, cellsalign: 'right', datafield: 'P2', width: 80 },
                        { text: 'Periode 3',  columngroup: 'stg',cellsformat: 'c2', align: 'rigt', cellsrenderer: cellsrenderer, cellsalign: 'right', datafield: 'P3', width: 80 },
                        { text: 'Periode 4',  columngroup: 'stg',cellsformat: 'c2', align: 'rigt', cellsrenderer: cellsrenderer, cellsalign: 'right', datafield: 'P4', width: 80 },
                        { text: 'Status',  align: 'center', datafield: 'status', width: 50 }    
        ],
        columngroups: [
                    { text: 'Akurasi Glaze Tiap Periode (%)', align: 'center', name: 'stg' }
                ]
    });
    $("#excelExport").jqxButton();
    $("#excelExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'Data Stok Inventory Glasir');           
            });
});
</script>
<div id="jqxgrid"></div>
</div>