@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{url('admin/users/create')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>

                    <a href="{{url('admin/users/create')}}" class="btn btn-sm btn-flat btn-success btn-filter"><i class="fa fa-filter"></i> Filter By Role</a>
                </p>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <center>
                    <p style="color: red;">
                      <b><i>
                        Data users yang sudah ngelink / sudah di pakai untuk transaksi tidak dapat dihapus, Relasi (Restrict)
                      </i></b>
                    </p>
                  </center>
                </div>
              </div>
               <div class="table-responsive">
                   <table class="table tbl-users">
                       <thead>
                           <tr>
                                <th>Action</th>
                                <th>Cabang</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Role</th>
                               <th>No WA</th>
                               <th>Kelamin</th>
                               <th>Alamat</th>
                               <th>Created At</th>
                               <th>Updated At</th>
                           </tr>
                       </thead>
                   </table>
               </div>
            </div>
        </div>
    </div>
</div>

<!-- modal filter -->
<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
  <div class="modal-content bg-gradient-danger">

    <div class="modal-header">
      <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>

    <div class="modal-body">

      <form role="form" method="get" action="{{url('admin/users/filter')}}">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Select Role</label>
            <select class="form-control" name="role_id" required="">
              <option selected="" disabled="">Select Role</option>
              @foreach($roles as $rl)
              <option value="{{$rl->id}}">{{$rl->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>

  </div>
</div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){

        $('.btn-filter').click(function(e){
          e.preventDefault();
          $('#modal-filter').modal();
        })

        $('.tbl-users').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{$yajra}}",
            columns: [
                // or just disable search since it's not really searchable. just add searchable:false
                {data: 'action', name: 'action'},
                {data: 'cabang.nama', name: 'cabang.nama'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role.nama', name: 'role.nama'},
                {data: 'no_telp', name: 'no_telp'},
                {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                {data: 'alamat', name: 'alamat'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'}
            ]
        });
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        });
 
    })
</script>
 
@endsection