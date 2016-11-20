<?php

namespace App\Services\Thumbnails;

use App\Services\Thumbnails\Contracts\ThumbnailServiceContract;
use App\Services\Thumbnails\Exceptions\ThumbnailException;
use Illuminate\Contracts\Filesystem\Filesystem;
use Gregwar\Image\Image;

/**
 * Class ThumbnailService.
 * @property Filesystem $fs
 * @package App\Services\Thumbnails
 */
class ThumbnailService implements ThumbnailServiceContract
{
    /**
     * ThumbnailService constructor.
     *
     * @param Filesystem $fs
     */
    public function __construct(Filesystem $fs)
    {
        $this->fs = $fs;
    }

    /**
     * @inheritdoc
     */
    public function createThumbnailFile(string $originalFilePath, string $width = '100', string $height = '100'): string
    {
        if (!$this->fs->exists($originalFilePath)) {
            throw new ThumbnailException('Original file does not exist.');
        }

        $thumbnailFilePath = $this->generateThumbnailFilePath($originalFilePath, $width, $height);
        $thumbnailContent = $this->generateThumbnailFileContent($this->fs->get($originalFilePath), $width, $height);

        if (!$this->fs->put($thumbnailFilePath, $thumbnailContent)) {
            throw new ThumbnailException('Thumbnail file saving error.');
        }

        return $thumbnailFilePath;
    }

    /**
     * Generate thumbnail file content.
     *
     * @param string $originalContent
     * @param string $width
     * @param string $height
     * @return string
     */
    public function generateThumbnailFileContent(string $originalContent, string $width = '100', string $height = '100') : string
    {
        return Image::fromData($originalContent)
            ->zoomCrop($width, $height)
            ->get();
    }

    /**
     * Generate thumbnail file path.
     *
     * @param string $originalFilePath
     * @param string $width
     * @param string $height
     * @return string
     */
    private function generateThumbnailFilePath(string $originalFilePath, string $width = '100', string $height = '100')
    {
        return sprintf(
            '%s/%s_%sx%s.%s',
            pathinfo($originalFilePath, PATHINFO_DIRNAME),
            pathinfo($originalFilePath, PATHINFO_FILENAME),
            $width,
            $height,
            pathinfo($originalFilePath, PATHINFO_EXTENSION)
        );
    }
}
