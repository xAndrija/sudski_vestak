<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\KlijentKorisnik;
use App\Models\Poruka;
use App\Models\Posiljalac;
use App\Models\Primalac;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PorukaController
 */
final class PorukaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $porukas = Poruka::factory()->count(3)->create();

        $response = $this->get(route('porukas.index'));

        $response->assertOk();
        $response->assertViewIs('poruka.index');
        $response->assertViewHas('porukas', $porukas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('porukas.create'));

        $response->assertOk();
        $response->assertViewIs('poruka.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PorukaController::class,
            'store',
            \App\Http\Requests\PorukaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $sadrzaj = fake()->text();
        $datum_slanja = Carbon::parse(fake()->date());
        $posiljalac = Posiljalac::factory()->create();
        $primalac = Primalac::factory()->create();
        $klijent_korisnik = KlijentKorisnik::factory()->create();

        $response = $this->post(route('porukas.store'), [
            'sadrzaj' => $sadrzaj,
            'datum_slanja' => $datum_slanja->toDateString(),
            'posiljalac_id' => $posiljalac->id,
            'primalac_id' => $primalac->id,
            'klijent_korisnik_id' => $klijent_korisnik->id,
        ]);

        $porukas = Poruka::query()
            ->where('sadrzaj', $sadrzaj)
            ->where('datum_slanja', $datum_slanja)
            ->where('posiljalac_id', $posiljalac->id)
            ->where('primalac_id', $primalac->id)
            ->where('klijent_korisnik_id', $klijent_korisnik->id)
            ->get();
        $this->assertCount(1, $porukas);
        $poruka = $porukas->first();

        $response->assertRedirect(route('porukas.index'));
        $response->assertSessionHas('poruka.id', $poruka->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $poruka = Poruka::factory()->create();

        $response = $this->get(route('porukas.show', $poruka));

        $response->assertOk();
        $response->assertViewIs('poruka.show');
        $response->assertViewHas('poruka', $poruka);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $poruka = Poruka::factory()->create();

        $response = $this->get(route('porukas.edit', $poruka));

        $response->assertOk();
        $response->assertViewIs('poruka.edit');
        $response->assertViewHas('poruka', $poruka);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PorukaController::class,
            'update',
            \App\Http\Requests\PorukaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $poruka = Poruka::factory()->create();
        $sadrzaj = fake()->text();
        $datum_slanja = Carbon::parse(fake()->date());
        $posiljalac = Posiljalac::factory()->create();
        $primalac = Primalac::factory()->create();
        $klijent_korisnik = KlijentKorisnik::factory()->create();

        $response = $this->put(route('porukas.update', $poruka), [
            'sadrzaj' => $sadrzaj,
            'datum_slanja' => $datum_slanja->toDateString(),
            'posiljalac_id' => $posiljalac->id,
            'primalac_id' => $primalac->id,
            'klijent_korisnik_id' => $klijent_korisnik->id,
        ]);

        $poruka->refresh();

        $response->assertRedirect(route('porukas.index'));
        $response->assertSessionHas('poruka.id', $poruka->id);

        $this->assertEquals($sadrzaj, $poruka->sadrzaj);
        $this->assertEquals($datum_slanja, $poruka->datum_slanja);
        $this->assertEquals($posiljalac->id, $poruka->posiljalac_id);
        $this->assertEquals($primalac->id, $poruka->primalac_id);
        $this->assertEquals($klijent_korisnik->id, $poruka->klijent_korisnik_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $poruka = Poruka::factory()->create();

        $response = $this->delete(route('porukas.destroy', $poruka));

        $response->assertRedirect(route('porukas.index'));

        $this->assertModelMissing($poruka);
    }
}
