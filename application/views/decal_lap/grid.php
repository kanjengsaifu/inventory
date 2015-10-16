    <style>
        .column1 {
            background-color: #B2CEBC;
            color: white;
        }
        .column1a {
            background-color: #CCDED2;
            color: white;
        }
        .column1b {
            background-color: #E6EFE9;
            color: white;
        }
        .column2 {
            background-color: #005C1F;
            font-weight: bold;
        }
        .column3 {
            background-color: #B2C2F0;
            color: white;
        }
        .column3a {
            background-color: #CCD6F5;
            color: white;
        }
        .column3b {
            background-color: #E6EBFA;
            color: white;    
        }
        .column4 {
            background-color: #0033CC;
            font-weight: bold;
        }
        .column5 {
            background-color: #000000;
            font-weight: bold;
        }
    </style>
<div style='float: left;'>
     <input style="margin-top: 20px;" type="button" id='jqxButton1' value="Check All" />
     <input style="margin-top: 20px;" type="button" id='jqxButton2' value="Uncheck All" />
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
                        { name: 'opkw1kP' , type: 'number' },
                        { name: 'opkw1sP' , type: 'number' },
                        { name: 'opkw1bP' , type: 'number' },
                        { name: 'opkw2kP' , type: 'number' },
                        { name: 'opkw2sP' , type: 'number' },
                        { name: 'opkw2bP' , type: 'number' },
                        { name: 'opkw3kP' , type: 'number' },
                        { name: 'opkw3sP' , type: 'number' },
                        { name: 'opkw3bP' , type: 'number' },
                        { name: 'opkw1kT' , type: 'number' },
                        { name: 'opkw1sT' , type: 'number' },
                        { name: 'opkw1bT' , type: 'number' },
                        { name: 'opkw2kT' , type: 'number' },
                        { name: 'opkw2sT' , type: 'number' },
                        { name: 'opkw2bT' , type: 'number' },
                        { name: 'opkw3kT' , type: 'number' },
                        { name: 'opkw3sT' , type: 'number' },
                        { name: 'opkw3bT' , type: 'number' },
        ],
        url: '<?php echo base_url().'index.php/decal_lap/loadStok'?>'
    };
    
    var cellsrendererx = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
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
        pagesize: 12,
        pageable: true,
        sortable: true,
        columnsresize: true,
        filterable: true,
        showtoolbar: true,
        showstatusbar: true,
        showaggregates: true,
        statusbarheight: 25,
        pagesizeoptions: ['12', '30', '90', '100'],
        columns: [
                        { text: 'Kode',  pinned: false, align: 'center',datafield: 'id', width: 60, pinned: true },
                        { text: 'Nama',  pinned: false, align: 'center',datafield: 'nama', width: 201, pinned: true },
                        { text: 'Buyer',  pinned: false, align: 'center',datafield: 'buyer', width: 100, pinned: true, hidden: true },
                        {
                            cellclassname: 'column5', text: 'Grand <br>Total', align: 'center', editable: false, datafield: 'gtot', width: 80, pinned: true ,
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total1 = parseFloat(rowdata.opkw1kP) + parseFloat(rowdata.opkw1sP)+ parseFloat(rowdata.opkw1bP);
                                var total2 = parseFloat(rowdata.opkw2kP) + parseFloat(rowdata.opkw2sP)+ parseFloat(rowdata.opkw2bP);
                                var total3 = parseFloat(rowdata.opkw3kP) + parseFloat(rowdata.opkw3sP)+ parseFloat(rowdata.opkw3bP);
                                var total4 = parseFloat(rowdata.opkw1kT) + parseFloat(rowdata.opkw1sT)+ parseFloat(rowdata.opkw1bT);
                                var total5 = parseFloat(rowdata.opkw2kT) + parseFloat(rowdata.opkw2sT)+ parseFloat(rowdata.opkw2bT);
                                var total6 = parseFloat(rowdata.opkw3kT) + parseFloat(rowdata.opkw3sT)+ parseFloat(rowdata.opkw3bT);
                                var total = total1+total2+total3+total4+total5+total6;
                                if (total < 100) {
                                    return "<div style='margin: 4px;; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px;; color: #66FF33;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        {
                            cellclassname: 'column2', text: 'Total<br> (pcs)', align: 'center', editable: false, datafield: 'kw1totP', width: 75 , columngroup: 'header1',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total1 = parseFloat(rowdata.opkw1kP) + parseFloat(rowdata.opkw1sP)+ parseFloat(rowdata.opkw1bP);
                                var total2 = parseFloat(rowdata.opkw2kP) + parseFloat(rowdata.opkw2sP)+ parseFloat(rowdata.opkw2bP);
                                var total3 = parseFloat(rowdata.opkw3kP) + parseFloat(rowdata.opkw3sP)+ parseFloat(rowdata.opkw3bP);
                                var total = total1+total2+total3;
                                if (total < 100) {
                                    return "<div style='margin: 4px;; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px;; color: #FFFFFF;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //{ text: 'Total',  align: 'center',datafield: 'kw1totP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'header1',cellsformat: 'd2', width: 60 },
                        { cellclassname: 'column1', text: '[Sml]',  align: 'center',datafield: 'opkw1kP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd1',cellsformat: 'd2', width: 60 },
                        { cellclassname: 'column1', text: '[Med]',  align: 'center',datafield: 'opkw1sP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd1',cellsformat: 'd2', width: 60 },
                        { cellclassname: 'column1', text: '[Big]',  align: 'center',datafield: 'opkw1bP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd1',cellsformat: 'd2', width: 60},
                        {
                            cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'opkw1ksbP', width: 75 , columngroup: 'apd1',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.opkw1kP) + parseFloat(rowdata.opkw1sP)+ parseFloat(rowdata.opkw1bP);
                                if (total < 100) {
                                    return "<div style='margin: 4px;; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px;; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //{ text: 'Sub Total',  align: 'center',columngroup: 'apd1',cellsrenderer: cellsrenderer, datafield: 'opkw1ksbP', cellsalign: 'right', cellsformat: 'd2', width: 90 },
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'opkw2kP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd2',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'opkw2sP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd2',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'opkw2bP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd2',cellsformat: 'd2', width: 60},
                        {
                            hidden: true , cellclassname: 'column1a', text: 'Sub Total', align: 'center', editable: false, datafield: 'opkw2ksbP', width: 75 , columngroup: 'apd2',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.opkw2kP) + parseFloat(rowdata.opkw2sP)+ parseFloat(rowdata.opkw2bP);
                                if (total < 1000) {
                                    return "<div style='margin: 4px;; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px;; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //{ text: 'Sub Total',  align: 'center',columngroup: 'apd2',cellsrenderer: cellsrendererx, datafield: 'opkw2ksbP', cellsalign: 'right', cellsformat: 'd2', width: 90 },
                        { hidden: true , cellclassname: 'column1b', text: '[Sml]',  align: 'center',datafield: 'opkw3kP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd3',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1b', text: '[Med]',  align: 'center',datafield: 'opkw3sP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd3',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1b', text: '[Big]',  align: 'center',datafield: 'opkw3bP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd3',cellsformat: 'd2', width: 60},
                        {
                            hidden: true , cellclassname: 'column1b', text: 'Sub Total', align: 'center', editable: false, datafield: 'opkw3ksbP', width: 75 , columngroup: 'apd3',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.opkw3kP) + parseFloat(rowdata.opkw3sP)+ parseFloat(rowdata.opkw3bP);
                                if (total < 1000) {
                                    return "<div style='margin: 4px;; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px;; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //{ text: 'Sub Total',  align: 'center',columngroup: 'apd3',cellsrenderer: cellsrendererx, datafield: 'opkw3ksbP', cellsalign: 'right', cellsformat: 'd2', width: 90 },
                        {
                            cellclassname: 'column4', text: 'Total', align: 'center', editable: false, datafield: 'kw1totT', width: 75 , columngroup: 'header2',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total1 = parseFloat(rowdata.opkw1kT) + parseFloat(rowdata.opkw1sT)+ parseFloat(rowdata.opkw1bT);
                                var total2 = parseFloat(rowdata.opkw2kT) + parseFloat(rowdata.opkw2sT)+ parseFloat(rowdata.opkw2bT);
                                var total3 = parseFloat(rowdata.opkw3kT) + parseFloat(rowdata.opkw3sT)+ parseFloat(rowdata.opkw3bT);
                                var total = total1+total2+total3;
                                if (total < 100) {
                                    return "<div style='margin: 4px;; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px;; color: #FFFFFF;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //{ text: 'Total',  align: 'center',datafield: 'kw1totT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'header2',cellsformat: 'd2', width: 60 },
                        { cellclassname: 'column3', text: '[Sml]',  align: 'center',datafield: 'opkw1kT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd4',cellsformat: 'd2', width: 60 },
                        { cellclassname: 'column3', text: '[Med]',  align: 'center',datafield: 'opkw1sT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd4',cellsformat: 'd2', width: 60 },
                        { cellclassname: 'column3', text: '[Big]',  align: 'center',datafield: 'opkw1bT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd4',cellsformat: 'd2', width: 60},
                        {
                            cellclassname: 'column3', text: 'Sub Total', align: 'center', editable: false, datafield: 'opkw1ksbT', width: 75 , columngroup: 'apd4',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.opkw1kT) + parseFloat(rowdata.opkw1sT)+ parseFloat(rowdata.opkw1bT);
                                if (total < 100) {
                                    return "<div style='margin: 4px;; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px;; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //{ text: 'Sub Total',  align: 'center',columngroup: 'apd4',cellsrenderer: cellsrendererx, datafield: 'opkw1ksbT', cellsalign: 'right', cellsformat: 'd2', width: 90 },
                        { hidden: true , cellclassname: 'column3a', text: '[Sml]',  align: 'center',datafield: 'opkw2kT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd5',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3a', text: '[Med]',  align: 'center',datafield: 'opkw2sT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd5',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3a', text: '[Big]',  align: 'center',datafield: 'opkw2bT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd5',cellsformat: 'd2', width: 60},
                        {
                            hidden: true , cellclassname: 'column3a', text: 'Sub Total', align: 'center', editable: false, datafield: 'opkw2ksbT', width: 75 , columngroup: 'apd5',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.opkw2kT) + parseFloat(rowdata.opkw2sT)+ parseFloat(rowdata.opkw2bT);
                                if (total < 100) {
                                    return "<div style='margin: 4px;; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px;; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //{ text: 'Sub Total',  align: 'center',columngroup: 'apd5',cellsrenderer: cellsrendererx, datafield: 'opkw2ksbT', cellsalign: 'right', cellsformat: 'd2', width: 90 },
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'opkw3kT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd6',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'opkw3sT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd6',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'opkw3bT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd6',cellsformat: 'd2', width: 60},
                        {
                            hidden: true , cellclassname: 'column3b', text: 'Sub Total', align: 'center', editable: false, datafield: 'opkw3ksbT', width: 75 , columngroup: 'apd6',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.opkw3kT) + parseFloat(rowdata.opkw3sT)+ parseFloat(rowdata.opkw3bT);
                                if (total < 100) {
                                    return "<div style='margin: 4px;; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px;; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //{ text: 'Sub Total',  align: 'center',columngroup: 'apd6',cellsrenderer: cellsrendererx, datafield: 'opkw3ksbT', cellsalign: 'right', cellsformat: 'd2', width: 90 }
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
                        { label: 'Buyer', value: 'buyer', checked: false },
                        { value: 'kw1totP' , label: 'PDtot', checked: true  },
                        { value: 'opkw1kP' , label: 'PKW1sml', checked: true  },
                        { value: 'opkw1sP' , label: 'PKW1med', checked: true  },
                        { value: 'opkw1bP' , label: 'PKW1big', checked: true  },
                        { value: 'opkw1ksbP' , label: 'PKW1subt', checked: true  },
                        { value: 'opkw2kP' , label: 'PKW2sml', checked: false  },
                        { value: 'opkw2sP' , label: 'PKW2med', checked: false  },
                        { value: 'opkw2bP' , label: 'PKW2big', checked: false  },
                        { value: 'opkw2ksbP' , label: 'PKW2subt', checked: false  },
                        { value: 'opkw3kP' , label: 'PKW3sml', checked: false  },
                        { value: 'opkw3sP' , label: 'PKW3med', checked: false  },
                        { value: 'opkw3bP' , label: 'PKW3big', checked: false  },
                        { value: 'opkw3ksbP' , label: 'PKW3subt', checked: false  },
                        { value: 'kw1totT' , label: 'TDtot', checked: true  },
                        { value: 'opkw1kT' , label: 'TKW1sml', checked: true  },
                        { value: 'opkw1sT' , label: 'TKW1med', checked: true  },
                        { value: 'opkw1bT' , label: 'TKW1big', checked: true  },
                        { value: 'opkw1ksbT' , label: 'TKW1subt', checked: true  },
                        { value: 'opkw2kT' , label: 'PKW2sml', checked: false  },
                        { value: 'opkw2sT' , label: 'PKW2med', checked: false  },
                        { value: 'opkw2bT' , label: 'PKW2smlbig', checked: false  },
                        { value: 'opkw2ksbT' , label: 'TKW2subt', checked: false  },
                        { value: 'opkw3kT' , label: 'PKW3sml', checked: false  },
                        { value: 'opkw3sT' , label: 'PKW3med', checked: false  },
                        { value: 'opkw3bT' , label: 'PKW3big', checked: false  },
                        { value: 'opkw3ksbT' , label: 'TKW3subt', checked: false  }
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
    $("#jqxButton1").jqxButton({theme: 'energyblue'});
    $('#jqxButton1').on('click', function () {
       $("#jqxlistbox").jqxListBox('checkAll');
    });
    $("#jqxButton2").jqxButton({theme: 'energyblue'});
    $('#jqxButton2').on('click', function () {
       $("#jqxlistbox").jqxListBox('uncheckAll');
    });
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