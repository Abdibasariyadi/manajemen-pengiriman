<script id="details-template" type="text/x-handlebars-template">
    <div class="label label-info">User @{{ id }}'s Posts</div>
    <table class="table details-table" id="posts-@{{id}}">
        <thead>
            <tr>
                <th>Coa</th>
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
            </tr>
        </thead>
    </table>
</script>

<script type="text/javascript">
    $(document).ready(function(){

    	var template = Handlebars.compile($("#details-template").html());

    	var table = $('.tbl-jurnal').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: "{{$yajra}}",
	        columns: [
	            // or just disable search since it's not really searchable. just add searchable:false
	            {
	                "className":      'details-control',
	                "orderable":      false,
	                "searchable":     false,
	                "data":           null,
	                "defaultContent": '<button class="btn btn-xs btn-flat btn-success"><i class="fa fa-plus"></i></button>'
	            },
	            {data: 'ledger_number', name: 'ledger_number'},
	            {data: 'tanggal', name: 'tanggal'},
	            {data: 'total_debit', name: 'total_debit'},
	            {data: 'total_credit', name: 'total_credit'},
	            {data: 'ref_no', name: 'ref_no'},
	            {data: 'dibuat_oleh.name', name: 'dibuat_oleh.name'},
                {data: 'created_at', name: 'created_at'},
	            {data: 'cabang.nama', name: 'cabang.nama'}
	        ]
	    });

	    // Add event listener for opening and closing details
        $('.tbl-jurnal').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableId = 'posts-' + row.data().id;
 
            if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });
 
        function initTable(tableId, data) {
            $('#' + tableId).DataTable({
                processing: true,
                serverSide: true,
                ajax: data.details_url,
                columns: [
                { data: 'coa.nama', name: 'coa.nama' },
                { data: 'description', name: 'description' },
                { data: 'debit', name: 'debit' },
                { data: 'credit', name: 'credit' },
               
                ]
            })
        }
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>