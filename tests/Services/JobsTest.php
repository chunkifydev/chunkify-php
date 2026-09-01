<?php

namespace Tests\Services;

use Chunkify\Client;
use Chunkify\Core\Util;
use Chunkify\Jobs\Job;
use Chunkify\PaginatedResults;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class JobsTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->jobs->create(
            format: ['id' => 'mp4_av1'],
            sourceID: 'src_UioP9I876hjKlNBH78ILp0mo56t'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Job::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->jobs->create(
            format: [
                'id' => 'mp4_av1',
                'audioBitrate' => 32000,
                'bufsize' => 100000,
                'channels' => 1,
                'crf' => 35,
                'disableAudio' => true,
                'disableVideo' => true,
                'duration' => 1,
                'framerate' => 15,
                'gop' => 1,
                'height' => -2,
                'level' => 41,
                'maxrate' => 100000,
                'minrate' => 100000,
                'movflags' => 'movflags',
                'perTitle' => true,
                'pixfmt' => 'yuv410p',
                'preset' => '10',
                'profilev' => 'main10',
                'seek' => 1,
                'videoBitrate' => 100000,
                'width' => -2,
            ],
            sourceID: 'src_UioP9I876hjKlNBH78ILp0mo56t',
            hlsManifestID: 'hls_2v6EIgcNAycdS5g0IUm0TXBjvHV',
            metadata: ['key' => 'value', 'key2' => 'value2'],
            storage: ['id' => 'aws-my-storage', 'path' => '/path/to/video.mp4'],
            transcoder: ['quantity' => 2, 'type' => '4vCPU'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Job::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->jobs->retrieve('jobId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Job::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->jobs->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PaginatedResults::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Job::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->jobs->delete('jobId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCancel(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->jobs->cancel('jobId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
