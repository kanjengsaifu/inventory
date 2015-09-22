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
                        { name: 'sab' , type: 'float' },
                        { name: 'sas' , type: 'float' },
                        { name: 'gtot' , type: 'float' },
                        { name: 'turun_bgps' , type: 'float' },
                        { name: 'ditarik_supply' , type: 'float' },
                        { name: 'return_prod' , type: 'float' },
                        { name: 'kirim_prod' , type: 'float' },
                        { name: 'stok_bgps' , type: 'float' },
                        { name: 'stok_supply' , type: 'float' },
                        { name: 'total' , type: 'float' },
        ],
        url: '<?php echo base_url().'index.php/glasir/loadStok'?>'
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
        statusbarheight: 25,
        pagesizeoptions: ['13', '30', '90', '100'],
        columns: [
                        { text: 'Kode',  align: 'center',columngroup: 'glasir', datafield: 'id_glasir', width: 50 },
                        { text: 'Nama',  align: 'center',columngroup: 'glasir', datafield: 'nama_glasir', width: 201 },
                        { text: 'BGPS',  align: 'center',columngroup: 'stok', cellsrenderer: cellsrenderer, datafield: 'sab', cellsalign: 'right', cellsformat: 'd2', width: 70 },
                        { text: 'Supply',  align: 'center',columngroup: 'stok', cellsrenderer: cellsrenderer, datafield: 'sas', cellsalign: 'right', cellsformat: 'd2', width: 70 },
                        { text: 'Total',  align: 'center',columngroup: 'stok', cellsrenderer: cellsrenderer, datafield: 'gtot', cellsalign: 'right', cellsformat: 'd2', width: 70 },
                        { text: 'Turun BGPS',  align: 'center',columngroup: 'trans',cellsrenderer: cellsrenderer, datafield: 'turun_bgps', cellsalign: 'right', cellsformat: 'd2', width: 120 },
                        { text: 'Ditarik Supply',  align: 'center',columngroup: 'trans',cellsrenderer: cellsrenderer, datafield: 'ditarik_supply', cellsalign: 'right', cellsformat: 'd2', width: 110 },
                        { text: 'Return Glasir',  align: 'center',columngroup: 'trans',cellsrenderer: cellsrenderer, datafield: 'return_prod', cellsalign: 'right', cellsformat: 'd2', width: 110 },
                        { text: 'Kirim Glasir',  align: 'center',columngroup: 'trans', cellsrenderer: cellsrenderer, datafield: 'kirim_prod', cellsalign: 'right', cellsformat: 'd2', width: 110 },
                        { text: 'BGPS',  align: 'center',datafield: 'stok_bgps', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'stg',cellsformat: 'd2', width: 75 },
                        { text: 'Supply',  align: 'center',datafield: 'stok_supply', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'stg',cellsformat: 'd2', width: 75 },
                        { text: 'Total',  align: 'center',datafield: 'total', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'stg',cellsformat: 'd2', width: 80 }
        ],
        columngroups: [
                    { text: 'Glasir', align: 'center', name: 'glasir' },
                    { text: 'Stok Awal (Kilogram)', align: 'center', name: 'stok' },
                    { text: 'Transaksi Glasir (Kilogram)', align: 'center', name: 'trans' },
                    { text: 'Stok Glasir (Kilogram)', align: 'center', name: 'stg' }
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