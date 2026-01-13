<?php

namespace Tests\Unit;

use App\Models\Predmet;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PredmetDateCastsTest extends TestCase
{
    #[Test]
    public function it_casts_rok_and_datum_prijema_to_carbon(): void
    {
        $predmet = new Predmet;
        $predmet->setDateFormat('Y-m-d H:i:s');

        $predmet->datum_prijema = '2025-12-24';
        $predmet->rok = '2026-01-10';

        $this->assertInstanceOf(Carbon::class, $predmet->datum_prijema);
        $this->assertSame('2025-12-24', $predmet->datum_prijema->toDateString());

        $this->assertInstanceOf(Carbon::class, $predmet->rok);
        $this->assertSame('2026-01-10', $predmet->rok->toDateString());
    }
}
