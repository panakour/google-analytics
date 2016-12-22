<?php

namespace Panakour\Analytics\Core;

class MaxResults
{
    public function __construct(int $maxResults, ReportRequest $request)
    {
        $this->set($maxResults, $request->get());
    }

    private function set(int $maxResults, $request)
    {
        $request->setPageSize($maxResults);
    }
}
