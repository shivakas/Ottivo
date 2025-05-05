<?php

use OttonovaVacationApp\Model\Contract;
use OttonovaVacationApp\Model\Employee;

return [
    new Employee('Hans Müller', new DateTimeImmutable('1970-12-30'), new Contract(new DateTimeImmutable('2001-01-01'))),
    new Employee('Angelika Fringe', new DateTimeImmutable('1976-06-09'), new Contract(new DateTimeImmutable('2001-01-15'))),
    new Employee('Peter Klever', new DateTimeImmutable('1991-07-12'), new Contract(new DateTimeImmutable('2016-05-15'), 27)),
    new Employee('Marina Helter', new DateTimeImmutable('1970-01-26'), new Contract(new DateTimeImmutable('2018-01-15'))),
    new Employee('Sepp Meier', new DateTimeImmutable('1980-05-23'), new Contract(new DateTimeImmutable('2017-12-01'))),
];
