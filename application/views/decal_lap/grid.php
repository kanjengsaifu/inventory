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
                        { name: 'id' , type: 'string' },
                        { name: 'nama' , type: 'string' },
                        { name: 'buyer' , type: 'string' },
                        { name: 'kw1totP' , type: 'number' },
                        { name: 'opkw1kP' , type: 'number' },
                        { name: 'opkw1sP' , type: 'number' },
                        { name: 'opkw1bP' , type: 'number' },
                        { name: 'opkw1ksbP' , type: 'number' },
                        { name: 'opkw2kP' , type: 'number' },
                        { name: 'opkw2sP' , type: 'number' },
                        { name: 'opkw2bP' , type: 'number' },
                        { name: 'opkw2ksbP' , type: 'number' },
                        { name: 'opkw3kP' , type: 'number' },
                        { name: 'opkw3sP' , type: 'number' },
                        { name: 'opkw3bP' , type: 'number' },
                        { name: 'opkw3ksbP' , type: 'number' },
                        { name: 'kw1totT' , type: 'number' },
                        { name: 'opkw1kT' , type: 'number' },
                        { name: 'opkw1sT' , type: 'number' },
                        { name: 'opkw1bT' , type: 'number' },
                        { name: 'opkw1ksbT' , type: 'number' },
                        { name: 'opkw2kT' , type: 'number' },
                        { name: 'opkw2sT' , type: 'number' },
                        { name: 'opkw2bT' , type: 'number' },
                        { name: 'opkw2ksbT' , type: 'number' },
                        { name: 'opkw3kT' , type: 'number' },
                        { name: 'opkw3sT' , type: 'number' },
                        { name: 'opkw3bT' , type: 'number' },
                        { name: 'opkw3ksbT' , type: 'number' }
        ],
        url: '<?php echo base_url().'index.php/decal_lap/loadStok'?>'
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
        pagesize: 13,
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
                        { text: 'Kode',  pinned: false, align: 'center',datafield: 'id', width: 60, pinned: true },
                        { text: 'Nama',  pinned: false, align: 'center',datafield: 'nama', width: 201, pinned: true },
                        { text: 'Buyer',  pinned: false, align: 'center',datafield: 'buyer', width: 100, pinned: true },
                        { text: 'Total',  align: 'center',datafield: 'kw1totP', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'header1',cellsformat: 'd2', width: 60 },
                        { text: '[Sml]',  align: 'center',datafield: 'opkw1kP', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd1',cellsformat: 'd2', width: 60 },
                        { text: '[Med]',  align: 'center',datafield: 'opkw1sP', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd1',cellsformat: 'd2', width: 60 },
                        { text: '[Big]',  align: 'center',datafield: 'opkw1bP', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd1',cellsformat: 'd2', width: 60},
                        { text: 'Sub Total',  align: 'center',columngroup: 'apd1',cellsrenderer: cellsrenderer, datafield: 'opkw1ksbP', cellsalign: 'right', cellsformat: 'd2', width: 90 },
                        { text: '[Sml]',  align: 'center',datafield: 'opkw2kP', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd2',cellsformat: 'd2', width: 60 },
                        { text: '[Med]',  align: 'center',datafield: 'opkw2sP', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd2',cellsformat: 'd2', width: 60 },
                        { text: '[Big]',  align: 'center',datafield: 'opkw2bP', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd2',cellsformat: 'd2', width: 60},
                        { text: 'Sub Total',  align: 'center',columngroup: 'apd2',cellsrenderer: cellsrenderer, datafield: 'opkw2ksbP', cellsalign: 'right', cellsformat: 'd2', width: 90 },
                        { text: '[Sml]',  align: 'center',datafield: 'opkw3kP', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd3',cellsformat: 'd2', width: 60 },
                        { text: '[Med]',  align: 'center',datafield: 'opkw3sP', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd3',cellsformat: 'd2', width: 60 },
                        { text: '[Big]',  align: 'center',datafield: 'opkw3bP', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd3',cellsformat: 'd2', width: 60},
                        { text: 'Sub Total',  align: 'center',columngroup: 'apd3',cellsrenderer: cellsrenderer, datafield: 'opkw3ksbP', cellsalign: 'right', cellsformat: 'd2', width: 90 },
                        { text: 'Total',  align: 'center',datafield: 'kw1totT', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'header2',cellsformat: 'd2', width: 60 },
                        { text: '[Sml]',  align: 'center',datafield: 'opkw1kT', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd4',cellsformat: 'd2', width: 60 },
                        { text: '[Med]',  align: 'center',datafield: 'opkw1sT', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd4',cellsformat: 'd2', width: 60 },
                        { text: '[Big]',  align: 'center',datafield: 'opkw1bT', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd4',cellsformat: 'd2', width: 60},
                        { text: 'Sub Total',  align: 'center',columngroup: 'apd4',cellsrenderer: cellsrenderer, datafield: 'opkw1ksbT', cellsalign: 'right', cellsformat: 'd2', width: 90 },
                        { text: '[Sml]',  align: 'center',datafield: 'opkw2kT', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd5',cellsformat: 'd2', width: 60 },
                        { text: '[Med]',  align: 'center',datafield: 'opkw2sT', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd5',cellsformat: 'd2', width: 60 },
                        { text: '[Big]',  align: 'center',datafield: 'opkw2bT', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd5',cellsformat: 'd2', width: 60},
                        { text: 'Sub Total',  align: 'center',columngroup: 'apd5',cellsrenderer: cellsrenderer, datafield: 'opkw2ksbT', cellsalign: 'right', cellsformat: 'd2', width: 90 },
                        { text: '[Sml]',  align: 'center',datafield: 'opkw3kT', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd6',cellsformat: 'd2', width: 60 },
                        { text: '[Med]',  align: 'center',datafield: 'opkw3sT', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd6',cellsformat: 'd2', width: 60 },
                        { text: '[Big]',  align: 'center',datafield: 'opkw3bT', cellsrenderer: cellsrenderer, cellsalign: 'right', columngroup: 'apd6',cellsformat: 'd2', width: 60},
                        { text: 'Sub Total',  align: 'center',columngroup: 'apd6',cellsrenderer: cellsrenderer, datafield: 'opkw3ksbT', cellsalign: 'right', cellsformat: 'd2', width: 90 }
        ],
        columngroups: [
                    { text: 'Area Produksi Decal', align: 'center', name: 'header1' },
                    { text: 'Stok Awal [KW 1]', align: 'center', name: 'apd1' , parentgroup: 'header1'},
                    { text: 'Stok Awal [KW 2]', align: 'center', name: 'apd2' , parentgroup: 'header1'},
                    { text: 'Stok Awal [KW 3]', align: 'center', name: 'apd3' , parentgroup: 'header1'},
                    { text: 'Area Transit Decal', align: 'center', name: 'header2' },
                    { text: 'Stok Awal [KW 1]', align: 'center', name: 'apd4' , parentgroup: 'header2'},
                    { text: 'Stok Awal [KW 2]', align: 'center', name: 'apd5' , parentgroup: 'header2'},
                    { text: 'Stok Awal [KW 3]', align: 'center', name: 'apd6' , parentgroup: 'header2'}
                ]
    });
    var listSource = [  { label: 'Kode', value: 'id', checked: true }, 
                        { label: 'Nama', value: 'nama', checked: true }, 
                        { label: 'Buyer', value: 'buyer', checked: true },
                        { value: 'kw1totP' , label: 'PDtot', checked: true  },
                        { value: 'opkw1kP' , label: 'PKW1sml', checked: true  },
                        { value: 'opkw1sP' , label: 'PKW1med', checked: true  },
                        { value: 'opkw1bP' , label: 'PKW1big', checked: true  },
                        { value: 'opkw1ksbP' , label: 'PKW1subt', checked: true  },
                        { value: 'opkw2kP' , label: 'PKW2sml', checked: true  },
                        { value: 'opkw2sP' , label: 'PKW2med', checked: true  },
                        { value: 'opkw2bP' , label: 'PKW2big', checked: true  },
                        { value: 'opkw2ksbP' , label: 'PKW2subt', checked: true  },
                        { value: 'opkw3kP' , label: 'PKW3sml', checked: true  },
                        { value: 'opkw3sP' , label: 'PKW3med', checked: true  },
                        { value: 'opkw3bP' , label: 'PKW3big', checked: true  },
                        { value: 'opkw3ksbP' , label: 'PKW3subt', checked: true  },
                        { value: 'kw1totT' , label: 'TDtot', checked: true  },
                        { value: 'opkw1kT' , label: 'TKW1sml', checked: true  },
                        { value: 'opkw1sT' , label: 'TKW1med', checked: true  },
                        { value: 'opkw1bT' , label: 'TKW1big', checked: true  },
                        { value: 'opkw1ksbT' , label: 'TKW1subt', checked: true  },
                        { value: 'opkw2kT' , label: 'PKW2sml', checked: true  },
                        { value: 'opkw2sT' , label: 'PKW2med', checked: true  },
                        { value: 'opkw2bT' , label: 'PKW2smlbig', checked: true  },
                        { value: 'opkw2ksbT' , label: 'TKW2subt', checked: true  },
                        { value: 'opkw3kT' , label: 'PKW3sml', checked: true  },
                        { value: 'opkw3sT' , label: 'PKW3med', checked: true  },
                        { value: 'opkw3bT' , label: 'PKW3big', checked: true  },
                        { value: 'opkw3ksbT' , label: 'TKW3subt', checked: true  }
                        ];
    $("#jqxlistbox").jqxListBox({ 
                        source: listSource, 
                        width: 140, 
                        height: 490,  
                        checkboxes: true });
                        
    $("#jqxlistbox").on('checkChange', function (event) {
                $("#jqxgrid").jqxGrid('beginupdate');
                if (event.args.checked) {
                    $("#jqxgrid").jqxGrid('showcolumn', event.args.value);
                }
                else {
                    $("#jqxgrid").jqxGrid('hidecolumn', event.args.value);
                }
                $("#jqxgrid").jqxGrid('endupdate');
            });
            
    $("#excelExport").jqxButton();
    $("#excelExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'Data Stok Decal');           
            });
});
</script>
</div>
<table width="100%">
<tr>
<td valign="top" width="10%">
   <div id="jqxlistbox"></div>
</td>
<td valign="top" width="90%">
    <div id="jqxgrid"></div>
</td>
</tr>
</table> 