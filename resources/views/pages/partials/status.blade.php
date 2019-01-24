@if (isset($status))
    
    @if ($status == 'deleted')
        <div class="alert alert-warning">Wpis został usunięty</div>
    @elseif ($status == 'created')
        <div class="alert alert-success">Wpis został dodany</div>
    @endif

@endif