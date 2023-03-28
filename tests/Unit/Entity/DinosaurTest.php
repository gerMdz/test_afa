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
}