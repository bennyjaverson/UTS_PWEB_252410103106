<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    @include('partials.head')
</head>
<body class="{{ request()->routeIs('login') ? '' : 'has-mobile-nav' }}">
    @if (!request()->routeIs('login'))
        <x-navbar :username="$username" />
    @endif
    @yield('content')
    <x-footer />
</body>
</html>
