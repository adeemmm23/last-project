@extends('template')
@section('titre', 'Bienvenue !')
@section('contenu')

<!-- @if(session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif -->

<form action="{{ route('films.search') }}" class="d-flex w-100" style="margin-top: 50px; margin-bottom: 50px;" role="search" method="GET">
    @csrf
    @method('GET')
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{
    Route::currentRouteName() == 'films.search' ? request()->input('search') : '' }}">
    <button class="btn btn-outline-success me-2" type="button">Search</button>
    <a href="{{route('films.create')}}" class="btn btn-success text-nowrap">Ajouter un
        film</a>
</form>

<h1 style=" margin-top: 50px">Films</h1>
<table class="table table-dark" style="width: 80%; margin-top: 100px;margin-bottom: 100px">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col" style="min-width: 200px;">Titre</th>
            <th scope="col" style="min-width: 200px;">Année de sortie</th>
            <th scope="col">Description</th>
            <th scope="col">Durée</th>
            <th scope="col" colspan="3">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($films as $film)
        <tr>
            <th scope="row">{{ $film->id }}</th>
            <td class="text-truncate">{{ $film->titre }}</td>
            <td>{{ $film->anneesortie }}</td>
            <td class=" text-truncate" style="max-width: 500px;">{{ $film->description }}</td>
            <td>{{ $film->duree }}</td>
            <td> <a href="{{route('films.show', $film->id)}}" class="btn btn-primary">Détails</a></td>
            <td>
                <form action="{{ route('films.destroy', $film->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
            <td> <a href="{{route('films.edit', $film->id)}}" class="btn btn-warning">Modifier</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('script')


@if (session('message'))
<script defer type="text/javascript">
    setTimeout(() => {
        alert("{{ session('message') }}");
    }, 500);
</script>
@endif
@endsection