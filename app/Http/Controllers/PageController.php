<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function dashboard(Request $request)
    {
        $username = $request->query('username', '');
        if (!is_string($username) || trim($username) === '') {
            return redirect()->route('login');
        }
        $username = trim($username);

        $games = $this->dataGame();
        $recommended = array_values(array_filter($games, fn($game) => $game['grup'] === 'recommended' || ($game['rekomendasi'] ?? false)));
        $picks = array_values(array_filter($games, fn($game) => $game['grup'] === 'picks'));
        $discounts = array_values(array_filter($games, fn($game) => $game['grup'] === 'discount'));

        return view('dashboard', compact('username', 'recommended', 'picks', 'discounts'));
    }

    public function pengelolaan(Request $request)
    {
        $username = $request->query('username', '');
        if (!is_string($username) || trim($username) === '') {
            return redirect()->route('login');
        }
        $username = trim($username);

        $games = $this->dataGame();
        $library = array_values(array_filter($games, fn($game) => $game['grup'] === 'library'));
        $installed = array_filter($library, fn($game) => $game['terpasang']);

        $jumlahGame = count($library);
        $jumlahTerpasang = count($installed);
        $totalJamMain = array_sum(array_column($library, 'jam_main'));
        $storageTerpakai = array_sum(array_column($installed, 'ukuran_gb'));
        $kapasitasStorage = 512;
        $persenStorage = round($storageTerpakai / $kapasitasStorage * 100);

        return view('pengelolaan', compact(
            'username', 'library', 'jumlahGame', 'jumlahTerpasang',
            'totalJamMain', 'storageTerpakai', 'kapasitasStorage', 'persenStorage'
        ));
    }

    public function profile(Request $request)
    {
        $username = $request->query('username', '');
        if (!is_string($username) || trim($username) === '') {
            return redirect()->route('login');
        }
        $username = trim($username);

        $games = $this->dataGame();
        $library = array_values(array_filter($games, fn($game) => $game['grup'] === 'library'));
        $favorites = array_values(array_filter($library, fn($game) => $game['favorit']));
        usort($favorites, fn($a, $b) => $b['jam_main'] <=> $a['jam_main']);
        $jumlahGame = count($library);
        $totalJamMain = array_sum(array_column($library, 'jam_main'));
        $bio = 'Suka menjelajahi dunia game dan mengumpulkan achievement.';

        $friends = [
            ['nama' => 'Light', 'status' => 'Online', 'gambar' => asset('images/light.jpg')],
            ['nama' => 'DhaniRamadhani', 'status' => 'Offline', 'gambar' => asset('images/dhani.jpg')],
            ['nama' => 'magnumpcom', 'status' => 'Offline', 'gambar' => asset('images/magnum.jpg')],
            ['nama' => 'moL.is', 'status' => 'Offline', 'gambar' => asset('images/mol.jpg')],
        ];

        $achievements = [
            ['nama' => 'New Player', 'deskripsi' => 'Bergabung sebagai pemain', 'terbuka' => true],
            ['nama' => 'Collector', 'deskripsi' => 'Memiliki 5 game', 'terbuka' => true],
            ['nama' => '100 Hours', 'deskripsi' => 'Bermain selama 100 jam', 'terbuka' => true],
            ['nama' => 'Socialite', 'deskripsi' => 'Memiliki 10 teman', 'terbuka' => false],
        ];

        $jumlahTeman = count($friends);

        return view('profile', compact(
            'username', 'favorites', 'jumlahGame', 'totalJamMain',
            'bio', 'friends', 'achievements', 'jumlahTeman'
        ));
    }

    private function dataGame()
    {
        $games = [
            [
                'id' => 'elden-ring',
                'nama' => 'ELDEN RING',
                'genre' => 'Action RPG',
                'grup' => 'recommended',
                'gambar' => asset('images/elden_ring.jpg'),
                'harga' => 599000,
                'harga_asli' => 599000,
                'deskripsi' => 'Jelajahi Lands Between dan hadapi musuh-musuh tangguh.',
            ],
            [
                'id' => 'cyberpunk-2077',
                'nama' => 'Cyberpunk 2077',
                'genre' => 'RPG',
                'grup' => 'recommended',
                'gambar' => asset('images/cyberpunk.jpg'),
                'harga' => 450000,
                'harga_asli' => 450000,
                'deskripsi' => 'Petualangan di Night City dengan cerita dan pilihan karakter.',
            ],
            [
                'id' => 'hades',
                'nama' => 'Hades',
                'genre' => 'Action Roguelike',
                'grup' => 'picks',
                'gambar' => asset('images/hades.jpg'),
                'harga' => 125000,
                'harga_asli' => 125000,
            ],
            [
                'id' => 'stardew-valley',
                'nama' => 'Stardew Valley',
                'genre' => 'Farming Simulation',
                'grup' => 'picks',
                'gambar' => asset('images/stardew_valley.jpg'),
                'harga' => 115000,
                'harga_asli' => 115000,
            ],
            [
                'id' => 'hollow-knight',
                'nama' => 'Hollow Knight',
                'genre' => 'Metroidvania',
                'grup' => 'picks',
                'gambar' => asset('images/hollow_knight.jpg'),
                'harga' => 149000,
                'harga_asli' => 149000,
            ],
            [
                'id' => 'celeste',
                'nama' => 'Celeste',
                'genre' => 'Platformer',
                'grup' => 'picks',
                'gambar' => asset('images/celeste.jpg'),
                'harga' => 109000,
                'harga_asli' => 109000,
            ],
            [
                'id' => 'resident-evil-4',
                'nama' => 'Resident Evil 4',
                'genre' => 'Survival Horror',
                'grup' => 'discount',
                'gambar' => asset('images/re4.jpg'),
                'harga' => 324000,
                'harga_asli' => 360000,
            ],
            [
                'id' => 'red-dead-redemption-2',
                'nama' => 'Red Dead Redemption 2',
                'genre' => 'Action Adventure',
                'grup' => 'discount',
                'gambar' => asset('images/rdr2.jpg'),
                'harga' => 320000,
                'harga_asli' => 400000,
            ],
            [
                'id' => 'hogwarts-legacy',
                'nama' => 'Hogwarts Legacy',
                'genre' => 'Action RPG',
                'grup' => 'discount',
                'gambar' => asset('images/hogwarts_legacy.jpg'),
                'harga' => 350000,
                'harga_asli' => 500000,
            ],
            [
                'id' => 'witcher-3',
                'nama' => 'The Witcher 3: Wild Hunt',
                'genre' => 'RPG',
                'grup' => 'discount',
                'gambar' => asset('images/witcher3.jpg'),
                'harga' => 150000,
                'harga_asli' => 300000,
            ],
            [
                'id' => 'fc-26',
                'nama' => 'FC 26',
                'genre' => 'Sports',
                'grup' => 'library',
                'rekomendasi' => true,
                'gambar' => asset('images/fc26.jpg'),
                'harga' => 0,
                'harga_asli' => 0,
                'deskripsi' => 'Mainkan pertandingan sepak bola bersama klub dan pemain favoritmu.',
                'ukuran_gb' => 100,
                'jam_main' => 260,
                'terakhir_dimainkan' => '8 Nov 2026',
                'terpasang' => true,
                'favorit' => true,
            ],
            [
                'id' => 'euro-truck-simulator-2',
                'nama' => 'Euro Truck Simulator 2',
                'genre' => 'Simulation',
                'grup' => 'library',
                'gambar' => asset('images/ets2.jpg'),
                'harga' => 0,
                'harga_asli' => 0,
                'ukuran_gb' => 48,
                'jam_main' => 124,
                'terakhir_dimainkan' => '6 Nov 2026',
                'terpasang' => true,
                'favorit' => true,
            ],
            [
                'id' => 'portal-2',
                'nama' => 'Portal 2',
                'genre' => 'Puzzle',
                'grup' => 'library',
                'gambar' => asset('images/portal2.jpg'),
                'harga' => 0,
                'harga_asli' => 0,
                'ukuran_gb' => 32,
                'jam_main' => 56,
                'terakhir_dimainkan' => '2 Nov 2026',
                'terpasang' => false,
                'favorit' => false,
            ],
            [
                'id' => 'dead-cells',
                'nama' => 'Dead Cells',
                'genre' => 'Action Roguelike',
                'grup' => 'library',
                'gambar' => asset('images/dead_cells.jpg'),
                'harga' => 0,
                'harga_asli' => 0,
                'ukuran_gb' => 21,
                'jam_main' => 38,
                'terakhir_dimainkan' => '30 Okt 2026',
                'terpasang' => true,
                'favorit' => true,
            ],
            [
                'id' => 'terraria',
                'nama' => 'Terraria',
                'genre' => 'Sandbox Adventure',
                'grup' => 'library',
                'gambar' => asset('images/terraria.jpg'),
                'harga' => 0,
                'harga_asli' => 0,
                'ukuran_gb' => 4,
                'jam_main' => 18,
                'terakhir_dimainkan' => '12 Okt 2026',
                'terpasang' => true,
                'favorit' => false,
            ],
            [
                'id' => 'slay-the-spire',
                'nama' => 'Slay the Spire',
                'genre' => 'Card Strategy',
                'grup' => 'library',
                'gambar' => asset('images/slay_spire.jpg'),
                'harga' => 0,
                'harga_asli' => 0,
                'ukuran_gb' => 9,
                'jam_main' => 71,
                'terakhir_dimainkan' => '25 Sep 2026',
                'terpasang' => false,
                'favorit' => true,
            ],
        ];

        foreach ($games as $index => $game) {
            $games[$index]['diskon_persen'] = $game['harga_asli'] > $game['harga']
                ? round((1 - $game['harga'] / $game['harga_asli']) * 100)
                : 0;
        }

        return $games;
    }
}
