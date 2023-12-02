<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
<div class="container">
    <h1>Liste des clients</h1>
    <!-- Button trigger modal -->
    @if (\Session::has('success'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Message: </strong> {{ \Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (\Session::has('fail'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Message: </strong> {{ \Session::get('fail') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
       @endif
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajouter client
    </button>

    <!-- Start Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                 <form method="POST" action="{{ route('client.store') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="firstName" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="lastName" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" class="form-control" name="phone" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="adresse" aria-describedby="emailHelp">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                 </form>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Adresse</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clients as $client)
            <tr>
                <th scope="row">1</th>
                <td>{{ $client->firstName }}</td>
                <td>{{ $client->lastName }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->adresse }}</td>
                <td>
                    <form method="POST" action="{{ route('client.destroy', $client->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                            <i class="bi bi-trash text-danger" style="cursor: pointer" data-toggle="tooltip" data-placement="top"
                               title="Supprimer"></i>
                        </button>
                    </form>

                </td>
                <td> <!-- Edit button and form -->
                    <button type="button" class="btn btn-link text-danger" data-bs-toggle="modal" data-bs-target="#editModal{{ $client->id }}">
                        <i class="bi bi-pencil-square" data-toggle="tooltip" data-placement="top" title="Modifier"></i>
                    </button>
                    <div class="modal fade" id="editModal{{ $client->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $client->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel{{ $client->id }}">Modifier un client</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('client.update', [$client->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Prénom</label>
                                            <input type="date" class="form-control" name="firstName" value="{{ $client->firstName }}" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nom</label>
                                            <input type="number" class="form-control" name="lastName" value="{{ $client->prix }}" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="number" class="form-control" name="email" value="{{ $client->email }}" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Téléphone</label>
                                            <input type="number" class="form-control" name="phone" value="{{ $client->phone }}" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Adresse</label>
                                            <input type="number" class="form-control" name="adresse" value="{{ $client->adresse }}" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div></td>


            </tr>
        @endforeach
        </tbody>
    </table>

</div>
<!-- End Modal -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>
</body>

</html>
<style>
    .bi-trash:hover {
        color: #f89797 !important; /* La couleur que vous souhaitez lors du survol */
    }
</style>
