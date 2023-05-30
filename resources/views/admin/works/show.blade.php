@extends('layouts.admin')



@section('content')
{{-- {{dd($work->types_method)}} --}}
    <div class="card p-2 mb-2">

        <div class="card-body">
        <h5 class="card-title">Titolo: {{$work->title}}</h5>
        <p class="card-text">Descrizione: {{$work->description}}</p>
        <p class="card-text">Tipo: {{$work->type?$work->type->name:'Nessun tipo selezionato'}}</p>
        <p class="card-text">Slug: {{$work->slug}}</p>
        @foreach ($work->technologies as $technology)
        <p class="card-text">{{$technology->name}}</p>
        @endforeach
        </div>

    </div>
    <a class="btn btn-warning" href="{{route('admin.works.index')}}">Torna alla lista</a>
@endsection