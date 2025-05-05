<?php

namespace OttonovaVacationApp\Tests\Model;

use PHPUnit\Framework\TestCase;
use OttonovaVacationApp\Model\Contract;
use DateTimeImmutable;

class ContractTest extends TestCase
{
    public function testCreatesContractWithDefaults()
    {
        $startDate = new DateTimeImmutable('2020-01-01');
        $contract = new Contract($startDate);

        $this->assertEquals($startDate, $contract->startDate);
        $this->assertNull($contract->specialVacationDays);
    }

    public function testCreatesContractWithSpecialVacationDays()
    {
        $startDate = new DateTimeImmutable('2020-01-01');
        $contract = new Contract($startDate, 30);

        $this->assertEquals(30, $contract->specialVacationDays);
    }
}
