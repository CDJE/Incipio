<?php

namespace ApiBundle\DataFixtures\Faker\Provider;

use Faker\Provider\DateTime as DateTimeProvider;

/**
 * Class MandateProvider.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class MandateProvider extends DateTimeProvider
{
    /**
     * Generate a datetime from the year given.
     *
     * @example
     *   startMandateDateTime()       -> DateTime('2015-05-30 19:28:21')
     *   startMandateDateTime('now')  -> DateTime('2015-05-29 22:30:48')
     *   startMandateDateTime('2014') -> DateTime('2014-02-27 20:52:14')
     *   startMandateDateTime(2012)   -> DateTime('2012-08-23 11:47:02')
     *
     * @param string|int $year A year in integer or string format. If value is invalid, the current year is taken.
     *
     * @return \DateTime
     */
    public function startMandateDateTime($year = 'now')
    {
        // Insure input value is taken as an integer
        if ('string' === gettype($year)) {
            $year = (int) $year;
        }

        // Check if the integer value is a year (and not before J.-C.), if not take this time's year
        if (1000 > $year || 10000 <= $year) {
            $now  = new \DateTime();
            $year = (int) $now->format('Y');
        }

        $startDate = new \DateTime(sprintf('%d-01-01', $year));
        $endDate   = new \DateTime(sprintf('%d-12-31', $year));

        return $this->dateTimeBetween($startDate, $endDate);
    }

    /**
     * Generate a datetime starting from the date given and on a period going from 3 month to 2 years.
     *
     * @param \DateTime $startDate
     *
     * @return \DateTime
     */
    public function endMandateDateTime(\DateTime $startDate)
    {
        $year = (int) $startDate->format('Y');
        $month = (int) $startDate->format('m');

        $startDate = new \DateTime();
        $startDate->setDate($year, $month + 3, 01);

        $endDate = new \DateTime();
        $endDate->setDate($year + 2, $month, 01);

        return $this->dateTimeBetween($startDate, $endDate);
    }
}
