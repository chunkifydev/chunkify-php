<?php

namespace Tests\Services;

use Chunkify\Client;
use Chunkify\Core\Util;
use Chunkify\Metrics\MetricsAssets;
use Chunkify\Metrics\MetricsStorage;
use Chunkify\Metrics\MetricsUsage;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class MetricsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(
            projectAccessToken: 'My Project Access Token',
            teamAccessToken: 'My Team Access Token',
            baseUrl: $testUrl,
        );

        $this->client = $client;
    }

    #[Test]
    public function testAssets(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->metrics->assets();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MetricsAssets::class, $result);
    }

    #[Test]
    public function testStorage(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->metrics->storage();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MetricsStorage::class, $result);
    }

    #[Test]
    public function testUsage(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->metrics->usage();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MetricsUsage::class, $result);
    }
}
