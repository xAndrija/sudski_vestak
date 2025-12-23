<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Klijent;
use App\Models\Zahtev;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ZahtevController
 */
final class ZahtevControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $zahtevs = Zahtev::factory()->count(3)->create();

        $response = $this->get(route('zahtevs.index'));

        $response->assertOk();
        $response->assertViewIs('zahtev.index');
        $response->assertViewHas('zahtevs', $zahtevs);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('zahtevs.create'));

        $response->assertOk();
        $response->assertViewIs('zahtev.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ZahtevController::class,
            'store',
            \App\Http\Requests\ZahtevStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $broj_zahteva = fake()->word();
        $opis = fake()->text();
        $tip_vestacenja = fake()->word();
        $lokacija = fake()->word();
        $hitnost = fake()->word();
        $status = fake()->word();
        $datum_podnosenja = Carbon::parse(fake()->date());
        $klijent = Klijent::factory()->create();

        $response = $this->post(route('zahtevs.store'), [
            'broj_zahteva' => $broj_zahteva,
            'opis' => $opis,
            'tip_vestacenja' => $tip_vestacenja,
            'lokacija' => $lokacija,
            'hitnost' => $hitnost,
            'status' => $status,
            'datum_podnosenja' => $datum_podnosenja->toDateString(),
            'klijent_id' => $klijent->id,
        ]);

        $zahtevs = Zahtev::query()
            ->where('broj_zahteva', $broj_zahteva)
            ->where('opis', $opis)
            ->where('tip_vestacenja', $tip_vestacenja)
            ->where('lokacija', $lokacija)
            ->where('hitnost', $hitnost)
            ->where('status', $status)
            ->where('datum_podnosenja', $datum_podnosenja)
            ->where('klijent_id', $klijent->id)
            ->get();
        $this->assertCount(1, $zahtevs);
        $zahtev = $zahtevs->first();

        $response->assertRedirect(route('zahtevs.index'));
        $response->assertSessionHas('zahtev.id', $zahtev->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $zahtev = Zahtev::factory()->create();

        $response = $this->get(route('zahtevs.show', $zahtev));

        $response->assertOk();
        $response->assertViewIs('zahtev.show');
        $response->assertViewHas('zahtev', $zahtev);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $zahtev = Zahtev::factory()->create();

        $response = $this->get(route('zahtevs.edit', $zahtev));

        $response->assertOk();
        $response->assertViewIs('zahtev.edit');
        $response->assertViewHas('zahtev', $zahtev);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ZahtevController::class,
            'update',
            \App\Http\Requests\ZahtevUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $zahtev = Zahtev::factory()->create();
        $broj_zahteva = fake()->word();
        $opis = fake()->text();
        $tip_vestacenja = fake()->word();
        $lokacija = fake()->word();
        $hitnost = fake()->word();
        $status = fake()->word();
        $datum_podnosenja = Carbon::parse(fake()->date());
        $klijent = Klijent::factory()->create();

        $response = $this->put(route('zahtevs.update', $zahtev), [
            'broj_zahteva' => $broj_zahteva,
            'opis' => $opis,
            'tip_vestacenja' => $tip_vestacenja,
            'lokacija' => $lokacija,
            'hitnost' => $hitnost,
            'status' => $status,
            'datum_podnosenja' => $datum_podnosenja->toDateString(),
            'klijent_id' => $klijent->id,
        ]);

        $zahtev->refresh();

        $response->assertRedirect(route('zahtevs.index'));
        $response->assertSessionHas('zahtev.id', $zahtev->id);

        $this->assertEquals($broj_zahteva, $zahtev->broj_zahteva);
        $this->assertEquals($opis, $zahtev->opis);
        $this->assertEquals($tip_vestacenja, $zahtev->tip_vestacenja);
        $this->assertEquals($lokacija, $zahtev->lokacija);
        $this->assertEquals($hitnost, $zahtev->hitnost);
        $this->assertEquals($status, $zahtev->status);
        $this->assertEquals($datum_podnosenja, $zahtev->datum_podnosenja);
        $this->assertEquals($klijent->id, $zahtev->klijent_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $zahtev = Zahtev::factory()->create();

        $response = $this->delete(route('zahtevs.destroy', $zahtev));

        $response->assertRedirect(route('zahtevs.index'));

        $this->assertModelMissing($zahtev);
    }
}
