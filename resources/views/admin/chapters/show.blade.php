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
        {{-- TODO --}}
        {{-- <div class="mt-4">
            <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
            <label class="btn btn-outline-info" for="btncheck1">Mes cours</label>
        </div> --}}
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
                                <a href="#" class="text-decoration-none text-body">
                                    <img src="{{ $course->teacher->avatar }}" class="rounded border bg-secondary-subtle" width="35"
                                    alt="">
                                    <span class="ms-2">
                                        {{ $course->teacher_full_name }}
                                    </span>
                                </a>
                                <small
                                    class="bagdge text-bg-body border p-1 px-2 rounded">📆&nbsp;&nbsp;{{ $course->updated_at->format('d-m-Y') }}</small>

                            </div>
                            <h5 class="card-title mt-3 fw-bold">{{ $course->title }}</h5>
                            <span class="card-text text-muted">
                                {!! Str::words($course->context, 10, ' ...') !!}
                            </span>
                            <div class="d-flex justify-content-between mt-4">
                                <a class="btn btn-outline-primary "
                                    href="{{ route('courses.show', ['course' => $course->slug]) }}">
                                    Consulter
                                </a>
                                {{-- Editable uniquement si vous êtes l'auteur du cours  --}}
                                <a class="btn btn-outline-primary @if ($course->teacher_id !== auth()->id()) disabled btn-outline-secondary @endif"
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
