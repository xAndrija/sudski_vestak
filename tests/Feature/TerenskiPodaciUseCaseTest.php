<?php

namespace Tests\Feature;

use App\Models\Klijent;
use App\Models\TerenskiPodaci;
use App\Models\User;
use App\Models\Zahtev;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class TerenskiPodaciUseCaseTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_saves_terenski_podaci_with_photos_and_links_to_zahtev(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $klijent = Klijent::factory()->create();
        $zahtev = Zahtev::factory()->create([
            'klijent_id' => $klijent->id,
            'status' => 'u_obradi',
        ]);

        $payload = [
            'datum_terena' => '2025-12-24',
            'opis_terena' => 'Opis zapazanja sa terena',
            'merenja' => 'pH=6.2; vlaznost=18%',
            'analize' => 'Analiza uzorka zemlje',
            'zahtev_id' => $zahtev->id,
            'fotografije' => [
                UploadedFile::fake()->image('foto1.jpg'),
                UploadedFile::fake()->image('foto2.png'),
            ],
        ];

        $response = $this->post(route('terenskiPodacis.store'), $payload);

        $response->assertRedirect(route('terenskiPodacis.index'));

        $this->assertDatabaseHas('terenski_podacis', [
            'zahtev_id' => $zahtev->id,
            'opis_terena' => $payload['opis_terena'],
        ]);

        $tp = TerenskiPodaci::firstOrFail();
        $this->assertSame($zahtev->id, $tp->zahtev_id);
        $this->assertSame($payload['datum_terena'], $tp->datum_terena->toDateString());

        $paths = json_decode($tp->fotografije, true);
        $this->assertIsArray($paths);
        $this->assertCount(2, $paths);

        Storage::disk('public')->assertExists($paths[0]);
        Storage::disk('public')->assertExists($paths[1]);
    }

    #[Test]
    public function it_rejects_invalid_photo_format(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $klijent = Klijent::factory()->create();
        $zahtev = Zahtev::factory()->create([
            'klijent_id' => $klijent->id,
            'status' => 'u_obradi',
        ]);

        $response = $this->from(route('terenskiPodacis.create'))->post(route('terenskiPodacis.store'), [
            'datum_terena' => '2025-12-24',
            'opis_terena' => 'Opis',
            'merenja' => 'Merenja',
            'analize' => 'Analize',
            'zahtev_id' => $zahtev->id,
            'fotografije' => [
                UploadedFile::fake()->create('malware.exe', 10, 'application/octet-stream'),
            ],
        ]);

        $response->assertRedirect(route('terenskiPodacis.create'));
        $response->assertSessionHasErrors(['fotografije.0']);

        $this->assertSame(0, TerenskiPodaci::count());
    }

    #[Test]
    public function it_validates_required_fields(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->from(route('terenskiPodacis.create'))->post(route('terenskiPodacis.store'), []);

        $response->assertRedirect(route('terenskiPodacis.create'));
        $response->assertSessionHasErrors([
            'datum_terena',
            'opis_terena',
            'merenja',
            'fotografije',
            'analize',
            'zahtev_id',
        ]);
    }
}
