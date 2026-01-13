<?php

namespace Tests\Unit;

use App\Models\Predmet;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PredmetStatusLabelTest extends TestCase
{
    #[Test]
    public function it_maps_known_status_values_to_labels(): void
    {
        $predmet = new Predmet;

        $predmet->status = 'novo';
        $this->assertSame('Novo', $predmet->status_label);

        $predmet->status = 'u_obradi';
        $this->assertSame('U obradi', $predmet->status_label);

        $predmet->status = 'zavrsen';
        $this->assertSame('Završen', $predmet->status_label);

        $predmet->status = 'odbijen';
        $this->assertSame('Odbijen', $predmet->status_label);
    }

    #[Test]
    public function it_falls_back_to_raw_status_value_or_empty_string(): void
    {
        $predmet = new Predmet;

        $predmet->status = 'nepoznato';
        $this->assertSame('nepoznato', $predmet->status_label);

        $predmet->status = null;
        $this->assertSame('', $predmet->status_label);
    }
}
