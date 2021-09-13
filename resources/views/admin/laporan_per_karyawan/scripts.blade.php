<script type="text/javascript">
    $(document).ready(function(){

        $('.btn-filter').click(function(e){
            e.preventDefault();
            $('.form-filter').toggle();
        })

        $('.tbl-karyawan').DataTable({
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
                {data: 'name', name: 'name'},
                {data: 'belum_dibayar', name: 'belum_dibayar'},
                {data: 'nilai_belum_dibayar', name: 'nilai_belum_dibayar'},
                {data: 'sudah_dibayar', name: 'sudah_dibayar'},
                {data: 'nilai_sudah_dibayar', name: 'nilai_sudah_dibayar'},
                {data: 'menunggu_dikerjakan', name: 'menunggu_dikerjakan'},
                {data: 'nilai_menunggu_dikerjakan', name: 'nilai_menunggu_dikerjakan'},
                {data: 'sedang_dikerjakan', name: 'sedang_dikerjakan'},
                {data: 'nilai_sedang_dikerjakan', name: 'nilai_sedang_dikerjakan'},
                {data: 'sedang_selesai', name: 'sedang_selesai'},
                {data: 'nilai_selesai', name: 'nilai_selesai'}
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