<?php

namespace App\Tests\Unit\Service;

use App\Enum\SaludStatusEnum;
use Generator;
use PHPUnit\Framework\TestCase;
use App\Service\GithubService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubServiceTest extends TestCase
{
   /**
    * @dataProvider dinoNameProvider
    */
    public function testGetHealthReportReturnsCorrectHealthStatusForDino(SaludStatusEnum $statusEsperado, string $dinoName ):void
    {

        $mockLogger = $this->createMock(LoggerInterface::class);
        $mockClient = $this->createMock(HttpClientInterface::class);


        $service = new GithubService($mockClient, $mockLogger);


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