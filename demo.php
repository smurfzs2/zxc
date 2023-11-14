<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
<table id="tblUser">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Last Name</th>
            <th>Birthday</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Department</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Full Name</th>
            <th>Last Name</th>
            <th>Birthday</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Department</th>
        </tr>
    </tfoot>
</table>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    var dataTable = $('#mainTableId').DataTable( {
        "processing"    : true,
        "ordering"      : false,
        "serverSide"    : true,
        "bInfo" 		: false,
        "ajax": {
            url     :"server_processing.php", // json datasource
            type    : "post",  // method  , by default get
            data    : {
                        "sql"   	    : "<?php echo $query ?>"
                        },
            error: function(data){  // error handling
                
                $(".mainTableId-error").html("");
                $("#mainTableId").append('<tbody class="mainTableId-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#mainTableId_processing").css("display","none");
                
            }
        },
        "createdRow": function( row, data, index ) {},
        "columnDefs": [],
        fixedColumns:   {
                leftColumns: 0
        },

        paging: true,
        deferRender:    true,
        
        scrollY     	: 350,
        scrollCollapse	: false,
        scroller    	: {
            loadingIndicator    : true
        },
        
    });
} );
</script>