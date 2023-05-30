@extends('layouts.admin')

@section('content')

    <form method="POST" action="{{ route('admin.works.update', ['work' => $work->id]) }}">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror " id="title" name="title" value="{{old('title', $work->title)}}">
            @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="languages" class="form-label">Linguaggi</label>
            <input type="text" class="form-control @error('languages') is-invalid @enderror " id="languages" name="languages" value="{{old('languages', $work->languages)}}">
            @error('languages')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Testo dell'articolo</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('content', $work->description)}}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type_id" class="form-label">Seleziona tipo</label>
        
            <select class="form-select" name="type_id" id="type_id">
                <option @selected(old('type_id', $work->type_id)=='') value="">Nessun tipo</option>
        
                @foreach ($types as $type)
                    <option @selected(old('type_id', $work->type_id)==$type->id) value="{{$type->id}}">{{$type->name}}</option>
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
            
                @foreach ($technologies as $technology)
                
                {{-- l'autenticazione nella if($errors->any()) è uguale a quella della create, quidi vengono presi i valori se selezionati e poi la validazione non va a
                buon fine tornando un errore--}}
                @if ($errors->any())
                    <input id="technology_{{$technology->id}}" @if (in_array($technology->id, old('technologies', []))) checked @endif type="checkbox" name="technologies[]" value="{{$technology->id}}">
                {{-- questa autenticazione invece serve per controllare tutti i valori che erano già impostati nella checkbox 
                    prima delle modifiche--}}
                @else
                    <input id="technology_{{$technology->id}}" @if ($work->technologies->contains($technology->id)) checked @endif type="checkbox" name="technologies[]" value="{{$technology->id}}">
                @endif
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