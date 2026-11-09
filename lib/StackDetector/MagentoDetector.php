<?php

declare(strict_types=1);

namespace fortrabbit\StackDetector\StackDetector;

use fortrabbit\StackDetector\StackDetectorInterface;
use fortrabbit\StackDetector\Enum\StackType;

class MagentoDetector extends BaseComposerTypeDetector implements StackDetectorInterface
{
    protected function packagesToSearch(): array
    {
        // Open Source first, then Adobe Commerce; both lock magento/magento2-base.
        return [
            'magento/product-community-edition',
            'magento/product-enterprise-edition',
            'magento/magento2-base',
        ];
    }

    protected function detectedStackType(): StackType
    {
        return StackType::MAGENTO;
    }
}
