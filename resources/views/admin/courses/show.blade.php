@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">
            {{ $course->title }}
        </h1>
        <div class="row">
<div class="col-md-10">

    <div class="card p-3">
        Le cours
    </div>
</div>
<div class="col-md-2">
    <div class="card p-3">
        Le cours
    </div>
</div>
        </div>
    </div>
@endsection
