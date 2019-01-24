@if (isset($errors) && $errors->count())
    <div class="alert alert-danger">
        Wystąpiły błędy:
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif