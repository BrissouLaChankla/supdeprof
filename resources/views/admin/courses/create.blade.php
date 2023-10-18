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
            <form method="POST"  action="{{ route('courses.store') }}" enctype="multipart/form-data">
            @else
                <form method="POST" id="form" action="{{ route('courses.update', $course->id) }}" enctype="multipart/form-data">
                    @method('PUT')

                    <button onclick="saveCourse(event)"
                    class="btn btn-primary btn-lg m-4 rounded-circle d-flex align-items-center justify-content-center position-fixed end-0 bottom-0 me-3"
                    style="height:50px">
                    <svg fill="#FFFFFF" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18"
                        viewBox="0 0 407.096 407.096" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M402.115,84.008L323.088,4.981C319.899,1.792,315.574,0,311.063,0H17.005C7.613,0,0,7.614,0,17.005v373.086
           c0,9.392,7.613,17.005,17.005,17.005h373.086c9.392,0,17.005-7.613,17.005-17.005V96.032
           C407.096,91.523,405.305,87.197,402.115,84.008z M300.664,163.567H67.129V38.862h233.535V163.567z" />
                                <path d="M214.051,148.16h43.08c3.131,0,5.668-2.538,5.668-5.669V59.584c0-3.13-2.537-5.668-5.668-5.668h-43.08
           c-3.131,0-5.668,2.538-5.668,5.668v82.907C208.383,145.622,210.92,148.16,214.051,148.16z" />
                            </g>
                        </g>
                    </svg></button>
                    
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
            const saveCourse = async (event) => {
                event.preventDefault();

                const form = document.querySelector("#form");
                const url = form.action;

                let formData = new FormData(form)
                formData.append("isfast", true);
                try {
                    fetch(url, {
                            headers: {
                                // 'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                            },
                            method: "POST",
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: data,
                            });
                        })


                } catch (error) {
                    console.error(error);
                }
            }

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
