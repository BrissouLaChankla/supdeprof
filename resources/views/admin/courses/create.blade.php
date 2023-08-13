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

        <form method="POST" action="{{ route('courses.store') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titre du cours</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div class="mb-3">
                <label for="slides" class="form-label">Lien du Google Slides</label>
                <input type="text" class="form-control" id="slides" name="presentation_iframe">
            </div>

            <div class="mb-3">
                <label for="context" class="form-label">Mise en contexte</label>
                <textarea class="tinyMce" name="context" id="context"></textarea>
            </div>

            <input type="hidden" name="chapter_id" value="{{ $chapter_id }}">
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>



    @push('scripts')
        @vite(['resources/js/tinyMCE.js'])
    @endpush
@endsection
