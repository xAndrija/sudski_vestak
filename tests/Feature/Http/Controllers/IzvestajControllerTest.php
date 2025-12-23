<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Izvestaj;
use App\Models\Korisnik;
use App\Models\KorisnikZahtev;
use App\Models\Zahtev;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\IzvestajController
 */
final class IzvestajControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $izvestajs = Izvestaj::factory()->count(3)->create();

        $response = $this->get(route('izvestajs.index'));

        $response->assertOk();
        $response->assertViewIs('izvestaj.index');
        $response->assertViewHas('izvestajs', $izvestajs);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('izvestajs.create'));

        $response->assertOk();
        $response->assertViewIs('izvestaj.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\IzvestajController::class,
            'store',
            \App\Http\Requests\IzvestajStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $naziv = fake()->word();
        $datum = Carbon::parse(fake()->date());
        $status = fake()->word();
        $korisnik = Korisnik::factory()->create();
        $zahtev = Zahtev::factory()->create();
        $korisnik_zahtev = KorisnikZahtev::factory()->create();

        $response = $this->post(route('izvestajs.store'), [
            'naziv' => $naziv,
            'datum' => $datum->toDateString(),
            'status' => $status,
            'korisnik_id' => $korisnik->id,
            'zahtev_id' => $zahtev->id,
            'korisnik_zahtev_id' => $korisnik_zahtev->id,
        ]);

        $izvestajs = Izvestaj::query()
            ->where('naziv', $naziv)
            ->where('datum', $datum)
            ->where('status', $status)
            ->where('korisnik_id', $korisnik->id)
            ->where('zahtev_id', $zahtev->id)
            ->where('korisnik_zahtev_id', $korisnik_zahtev->id)
            ->get();
        $this->assertCount(1, $izvestajs);
        $izvestaj = $izvestajs->first();

        $response->assertRedirect(route('izvestajs.index'));
        $response->assertSessionHas('izvestaj.id', $izvestaj->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $izvestaj = Izvestaj::factory()->create();

        $response = $this->get(route('izvestajs.show', $izvestaj));

        $response->assertOk();
        $response->assertViewIs('izvestaj.show');
        $response->assertViewHas('izvestaj', $izvestaj);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $izvestaj = Izvestaj::factory()->create();

        $response = $this->get(route('izvestajs.edit', $izvestaj));

        $response->assertOk();
        $response->assertViewIs('izvestaj.edit');
        $response->assertViewHas('izvestaj', $izvestaj);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\IzvestajController::class,
            'update',
            \App\Http\Requests\IzvestajUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $izvestaj = Izvestaj::factory()->create();
        $naziv = fake()->word();
        $datum = Carbon::parse(fake()->date());
        $status = fake()->word();
        $korisnik = Korisnik::factory()->create();
        $zahtev = Zahtev::factory()->create();
        $korisnik_zahtev = KorisnikZahtev::factory()->create();

        $response = $this->put(route('izvestajs.update', $izvestaj), [
            'naziv' => $naziv,
            'datum' => $datum->toDateString(),
            'status' => $status,
            'korisnik_id' => $korisnik->id,
            'zahtev_id' => $zahtev->id,
            'korisnik_zahtev_id' => $korisnik_zahtev->id,
        ]);

        $izvestaj->refresh();

        $response->assertRedirect(route('izvestajs.index'));
        $response->assertSessionHas('izvestaj.id', $izvestaj->id);

        $this->assertEquals($naziv, $izvestaj->naziv);
        $this->assertEquals($datum, $izvestaj->datum);
        $this->assertEquals($status, $izvestaj->status);
        $this->assertEquals($korisnik->id, $izvestaj->korisnik_id);
        $this->assertEquals($zahtev->id, $izvestaj->zahtev_id);
        $this->assertEquals($korisnik_zahtev->id, $izvestaj->korisnik_zahtev_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $izvestaj = Izvestaj::factory()->create();

        $response = $this->delete(route('izvestajs.destroy', $izvestaj));

        $response->assertRedirect(route('izvestajs.index'));

        $this->assertModelMissing($izvestaj);
    }
}
