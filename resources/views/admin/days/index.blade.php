@extends('admin.layouts.app')
@php
// Pas ouf go changer ça 
    $colorPalette = [
        '#039BE5', // Bleu ciel
        '#1A237E', // Bleu foncé
        '#66BB6A', // Vert tendre
        '#FFD54F', // Jaune pâle
        '#EC407A', // Rose doux
        '#9E9E9E', // Gris neutre
        '#6A1B9A', // Violet profond
        '#039BE5', // Bleu ciel
        '#1A237E', // Bleu foncé
        '#66BB6A', // Vert tendre
        '#FFD54F', // Jaune pâle
        '#EC407A', // Rose doux
        '#9E9E9E', // Gris neutre
        '#6A1B9A', // Violet profond
        '#039BE5', // Bleu ciel
        '#1A237E', // Bleu foncé
        '#66BB6A', // Vert tendre
        '#FFD54F', // Jaune pâle
        '#EC407A', // Rose doux
        '#9E9E9E', // Gris neutre
        '#6A1B9A', // Violet profond
        '#039BE5', // Bleu ciel
        '#1A237E', // Bleu foncé
        '#66BB6A', // Vert tendre
        '#FFD54F', // Jaune pâle
        '#EC407A', // Rose doux
        '#9E9E9E', // Gris neutre
        '#6A1B9A', // Violet profond
    ];
@endphp

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Sélectionne un chapitre</h1>
            <a href="{{ route('chapters.create') }}" class="btn btn-primary ">
                Ajouter un chapitre
            </a>
        </div>
        <div class="row mt-4 ">
            @forelse($chapters as $key => $chapter)
                <div class="col-md-3">
                    <a href="{{ route('chapters.show', ["chapter" => $chapter->id]) }}" class="card text-decoration-none p-3 text-center text-white" style="background-color: {{ $colorPalette[$key] }}">
                        <span class="fs-1">
                            <i class="{{ $chapter->icon }}"></i>
                        </span>
                        <h2>{{ $chapter->name }}</h2>
                    </a>
                </div>
            @empty
                <em>Il n'y a aucun chapitre pour le moment.</em>
            @endforelse
        </div>
    </div>
@endsection
