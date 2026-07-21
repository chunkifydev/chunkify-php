<?php

declare(strict_types=1);

namespace Chunkify;

use Chunkify\Core\BaseClient;
use Chunkify\Core\Implementation\StreamingHttpClient;
use Chunkify\Core\Util;
use Chunkify\Services\FilesService;
use Chunkify\Services\JobsService;
use Chunkify\Services\NotificationsService;
use Chunkify\Services\ProjectsService;
use Chunkify\Services\SourcesService;
use Chunkify\Services\StoragesService;
use Chunkify\Services\TokensService;
use Chunkify\Services\UploadsService;
use Chunkify\Services\WebhooksService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \Chunkify\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
class Client extends BaseClient
{
    public string $projectAccessToken;

    public string $teamAccessToken;

    public string $webhookKey;

    /**
     * @api
     */
    public FilesService $files;

    /**
     * @api
     */
    public JobsService $jobs;

    /**
     * @api
     */
    public NotificationsService $notifications;

    /**
     * @api
     */
    public ProjectsService $projects;

    /**
     * @api
     */
    public SourcesService $sources;

    /**
     * @api
     */
    public StoragesService $storages;

    /**
     * @api
     */
    public TokensService $tokens;

    /**
     * @api
     */
    public UploadsService $uploads;

    /**
     * @api
     */
    public WebhooksService $webhooks;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $projectAccessToken = null,
        ?string $teamAccessToken = null,
        ?string $webhookKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->projectAccessToken = (string) ($projectAccessToken ?? Util::getenv(
            'CHUNKIFY_TOKEN'
        ));
        $this->teamAccessToken = (string) ($teamAccessToken ?? Util::getenv(
            'CHUNKIFY_TEAM_TOKEN'
        ));
        $this->webhookKey = (string) ($webhookKey ?? Util::getenv(
            'CHUNKIFY_WEBHOOK_SECRET'
        ));

        $baseUrl ??= Util::getenv(
            'CHUNKIFY_BASE_URL'
        ) ?: 'https://api.chunkify.dev/v1';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        if (is_null($options->streamingTransporter)) {
            assert(!is_null($options->transporter));
            $options->streamingTransporter = new StreamingHttpClient($options->transporter);
        }

        /** @var array<string, string|null> $headers */
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => sprintf('chunkify/PHP %s', VERSION),
            'X-Stainless-Lang' => 'php',
            'X-Stainless-Package-Version' => VERSION,
            'X-Stainless-Arch' => Util::machtype(),
            'X-Stainless-OS' => Util::ostype(),
            'X-Stainless-Runtime' => php_sapi_name(),
            'X-Stainless-Runtime-Version' => phpversion(),
        ];

        $customHeadersEnv = Util::getenv('CHUNKIFY_CUSTOM_HEADERS');
        if (null !== $customHeadersEnv) {
            foreach (explode("\n", $customHeadersEnv) as $line) {
                $colon = strpos($line, ':');
                if (false !== $colon) {
                    $headers[trim(substr($line, 0, $colon))] = trim(substr($line, $colon + 1));
                }
            }
        }

        parent::__construct(
            headers: $headers,
            baseUrl: $baseUrl,
            options: $options
        );

        $this->files = new FilesService($this);
        $this->jobs = new JobsService($this);
        $this->notifications = new NotificationsService($this);
        $this->projects = new ProjectsService($this);
        $this->sources = new SourcesService($this);
        $this->storages = new StoragesService($this);
        $this->tokens = new TokensService($this);
        $this->uploads = new UploadsService($this);
        $this->webhooks = new WebhooksService($this);
    }

    /**
     * @param array{projectAccessToken?: bool, teamAccessToken?: bool} $security
     *
     * @return array<string,string>
     */
    protected function authHeaders(array $security): array
    {
        return [
            ...($security['projectAccessToken'] ?? false) ? $this->projectAccessTokenScheme(
            ) : [],
            ...($security['teamAccessToken'] ?? false) ? $this->teamAccessTokenScheme(
            ) : [],
        ];
    }

    /** @return array<string,string> */
    protected function projectAccessTokenScheme(): array
    {
        return $this->projectAccessToken ? [
            'Authorization' => "Bearer {$this->projectAccessToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function teamAccessTokenScheme(): array
    {
        return $this->teamAccessToken ? [
            'Authorization' => "Bearer {$this->teamAccessToken}",
        ] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     * @param array{projectAccessToken?: bool, teamAccessToken?: bool}|null $security
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
        ?array $security = null,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [
                ...$this->authHeaders(
                    security: ($security ?? [
                        'projectAccessToken' => true, 'teamAccessToken' => true,
                    ]),
                ),
                ...$headers,
            ],
            body: $body,
            opts: $opts,
            security: $security,
        );
    }
}
