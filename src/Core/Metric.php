<?php

namespace Panakour\Analytics\Core;

use Google_Service_AnalyticsReporting_Metric;

class Metric
{
    private $metric;

    public function __construct(array $metrics, ReportRequest $request)
    {
        $this->create($metrics);
        $this->set($request->get());
    }

    private function create(array $metrics)
    {
        foreach ($metrics as $index => $metric) {
            $session = new Google_Service_AnalyticsReporting_Metric();
            $session->setExpression($metric);
            $this->metric[$index] = $session;
        }
    }

    private function set($request)
    {
        $request->setMetrics($this->metric);
    }
}
