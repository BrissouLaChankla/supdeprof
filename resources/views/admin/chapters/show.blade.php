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
        <div class="mt-4">
            <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
            <label class="btn btn-outline-info" for="btncheck1">Mes cours</label>
        </div>
        <div class="row mt-4">
            {{ $courses->links() }}

            @forelse($courses as $course)
                <div class="col-md-6 col-lg-4">
                    <div class="card overflow-hidden my-3">
                        <div class="bg-secondary text-center text-white fs-1 py-4">
                            <li class="{{ $chapter->icon }}"></li>
                        </div>
                        <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="bagdge text-bg-light pe-3 ps-2 py-1 position-absolute top-0 end-0 border-bottom-start-rounded">📆&nbsp;&nbsp;01/01/2023</small>
                            <span class="badge rounded-pill text-bg-dark text-white px-3 py-1">{{$course->teacher_full_name}}</span>
                        </div>
                            <h5 class="card-title mt-3 fw-bold">{{ $course->title }}</h5>
                            <p class="card-text">
                                {!! Str::words($course->context, 10, ' ...') !!}
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-outline-primary " href="{{ route('courses.show', ['course' => $course->slug]) }}">
                                    Consulter
                                </a>
                                {{-- Editable uniquement si vous êtes l'auteur du cours  --}}
                                <a class="btn btn-outline-primary @if($course->teacher_id !== auth()->id()) disabled btn-outline-secondary @endif"
                                    href="{{ route('courses.edit', ['course' => $course->id]) }}">
                                    ✏️
                                </a>
                            </div>

                        </div>
                    </div>

                </div>

            @empty
                <p>Il n'y a aucun cours pour le moment.</p>
            @endforelse
        </div>
    </div>
@endsection
