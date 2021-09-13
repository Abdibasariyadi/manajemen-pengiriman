<script type="text/javascript">
    $(document).ready(function(){

        $('body').on('click','.btn-hapus-line',function(e){
            e.preventDefault();
            $(this).closest('tr').remove();
        })

    	$('.btn-add-line').click(function(e){
    		e.preventDefault();
    		var nilai = '';

    		nilai += '<tr>';

    			nilai += '<td>';
    				nilai += '<select class="form-control select2" name="coa_id_line[]" required="">';
    					nilai += '<option selected="" disabled="">Pilih COA</option>';
    					@foreach($coas as $co)
    					nilai += '<option value="{{$co->id}}">{{$co->nama}}</option>';
    					@endforeach
    				nilai += '</select>';
    			nilai += '</td>';

    			nilai += '<td>';
    				nilai += '<input type="number" name="nominal[]" class="form-control" required="">';
    			nilai += '</td>';

    			nilai += '<td>';
    				nilai += '<input type="text" name="note_line[]" class="form-control">';
    			nilai += '</td>';

    			nilai += '<td>';
    				nilai += '<button class="btn btn-xs btn-danger btn-hapus-line"><i class="fa fa-trash"></i></button>';
    			nilai += '</td>';

    		nilai += '</tr>';

    		$('#lines').append(nilai);
    	});
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>