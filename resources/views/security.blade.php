@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="panel panel-default">
                <div class="panel-heading">Update Password</div>

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                          {{Session::get('success')}}
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                          {{Session::get('error')}}
                        </div>
                    @endif

                    {!! Form::open(array('route' => 'security_update', 'class' => 'form')) !!}

                    {{ csrf_field() }}

                    <!-- Current Password -->
                    <div class="form-group">
                        {!! Form::label('Current Password') !!}
                        {!! Form::password('current_password', array('required', 'class'=>'form-control', 'placeholder'=>'Current Password')) !!}
                    </div>

                    <!-- New Password -->
                    <div class="form-group">
                        {!! Form::label('New Password') !!}
                        {!! Form::password('password', array('required', 'class'=>'form-control', 'placeholder'=>'New Password')) !!}
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        {!! Form::label('Confirm Password') !!}
                        {!! Form::password('password_confirmation', array('required', 'class'=>'form-control', 'placeholder'=>'Confirm Password')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Update', 
                          array('class'=>'btn btn-primary')) !!}
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