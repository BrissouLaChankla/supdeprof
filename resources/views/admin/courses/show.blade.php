@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-lg-5">
        <h1 class="text-center mb-2">
            {{ $course->title }}
        </h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Cours</button>
            </li>
            @isset($course->presentation_iframe)
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Slides</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ressources-tab" data-bs-toggle="tab" data-bs-target="#ressources" type="button"
                    role="tab" aria-controls="ressources" aria-selected="false">Ressources</button>
            </li>
            @endisset
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <div class="row">
                    <div class="col-md-9">

                        <div class="card course-container scrollspy-example scrollbar" data-bs-spy="scroll"
                            data-bs-target="#simple-list-example" data-bs-offset="0" data-bs-smooth-scroll="true"
                            tabindex="0">
                            <div id="section_0">
                                <h2 class="title-section px-4 py-2 fs-4 fw-bold bg-primary-subtle">Contexte
                                </h2>
                                <div class="p-4 lead">
                                    {!! $course->context !!}
                                </div>
                            </div>
                            @forelse ($course->sections as $section)
                                <div id="section_{{ $section->order + 1 }}">
                                    <h2 class="title-section px-4 py-2 fs-4 fw-bold bg-primary-subtle">{{ $section->title }}
                                    </h2>
                                    <div class="p-4">
                                        {!! $section->content !!}
                                    </div>
                                </div>
                            @empty
                                <p>Le cours est vide.</p>
                            @endforelse

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 mt-3" id="simple-list-example">
                            <a class="p-1 rounded anchor text-decoration-none"
                            href="#section_0">Contexte</a>
                            @forelse ($course->sections as $section)
                                <a class="p-1 rounded anchor text-decoration-none"
                                    href="#section_{{ $section->order + 1 }}">{{ $section->title }}</a>
                            @empty
                                <p>Aucun chapitre pour le moment.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @isset($course->presentation_iframe)
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mt-3">
                        {!! $course->presentation_iframe !!}
                    </div>
                </div>
            @endisset
            <div class="tab-pane fade" id="ressources" role="tabpanel" aria-labelledby="ressources-tab">
                <div class="mt-3">
                    <em>
                        A venir...
                    </em>
                </div>
            </div>
        </div>

    </div>
    @push('styles')
        <link href="{{ asset('css/prism.css') }}" rel="stylesheet">
    @endpush
    @push('scripts')
        @vite(['resources/js/prism.js'])


    @endpush
@endsection
