@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <h1>
                    Toutes les journées
                </h1>
            </div>
            <a href="{{ route('days.create') }}" class="btn btn-primary ">
                Créer une journée
            </a>
        </div>

        <div class="mt-4">
            <div class="btn btn-secondary">Voir les cours du jour</div>
        </div>
        <div class="mt-4">
            <div class="row">

                @forelse ($days as $day)
                    <div class="col-lg-6">
                        <div class="card overflow-hidden mb-3" style="max-width: 540px;">

                            <div class="row g-0">
                                <div class="col-md-3">
                                    <div
                                        class="bg-secondary d-flex align-items-center justify-content-center text-white  h-100 position-relative">
                                        @if ($day->is_today)
                                            <span class="bg-warning text-center py-2 top-0 w-100 position-absolute">
                                                Cours du jour !
                                            </span>
                                        @endif
                                        <span class="fs-1">
                                            <i class="{{ $day->icon }}"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="card-title m-0">{{ $day->name }}</h5>
                                            <small class="bg-primary-subtle rounded px-2">

                                                {{ $day->class_year }}
                                                @if ($day->class_year === 1)
                                                    ère année
                                                @else
                                                    ème année
                                                @endif
                                            </small>
                                        </div>
                                        <small class="card-text mb-2">{!! Str::words($day->goal, 8, ' ...') !!}</small>
                                        <hr>
                                        <h6>Les cours :</h6>
                                        <div class="row">
                                            @forelse ($day->courses as $course)
                                                <div class="col-lg-6">
                                                    <div
                                                        class="card mt-2 d-flex flex-row p-2 justify-content-between align-items-center">
                                                        <a href="{{ route('courses.show', ['course' => $course->slug]) }}"
                                                            class="text-decoration-none"> {{ $course->title }}</a>


                                                        <a href="{{ route('remove-course-from-day', ['id' => $course->id]) }}"
                                                            class="text-danger"
                                                            onclick="event.preventDefault();
                                                            document.getElementById('remove-course-from-day-{{ $course->id }}').submit();">
                                                            <i class="fa-solid fa-times"></i>
                                                        </a>

                                                        <form id="remove-course-from-day-{{ $course->id }}"
                                                            action="{{ route('remove-course-from-day', ['id' => $course->id]) }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>

                                            @empty
                                                <small class="text-info mt-2"><em>Aucun cours dans cette journée
                                                        !</em></small>
                                            @endforelse
                                        </div>

                                    </div>
                                    @if (!$day->is_today)
                                        <div class="text-center py-2 btn btn-warning w-100 rounded-0"
                                            onclick="setToday({{ $day->id }}, {{ $day->class_year }})">
                                            Définir en tant que cours du jour
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <p>Aucun jour de crée.</p>
                @endforelse
            </div>
        </div>
        <div class="mt-4">
            <h3>Liste des cours dans aucune journées :</h3>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Chapitre</th>
                        <th scope="col">Contexte</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Ajouter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coursesNoDays as $course)
                        <tr>
                            <th scope="row">{{ $course->title }}</th>
                            <td>
                                <span class="badge text-bg-secondary">{{ $course->chapter->name }}</span>
                            </td>
                            <td>{!! Str::words($course->context, 10, ' ...') !!}</td>
                            <td>{{ $course->teacher_full_name }}</td>
                            <td>
                                @if ($days->isEmpty())
                                    -
                                @else
                                    <form class="d-flex align-items-center gap-2" method="POST"
                                        action="{{ route('add-course-to-day') }}">
                                        @csrf

                                        <select class="form-control form-control-sm" name="day_id" id="">
                                            @foreach ($days as $day)
                                                <option value="{{ $day->id }}">{{ $day->name }}</option>
                                            @endforeach
                                        </select>

                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        <input type="submit" value="+" class="btn btn-success btn-sm">
                                    </form>
                                @endisset
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


@push('scripts')
    <script>
        function setToday(id, class_year) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "S'il y a déjà un cours du jours, il sera remplacé.",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Oups..',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, c\'est bon'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route('set-today-day') }}', {
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                            },
                            method: "POST",
                            body: JSON.stringify({
                                id,
                                class_year
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data)
                            location.reload();
                        })

                }
            })
        }
    </script>
@endpush
@endsection
