@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('days.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Nom de la journée') }}</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="goal" class="form-label">{{ __('But de cette journée') }}</label>
                <textarea  class="form-control basic" id="goal" name="goal" rows="3" required></textarea>
            </div>

            <div class="mb-4">
                <label for="class_year" class="form-label">{{ __('Classe concernée') }}</label>
                <select class="form-select" id="class_year" name="class_year" aria-label="Class year select">
                    <option value="1">Première année</option>
                    <option value="2">Deuxième année</option>
                    <option value="3">Troisième année</option>
                  </select>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">{{ __('Enregistrer') }}</button>
            </div>
        </form>

    </div>
@endsection
