@extends('layouts.app')
@section('content')

    @include('admin_dashboard.page_name')
                <div class="card-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('/districts'); !!}">Districts</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
                    </ol>
                </div>
                <div class="card-body">
                	<form id="save_district_name" method="POST">
                		<div class="alert alert-danger print-error-msg" style="display:none">
			            	<ul></ul>
			            </div>
                		{{ csrf_field() }}
                		<div class="table-responsive">
			                <table class="table" id="dynamic_field">  
			                    <tr>  
			                        <td><input type="text" name="name[]" placeholder="Enter district name" class="form-control name_list" /></td>  
			                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
			                    </tr>  
			                </table>  
			            </div>
			            <div class="form-group row">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary">Add</button>
							</div>
						</div>
                	</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    	var postURL = "{{ url('save_district') }}";
    	var redirectURL = "{{ url('districts') }}";
    	var i=1;
    	$('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter district name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      	});  


      	$('body').on('click', '.btn_remove', function(){  
        	var button_id = $(this).attr("id");   
        	$('#row'+button_id+'').remove();  
      	});

      	$('body').on('submit','#save_district_name', function(e){
      		e.preventDefault();
      		$.ajax({  
                url:postURL,
                method:"POST",  
                data:$('#save_district_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    console.log(data);
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        window.location.href = redirectURL;
                    }
                },
                error: function( json )
	            {
	                if(json.status === 422) {
	                    var errors = json.responseJSON;
	                    $(".print-error-msg").find("ul").html('');
						$(".print-error-msg").css('display','block');
						$(".print-success-msg").css('display','none');
	                    $.each(json.responseJSON.errors, function (key, value) {
	                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
	                    });
	                } else {
	                    
	                }
	            }
           	});
		});
		function printErrorMsg (msg) {
			$(".print-error-msg").find("ul").html('');
			$(".print-error-msg").css('display','block');
			$(".print-success-msg").css('display','none');
			$.each( msg, function( key, value ) {
				$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
			});
		}
    });
</script>
@endsection