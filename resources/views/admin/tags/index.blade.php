@extends('layouts.admin')

@section('content')

<h1>Categories</h1>
@include('partials.session_message')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{route('admin.tags.store')}}" method="post" class="d-flex">
                @csrf
                <div class="mb-2 mr-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="nome tag" aria-describedby="helperName">
                    <small id="helperName" class="text-muted">Aggiungi il nome del tag</small>
                </div>
                <div class="align-self-center">
                    <button type="submit" class="btn btn-success">Aggiungi</button>
                </div>
                
            </form>
        </div>
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                        <tr>
                            <th scope="row">{{$tag->id}}</th>
                            <td>
                                <form action="{{route('admin.tags.update', $tag->slug)}}" method="post" id="tag-{{$tag->id}}">
                                @csrf
                                @method('PATCH')
                                <input class="border-0 bg-transparent" type="text" name="name" value="{{$tag->name}}">
                                </form>
                            </td>
                            <td>{{$tag->slug}}</td>
                            <!-- actions  -->
                            <td>
                                <button form="tag-{{$tag->id}}" type="submit" class="btn btn-primary">Update</button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#delete-tag-{{$tag->slug}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </button>  
                                <!-- Modal -->
                                <div class="modal fade" id="delete-tag-{{$tag->slug}}" tabindex="-1" role="dialog" aria-labelledby="modelName-{{$tag->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Stai Cancellando: <span class="text-danger">{{$tag->name}}</span></h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Cancellazione dati <span class="text-danger">irreversibile</span>! <br>
                                                Continuare?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{route('admin.tags.destroy', $tag->slug)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row">Nessuna categoria esistente</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection