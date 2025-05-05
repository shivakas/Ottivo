<?php

namespace OttonovaVacationApp\Model;

use DateTimeImmutable;

class Contract
{
    public function __construct(
        public DateTimeImmutable $startDate,
        public ?int $specialVacationDays = null
    ) {}
}
