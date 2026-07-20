<?php

namespace Chunkify;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkPage;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Contracts\BasePage;
use Chunkify\Core\Conversion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Core\Conversion\ListOf;
use Psr\Http\Message\ResponseInterface;

/**
 * @phpstan-type PaginatedResultsShape = array{
 *   data?: list<array<string,mixed>>|null, total?: int|null, offset?: int|null
 * }
 *
 * @template TItem
 *
 * @implements BasePage<TItem>
 */
final class PaginatedResults implements BaseModel, BasePage
{
    /** @use SdkModel<PaginatedResultsShape> */
    use SdkModel;

    /** @use SdkPage<TItem> */
    use SdkPage;

    /** @var list<TItem>|null $data */
    #[Optional(list: 'mixed')]
    public ?array $data;

    #[Optional]
    public ?int $total;

    #[Optional]
    public ?int $offset;

    /**
     * @internal
     *
     * @param array{
     *   method: string,
     *   path: string,
     *   query: array<string,mixed>,
     *   headers: array<string,string|list<string>|null>,
     *   body: mixed,
     * } $requestInfo
     */
    public function __construct(
        private string|Converter|ConverterSource $convert,
        private Client $client,
        private array $requestInfo,
        private RequestOptions $options,
        private ResponseInterface $response,
        private mixed $parsedBody,
    ) {
        $this->initialize();

        if (!is_array($this->parsedBody)) {
            return;
        }

        // @phpstan-ignore-next-line argument.type
        self::__unserialize($this->parsedBody);

        if (is_array($items = $this->offsetGet('data'))) {
            $parsed = Conversion::coerce(new ListOf($convert), value: $items);
            // @phpstan-ignore-next-line
            $this->offsetSet('data', value: $parsed);
        }
    }

    /** @return list<TItem> */
    public function getItems(): array
    {
        // @phpstan-ignore-next-line return.type
        return $this->offsetGet('data') ?? [];
    }

    /**
     * @internal
     *
     * @return array{
     *   array{
     *     method: string,
     *     path: string,
     *     query: array<string,mixed>,
     *     headers: array<string,string|list<string>|null>,
     *     body: mixed,
     *   },
     *   RequestOptions,
     * }|null
     */
    public function nextRequest(): ?array
    {
        $items = $this->getItems();
        // @phpstan-ignore-next-line binaryOp.invalid
        $curr = ($this->offset ?? 0) + ($cnt = count($items));
        if (!$cnt || ($curr >= ($this->total ?? null))) {
            return null;
        }

        $nextRequest = array_merge_recursive(
            $this->requestInfo,
            ['query' => ['offset' => $curr]]
        );

        // @phpstan-ignore-next-line return.type
        return [$nextRequest, $this->options];
    }
}
