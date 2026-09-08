<?php

namespace Tests\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\WebhookException;
use Chunkify\Core\Util;
use Chunkify\Webhooks\WebhookListResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use StandardWebhooks\Webhook;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class WebhooksTest extends TestCase
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

        $result = $this->client->webhooks->create(
            url: 'https://example.com/webhook'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(\Chunkify\Webhooks\Webhook::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->create(
            url: 'https://example.com/webhook',
            enabled: true,
            events: ['job.completed'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(\Chunkify\Webhooks\Webhook::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->retrieve('webhookId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(\Chunkify\Webhooks\Webhook::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->update('webhookId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->delete('webhookId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUnwrap(): void
    {
        $payload = '{"id":"notf_2G6MJiNz71bHQGNzGwKx5cJwPFS","data":{"files":[{"id":"file_2G6MJiNz71bHQGNzGwKx5cJwPFS","audio_bitrate":128000,"audio_codec":"aac","created_at":"2025-01-01T12:00:00Z","duration":120,"height":1080,"job_id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","mime_type":"video/mp4","path":"path/to/file.mp4","size":1234567,"storage_id":"stor_chunkify_2wLmj1fp8neUaFAWwwxvzKAT0Fa","url":"https://my-bucket.s3.us-east-1.amazonaws.com/path/to/file.mp4?X-Amz-Algorithm=AWS4-HMAC-SHA256","video_bitrate":20000000,"video_codec":"h264","video_framerate":29.97,"width":1920,"cdn_url":"https://media.example.com/path/to/file.mp4"}],"job":{"id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","billable_time":120,"created_at":"2025-01-01T12:00:00Z","format":{"id":"mp4_h264","audio_bitrate":32000,"bufsize":100000,"channels":1,"crf":35,"disable_audio":true,"disable_video":true,"duration":1,"framerate":15,"gop":1,"height":-2,"level":41,"maxrate":100000,"minrate":100000,"movflags":"movflags","per_title":true,"pixfmt":"yuv410p","preset":"10","profilev":"main10","seek":1,"video_bitrate":100000,"width":-2},"progress":45.5,"source_id":"src_2G6MJiNz71bHQGNzGwKx5cJwPFS","status":"pending","storage":{"id":"stor_aws_S1cce6120E56e7Tu9ioP09Nhjk1","path":"path/to/video.mp4"},"transcoder":{"auto":true,"quantity":10,"type":"4vCPU"},"updated_at":"2025-01-01T12:05:00Z","error":{"detail":"detail","message":"message","type":"setup"},"hls_manifest_id":"hls_2v6EIgcNAycdS5g0IUm0TXBjvHV","metadata":{"key1":"value1","key2":"value2"},"started_at":"2025-01-01T12:01:00Z"}},"date":"2025-01-01T12:00:00Z","event":"job.completed"}';
        $this->client->webhooks->unwrap($payload);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnwrapBadJson(): void
    {
        $this->expectException(WebhookException::class);

        $badPayload = 'not a json string';
        $this->client->webhooks->unwrap($badPayload);
    }

    #[Test]
    public function testUnwrapWithVerification(): void
    {
        $payload = '{"id":"notf_2G6MJiNz71bHQGNzGwKx5cJwPFS","data":{"files":[{"id":"file_2G6MJiNz71bHQGNzGwKx5cJwPFS","audio_bitrate":128000,"audio_codec":"aac","created_at":"2025-01-01T12:00:00Z","duration":120,"height":1080,"job_id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","mime_type":"video/mp4","path":"path/to/file.mp4","size":1234567,"storage_id":"stor_chunkify_2wLmj1fp8neUaFAWwwxvzKAT0Fa","url":"https://my-bucket.s3.us-east-1.amazonaws.com/path/to/file.mp4?X-Amz-Algorithm=AWS4-HMAC-SHA256","video_bitrate":20000000,"video_codec":"h264","video_framerate":29.97,"width":1920,"cdn_url":"https://media.example.com/path/to/file.mp4"}],"job":{"id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","billable_time":120,"created_at":"2025-01-01T12:00:00Z","format":{"id":"mp4_h264","audio_bitrate":32000,"bufsize":100000,"channels":1,"crf":35,"disable_audio":true,"disable_video":true,"duration":1,"framerate":15,"gop":1,"height":-2,"level":41,"maxrate":100000,"minrate":100000,"movflags":"movflags","per_title":true,"pixfmt":"yuv410p","preset":"10","profilev":"main10","seek":1,"video_bitrate":100000,"width":-2},"progress":45.5,"source_id":"src_2G6MJiNz71bHQGNzGwKx5cJwPFS","status":"pending","storage":{"id":"stor_aws_S1cce6120E56e7Tu9ioP09Nhjk1","path":"path/to/video.mp4"},"transcoder":{"auto":true,"quantity":10,"type":"4vCPU"},"updated_at":"2025-01-01T12:05:00Z","error":{"detail":"detail","message":"message","type":"setup"},"hls_manifest_id":"hls_2v6EIgcNAycdS5g0IUm0TXBjvHV","metadata":{"key1":"value1","key2":"value2"},"started_at":"2025-01-01T12:01:00Z"}},"date":"2025-01-01T12:00:00Z","event":"job.completed"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnwrapWrongKey(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"notf_2G6MJiNz71bHQGNzGwKx5cJwPFS","data":{"files":[{"id":"file_2G6MJiNz71bHQGNzGwKx5cJwPFS","audio_bitrate":128000,"audio_codec":"aac","created_at":"2025-01-01T12:00:00Z","duration":120,"height":1080,"job_id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","mime_type":"video/mp4","path":"path/to/file.mp4","size":1234567,"storage_id":"stor_chunkify_2wLmj1fp8neUaFAWwwxvzKAT0Fa","url":"https://my-bucket.s3.us-east-1.amazonaws.com/path/to/file.mp4?X-Amz-Algorithm=AWS4-HMAC-SHA256","video_bitrate":20000000,"video_codec":"h264","video_framerate":29.97,"width":1920,"cdn_url":"https://media.example.com/path/to/file.mp4"}],"job":{"id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","billable_time":120,"created_at":"2025-01-01T12:00:00Z","format":{"id":"mp4_h264","audio_bitrate":32000,"bufsize":100000,"channels":1,"crf":35,"disable_audio":true,"disable_video":true,"duration":1,"framerate":15,"gop":1,"height":-2,"level":41,"maxrate":100000,"minrate":100000,"movflags":"movflags","per_title":true,"pixfmt":"yuv410p","preset":"10","profilev":"main10","seek":1,"video_bitrate":100000,"width":-2},"progress":45.5,"source_id":"src_2G6MJiNz71bHQGNzGwKx5cJwPFS","status":"pending","storage":{"id":"stor_aws_S1cce6120E56e7Tu9ioP09Nhjk1","path":"path/to/video.mp4"},"transcoder":{"auto":true,"quantity":10,"type":"4vCPU"},"updated_at":"2025-01-01T12:05:00Z","error":{"detail":"detail","message":"message","type":"setup"},"hls_manifest_id":"hls_2v6EIgcNAycdS5g0IUm0TXBjvHV","metadata":{"key1":"value1","key2":"value2"},"started_at":"2025-01-01T12:01:00Z"}},"date":"2025-01-01T12:00:00Z","event":"job.completed"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $wrongKey = 'whsec_aaaaaaaaaa';
        $this->client->webhooks->unwrap($payload, $headers, $wrongKey);
    }

    #[Test]
    public function testUnwrapBadSignature(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"notf_2G6MJiNz71bHQGNzGwKx5cJwPFS","data":{"files":[{"id":"file_2G6MJiNz71bHQGNzGwKx5cJwPFS","audio_bitrate":128000,"audio_codec":"aac","created_at":"2025-01-01T12:00:00Z","duration":120,"height":1080,"job_id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","mime_type":"video/mp4","path":"path/to/file.mp4","size":1234567,"storage_id":"stor_chunkify_2wLmj1fp8neUaFAWwwxvzKAT0Fa","url":"https://my-bucket.s3.us-east-1.amazonaws.com/path/to/file.mp4?X-Amz-Algorithm=AWS4-HMAC-SHA256","video_bitrate":20000000,"video_codec":"h264","video_framerate":29.97,"width":1920,"cdn_url":"https://media.example.com/path/to/file.mp4"}],"job":{"id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","billable_time":120,"created_at":"2025-01-01T12:00:00Z","format":{"id":"mp4_h264","audio_bitrate":32000,"bufsize":100000,"channels":1,"crf":35,"disable_audio":true,"disable_video":true,"duration":1,"framerate":15,"gop":1,"height":-2,"level":41,"maxrate":100000,"minrate":100000,"movflags":"movflags","per_title":true,"pixfmt":"yuv410p","preset":"10","profilev":"main10","seek":1,"video_bitrate":100000,"width":-2},"progress":45.5,"source_id":"src_2G6MJiNz71bHQGNzGwKx5cJwPFS","status":"pending","storage":{"id":"stor_aws_S1cce6120E56e7Tu9ioP09Nhjk1","path":"path/to/video.mp4"},"transcoder":{"auto":true,"quantity":10,"type":"4vCPU"},"updated_at":"2025-01-01T12:05:00Z","error":{"detail":"detail","message":"message","type":"setup"},"hls_manifest_id":"hls_2v6EIgcNAycdS5g0IUm0TXBjvHV","metadata":{"key1":"value1","key2":"value2"},"started_at":"2025-01-01T12:01:00Z"}},"date":"2025-01-01T12:00:00Z","event":"job.completed"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $badSig = $webhook->sign($messageId, $timestamp, 'some other payload');

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$badSig],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
    }

    #[Test]
    public function testUnwrapOldTimestamp(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"notf_2G6MJiNz71bHQGNzGwKx5cJwPFS","data":{"files":[{"id":"file_2G6MJiNz71bHQGNzGwKx5cJwPFS","audio_bitrate":128000,"audio_codec":"aac","created_at":"2025-01-01T12:00:00Z","duration":120,"height":1080,"job_id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","mime_type":"video/mp4","path":"path/to/file.mp4","size":1234567,"storage_id":"stor_chunkify_2wLmj1fp8neUaFAWwwxvzKAT0Fa","url":"https://my-bucket.s3.us-east-1.amazonaws.com/path/to/file.mp4?X-Amz-Algorithm=AWS4-HMAC-SHA256","video_bitrate":20000000,"video_codec":"h264","video_framerate":29.97,"width":1920,"cdn_url":"https://media.example.com/path/to/file.mp4"}],"job":{"id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","billable_time":120,"created_at":"2025-01-01T12:00:00Z","format":{"id":"mp4_h264","audio_bitrate":32000,"bufsize":100000,"channels":1,"crf":35,"disable_audio":true,"disable_video":true,"duration":1,"framerate":15,"gop":1,"height":-2,"level":41,"maxrate":100000,"minrate":100000,"movflags":"movflags","per_title":true,"pixfmt":"yuv410p","preset":"10","profilev":"main10","seek":1,"video_bitrate":100000,"width":-2},"progress":45.5,"source_id":"src_2G6MJiNz71bHQGNzGwKx5cJwPFS","status":"pending","storage":{"id":"stor_aws_S1cce6120E56e7Tu9ioP09Nhjk1","path":"path/to/video.mp4"},"transcoder":{"auto":true,"quantity":10,"type":"4vCPU"},"updated_at":"2025-01-01T12:05:00Z","error":{"detail":"detail","message":"message","type":"setup"},"hls_manifest_id":"hls_2v6EIgcNAycdS5g0IUm0TXBjvHV","metadata":{"key1":"value1","key2":"value2"},"started_at":"2025-01-01T12:01:00Z"}},"date":"2025-01-01T12:00:00Z","event":"job.completed"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => ['5'],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
    }

    #[Test]
    public function testUnwrapWrongMessageID(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"notf_2G6MJiNz71bHQGNzGwKx5cJwPFS","data":{"files":[{"id":"file_2G6MJiNz71bHQGNzGwKx5cJwPFS","audio_bitrate":128000,"audio_codec":"aac","created_at":"2025-01-01T12:00:00Z","duration":120,"height":1080,"job_id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","mime_type":"video/mp4","path":"path/to/file.mp4","size":1234567,"storage_id":"stor_chunkify_2wLmj1fp8neUaFAWwwxvzKAT0Fa","url":"https://my-bucket.s3.us-east-1.amazonaws.com/path/to/file.mp4?X-Amz-Algorithm=AWS4-HMAC-SHA256","video_bitrate":20000000,"video_codec":"h264","video_framerate":29.97,"width":1920,"cdn_url":"https://media.example.com/path/to/file.mp4"}],"job":{"id":"job_2G6MJiNz71bHQGNzGwKx5cJwPFS","billable_time":120,"created_at":"2025-01-01T12:00:00Z","format":{"id":"mp4_h264","audio_bitrate":32000,"bufsize":100000,"channels":1,"crf":35,"disable_audio":true,"disable_video":true,"duration":1,"framerate":15,"gop":1,"height":-2,"level":41,"maxrate":100000,"minrate":100000,"movflags":"movflags","per_title":true,"pixfmt":"yuv410p","preset":"10","profilev":"main10","seek":1,"video_bitrate":100000,"width":-2},"progress":45.5,"source_id":"src_2G6MJiNz71bHQGNzGwKx5cJwPFS","status":"pending","storage":{"id":"stor_aws_S1cce6120E56e7Tu9ioP09Nhjk1","path":"path/to/video.mp4"},"transcoder":{"auto":true,"quantity":10,"type":"4vCPU"},"updated_at":"2025-01-01T12:05:00Z","error":{"detail":"detail","message":"message","type":"setup"},"hls_manifest_id":"hls_2v6EIgcNAycdS5g0IUm0TXBjvHV","metadata":{"key1":"value1","key2":"value2"},"started_at":"2025-01-01T12:01:00Z"}},"date":"2025-01-01T12:00:00Z","event":"job.completed"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => ['wrong'],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
    }
}
