@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Sélectionnez un chapitre :</h1>
            <a href="{{ route('courses.create') }}"
                class="btn btn-primary btn-lg"
                >
                Ajouter un chapitre
            </a>
        </div>
      
        @forelse($chapters as $chapter)
            <p>{{ $chapter }}</p>
        @empty
            <p>Il n'y a aucun chapitre pour le moment.</p>
        @endforelse
    </div>
@endsection
