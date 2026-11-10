@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<main class="container gv-page">
    <section class="gv-page-header">
        <h1 class="gv-page-title gv-user-content">Selamat datang, {{ $username }}</h1>
        <p class="gv-muted mb-0">Lihat pilihan game dan penawaran diskon.</p>
    </section>
    <section class="mb-5">
        <div class="mb-3">
            <h2 class="gv-section-title mb-0">Recommended Games</h2>
        </div>
        <div class="row g-4">
            @forelse ($recommended as $game)
                <div class="col-12 col-md-6 col-xl-4">
                    @include('partials.game-card', ['game' => $game, 'jenis' => 'recommended'])
                </div>
            @empty
                <p class="text-secondary">Belum ada game rekomendasi.</p>
            @endforelse
        </div>
    </section>
    <section class="mb-5">
        <div class="mb-3">
            <h2 class="gv-section-title mb-0">Game Store Picks</h2>
        </div>
        <div class="row g-4">
            @forelse ($picks as $game)
                <div class="col-12 col-md-6 col-xl-3">
                    @include('partials.game-card', ['game' => $game, 'jenis' => 'picks'])
                </div>
            @empty
                <p class="text-secondary">Belum ada game pilihan.</p>
            @endforelse
        </div>
    </section>
    <section class="mb-5">
        <div class="mb-3">
            <h2 class="gv-section-title mb-0">Special Discounts</h2>
        </div>
        <div class="row g-4">
            @forelse ($discounts as $game)
                <div class="col-12 col-md-6 col-xl-3">
                    @include('partials.game-card', ['game' => $game, 'jenis' => 'discount'])
                </div>
            @empty
                <p class="text-secondary">Belum ada game diskon.</p>
            @endforelse
        </div>
    </section>
</main>
@endsection
