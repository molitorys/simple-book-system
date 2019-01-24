@extends('layouts.general')

@section('content')

<h2>Lista Czytelników</h2>

@include('pages.partials.status')

@if (isset($readers) && $readers->isNotEmpty())

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nick czytelnika</th>
                <th scope="col" class="text-center">Data utworzenia</th>
                <th scope="col" class="text-center">Data dodania książki</th>
                <th scope="col" class="text-center">Liczba książek</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($readers as $reader)
            <tr>
                <th scope="row">{{ $reader->id }}</th>
                <td>{{ $reader->nick }}</td>
                <td class="text-center">{{ $reader->created_at }}</td>
                <td class="text-center">
                    @if ($reader->books_count > 0 && $reader->latestBook)
                    {{ $reader->latestBook->added_at }}
                    @else
                    -
                    @endif
                </td>
                <td class="text-center">{{ $reader->books_count }}</td>
                <td class="text-right"><a class="btn btn-primary" href="{{ $reader->url() }}"><i class="fa fa-book"></i> Szczegóły</a></td>
                <td class="text-right">
                <form method="POST" action="{{ $reader->url() }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Usuń</button>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>

@else
    <div>Brak czytelników. <a href="{{ route('create.form') }}">Możesz być pierwszy...</a></div>
@endif

@endsection