<?php

namespace Tests\Services;

use Chunkify\Client;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\Thumbnails\Thumbnail;
use Chunkify\Thumbnails\ThumbnailFormat;
use Chunkify\Thumbnails\ThumbnailOutput;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ThumbnailsTest extends TestCase
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

        $result = $this->client->thumbnails->create(sourceID: 'src_example');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Thumbnail::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->thumbnails->create(
            sourceID: 'src_example',
            count: 10,
            format: ThumbnailFormat::JPEG,
            metadata: ['foo' => 'string'],
            output: ThumbnailOutput::IMAGES,
            range: ['end' => 1, 'start' => 0],
            size: 64,
            storage: ['id' => 'x', 'path' => 'x'],
            timestamps: [0],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Thumbnail::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->thumbnails->retrieve('thumbnailId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Thumbnail::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->thumbnails->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PaginatedResults::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Thumbnail::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->thumbnails->delete('thumbnailId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
