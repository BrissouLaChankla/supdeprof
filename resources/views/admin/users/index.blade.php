@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1>Gestion des utilisateurs</h1>
        </div>

        <x-datatable name="etudiant" :role="$students" />
        <x-datatable name="intervenant" :role="$teachers" />
        <x-datatable name="administrateur" :role="$admins" />


    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('table').forEach(el => {
                    const dataTable = new simpleDatatables.DataTable(el)
                })
            })
        </script>
    @endpush
@endsection
