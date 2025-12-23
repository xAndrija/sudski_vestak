<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Uloga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UlogaController
 */
final class UlogaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $ulogas = Uloga::factory()->count(3)->create();

        $response = $this->get(route('ulogas.index'));

        $response->assertOk();
        $response->assertViewIs('uloga.index');
        $response->assertViewHas('ulogas', $ulogas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('ulogas.create'));

        $response->assertOk();
        $response->assertViewIs('uloga.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UlogaController::class,
            'store',
            \App\Http\Requests\UlogaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $naziv = fake()->word();

        $response = $this->post(route('ulogas.store'), [
            'naziv' => $naziv,
        ]);

        $ulogas = Uloga::query()
            ->where('naziv', $naziv)
            ->get();
        $this->assertCount(1, $ulogas);
        $uloga = $ulogas->first();

        $response->assertRedirect(route('ulogas.index'));
        $response->assertSessionHas('uloga.id', $uloga->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $uloga = Uloga::factory()->create();

        $response = $this->get(route('ulogas.show', $uloga));

        $response->assertOk();
        $response->assertViewIs('uloga.show');
        $response->assertViewHas('uloga', $uloga);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $uloga = Uloga::factory()->create();

        $response = $this->get(route('ulogas.edit', $uloga));

        $response->assertOk();
        $response->assertViewIs('uloga.edit');
        $response->assertViewHas('uloga', $uloga);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UlogaController::class,
            'update',
            \App\Http\Requests\UlogaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $uloga = Uloga::factory()->create();
        $naziv = fake()->word();

        $response = $this->put(route('ulogas.update', $uloga), [
            'naziv' => $naziv,
        ]);

        $uloga->refresh();

        $response->assertRedirect(route('ulogas.index'));
        $response->assertSessionHas('uloga.id', $uloga->id);

        $this->assertEquals($naziv, $uloga->naziv);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $uloga = Uloga::factory()->create();

        $response = $this->delete(route('ulogas.destroy', $uloga));

        $response->assertRedirect(route('ulogas.index'));

        $this->assertModelMissing($uloga);
    }
}
