<?php

namespace Opteck\Tests;

use Opteck\Entities\Asset;

class GetAssetsTest extends TestCase
{
    public function testAssetsRetrieving()
    {
        $assets = $this->apiClient->getAssets();
        $this->assertTrue(is_array($assets), 'Assets set should be an array.');
        foreach ($assets as $asset) {
            $this->assertTrue($asset instanceof Asset, 'Each item of assets set should be instance of \Opteck\Entities\Asset.');
            $this->assertGreaterThan(0, $asset->getId(), 'Asset ID should be greater than 0.');
            $this->assertNotEmpty($asset->getName(), 'Asset should has non-empty name.');
            $this->assertGreaterThan(0, $asset->getPrecision());
            $this->assertGreaterThan(0, $asset->getMarketId(), 'Asset\'s attribute Market ID should be greater than 0.');
            $this->assertTrue(is_bool($asset->isActive()));
            if (!$asset->isActive()){
                $this->assertNotEmpty($asset->getNextOpenTime());
            }
        }
    }
}
