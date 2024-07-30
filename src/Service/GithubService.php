<?php

namespace App\Service;

use App\Enum\SaludStatusEnum;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubService
{

    public function __construct(private HttpClientInterface $httpClient, private LoggerInterface $logger)
    {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getHealthReport(string $dinosaurName): SaludStatusEnum
    {
        $salud = SaludStatusEnum::SALUDABLE;

        $response = $this->httpClient->request(
            method: 'GET',
            url: 'https://api.github.com/repos/SymfonyCasts/dino-park/issues'
        );

        $this->logger->info('Request Dino Issues', [
            'dino' => $dinosaurName,
            'responseStatus' => $response->getStatusCode()
        ]);

        foreach ($response->toArray() as $issue) {
            if (str_contains($issue['title'], $dinosaurName)) {
                $salud = $this->getDinoStatusFromLabels($issue['labels']);
            }
        }

        return $salud;
    }

    private function getDinoStatusFromLabels(array $labels): SaludStatusEnum
    {
        $salud = SaludStatusEnum::SALUDABLE;
        foreach ($labels as $label) {
            $label = $label['name'];
            // We only care about "Status" labels
            if (!str_starts_with($label, 'Status:')) {
                continue;
            }
            // Remove the "Status:" and whitespace from the label
            $status = trim(substr($label, strlen('Status:')));

            $salud = SaludStatusEnum::tryFrom($status);
            if (null === $salud) {
                throw new RuntimeException(sprintf('%s es un estado desconocido', $status));
            }
        }
        return $salud;
    }
}