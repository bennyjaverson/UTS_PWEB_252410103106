@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
<main class="container gv-page">
    <section class="gv-panel gv-profile-header mb-4">
        @include('partials.avatar', ['avatarClass' => 'gv-profile-avatar', 'avatarSize' => 100])
        <div>
            <h1 class="gv-page-title mb-2 gv-user-content">{{ $username }}</h1>
            <p class="gv-muted mb-0">{{ $bio }}</p>
        </div>
    </section>
    <section class="row g-3 mb-5">
        <div class="col-6 col-lg-3">
            <div class="gv-stat h-100">
                <span>Games Owned</span>
                <p class="gv-stat-value">{{ $jumlahGame }}</p>
                <small>Total koleksi game</small>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="gv-stat h-100">
                <span>Total Playtime</span>
                <p class="gv-stat-value">{{ $totalJamMain }} <small>hrs</small></p>
                <small>Waktu bermain</small>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="gv-stat h-100">
                <span>Friends</span>
                <p class="gv-stat-value">{{ $jumlahTeman }}</p>
                <small>Teman terhubung</small>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="gv-stat h-100">
                <span>Favorite Games</span>
                <p class="gv-stat-value">{{ count($favorites) }}</p>
                <small>Game pilihanmu</small>
            </div>
        </div>
    </section>
    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <section class="gv-panel mb-4">
                <h2 class="gv-section-title mb-4">Favorite Games</h2>
                <div class="row g-3">
                    @forelse ($favorites as $game)
                        <div class="col-12 col-md-6">
                            <article class="gv-favorite">
                                <img src="{{ $game['gambar'] }}" alt="{{ $game['nama'] }}" width="320" height="180" loading="lazy">
                                <div class="gv-favorite-info">
                                    <span class="gv-star">★ Favorite</span>
                                    <h3 class="gv-card-title">{{ $game['nama'] }}</h3>
                                    <p class="gv-muted mb-0">{{ $game['jam_main'] }} hrs played</p>
                                </div>
                            </article>
                        </div>
                    @empty
                        <p class="gv-muted">Belum ada game favorit.</p>
                    @endforelse
                </div>
            </section>
            <section class="gv-panel">
                <h2 class="gv-section-title mb-4">Achievements</h2>
                <div class="d-flex flex-column gap-3">
                    @foreach ($achievements as $achievement)
                        <div class="gv-achievement">
                            <div class="gv-achievement-icon {{ $achievement['terbuka'] ? 'gv-achievement-unlocked' : '' }}">
                                {{ $achievement['terbuka'] ? '★' : '◇' }}
                            </div>
                            <div class="gv-flex-grow">
                                <h3 class="gv-card-title">{{ $achievement['nama'] }}</h3>
                                <p class="gv-muted mb-0">{{ $achievement['deskripsi'] }}</p>
                            </div>
                            <span class="gv-status {{ $achievement['terbuka'] ? 'gv-installed' : 'gv-not-installed' }}">
                                {{ $achievement['terbuka'] ? 'Unlocked' : 'Locked' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
        <div class="col-12 col-lg-4">
            <section class="gv-panel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="gv-section-title mb-0">Friends</h2>
                    <span class="gv-count">{{ $jumlahTeman }}</span>
                </div>
                <div class="d-flex flex-column gap-3">
                    @forelse ($friends as $friend)
                        <div class="gv-friend">
                            <img src="{{ $friend['gambar'] }}" alt="" class="gv-friend-avatar" width="44" height="44" loading="lazy" aria-hidden="true">
                            <div class="gv-flex-grow">
                                <h3 class="gv-card-title">{{ $friend['nama'] }}</h3>
                                <span class="{{ $friend['status'] === 'Online' ? 'gv-online' : 'gv-muted' }}">
                                    ● {{ $friend['status'] }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="gv-muted">Belum ada teman.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</main>
@endsection
