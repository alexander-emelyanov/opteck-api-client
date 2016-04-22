<?php

namespace Opteck\Tests;

use Opteck\Entities\TradeAction;
use Opteck\Payload;
use Opteck\Responses\GetTradeActions;

class GetTradeActionsTest extends TestCase
{
    public function testSuccessResponse()
    {
        // Successful trade actions retrieving
        $json = <<<JSON
    {"returnCode":1,"description":"Successful call","timestampGenerated":"2016-04-22T10:46:55+00:00","data":[{"id":"1","optionTypeID":"4","assetID":"17","assetName":"EURUSD","definitionID":"7","createdDate":"2016-04-21T11:48:34+00:00","expirationDate":"2016-04-21T11:49:34+00:00","currency":"USD","status":3,"direction":"1","amount":"25.00","amountLead":"25.00","profit":"41.00","profitLead":"41.00","strike":1.13212,"strikeEnd":1.13321}]}
JSON;
        $response = new GetTradeActions(new Payload($json));
        $tradeActions = $response->getTradeActions();

        $this->assertNotEmpty($tradeActions);
        $this->assertEquals(1, count($tradeActions));
        foreach ($tradeActions as $tradeAction) {
            $this->assertTrue($tradeAction instanceof TradeAction);
            $this->assertEquals(1, $tradeAction->getId());
            $this->assertEquals(4, $tradeAction->getOptionTypeId());
            $this->assertEquals('EURUSD', $tradeAction->getAssetName());
            $this->assertEquals('7', $tradeAction->getDefinitionId());
            $this->assertEquals(strtotime('2016-04-21T11:48:34+00:00'), $tradeAction->getCreatedDate());
            $this->assertEquals(strtotime('2016-04-21T11:49:34+00:00'), $tradeAction->getExpirationDate());
            $this->assertEquals('USD', $tradeAction->getCurrency());
            $this->assertEquals('Closed', $tradeAction->getStatusText());
            $this->assertEquals(1, $tradeAction->getDirection());
            $this->assertEquals(25, $tradeAction->getAmount());
            $this->assertEquals(25, $tradeAction->getAmountLead());
            $this->assertEquals(41, $tradeAction->getProfit());
            $this->assertEquals(41, $tradeAction->getProfitLead());
            $this->assertEquals(1.13212, $tradeAction->getStrike());
            $this->assertEquals(1.13321, $tradeAction->getStrikeEnd());
        }
    }

    public function testApiCall()
    {
        $tradeActions = $this->apiClient->getTradeActions('test.auth@gmail.com');
        $this->assertEmpty($tradeActions);
    }

}
