@extends('layouts.admin')

@section('content')

<div class="container py-5">
@include('partials.error')
<form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Titolo</label>
    <input type="title" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="titlehelp" value="{{old('title')}}">
    <div id="titlehelp" class="form-text">Inserire il titolo del post</div>
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">Contenuto</label>
    <textarea type="text" class="form-control" name="content" id="content" aria-describedby="contenthelp">
    {{old('content')}}
    </textarea>
    <div id="contenthelp" class="form-text">Inserire la descrizione del fumetto</div>
  </div>
  <div class="mb-3">
    <label for="category_id" class="form-label">Categoria</label>
    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
      <option value="">Scegli una categoria</option>
        @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
  </div>


  <div class="mb-3">
    <label for="tags" class="form-label">Tags</label>
    <select multiple class="form-control" name="tags[]" id="tags">
      <option value="" disabled>Scegli una categoria</option>
        @forelse($tags as $tag)
          <option value="{{$tag->id}}">{{$tag->name}}</option>
        @empty
        <option value="">NO TAGS</option>
        @endforelse
    </select>
  </div>

  


  <div class="mb-3">
    <label for="img" class="form-label">Image</label>
    <input type="file" class="form-control" name="img" id="img" aria-describedby="imghelp">
    <div id="imghelp" class="form-text">Inserire Immagine del post</div>
  </div>
  <button type="submit" class="btn btn-primary">Aggiungi</button>
</form>
</div>

@endsection