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
                        <div class="row">
                            <div class="col-md-offset-1 col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12">
                                                <a href="{{'addtask'}}" class="btn btn-sm btn-primary pull-left"><i class="fa fa-plus-circle"></i> Add New</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <!-- <th>Status</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php $count=1; @endphp

                                            @foreach( $data as $user) 
                                                    <td>{{$count++}}</td>
                                                    <td>{{$user->task}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <select id="status" class="btn btn-secondary dropdown-toggle form-select" data-bs-toggle="dropdown" aria-expanded="false" aria-label="select example" href="javascript::void(0)" onchange="updatestatus(<?= $user->id; ?>)" >
                                                                <option value="Pending" {{$user->status == "Pending"  ? 'selected' : ''}}>Pending</option>
                                                                <option value="Done" {{$user->status == "Done"  ? 'selected' : ''}}>Done</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function updatestatus(taskid){
        let status = $('#status').val();
        
        let url = window.location.origin + '/api/todo/status/'+taskid+'/'+status;

        console.log(url);
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
               }
            },
            error: function (error) {
                
            }
        });
    }

</script>