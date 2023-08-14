@extends('admin.layouts.app')

@section('content')
    <div class="container">

        
        <div class="d-flex align-items-center">
            <img src={{ Auth::user()->avatar }} class="img-thumbnail me-3 pb-0" width="75" alt="Avatar">
            <h2>
                Salut {{ Auth::user()->firstname }} !
            </h2>
        </div>
    </div>
    @endsection
