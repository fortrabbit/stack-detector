<?php

declare(strict_types=1);

namespace fortrabbit\StackDetector\StackDetector;

use fortrabbit\StackDetector\DTO\Stack;
use fortrabbit\StackDetector\StackDetectorInterface;
use fortrabbit\StackDetector\Enum\StackType;

class LaravelDetector extends BaseComposerTypeDetector implements StackDetectorInterface
{
    protected function packagesToSearch(): array
    {
        return ['laravel/framework'];
    }

    protected function detectedStackType(): StackType
    {
        return StackType::LARAVEL;
    }

    public function getStack(string $baseUri, ?string $subDirectory): ?Stack
    {
        if ($this->hasChildStack($baseUri, $subDirectory, 'laravel/framework')) {
            return null;
        }

        return parent::getStack($baseUri, $subDirectory);
    }
}
