<?php

namespace App\Tests\Unit\Service;

use App\Enum\SaludStatusEnum;
use App\Service\GithubService;
use Generator;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class GithubServiceTest extends TestCase
{
    /**
     * @dataProvider dinoNameProvider
     */
    public function testGetHealthReportReturnsCorrectHealthStatusForDino(SaludStatusEnum $statusEsperado, string $dinoName): void
    {

        $mockLogger = $this->createMock(LoggerInterface::class);
        $mockClient = $this->createMock(HttpClientInterface::class);
        $mockResponse = $this->createMock(ResponseInterface::class);
        $mockResponse
            ->method('toArray')
            ->willReturn([
                [
                    'title' => 'Daisy',
                    'labels' => [['name' => 'Status: Sick']],
                ],
                [
                    'title' => 'Maverick',
                    'labels' => [['name' => 'Status: Healthy']],
                ],
            ]);


        $mockClient
            ->expects(self::once())
            ->method('request')
            ->with('GET', 'https://api.github.com/repos/SymfonyCasts/dino-park/issues')
            ->willReturn($mockResponse);

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