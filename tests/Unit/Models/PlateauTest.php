<?php

namespace Tests\Unit\Models;

use App\Models\Plateau;
use Exception;
use Tests\TestCase;

class PlateauTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function test_can_create_and_save()
    {
        $x = random_int(1, 100);
        $y = random_int(1, 100);

        $plateau = new Plateau($x, $y);
        $plateau->save();

        $findPlateau = Plateau::find($plateau->getId());

        $this->assertSame(
            $plateau->getId(),
            $findPlateau->getId(),
        );

        $this->assertSame(
            $plateau->getMaxXCoordinate(),
            $findPlateau->getMaxXCoordinate(),
        );

        $this->assertSame(
            $plateau->getMaxYCoordinate(),
            $findPlateau->getMaxYCoordinate(),
        );
    }
}
