<?php

namespace Panakour\Analytics\Core;

use Google_Service_AnalyticsReporting_DateRange;

class DateRange
{
    private $dateRange;

    public function __construct(array $dateRange, ReportRequest $request)
    {
        $this->create($dateRange);
        $this->set($request->get());
    }

    private function create(array $dateRange)
    {
        $this->dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $this->dateRange->setStartDate($dateRange['startDate']);
        $this->dateRange->setEndDate($dateRange['endDate']);
    }

    private function set($request)
    {
        $request->setDateRanges($this->dateRange);
    }
}
