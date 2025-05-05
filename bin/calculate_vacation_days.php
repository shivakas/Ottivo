#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use OttonovaVacationApp\Service\VacationCalculator;
use OttonovaVacationApp\Model\Employee;

/**
 * Entry point: bin/calculate_vacation_days.php 2024
 */

// Validate argument
if ($argc !== 2 || !is_numeric($argv[1])) {
    echo "Usage: php bin/calculate_vacation_days.php <year>\n";
    exit(1);
}

$year = (int) $argv[1];

// Load employee data
$employees = require __DIR__ . '/../config/employees.php';

// Create calculator
$calculator = new VacationCalculator();

echo "Vacation days for year $year:\n";
echo "-----------------------------\n";

foreach ($employees as $employee) {
    if (!$employee instanceof Employee) {
        continue;
    }

    $days = $calculator->calculate($employee, $year);
    echo "{$employee->name}: {$days} days\n";
}
