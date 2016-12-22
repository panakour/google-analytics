<?php

namespace Panakour\Analytics\Core;

use Google_Service_AnalyticsReporting_ReportRequest;

class ReportRequest
{
    private $request;

    public function __construct()
    {
        $this->create();
    }

    private function create()
    {
        $this->request = new Google_Service_AnalyticsReporting_ReportRequest();
    }

    public function get()
    {
        return $this->request;
    }
}
