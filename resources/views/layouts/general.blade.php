<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
@include('layouts.partials.head')

<body>

    <div class="container">

        @include('layouts.partials.header')
        @include('layouts.partials.navigation')

        <div class="content">
            @yield('content')
        </div>

        @include('layouts.partials.footer')
        @include('layouts.partials.scripts')

    </div>

</body>
</html>

