@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1>Gestion des utilisateurs</h1>

        </div>
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                Liste des étudiants
            </h2>
            <a href="{{ route('chapters.create') }}" class="btn btn-primary ">
                Ajouter un étudiant
            </a>
        </div>
        {{-- @foreach ($users->students as $student)
        @endforeach --}}

        <div class="d-flex justify-content-between align-items-center">
            <h2>
                Liste des intervenants
            </h2>
            <a href="{{ route('chapters.create') }}" class="btn btn-primary ">
                Ajouter un intervenant
            </a>
        </div>
        {{-- @foreach ($users->teachers as $teacher)
        @endforeach --}}

          @foreach ($admins as $admin)
          {{$admin->firstname}}
        @endforeach
    </div>
@endsection
