@extends('layouts.admin')


@section('content')

    <form method="POST" action="{{route('admin.works.store')}}">

        @csrf

        <div class="mb-3">
        <label for="title" class="form-label">Nome del progetto</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}">
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrizione del progetto</label>
        <textarea class="form-control  @error('description') is-invalid @enderror" id="description " name="description">{{old('description')}}</textarea>
        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="languages" class="form-label">Linguaggi usati nel progetto</label>
        <input type="text" class="form-control @error('price') is-invalid @enderror" id="languages " name="languages" value="{{old('languages')}}">
        @error('languages')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="type_id" class="form-label">Seleziona tipo</label>

        <select class="form-select" name="type_id" id="type_id">
            <option @selected(old('type_id')=='') value="">Nessun tipo</option>

            @foreach ($types as $type)
                <option @selected(old('type_id')==$type->id) value="{{$type->id}}">{{$type->name}}</option>
            @endforeach

        </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> 

        <div class="mb-3">
            {{-- per impostare il name da una tabella many to many si da un nome comune per tutti
                che ci ritornera un array con i relativi nomi associati al loro id  --}}
            
                {{-- controllo checkbox: alla request viene passato un [1,2,3,4] che sono gli id dei valori che abbiamo selezionato
                    se fosse avvenuto un errore di autenticazione vengono ricreati tutti gli elementi
                    ma per impostare il valore su checked su quelli che avevamo selezionato guardiamo i gli id dei technologies precedentemente creato
                    quindi che si trova nella old della request che non è stata validata
                    di conseguenza: "in_array" farà il ciclo dell'arraay "technology->id" è il riferimento a cosa vogliamo controllare
                    mentre la "old('technologies', [])" ritornera i valori 'technologies' se presenti altrimenti passera un array vuoto--}}
                @foreach ($technologies as $technology)
                <input id="technology_{{$technology->id}}" @if (in_array($technology->id, old('technologies', []))) checked @endif type="checkbox" name="technologies[]" value="{{$technology->id}}">
                <label for="technology_{{$technology->id}}" class="form-label">{{$technology->name}}</label>
                <br>
            @endforeach
            @error('technology')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>



        <button type="submit" class="btn btn-primary">Salva</button>
</form>

@endsection