@extends('app')
@section('title', 'Halaman Login')
@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-round">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Login Form</div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('checkUser')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" />
                        <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" />
                        <small id="passwordHelp2" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Submit</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
