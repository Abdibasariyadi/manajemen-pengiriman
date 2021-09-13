<script type="text/javascript">
    $(document).ready(function(){

        var ids = [];

        $('.btn-filter').click(function(e){
            e.preventDefault();
            $('.form-filter').fadeToggle();
        })

        $('.btn-verif').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'post',
                dataType:'json',
                url:"{{url('admin/income/verif')}}",
                data:{
                    data:ids
                },
                success:function(data){
                    console.log(data);
                    location.reload();
                },
                error:function(a,b,c){
                    alert(c);
                }
            })
        })

        $('body').on('click','.check-income-all',function(e){
            ids=[];
            if($(this).is(':checked')){
                 $('.check-income').each(function(i,v){
                    var nilai = $(this).val();
                    $(this).prop('checked', true);
                    ids.push(nilai)
                 })
            }else{
                 $('.check-income').each(function(i,v){
                    $(this).prop('checked', false);
                 })
                 ids=[];
            }
        });

        $('body').on('click','.check-income',function(e){
            ids=[];
             $('.check-income').each(function(i,ee){
                if($(this).is(':checked')){
                     var nilai = $(this).val();
                    ids.push(nilai);
                }else{
                     // $('.sku').fadeIn();
                }
             });

            // alert(ids);
        });

        $('.tbl-income').DataTable({
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
                {data: 'status', name: 'status', searchable:false, orderable:false},
                {data: 'action', name: 'action', searchable:false, orderable:false},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'ref_no', name: 'ref_no'},
                {data: 'coa.nama', name: 'coa.nama'},
                {data: 'note', name: 'note'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'dibuat_oleh.name', name: 'dibuat_oleh.name'},
                {data: 'diupdate_oleh.name', name: 'diupdate_oleh.name'}
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