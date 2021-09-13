@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{url('admin/role/create')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                </p>
            </div>
            <div class="box-body">
               <div class="table-responsive">
                   <table class="table myTable">
                       <thead>
                           <tr>
                                <th>Action</th>
                                <th>Manage Role</th>
                               <th>Nama</th>
                               <th>Created At</th>
                               <th>Updated At</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($data as $dt)
                           <tr>
                                <td>
                                    <div style="width:60px">
                                        <a href="{{url('admin/role/'.$dt->id)}}" id-supplier="'.$id.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a>

                                        <button href="{{url('admin/role/'.$dt->id)}}" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </td>
                                <td>
                                   <a href="{{url('admin/role/permission/'.$dt->id)}}" class="btn btn-success btn-xs btn-edit" id="edit"><i class="fa fa-check"></i> Manage Permissions</a>
                                </td>
                               <td>{{$dt->nama}}</td>
                               <td>{{ date('d M Y H:i:s',strtotime($dt->created_at)) }}</td>
                               <td>{{ date('d M Y H:i:s',strtotime($dt->updated_at)) }}</td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
               </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection
