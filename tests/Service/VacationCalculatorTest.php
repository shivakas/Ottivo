<?php

namespace OttonovaVacationApp\Tests\Service;

use PHPUnit\Framework\TestCase;
use OttonovaVacationApp\Model\Employee;
use OttonovaVacationApp\Model\Contract;
use OttonovaVacationApp\Service\VacationCalculator;
use DateTimeImmutable;

class VacationCalculatorTest extends TestCase
{
    private VacationCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new VacationCalculator();
    }

    public function testDefaultVacationWithoutBonus()
    {
        $employee = new Employee(
            'Test User',
            new DateTimeImmutable('1995-01-01'),
            new Contract(new DateTimeImmutable('2015-01-01'))
        );

        $this->assertEquals(26, $this->calculator->calculate($employee, 2024));
    }

    public function testSpecialVacationOverridesDefault()
    {
        $employee = new Employee(
            'Test User',
            new DateTimeImmutable('1990-01-01'),
            new Contract(new DateTimeImmutable('2015-01-01'), 28)
        );

        $this->assertEquals(28, $this->calculator->calculate($employee, 2024));
    }

    public function testBonusVacationForOlderEmployee()
    {
        $employee = new Employee(
            'Older Employee',
            new DateTimeImmutable('1970-01-01'),
            new Contract(new DateTimeImmutable('2000-01-01')) // 24 yrs employed
        );

        $this->assertEquals(26 + 4, $this->calculator->calculate($employee, 2024));
    }

    public function testProratedVacation()
    {
        $employee = new Employee(
            'New Joiner',
            new DateTimeImmutable('1990-01-01'),
            new Contract(new DateTimeImmutable('2024-03-15'))
        );

        // Should have 9 full months from April to Dec = 9/12 * 26
        $this->assertEquals(19, $this->calculator->calculate($employee, 2024));
    }

    public function testProratedWithBonus()
    {
        $employee = new Employee(
            'Experienced Newcomer',
            new DateTimeImmutable('1970-01-01'),
            new Contract(new DateTimeImmutable('2024-02-01')) // 11 full months
        );

        // 26 + 0 bonus (0 years yet), prorated to 11 months
        $this->assertEquals(23, $this->calculator->calculate($employee, 2024));
    }
}
