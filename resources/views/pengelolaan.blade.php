@extends('layouts.app')
@section('title', 'My Library')
@section('content')
<main class="container gv-page">
    <section class="gv-page-header">
        <h1 class="gv-page-title">My Library</h1>
        <p class="gv-muted gv-user-content mb-0">Contoh koleksi game milik {{ $username }}.</p>
    </section>
    <section class="row g-3 mb-5">
        <div class="col-6 col-lg-3">
            <div class="gv-stat h-100">
                <span>Total Games</span>
                <p class="gv-stat-value">{{ $jumlahGame }}</p>
                <small>Game dalam koleksi</small>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="gv-stat h-100">
                <span>Installed</span>
                <p class="gv-stat-value">{{ $jumlahTerpasang }}</p>
                <small>Game terpasang</small>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="gv-stat h-100">
                <span>Playtime</span>
                <p class="gv-stat-value">{{ $totalJamMain }} <small>hrs</small></p>
                <small>Total waktu bermain</small>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="gv-stat h-100">
                <span>Storage Used</span>
                <p class="gv-stat-value">{{ $storageTerpakai }} <small>GB</small></p>
                <small>Dari {{ $kapasitasStorage }} GB</small>
            </div>
        </div>
    </section>
    <section class="gv-panel mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 id="storage-overview" class="gv-section-title mb-0">Storage Overview</h2>
            <span class="gv-muted">{{ $persenStorage }}%</span>
        </div>
        <div class="progress gv-progress mb-3">
            <div class="progress-bar gv-progress-fill" role="progressbar" aria-labelledby="storage-overview" style="width: {{ $persenStorage }}%" aria-valuenow="{{ $persenStorage }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="d-flex justify-content-between gap-3">
            <span class="gv-muted">{{ $storageTerpakai }} GB used</span>
            <span class="gv-muted">{{ $kapasitasStorage - $storageTerpakai }} GB available</span>
        </div>
    </section>
    <section>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="gv-section-title mb-0">All Games</h2>
            <span class="gv-count">{{ $jumlahGame }} Games</span>
        </div>
        <p id="installation-note" class="gv-muted">Status game merupakan data contoh. Install dan Uninstall belum tersedia di website ini.</p>
        <div class="d-flex flex-column gap-3">
            @forelse ($library as $game)
                <article class="gv-library-card">
                    <img src="{{ $game['gambar'] }}" alt="{{ $game['nama'] }}" class="gv-library-cover" width="320" height="180" loading="lazy">
                    <div class="gv-library-info">
                        <div class="d-flex align-items-start justify-content-between gap-3">
                            <div>
                                <h3 class="gv-card-title">{{ $game['nama'] }}</h3>
                                <p class="gv-muted mb-2">{{ $game['genre'] }}</p>
                            </div>
                            @if ($game['favorit'])
                                <span class="gv-star" title="Favorite">★</span>
                            @endif
                        </div>
                        <div class="d-flex flex-wrap gap-3 gv-game-details">
                            <span>Playtime: <strong>{{ $game['jam_main'] }} hrs</strong></span>
                            <span>Size: <strong>{{ $game['ukuran_gb'] }} GB</strong></span>
                            <span>Last played: <strong>{{ $game['terakhir_dimainkan'] }}</strong></span>
                        </div>
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mt-3">
                            @if ($game['terpasang'])
                                <span class="gv-status gv-installed">● Installed</span>
                                <button type="button" class="btn gv-btn-outline" aria-describedby="installation-note" disabled>Uninstall</button>
                            @else
                                <span class="gv-status gv-not-installed">● Not Installed</span>
                                <button type="button" class="btn gv-btn-primary" aria-describedby="installation-note" disabled>Install</button>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-secondary">Belum ada game di Library.</p>
            @endforelse
        </div>
    </section>
</main>
@endsection
