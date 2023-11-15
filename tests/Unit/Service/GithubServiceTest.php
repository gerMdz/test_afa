<?php

namespace App\Tests\Unit\Service;

use App\Enum\SaludStatusEnum;
use Generator;
use PHPUnit\Framework\TestCase;
use App\Service\GithubService;

class GithubServiceTest extends TestCase
{
   /**
    * @dataProvider dinoNameProvider
    */
    public function testGetHealthReportReturnsCorrectHealthStatusForDino(SaludStatusEnum $statusEsperado, string $dinoName ):void
    {
        $service = new GithubService();

        self::assertSame($statusEsperado, $service->getHealthReport($dinoName));


    }

    public function dinoNameProvider(): Generator
    {
        yield 'Sick Dino' => [
            SaludStatusEnum::ENFERMO,
          'Daisy'
        ];

        yield 'Healthy Dino' => [
          SaludStatusEnum::SALUDABLE,
          'Maverick'
        ];
    }
}