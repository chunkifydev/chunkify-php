<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Files;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Files\JobFile;

/**
 * Response containing a list of files for a job.
 *
 * @phpstan-import-type JobFileShape from \Chunkify\Files\JobFile
 *
 * @phpstan-type FileListResponseShape = array{
 *   data: list<JobFile|JobFileShape>, status: 'success'
 * }
 */
final class FileListResponse implements BaseModel
{
    /** @use SdkModel<FileListResponseShape> */
    use SdkModel;

    /**
     * Status indicates the response status "success".
     *
     * @var 'success' $status
     */
    #[Required]
    public string $status = 'success';

    /** @var list<JobFile> $data */
    #[Required(list: JobFile::class)]
    public array $data;

    /**
     * `new FileListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileListResponse::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileListResponse)->withData(...)
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
     *
     * @param list<JobFile|JobFileShape> $data
     */
    public static function with(array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * @param list<JobFile|JobFileShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Status indicates the response status "success".
     *
     * @param 'success' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
