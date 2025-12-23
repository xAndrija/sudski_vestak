<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Dokument;
use App\Models\TerenskiPodaci;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DokumentController
 */
final class DokumentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $dokuments = Dokument::factory()->count(3)->create();

        $response = $this->get(route('dokuments.index'));

        $response->assertOk();
        $response->assertViewIs('dokument.index');
        $response->assertViewHas('dokuments', $dokuments);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('dokuments.create'));

        $response->assertOk();
        $response->assertViewIs('dokument.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DokumentController::class,
            'store',
            \App\Http\Requests\DokumentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $naziv = fake()->word();
        $tip = fake()->word();
        $putanja = fake()->word();
        $datum_dodavanja = Carbon::parse(fake()->date());
        $terenski_podaci = TerenskiPodaci::factory()->create();

        $response = $this->post(route('dokuments.store'), [
            'naziv' => $naziv,
            'tip' => $tip,
            'putanja' => $putanja,
            'datum_dodavanja' => $datum_dodavanja->toDateString(),
            'terenski_podaci_id' => $terenski_podaci->id,
        ]);

        $dokuments = Dokument::query()
            ->where('naziv', $naziv)
            ->where('tip', $tip)
            ->where('putanja', $putanja)
            ->where('datum_dodavanja', $datum_dodavanja)
            ->where('terenski_podaci_id', $terenski_podaci->id)
            ->get();
        $this->assertCount(1, $dokuments);
        $dokument = $dokuments->first();

        $response->assertRedirect(route('dokuments.index'));
        $response->assertSessionHas('dokument.id', $dokument->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $dokument = Dokument::factory()->create();

        $response = $this->get(route('dokuments.show', $dokument));

        $response->assertOk();
        $response->assertViewIs('dokument.show');
        $response->assertViewHas('dokument', $dokument);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $dokument = Dokument::factory()->create();

        $response = $this->get(route('dokuments.edit', $dokument));

        $response->assertOk();
        $response->assertViewIs('dokument.edit');
        $response->assertViewHas('dokument', $dokument);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DokumentController::class,
            'update',
            \App\Http\Requests\DokumentUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $dokument = Dokument::factory()->create();
        $naziv = fake()->word();
        $tip = fake()->word();
        $putanja = fake()->word();
        $datum_dodavanja = Carbon::parse(fake()->date());
        $terenski_podaci = TerenskiPodaci::factory()->create();

        $response = $this->put(route('dokuments.update', $dokument), [
            'naziv' => $naziv,
            'tip' => $tip,
            'putanja' => $putanja,
            'datum_dodavanja' => $datum_dodavanja->toDateString(),
            'terenski_podaci_id' => $terenski_podaci->id,
        ]);

        $dokument->refresh();

        $response->assertRedirect(route('dokuments.index'));
        $response->assertSessionHas('dokument.id', $dokument->id);

        $this->assertEquals($naziv, $dokument->naziv);
        $this->assertEquals($tip, $dokument->tip);
        $this->assertEquals($putanja, $dokument->putanja);
        $this->assertEquals($datum_dodavanja, $dokument->datum_dodavanja);
        $this->assertEquals($terenski_podaci->id, $dokument->terenski_podaci_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $dokument = Dokument::factory()->create();

        $response = $this->delete(route('dokuments.destroy', $dokument));

        $response->assertRedirect(route('dokuments.index'));

        $this->assertModelMissing($dokument);
    }
}
