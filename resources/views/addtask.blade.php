@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">{{ __('Dashboard') }}</div>
                        <div class="col-md-3">Welcome,{{ Auth::user()->name }}</div>
                    </div>
                </div>
  
                <div class="card-body">
                    
                    <div class="container">
                        <div class="row ">
                            <div class="col-lg-12 mx-auto">
                                <div class="card mt-2 mx-auto p-4 bg-light">
                                    <div class="card-body bg-light">
                            
                                    <div class = "container">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h3 >Todo Task</h3>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="{{'dashboard'}}" class="btn btn-primary btn-sm"> >> Back</a>
                                            </div>

                                        </div>
                                        <hr>
                                        <form action="" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" id="userid" value="{{ Auth::user()->id }}">
                                            <div class="controls">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="form_name">Task Name *</label>
                                                            <input id="task" type="text" name="task" class="form-control" placeholder="Please enter your taskname *" required="required" data-error="Firstname is required.">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="status">Status (optional)</label>
                                                            <select id="status" name="staus" class="form-control" required="required" data-error="Please specify your status.">
                                                                <option value="" selected disabled>--Select Your Status--</option>
                                                                <option value="Pending">Pending</option>
                                                                <option value="Done">Done</option>
                                                            </select>   
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">        
                                                        <input type="submit" class="btn btn-success btn-send  pt-2 btn-block" value="Submit" href="javascript::void(0)" onclick="createtask()">
                                                    </div>
                                        
                                                </div>


                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function createtask(){
        let userid = $('#userid').val();
        let task = $('#task').val();
        let status = $('#status').val();
        
        let url = window.location.origin + '/api/todo/add/'+task+'/'+userid;
        // alert(url);
        // console.log(url);
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            headers: {
                'api_key': 'helloatg'
            },
            contentType: 'application/json; charset=utf-8',
            success: function (result) {
               if(result.status == 1){
                    alert(result.message);
                    window.location= window.location.origin + '/dashboard'; 

               }
            },
            error: function (error) {
                
            }
        });
    }

</script>