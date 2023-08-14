@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <a class="fs-3 text-decoration-none" href="{{ route('chapters.index') }}">⬅️</a>
                <h1 class="ms-3">
                    Tous les cours sur {{ $chapter->name }}
                </h1>
            </div>
            <a href="{{ route('courses.create', ['chapter' => $chapter->id]) }}" class="btn btn-primary ">
                Ajouter un cours
            </a>
        </div>
        @forelse($chapter->courses as $course)
            <a href="{{ route('courses.edit', ['course' => $course->id]) }}" >
                {{ $course->title }}
            </a>
        @empty
            <p>Il n'y a aucun cours pour le moment.</p>
        @endforelse
    </div>
@endsection
