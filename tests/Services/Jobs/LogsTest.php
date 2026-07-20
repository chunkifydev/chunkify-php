<?php

namespace Tests\Services\Jobs;

use Chunkify\Client;
use Chunkify\Core\Util;
use Chunkify\Jobs\Logs\LogListResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class LogsTest extends TestCase
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
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->jobs->logs->list('jobId', service: 'transcoder');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LogListResponse::class, $result);
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->jobs->logs->list(
            'jobId',
            service: 'transcoder',
            transcoderID: 0
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LogListResponse::class, $result);
    }
}
