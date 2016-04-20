<?php

namespace Opteck\Tests;

use Opteck\Entities\Asset;
use Opteck\Entities\Market;
use Opteck\Responses\AssetRate;

class TradingTest extends TestCase
{
    public function testMarketsRetrieving()
    {
        $markets = $this->apiClient->getMarkets();
        $this->assertTrue(is_array($markets), 'Markets set should be an array.');
        foreach ($markets as $market) {
            $this->assertTrue($market instanceof Market, 'Each item of markets set should be instance of \Opteck\Entities\Market.');
            $this->assertGreaterThan(0, $market->getId(), 'Market ID should be greater than 0.');
            $this->assertNotEmpty($market->getName(), 'Market should has non-empty name.');
        }
    }

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
            if (!$asset->isActive()) {
                $this->assertNotEmpty($asset->getNextOpenTime());
            }
        }
    }

    public function testAssetsRates()
    {
        $assets = $this->apiClient->getAssets();
        shuffle($assets);
        $asset = array_pop($assets);
        $assetRate = $this->apiClient->getAssetRate($asset->getId());
        $this->assertTrue($assetRate instanceof AssetRate);
        $this->assertGreaterThan(0, $assetRate->getRate());
        $this->assertNotEmpty($assetRate->getMicrotime());
        $this->assertNotEmpty($assetRate->getTimestamp());
    }
}
