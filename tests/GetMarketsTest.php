<?php

namespace Opteck\Tests;

use Opteck\Entities\Market;

class GetMarketsTest extends TestCase
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
}
