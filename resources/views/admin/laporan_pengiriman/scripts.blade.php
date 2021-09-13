<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-filter').click(function(e){
    		e.preventDefault();
    		$('.div-filter').toggle();
    	})

        $("input[name='all_user']").click(function(e){

        if($(this).is(':checked')){
            // $('.sku').fadeOut();
            $("select[name='user_id']").empty();
            var hasil = '<option value="all">All</option>';
            // alert('checked');
            $("select[name='user_id']").append(hasil);
        }else{
            $("select[name='user_id']").empty();
            var hasil = '<option value="all">All</option>';
            // alert('checked');
            $("select[name='user_id']").append(hasil);
        }
        });

        $('.cari-user').select2({
        placeholder: 'Cari User...',
        ajax: {
        url: "{{ url('laporan/pengiriman/get-user') }}",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
            results:  $.map(data, function (item) {
                return {
                text: item.name,
                id: item.id
                }
            })
            };
        },
        cache: true
        }
        });

        $('.tbl-pengiriman').DataTable({
            dom: 'lBfrtip',
            button: [
            'excel'
            ],
            "lengthMenu": [
                [ 10, 25, 50, 100, 1000, -1 ],
                [ '10 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'All' ]
            ],
            processing: true,
            serverSide: true,
            ajax: "{{$yajra}}",
            columns: [
                // or just disable search since it's not really searchable. just add searchable:false
                {data: 'action', name: 'action', searchable:false, orderable:false},
                // {data: 'status', name: 'status'},
                {data: 'name', name: 'name'},
                {data: 'nama_penerima', name: 'nama_penerima'},
                {data: 'alamat', name: 'alamat'},
                {data: 'no_hp', name: 'no_hp'},
                {data: 'olshop', name: 'olshop'},
                {data: 'penjemput', name: 'penjemput'},
                {data: 'dana_talangan', name: 'dana_talangan'},
                {data: 'ongkir', name: 'ongkir'},
                {data: 'total_tagihan', name: 'total_tagihan'},
                {data: 'created_at', name: 'created_at', render: function (data, type, row) {
                    return moment(new Date(data).toString()).format('DD/MM/YYYY HH:mm');
                    }
                },
                {data: 'keterangan', name: 'keterangan'}
            ]
        });

        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })

    })
</script>
