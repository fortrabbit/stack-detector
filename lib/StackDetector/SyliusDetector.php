<?php

declare(strict_types=1);

namespace fortrabbit\StackDetector\StackDetector;

use fortrabbit\StackDetector\StackDetectorInterface;
use fortrabbit\StackDetector\Enum\StackType;

class SyliusDetector extends BaseComposerTypeDetector implements StackDetectorInterface
{
    public const string PACKAGE_NAME = 'sylius/sylius';

    protected function packagesToSearch(): array
    {
        return [self::PACKAGE_NAME];
    }

    protected function detectedStackType(): StackType
    {
        return StackType::SYLIUS;
    }
}
