@extends('admin.layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Nous ne chargeons cette vu avec un $chapter_id uniquement lors de la création d'un cours, c'est comme ça qu'on sait s'il est entrain de créer ou d'éditer --}}
        
        @isset($chapter_id)
            <form method="POST" action="{{ route('courses.store') }}">
        @else
            <form method="POST" action="{{ route('courses.update', $course->id) }}">
            @method('PUT')
        @endisset

                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Titre du cours</label>
                    <input type="text" class="form-control" name="title" id="title"
                        value="{{ $course->title ?? '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="slides" class="form-label">Lien du Google Slides</label>
                    <input type="text" class="form-control" id="slides"
                        value="{{ $course->presentation_iframe ?? '' }}" name="presentation_iframe">
                </div>

                <div class="mb-3">
                    <label for="context" class="form-label">Mise en contexte</label>
                    <textarea class="tinyMce" name="context" id="context">
                    {{ $course->context ?? '' }}
                </textarea>
                </div>
                @isset($chapter_id)
                    <input type="hidden" name="chapter_id" value="{{ $chapter_id }}">
                @endisset
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
    </div>



    @push('scripts')
        @vite(['resources/js/tinyMCE.js'])
    @endpush
@endsection
