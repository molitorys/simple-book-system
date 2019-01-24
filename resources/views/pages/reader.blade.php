@extends('layouts.general')

@section('content')

<h2>Czytelnik - {{ $reader->nick }}</h2>

<form method="POST" action="{{ $reader->url() }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Usuń czytelnika</button>
</form>
<br>

@include('pages.partials.status')

@if (isset($reader->books) && $reader->books->isNotEmpty())

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tytuł książki</th>
                <th scope="col" class="text-center">Data dodania</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reader->books as $book)
            <tr>
                <th scope="row">{{ $book->id }}</th>
                <td>{{ $book->title }}</td>
                <td class="text-center">{{ $book->added_at }}</td>
                <td class="text-right">
                <form method="POST" action="{{ route('reader.delete.book', ['slug' => $reader->nick_slug, 'id' => $reader->id, 'book_id' => $book->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Usuń</button>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>

@else
    <div>Czytelnik jeszcze nie posiada żadanej książki. <a href="{{ route('create.form') }}">Dodaj pierwszą książkę...</a></div>
@endif

@endsection