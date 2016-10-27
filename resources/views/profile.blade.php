@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="panel panel-default">
                <div class="panel-heading">Profile Information</div>

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                          {{Session::get('success')}}
                        </div>
                    @endif

                    {!! Form::open(array('route' => 'profile_store', 'class' => 'form')) !!}

                    {{ csrf_field() }}

                    <!-- First Name -->
                    <div class="form-group">
                        {!! Form::label('First Name') !!}
                        {!! Form::text('first_name', $user->first_name, array('required', 'class'=>'form-control', 'placeholder'=>'First Name')) !!}
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        {!! Form::label('Last Name') !!}
                        {!! Form::text('last_name', $user->last_name, array('required', 'class'=>'form-control', 'placeholder'=>'Last Name')) !!}
                    </div>

                    <!-- E-Mail Address -->
                    <div class="form-group">
                        {!! Form::label('Email') !!}
                        {!! Form::email('email', $user->email, array('required', 'class'=>'form-control', 'placeholder'=>'jdoe@example.com')) !!}
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