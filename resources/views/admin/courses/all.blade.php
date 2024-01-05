@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4">

            @forelse ($courses as $course)
                <a href="{{ route('courses.show', ['course' => $course->slug]) }}" class="col text-decoration-none">
                    <div class="card h-100">
                        <div class="bg-primary-subtle text-primary px-3 py-1 rounded-1 fs-3 text-center">
                            <li class="{{ $course->icon }}"></li>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text"> {!! Str::limit($course->context, 80) !!}</p>
                        </div>
                     
                    </div>
                </a>
            @empty
                <div class="alert alert-primary mt-4" role="alert">
                    Patience, nous n'avons pas encore vu de cours ensemble
                </div>
            @endforelse
        </div>

    </div>
@endsection
