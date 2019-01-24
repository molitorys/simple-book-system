@extends('layouts.general')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2" id="add-form-container">
        <h2>Utwórz wpis</h2>
        
        @include('pages.partials.errors')
        @include('pages.partials.status')

        <form method="post" action="{{ route('create.store') }}">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="title"><span class="red">*</span> Nick:</label>
                <input type="text" class="form-control" name="nick" id="nick" placeholder="Wpisz nick" value="@if (!empty(old('nick'))) {{ old('nick') }} @elseif (isset($nick) && !empty($nick)) {{ $nick }} @endif">
            </div>
            
            <div class="form-group">
                <label for="body"><span class="red">*</span> Książka:</label>
                <input type="text" class="form-control" name="book" id="book" placeholder="Wpisz tytuł książki" value="{{ old('book') }}">
            </div>
            
            <div class="form-group">    
                <button type="submit" class="btn btn-success">Zapisz</button>
            </div>

            <p><span class="red">*</span> - pola wymagane</p>
        </form>
    </div>
</div>

@endsection