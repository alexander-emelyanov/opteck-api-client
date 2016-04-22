<?php

namespace Opteck\Tests;

use Opteck\Entities\Asset;
use Opteck\Entities\Market;
use Opteck\Entities\OptionType;
use Opteck\Payload;
use Opteck\Requests\GetDefinitions;
use Opteck\Responses\GetAssetRate;
use Opteck\Responses\Trade as TradeResponse;

class TradingTest extends TestCase
{
    const RESPONSE_SUCCESSFUL_TRADE = '{"returnCode":1,"description":"Successful call","timestampGenerated":"2016-04-21T11:48:36+00:00","data":{"tradeActionID":46682766,"balance":225}}';

    public function testOptionTypesRetrieving()
    {
        $optionTypes = $this->apiClient->getOptionTypes();
        $this->assertTrue(is_array($optionTypes), 'Option types set should be an array.');
        foreach ($optionTypes as $optionType) {
            $this->assertTrue($optionType instanceof OptionType, 'Each item of option types set should be instance of \Opteck\Entities\OptionType.');
            $this->assertGreaterThan(0, $optionType->getId(), 'Option Type ID should be greater than 0.');
            $this->assertNotEmpty($optionType->getName(), 'Option Type should has non-empty name.');
        }
    }

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
        $this->assertTrue($assetRate instanceof GetAssetRate);
        $this->assertGreaterThan(0, $assetRate->getRate());
        $this->assertNotEmpty($assetRate->getMicrotime());
        $this->assertNotEmpty($assetRate->getTimestamp());
    }

    public function testDefinitionsRetrieving()
    {
        $request = new GetDefinitions([
            'isActive' => true,
        ]);
        $definitions = $this->apiClient->getDefinitions($request);
        $this->assertTrue(is_array($definitions));
        $this->assertNotEmpty($definitions);
        foreach ($definitions as $definition) {
            $this->assertNotEmpty($definition->getId());
            $this->assertGreaterThan(0, $definition->getAssetId());
            $this->assertNotEmpty($definition->getAssetName());
            $this->assertGreaterThan(0, $definition->getMarketId());
            $this->assertGreaterThan(0, $definition->getOptionTypeId());
            $this->assertGreaterThan(0, $definition->getDuration());
            $this->assertGreaterThan(-1, $definition->getStopTime());
            $this->assertGreaterThan(0, $definition->getPayout());
            $this->assertGreaterThan(-1, $definition->getProtection());
            $this->assertGreaterThan(-1, $definition->getSellStopTime());
            $this->assertGreaterThan(0, $definition->getStartTime());
            $this->assertGreaterThan(0, $definition->getEndTime());
            $this->assertTrue(is_bool($definition->getIsActive()));
            break;
        }
    }

    public function testTradeResponse()
    {
        $payload = new Payload(static::RESPONSE_SUCCESSFUL_TRADE);
        $response = new TradeResponse($payload);
        $this->assertTrue($response->isSuccess());
        $this->assertGreaterThan(0, $response->getTradeActionId(), 'Instance of \Opteck\Responses\Trade should returns ID for opened trade.');
        $this->assertGreaterThan(0, $response->getBalance(), 'Instance of \Opteck\Responses\Trade should returns actual balance.');
    }

    /**
     * Tests Asset Name resolving to ID with wrong asset name.
     * This case should raise \Opteck\Exceptions\AssetNotFoundException as well.
     *
     * @expectedException \Opteck\Exceptions\AssetNotFoundException
     */
    public function testWrongAssetName()
    {
        $this->apiClient->resolveAssetNameToId('WRONG_ASSET_NAME');
    }

    /**
     * @expectedException \Opteck\Exceptions\NoEnoughBalanceException
     */
    public function testOpenPositionMethod()
    {
        $this->apiClient->openPosition('test.auth@gmail.com', 'qwerty', 'EURUSD', 1, 25);
    }

    /**
     * @expectedException \Opteck\Exceptions\TooSmallAmountException
     */
    public function testTooSmallAmountException()
    {
        $json = <<<'JSON'
 {"returnCode":105,"description":"Too small amount","timestampGenerated":"2016-04-22T14:50:34+00:00"}
JSON;
        new TradeResponse(new Payload($json));
    }
}
