      <div class="d-flex justify-content-between align-items-center mt-4">
        <h2>
            Liste des {{$name}}s
        </h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary ">
            Ajouter un {{$name}}
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($role as $data)
                <tr>

                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->firstname }}</td>
                    <td>{{ $data->lastname }}</td>
                    <td>
                        <a href="mailto:{{ $data->email }}">{{ $data->email }}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
