<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Dinosaur;
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

    public function testDinoMayor10MtsOrGreaterIsLarge():void
    {
        $dino = new Dinosaur(name: 'GerTaurus', length: 12);

        self::assertSame('Grande', $dino->getSizeDescription(), 'Se supone que esto es un dinosaurio grande');
    }

    public function testDinoEntre5And9MetersIsMedium():void
    {
        $dino = new Dinosaur(name: 'GerTaurus', length: 8);

        self::assertSame('Mediano', $dino->getSizeDescription(), 'Se supone que esto es un dinosaurio mediano');
    }

    public function testDinoMenos5MtsIsSmall():void
    {
        $dino = new Dinosaur(name: 'GerTaurus', length: 4);

        self::assertSame('Chico', $dino->getSizeDescription(), 'Se supone que esto es un dinosaurio chico');
    }
}