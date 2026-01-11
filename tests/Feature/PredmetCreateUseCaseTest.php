<?php

namespace Tests\Feature;

use App\Models\Predmet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class PredmetCreateUseCaseTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function guest_cannot_create_predmet(): void
    {
        $response = $this->post(route('predmet.store'), [
            'broj' => 'P-UC1-001/2025',
            'vrsta' => 'parnica',
            'sud' => 'Osnovni sud',
            'datum_prijema' => '2025-12-24',
            'rok' => '2026-01-10',
            'status' => 'novo',
        ]);

        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function it_creates_new_predmet_and_is_visible_in_list(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = [
            'broj' => 'P-UC1-001/2025',
            'vrsta' => 'parnica',
            'sud' => 'Osnovni sud Beograd',
            'datum_prijema' => '2025-12-24',
            'rok' => '2026-01-10',
            'status' => 'novo',
        ];

        $response = $this->post(route('predmet.store'), $payload);

        $response->assertRedirect(route('predmeti'));

        $this->assertDatabaseHas('predmets', [
            'broj' => $payload['broj'],
            'vrsta' => $payload['vrsta'],
            'sud' => $payload['sud'],
            'status' => $payload['status'],
        ]);

        $predmet = Predmet::where('broj', $payload['broj'])->firstOrFail();
        $this->assertIsInt($predmet->id);
        $this->assertGreaterThan(0, $predmet->id);

        $listResponse = $this->get(route('predmeti'));
        $listResponse->assertOk();
        $listResponse->assertSee($payload['broj']);
    }

    #[Test]
    public function it_validates_required_fields_are_present(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->from(route('predmet.create'))->post(route('predmet.store'), [
            'broj' => '',
            'vrsta' => '',
            'status' => '',
        ]);

        $response->assertRedirect(route('predmet.create'));
        $response->assertSessionHasErrors(['broj', 'vrsta', 'status']);

        $this->assertSame(0, Predmet::count());
    }

    #[Test]
    public function it_rejects_duplicate_broj(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $broj = 'P-UC1-DUP/2025';

        Predmet::create([
            'broj' => $broj,
            'vrsta' => 'parnica',
            'sud' => 'Osnovni sud',
            'datum_prijema' => '2025-12-24',
            'rok' => '2026-01-10',
            'status' => 'novo',
        ]);

        $response = $this->from(route('predmet.create'))->post(route('predmet.store'), [
            'broj' => $broj,
            'vrsta' => 'krivicni',
            'sud' => 'Viši sud',
            'datum_prijema' => '2025-12-25',
            'rok' => '2026-01-11',
            'status' => 'u_obradi',
        ]);

        $response->assertRedirect(route('predmet.create'));
        $response->assertSessionHasErrors(['broj']);

        $this->assertSame(1, Predmet::where('broj', $broj)->count());
    }
}
