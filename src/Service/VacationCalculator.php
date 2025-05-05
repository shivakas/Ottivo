<?php

namespace OttonovaVacationApp\Service;

use OttonovaVacationApp\Model\Employee;
use DateTimeImmutable;
use DateInterval;

class VacationCalculator
{
    private const DEFAULT_VACATION_DAYS = 26;

    public function calculate(Employee $employee, int $year): int
    {
        $baseVacationDays = $employee->contract->specialVacationDays ?? self::DEFAULT_VACATION_DAYS;

        $bonusVacationDays = $this->calculateBonusVacationDays($employee, $year);

        $totalVacationDays = $baseVacationDays + $bonusVacationDays;

        // Check if the contract started during the year
        if ((int)$employee->contract->startDate->format('Y') === $year) {
            $totalVacationDays = $this->applyProration($employee, $year, $totalVacationDays);
        }

        return $totalVacationDays;
    }

    private function calculateBonusVacationDays(Employee $employee, int $year): int
    {
        $birthDate = $employee->dateOfBirth;
        $contractStartDate = $employee->contract->startDate;
        $referenceDate = new DateTimeImmutable("{$year}-01-01");

        // Age check
        $age = $birthDate->diff($referenceDate)->y;
        if ($age < 30) {
            return 0;
        }

        $yearsEmployed = $contractStartDate->diff($referenceDate)->y;
        return intdiv($yearsEmployed, 5); // +1 day per 5 years
    }

    private function applyProration(Employee $employee, int $year, int $totalVacation): int
    {
        $start = $employee->contract->startDate;

        // Only full months count, and only months after start date
        $fullMonths = 0;
        for ($month = 1; $month <= 12; $month++) {
            $monthStart = new DateTimeImmutable("{$year}-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-01");

            // Month must be fully after contract start (e.g., Feb 1 is a full month if contract starts Jan 15)
            if ($monthStart > $start && (int)$monthStart->format('Y') === $year) {
                $fullMonths++;
            }
        }

        return (int)floor($totalVacation * ($fullMonths / 12));
    }
}
