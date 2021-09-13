@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <a href="{{ url('admin/coa-category/create') }}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>

                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                   <div class="col-md-12 col-xs-12">
                    <div class="table-responsive">
                      <table class="table tbl-coa">
                        <thead>
                          <tr>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Nama</th>
                            <th>Cabang</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){

      $('.tbl-coa').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{$yajra}}",
        columns: [
            // or just disable search since it's not really searchable. just add searchable:false
            {data: 'action', name: 'action'},
            {data: 'status', name: 'status'},
            {data: 'nama', name: 'nama'},
            {data: 'cabang.nama', name: 'cabang.nama'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'dibuat_oleh.name', name: 'dibuat_oleh.name'},
            {data: 'diupdate_oleh.name', name: 'diupdate_oleh.name'},
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
 
@endsection