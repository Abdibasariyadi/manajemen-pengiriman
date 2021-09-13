@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <a href="{{ url('admin/coa') }}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a>

                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                   <div class="col-md-8 col-md-offset-2 col-xs-12">
                       <form role="form" method="post" action="{{url('admin/coa/'.$dt->id)}}">
                        @csrf
                        {{ method_field('PUT') }}
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Kategori COA</label>
                              <select class="form-control" name="category_id" required="">
                                @foreach($kategoris as $kt)
                                <option value="{{$kt->id}}" {{ ($dt->category_id == $kt->id) ? 'selected' : '' }}>{{$kt->nama}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">No COA</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="No COA" name="no_coa" autocomplete="off" required="" value="{{$dt->no_coa}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Nama</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="nama" autocomplete="off" required="" value="{{$dt->nama}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Saldo Normal</label>
                              <select class="form-control" name="saldo_normal" required="">
                                <option value="debit" {{ ($dt->saldo_normal == 'debit') ? 'selected' : '' }}>debit</option>
                                <option value="credit" {{ ($dt->saldo_normal == 'credit') ? 'selected' : '' }}>credit</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Status</label>
                              <select class="form-control" name="is_active" required="">
                                  <option value="1" {{ ($dt->is_active == 1) ? 'selected' : '' }}>Aktif</option>
                                  <option value="2" {{ ($dt->is_active != 1) ? 'selected' : '' }}>Tidak Aktif</option>
                              </select>
                            </div>
                          </div>
                          <!-- /.box-body -->
             
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                        </form>

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
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection