<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Klijent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\KlijentController
 */
final class KlijentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $klijents = Klijent::factory()->count(3)->create();

        $response = $this->get(route('klijents.index'));

        $response->assertOk();
        $response->assertViewIs('klijent.index');
        $response->assertViewHas('klijents', $klijents);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('klijents.create'));

        $response->assertOk();
        $response->assertViewIs('klijent.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KlijentController::class,
            'store',
            \App\Http\Requests\KlijentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $ime = fake()->word();
        $prezime = fake()->word();
        $telefon = fake()->word();
        $email = fake()->safeEmail();
        $adresa = fake()->word();

        $response = $this->post(route('klijents.store'), [
            'ime' => $ime,
            'prezime' => $prezime,
            'telefon' => $telefon,
            'email' => $email,
            'adresa' => $adresa,
        ]);

        $klijents = Klijent::query()
            ->where('ime', $ime)
            ->where('prezime', $prezime)
            ->where('telefon', $telefon)
            ->where('email', $email)
            ->where('adresa', $adresa)
            ->get();
        $this->assertCount(1, $klijents);
        $klijent = $klijents->first();

        $response->assertRedirect(route('klijents.index'));
        $response->assertSessionHas('klijent.id', $klijent->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $klijent = Klijent::factory()->create();

        $response = $this->get(route('klijents.show', $klijent));

        $response->assertOk();
        $response->assertViewIs('klijent.show');
        $response->assertViewHas('klijent', $klijent);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $klijent = Klijent::factory()->create();

        $response = $this->get(route('klijents.edit', $klijent));

        $response->assertOk();
        $response->assertViewIs('klijent.edit');
        $response->assertViewHas('klijent', $klijent);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KlijentController::class,
            'update',
            \App\Http\Requests\KlijentUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $klijent = Klijent::factory()->create();
        $ime = fake()->word();
        $prezime = fake()->word();
        $telefon = fake()->word();
        $email = fake()->safeEmail();
        $adresa = fake()->word();

        $response = $this->put(route('klijents.update', $klijent), [
            'ime' => $ime,
            'prezime' => $prezime,
            'telefon' => $telefon,
            'email' => $email,
            'adresa' => $adresa,
        ]);

        $klijent->refresh();

        $response->assertRedirect(route('klijents.index'));
        $response->assertSessionHas('klijent.id', $klijent->id);

        $this->assertEquals($ime, $klijent->ime);
        $this->assertEquals($prezime, $klijent->prezime);
        $this->assertEquals($telefon, $klijent->telefon);
        $this->assertEquals($email, $klijent->email);
        $this->assertEquals($adresa, $klijent->adresa);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $klijent = Klijent::factory()->create();

        $response = $this->delete(route('klijents.destroy', $klijent));

        $response->assertRedirect(route('klijents.index'));

        $this->assertModelMissing($klijent);
    }
}
