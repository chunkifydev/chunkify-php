<?php

namespace Tests\Services\Projects\Analytics\Connections;

use Chunkify\Client;
use Chunkify\Core\Util;
use Chunkify\Projects\Analytics\Connections\Keys\KeyListResponse;
use Chunkify\Projects\Analytics\Connections\Keys\KeyNewResponse;
use Chunkify\Projects\Analytics\Connections\Keys\KeyRotateResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class KeysTest extends TestCase
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

        $result = $this->client->projects->analytics->connections->keys->create(
            'projectId',
            'connectionId',
            purpose: 'player'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(KeyNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->projects->analytics->connections->keys->create(
            'projectId',
            'connectionId',
            purpose: 'player'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(KeyNewResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->projects->analytics->connections->keys->list(
            'projectId',
            'connectionId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(KeyListResponse::class, $result);
    }

    #[Test]
    public function testRotate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->projects->analytics->connections->keys->rotate(
            'projectId',
            'connectionId',
            'keyId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(KeyRotateResponse::class, $result);
    }
}
