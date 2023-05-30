@extends('layouts.admin')

@section('content')
<div class="d-flex w-100">

    <a href="{{route('admin.works.create')}}">Inserisci un nuovo progetto</a>

    <table class="table-info w-100">
        <thead>
            <tr>
                <th>#</th>
                <th>Titolo</th>
                <th>Slug</th>
                <th>Descrizione</th>
                <th>Tipi</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($works as $work)
            
            <tr>
                <th>{{$work->id}}</th>
                <td>{{$work->title}}</td>
                <td>{{$work->description}}</td>
                <td>{{$work->slug}}</td>
                <td>{{$work->type?->name}}</td>
                <td>    
                    <a class="btn btn-primary" href="{{route('admin.works.show',  ['work'=>$work->id])}}">Dettagli</a>
                    <a class="btn btn-secondary" href="{{route('admin.works.edit',  ['work'=>$work->id])}}">Modifica</a>
                    <form action="{{route('admin.works.destroy', ['work' => $work->id])}}" class="form_delete_work" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </td>                
            </tr>
            
            @endforeach
            
        </tbody>
    </table>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma eliminazione</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Confermi di voler eliminare l'elemento selezionato?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger">Conferma eliminazione</button>
        </div>
        </div>
    </div>
</div>

@endsection