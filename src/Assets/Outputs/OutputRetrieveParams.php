<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Retrieve one output belonging to the specified Asset and authenticated Project. Delivery URLs follow the output resource retention and expiry rules.
 *
 * @see Chunkify\Services\Assets\OutputsService::retrieve()
 *
 * @phpstan-type OutputRetrieveParamsShape = array{assetID: string}
 */
final class OutputRetrieveParams implements BaseModel
{
    /** @use SdkModel<OutputRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $assetID;

    /**
     * `new OutputRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OutputRetrieveParams::with(assetID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OutputRetrieveParams)->withAssetID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $assetID): self
    {
        $self = new self;

        $self['assetID'] = $assetID;

        return $self;
    }

    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }
}
