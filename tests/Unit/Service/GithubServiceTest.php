<?php

namespace App\Tests\Unit\Service;

use App\Enum\SaludStatusEnum;
use App\Service\GithubService;
use Generator;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class GithubServiceTest extends TestCase
{

    private LoggerInterface $mockLogger;
    private MockHttpClient $mockHttpClient;
    private MockResponse $mockResponse;

    /**
     * @dataProvider dinoNameProvider
     */
    public function testGetHealthReportReturnsCorrectHealthStatusForDino(SaludStatusEnum $statusEsperado, string $dinoName): void
    {

        $service = $this->createGithubService([[
            'title' => 'Daisy',
            'labels' => [['name' => 'Status: Sick']],
        ],
            [
                'title' => 'Maverick',
                'labels' => [['name' => 'Status: Healthy']],
            ],]);




        self::assertSame($statusEsperado, $service->getHealthReport($dinoName));
        self::assertSame(1, $this->mockHttpClient->getRequestsCount());
        self::assertSame('GET', $this->mockResponse->getRequestMethod());
        self::assertSame('https://api.github.com/repos/SymfonyCasts/dino-park/issues', $this->mockResponse->getRequestUrl());

    }

    public function createGithubService(array $responseData): GithubService
    {
        $this->mockResponse = new MockResponse(json_encode($responseData));
        $this->mockHttpClient->setResponseFactory($this->mockResponse);

        return new GithubService($this->mockHttpClient, $this->mockLogger);
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

    public function testExceptionThrownWithUnknownLabel(): void
    {

        $service = $this->createGithubService([
            [
                'title' => 'Maverick',
                'labels' => [['name' => 'Status: Drowsy']],
            ],
        ]);


        $this->expectException(RuntimeException::class);

        $this->expectExceptionMessage('Drowsy es un estado desconocido');

        $service->getHealthReport('Maverick');

    }

    protected function setUp(): void
    {
        $this->mockLogger = $this->createMock(LoggerInterface::class);
        $this->mockHttpClient = new MockHttpClient();
    }
}