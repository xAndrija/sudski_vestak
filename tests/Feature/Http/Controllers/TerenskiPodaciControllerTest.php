<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TerenskiPodaci;
use App\Models\Zahtev;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TerenskiPodaciController
 */
final class TerenskiPodaciControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $terenskiPodacis = TerenskiPodaci::factory()->count(3)->create();

        $response = $this->get(route('terenski-podacis.index'));

        $response->assertOk();
        $response->assertViewIs('terenskiPodaci.index');
        $response->assertViewHas('terenskiPodacis', $terenskiPodacis);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('terenski-podacis.create'));

        $response->assertOk();
        $response->assertViewIs('terenskiPodaci.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TerenskiPodaciController::class,
            'store',
            \App\Http\Requests\TerenskiPodaciStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $datum_terena = Carbon::parse(fake()->date());
        $opis_terena = fake()->text();
        $merenja = fake()->text();
        $fotografije = fake()->text();
        $analize = fake()->text();
        $zahtev = Zahtev::factory()->create();

        $response = $this->post(route('terenski-podacis.store'), [
            'datum_terena' => $datum_terena->toDateString(),
            'opis_terena' => $opis_terena,
            'merenja' => $merenja,
            'fotografije' => $fotografije,
            'analize' => $analize,
            'zahtev_id' => $zahtev->id,
        ]);

        $terenskiPodacis = TerenskiPodaci::query()
            ->where('datum_terena', $datum_terena)
            ->where('opis_terena', $opis_terena)
            ->where('merenja', $merenja)
            ->where('fotografije', $fotografije)
            ->where('analize', $analize)
            ->where('zahtev_id', $zahtev->id)
            ->get();
        $this->assertCount(1, $terenskiPodacis);
        $terenskiPodaci = $terenskiPodacis->first();

        $response->assertRedirect(route('terenskiPodacis.index'));
        $response->assertSessionHas('terenskiPodaci.id', $terenskiPodaci->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $terenskiPodaci = TerenskiPodaci::factory()->create();

        $response = $this->get(route('terenski-podacis.show', $terenskiPodaci));

        $response->assertOk();
        $response->assertViewIs('terenskiPodaci.show');
        $response->assertViewHas('terenskiPodaci', $terenskiPodaci);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $terenskiPodaci = TerenskiPodaci::factory()->create();

        $response = $this->get(route('terenski-podacis.edit', $terenskiPodaci));

        $response->assertOk();
        $response->assertViewIs('terenskiPodaci.edit');
        $response->assertViewHas('terenskiPodaci', $terenskiPodaci);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TerenskiPodaciController::class,
            'update',
            \App\Http\Requests\TerenskiPodaciUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $terenskiPodaci = TerenskiPodaci::factory()->create();
        $datum_terena = Carbon::parse(fake()->date());
        $opis_terena = fake()->text();
        $merenja = fake()->text();
        $fotografije = fake()->text();
        $analize = fake()->text();
        $zahtev = Zahtev::factory()->create();

        $response = $this->put(route('terenski-podacis.update', $terenskiPodaci), [
            'datum_terena' => $datum_terena->toDateString(),
            'opis_terena' => $opis_terena,
            'merenja' => $merenja,
            'fotografije' => $fotografije,
            'analize' => $analize,
            'zahtev_id' => $zahtev->id,
        ]);

        $terenskiPodaci->refresh();

        $response->assertRedirect(route('terenskiPodacis.index'));
        $response->assertSessionHas('terenskiPodaci.id', $terenskiPodaci->id);

        $this->assertEquals($datum_terena, $terenskiPodaci->datum_terena);
        $this->assertEquals($opis_terena, $terenskiPodaci->opis_terena);
        $this->assertEquals($merenja, $terenskiPodaci->merenja);
        $this->assertEquals($fotografije, $terenskiPodaci->fotografije);
        $this->assertEquals($analize, $terenskiPodaci->analize);
        $this->assertEquals($zahtev->id, $terenskiPodaci->zahtev_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $terenskiPodaci = TerenskiPodaci::factory()->create();

        $response = $this->delete(route('terenski-podacis.destroy', $terenskiPodaci));

        $response->assertRedirect(route('terenskiPodacis.index'));

        $this->assertModelMissing($terenskiPodaci);
    }
}
