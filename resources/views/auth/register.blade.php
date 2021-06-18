@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">    
<img src="/images/fyp-icon.png"></img></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <div id="app">
                        <register-form></register-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
