<?php

namespace Tests\Feature;

use Tests\TestCase;

class GameStoreDataTest extends TestCase
{
    public function test_pages_redirect_when_username_is_missing_or_invalid(): void
    {
        foreach (['dashboard', 'pengelolaan', 'profile'] as $page) {
            $this->get('/'.$page)->assertRedirect('/');
            $this->get('/'.$page.'?username[]=Benny')->assertRedirect('/');
        }
    }

    public function test_game_data_and_statistics_are_consistent_across_pages(): void
    {
        $home = $this->get('/dashboard?username=Benny')->assertOk();
        $library = $this->get('/pengelolaan?username=Benny')->assertOk();
        $profile = $this->get('/profile?username=Benny')->assertOk();

        $games = $library->viewData('library');
        $favorites = $profile->viewData('favorites');
        $fc26 = array_values(array_filter($games, fn($game) => $game['id'] === 'fc-26'))[0];
        $recommendedFc26 = array_values(array_filter($home->viewData('recommended'), fn($game) => $game['id'] === 'fc-26'))[0];

        $this->assertSame($fc26, $recommendedFc26);
        $this->assertSame($fc26, $favorites[0]);
        $this->assertGreaterThan(max(array_column(array_slice($favorites, 1), 'jam_main')), $fc26['jam_main']);
        $this->assertSame(count($games), $library->viewData('jumlahGame'));
        $this->assertSame(count($games), $profile->viewData('jumlahGame'));
        $this->assertSame(array_sum(array_column($games, 'jam_main')), $profile->viewData('totalJamMain'));
        $this->assertSame($library->viewData('totalJamMain'), $profile->viewData('totalJamMain'));

        $installed = array_filter($games, fn($game) => $game['terpasang']);
        $this->assertSame(count($installed), $library->viewData('jumlahTerpasang'));
        $this->assertSame(array_sum(array_column($installed, 'ukuran_gb')), $library->viewData('storageTerpakai'));
    }

    public function test_friends_use_the_names_and_statuses_from_the_reference(): void
    {
        $response = $this->get('/profile?username=Benny')->assertOk();
        $friends = $response->viewData('friends');

        $this->assertSame(['Light', 'DhaniRamadhani', 'magnumpcom', 'moL.is'], array_column($friends, 'nama'));
        $this->assertSame(['Online', 'Offline', 'Offline', 'Offline'], array_column($friends, 'status'));
        $this->assertSame(count($friends), $response->viewData('jumlahTeman'));
    }
}
