<?php

namespace Opteck\Tests;

use Opteck\Entities\Deposit;
use Opteck\Payload;
use Opteck\Responses\GetDeposits;

class EntitiesTest extends TestCase
{
    public function testDeposit()
    {

        // Valid deposits list with single deposit.
        $json = <<<'JSON'
{"returnCode":1,"description":"Successful call","timestampGenerated":"2016-04-21T16:08:12+03:00","data":{"allDepositsCount":"1","selectedDepositsCount":1,"limit":100,"offset":0,"deposits":[{"leadID":"1","dateDeposited":"2016-04-20T13:52:19+00:00","currency":"EUR","amount":"500.00","amountUSD":"574.71","isFirstTimeDeposit":"1","isValid":"1"}]}}
JSON;
        $response = new GetDeposits(new Payload($json));
        $deposits = $response->getDeposits();

        foreach ($deposits as $deposit) {
            $this->assertEquals(1, $deposit->getLeadId());
            $this->assertEquals(strtotime('2016-04-20T13:52:19+00:00'), $deposit->getDateDeposited());
            $this->assertEquals('EUR', $deposit->getCurrency());
            $this->assertEquals(500, $deposit->getAmount());
            $this->assertEquals(574.71, $deposit->getAmountUSD());
            $this->assertTrue($deposit->getIsFirstTimeDeposit());
            $this->assertTrue($deposit->getIsValid());
        }
    }
}
