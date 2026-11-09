<?php

declare(strict_types=1);

namespace fortrabbit\StackDetector\StackDetector;

use fortrabbit\StackDetector\DTO\Stack;
use fortrabbit\StackDetector\StackDetectorInterface;
use fortrabbit\StackDetector\Enum\StackType;

class SymfonyDetector extends BaseComposerTypeDetector implements StackDetectorInterface
{
    protected function packagesToSearch(): array
    {
        return ['symfony/framework-bundle', 'symfony/symfony'];
    }

    protected function detectedStackType(): StackType
    {
        return StackType::SYMFONY;
    }

    public function getStack(string $baseUri, ?string $subDirectory): ?Stack
    {
        if ($this->hasChildStack($baseUri, $subDirectory, 'symfony/framework-bundle')) {
            return null;
        }

        return parent::getStack($baseUri, $subDirectory);
    }
}
