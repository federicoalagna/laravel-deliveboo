@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                @if ($plates && $plates->count() > 0)
                    <div class="col d-flex justify-content-around">
                        <a href="{{ route('admin.plates.create') }}" class="btn btn-outline-primary   mb-3">Aggiungi un
                            piatto</a>
                        <a href="{{ route('admin.Restaurants.index') }}" class="btn btn-outline-primary   mb-3">Torna al tuo
                            ristorante</a>
                    </div>
                    @foreach ($plates as $plate)
                        <div class="card mb-4 shadow-lg border-primary rounded">

                            <div class="card-header bg-primary text-white">
                                <h3 class="mb-0">{{ $plate->name }}</h3>
                            </div>

                            <div class="card-body d-flex g-0">

                                <div class="card-img my-3">
                                    <img src="{{ asset('storage/' . $plate->cover_image) }}" class="img-fluid rounded-start"
                                        style="max-height: 200px;">
                                </div>

                                <div class="col-md-8 my-3 ms-3">
                                    <p class="card-text text-muted">Descrizione: {{ $plate->description }}</p>
                                    <p class="card-text">Ingredienti: <strong>{{ $plate->ingredients }}</strong></p>
                                    <p class="card-text">Prezzo: <strong>€{{ number_format($plate->price, 2) }}</strong></p>
                                    <div class="d-flex gap-3">
                                        <a href="{{ route('admin.plates.edit', $plate->id) }}"
                                            class="btn btn-outline-primary">Modifica</a>

                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-primary d-flex justify-content-between">
                                <a href="{{ route('admin.plates.show', $plate->id) }}"
                                    class="btn btn-outline-light">Dettagli</a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $plate->id }}">
                                    Elimina
                                </button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $plate->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $plate->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content border-danger">
                                    <div class="modal-header border-danger">
                                        <h1 class="modal-title fs-5 text-danger" id="deleteModalLabel{{ $plate->id }}">
                                            Elimina Piatto</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Sei sicuro di voler eliminare il piatto <strong>{{ $plate->name }}</strong>?
                                            Questa azione sarà irreversibile!</p>
                                    </div>
                                    <div class="modal-footer border-danger">
                                        <button type="button" class="btn btn-outline-primary"
                                            data-bs-dismiss="modal">Annulla</button>
                                        <form action="{{ route('admin.plates.destroy', $plate->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Elimina</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning text-center">
                        <h4 class="alert-heading">Non hai ancora creato nessun piatto!</h4>
                        <p>Clicca qui sotto per creare subito un piatto e iniziare a vendere.</p>
                        <a href="{{ route('admin.plates.create') }}" class="btn btn-primary">Crea un Piatto</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
