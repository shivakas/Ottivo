<?php

namespace OttonovaVacationApp\Tests\Model;

use PHPUnit\Framework\TestCase;
use OttonovaVacationApp\Model\Employee;
use OttonovaVacationApp\Model\Contract;
use DateTimeImmutable;

class EmployeeTest extends TestCase
{
    public function testCreatesEmployee()
    {
        $dob = new DateTimeImmutable('1985-01-01');
        $contract = new Contract(new DateTimeImmutable('2010-01-01'));
        $employee = new Employee('John Doe', $dob, $contract);

        $this->assertEquals('John Doe', $employee->name);
        $this->assertEquals($dob, $employee->dateOfBirth);
        $this->assertSame($contract, $employee->contract);
    }
}
