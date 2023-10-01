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
            <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
            @else
                <form method="POST" action="{{ route('courses.update', $course->id) }}" enctype="multipart/form-data">
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
                    <textarea class="tinyMce basic" name="context" id="context">
                    {{ $course->context ?? '' }}
                </textarea>
                </div>

                {{-- Ici que chaque section s'ajoute --}}
                <div id="sections-container">
                    @isset($course)
                        @foreach ($course->sections as $section)
                            <x-course-section :title="$section->title" :content="$section->content" />
                        @endforeach
                    @endisset
                </div>
                <span class="add-section btn btn-outline-primary">➕ Ajouter une section</span>




                @isset($chapter_id)
                    <input type="hidden" name="chapter_id" value="{{ $chapter_id }}">
                @endisset
                <div class="text-end">
                    <button type="submit" class="btn btn-primary btn-lg mt-4">Enregistrer</button>
                </div>

            </form>
    </div>



    @push('scripts')
        @vite(['resources/js/importMCE.js'])
        <script type="text/javascript" src="{{ asset('scripts/initMCE.js') }}"></script>

        <script>
            const addSectionsName = () => {
                document.querySelectorAll('#sections-container textarea').forEach((section, i) => {

                    section.name = "section_" + i
                });

                document.querySelectorAll('#sections-container input[type=text]').forEach((section, i) => {

                    section.name = "titlesection_" + i
                });
            }

            document.querySelector(".add-section").addEventListener('click', async () => {
                let response = await fetch('{{ route('add-section') }}');
                let data = await response.text();
                document.querySelector('#sections-container').insertAdjacentHTML(
                    'beforeend',
                    data
                );


                initMCE('{{ csrf_token() }}');
                addSectionsName();
                addDeleteInteraction();
            })

            const addDeleteInteraction = () => {
                document.querySelectorAll(".delete-section").forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.target.closest("div.section").remove();
                        addSectionsName();

                    })
                })
            }

            document.addEventListener('DOMContentLoaded', () => {

                initMCE('{{ csrf_token() }}');
                addSectionsName();
                addDeleteInteraction();
            })
        </script>
    @endpush

   
@endsection
