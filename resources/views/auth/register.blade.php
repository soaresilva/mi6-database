@extends('layout')
 
@section('content')
 
    @if($errors->count())
 
        @foreach($errors->all() as $error)
            <div class="alert-danger">{{ $error }}</div>
        @endforeach
 
    @endif
 
    <form action="{{ route('register') }}" method="post">
        @csrf
 
        <div class="form-group">
            <label for="">Name</label><br>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        </div>
 
        <div class="form-group">
            <label for="">Email</label><br>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
        </div>
 
        <div class="form-group">
            <label for="">Password</label><br>
            <input class="form-control" type="password" name="password" value="">
        </div>
 
        <div class="form-group">
            <label for="">Confirm password</label><br>
            <input class="form-control" type="password" name="password_confirmation" value="">
        </div>
 
        <button type="submit" class="btn btn-primary">Sign up</button>
 
    </form>
 
@endsection