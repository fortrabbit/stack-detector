<?php

declare(strict_types=1);

namespace fortrabbit\StackDetector\StackDetector;

use fortrabbit\StackDetector\Composer\PackageVersionProvider;
use fortrabbit\StackDetector\DTO\DependencyTree;
use fortrabbit\StackDetector\DTO\Stack;
use fortrabbit\StackDetector\Enum\StackType;

abstract class BaseComposerTypeDetector
{
    public function __construct(protected readonly PackageVersionProvider $packageVersionProvider)
    {
    }

    /**
     * @return string[]
     */
    abstract protected function packagesToSearch(): array;

    abstract protected function detectedStackType(): StackType;

    public function getStack(string $baseUri, ?string $subDirectory): ?Stack
    {
        $version = $this->packageVersionProvider->getVersionForPackage(
            $baseUri,
            $subDirectory,
            $this->packagesToSearch()
        );

        if (null === $version) {
            return null;
        }

        return new Stack(
            $this->detectedStackType(),
            $version->getVersion(),
        );
    }

    /**
     * True when software built on $parentPackage is installed, so the more specific detector wins.
     */
    protected function hasChildStack(string $baseUri, ?string $subDirectory, string $parentPackage): bool
    {
        foreach (DependencyTree::getChildStacksForPackage($parentPackage) as $packageName) {
            if (null !== $this->packageVersionProvider->getVersionForPackage(
                $baseUri,
                $subDirectory,
                [$packageName],
            )) {
                return true;
            }
        }

        return false;
    }
}
