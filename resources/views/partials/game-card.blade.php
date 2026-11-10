@if ($jenis === 'recommended')
    <article class="hero h-100">
        <img class="cover" src="{{ $game['gambar'] }}" alt="{{ $game['nama'] }}" width="640" height="360" fetchpriority="high">
        <div class="info">
            <h3 class="gv-card-title">{{ $game['nama'] }}</h3>
            <p>{{ $game['deskripsi'] }}</p>
            @if ($game['grup'] === 'library')
                <p class="gv-muted mb-0">In Library · {{ $game['jam_main'] }} hrs played</p>
            @else
                <strong>Rp {{ number_format($game['harga'], 0, ',', '.') }}</strong>
            @endif
        </div>
    </article>
@elseif ($jenis === 'picks')
    <article class="card mini h-100">
        <img class="cover" src="{{ $game['gambar'] }}" alt="{{ $game['nama'] }}" width="640" height="360" loading="lazy">
        <div>
            <h3 class="gv-card-title">{{ $game['nama'] }}</h3>
            <span>{{ $game['genre'] }}</span>
            <b>Rp {{ number_format($game['harga'], 0, ',', '.') }}</b>
        </div>
    </article>
@elseif ($jenis === 'discount')
    <article class="card disc h-100">
        <div class="img">
            <img class="cover {{ $game['id'] === 'red-dead-redemption-2' ? 'gv-cover-poster' : '' }}" src="{{ $game['gambar'] }}" alt="{{ $game['nama'] }}" width="640" height="360" loading="lazy">
            <span class="sale">-{{ $game['diskon_persen'] }}%</span>
        </div>
        <div class="foot">
            <div class="gv-card-copy">
                <h3 class="gv-card-title">{{ $game['nama'] }}</h3>
                <span class="mute">{{ $game['genre'] }}</span>
            </div>
            <div class="price">
                <b>Rp {{ number_format($game['harga'], 0, ',', '.') }}</b>
                <s>Rp {{ number_format($game['harga_asli'], 0, ',', '.') }}</s>
            </div>
        </div>
    </article>
@endif
