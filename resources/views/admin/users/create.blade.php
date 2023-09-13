@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Nom') }}</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Description') }}</label>
                <textarea  class="form-control basic" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">{{ __('Icône') }}</label>
                <input type="text" class="form-control" id="icon" name="icon" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">{{ __('Enregistrer') }}</button>
            </div>
        </form>

    </div>
@endsection
