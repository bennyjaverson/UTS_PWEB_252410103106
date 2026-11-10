@props(['username'])
<header class="navbar">
    <div class="container gv-nav">
        <a href="{{ route('dashboard', ['username' => $username]) }}" class="brand">
            <span>Game Store</span>
        </a>
        <nav class="links" aria-label="Navigasi utama">
            <a href="{{ route('dashboard', ['username' => $username]) }}" class="{{ request()->routeIs('dashboard') ? 'on' : '' }}" @if (request()->routeIs('dashboard')) aria-current="page" @endif>Home</a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="{{ request()->routeIs('pengelolaan') ? 'on' : '' }}" @if (request()->routeIs('pengelolaan')) aria-current="page" @endif>Library</a>
        </nav>
        <div class="gv-account">
            <a href="{{ route('profile', ['username' => $username]) }}" class="user" aria-label="Profile {{ $username }}" @if (request()->routeIs('profile')) aria-current="page" @endif>
                <span class="username">{{ $username }}</span>
                @include('partials.avatar', ['avatarClass' => 'avatar', 'avatarSize' => 36])
            </a>
            <a href="{{ route('login') }}" class="logout">Logout</a>
        </div>
    </div>
</header>
<nav class="tabbar" aria-label="Navigasi mobile">
    <a href="{{ route('dashboard', ['username' => $username]) }}" class="{{ request()->routeIs('dashboard') ? 'on' : '' }}" @if (request()->routeIs('dashboard')) aria-current="page" @endif>Home</a>
    <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="{{ request()->routeIs('pengelolaan') ? 'on' : '' }}" @if (request()->routeIs('pengelolaan')) aria-current="page" @endif>Library</a>
    <a href="{{ route('profile', ['username' => $username]) }}" class="{{ request()->routeIs('profile') ? 'on' : '' }}" @if (request()->routeIs('profile')) aria-current="page" @endif>Profile</a>
    <a href="{{ route('login') }}">Logout</a>
</nav>
