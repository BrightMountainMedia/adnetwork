@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="panel panel-default">
	            <div class="panel-heading">User Roles</div>

	            <div class="panel-body">
	                <ul class="list-group">
	                    @foreach ($roles as $role)
	                    <li class="list-group-item">
	                        {{ $role->role }}

	                        {!! Form::open(array('url' => '/admin/add-user-role/'.$role->id, 'class' => 'form')) !!}
		                    <button class="btn btn-link remove pull-right" name="form1"><i class="fa fa-fw fa-btn fa-close"></i></button>
		                    {!! Form::close() !!}
	                    </li>
	                    @endforeach
	                </ul>
	            </div>
	        </div>

        	<div class="panel panel-default">
                <div class="panel-heading">Add Role</div>

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                          {{Session::get('success')}}
                        </div>
                    @endif

                    {!! Form::open(array('route' => 'role.store', 'class' => 'form')) !!}

                    <!-- User Role -->
                    <div class="form-group{{ $errors->has('role') ? ' has-error' : ''}}">
                        {!! Form::text('role', null, array('required', 'class'=>'form-control', 'placeholder'=>'User Role')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Add Role', 
                          array('class'=>'btn btn-primary', 'name'=>'form2')) !!}
                    </div>

                    {!! Form::close() !!}

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection