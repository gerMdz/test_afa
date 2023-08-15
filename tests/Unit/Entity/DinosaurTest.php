<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Dinosaur;
use Generator;
use PHPUnit\Framework\TestCase;

class DinosaurTest extends TestCase
{
//    public function testItWorks(): void
//    {
//        self::assertEquals('53', 53);
//    }
//
//    public function testItWorksTheSame(): void
//    {
//        self::assertSame('53', 53);
//    }

    public function testCanGetAndSetData()
    {
        $dino = new Dinosaur('Dino One', 'Tyrannosaurus', '15', 'Polo Sub2');
        self::assertSame('Dino One', $dino->getName());
        self::assertSame('Tyrannosaurus', $dino->getGenus());
        self::assertSame(15, $dino->getLength());
        self::assertSame('Polo Sub2', $dino->getEnclosure());


    }

    /** @dataProvider sizeDescriptionProvider */
    public function testDinoTieneUnaDescriptionCorrectaParaSuLargo(int $length, string $expectedSize ):void
    {
        $dino = new Dinosaur(name: 'GerTaurus', length: $length);

        self::assertSame($expectedSize, $dino->getSizeDescription());
    }



    public function sizeDescriptionProvider(): Generator
    {
         yield 'Se supone que esto es un dinosaurio grande 10 mts.' => [10, 'Grande'];
         yield 'Se supone que esto es un dinosaurio mediano 5mts.' => [5, 'Mediano'];
         yield 'Se supone que esto es un dinosaurio chico 4 mts.' => [4, 'Chico'];
    }
}