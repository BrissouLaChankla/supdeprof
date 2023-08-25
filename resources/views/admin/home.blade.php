@extends('admin.layouts.app')

@section('content')
    <div class="container">


        {{-- <div class="d-flex align-items-center">
            <img src={{ Auth::user()->avatar }} class="img-thumbnail me-3 pb-0" width="75" alt="Avatar">
            <h2 class="h3 fw-bold m-0">
                Salut {{ Auth::user()->firstname }} !
            </h2>
        </div> --}}
        <div class="text-center mt-4">
            
            <x-animated-title :text="$today->name" />
            
            </div>
            <h5 class="mt-5 mb-3">
                Voici les notions du jour :
            </h5>
        <div class="bg-light px-3 pt-2 today-course-container scrollbar rounded shadow-sm">
            <div class="p-3 border-bottom pb-4">
                {!! $today->goal !!}
            </div>
            @forelse ($today->courses as $course)
                <a href="{{ route('courses.show', ['course' => $course->slug]) }}"
                    class="border-bottom d-flex align-items-center gap-3 py-2 text-decoration-none">

                    <div class="bg-primary-subtle text-primary px-3 py-1 rounded-1 fs-3">
                        <li class="{{ $course->icon }}"></li>
                    </div>

                    <div>
                        <h5>
                            {{ $course->title }}
                        </h5>
                        <p class="text-muted">{{ $course->chapter->name }}</p>
                    </div>
                </a>

            @empty
                <div class="alert alert-primary mt-4" role="alert">
                    Patience, les cours du jour arrivent !
                </div>
            @endforelse
        </div>
    </div>
@endsection
