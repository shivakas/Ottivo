<?php

namespace OttonovaVacationApp\Model;

use DateTimeImmutable;

class Employee
{
    public function __construct(
        public string $name,
        public DateTimeImmutable $dateOfBirth,
        public Contract $contract
    ) {}
}
