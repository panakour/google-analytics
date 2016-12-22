<?php

namespace Panakour\Analytics\Core;

use Google_Service_AnalyticsReporting_DimensionFilter;
use Google_Service_AnalyticsReporting_DimensionFilterClause;

class DimensionFilter
{
    private $dimensionFilter;
    private $filterClause;

    public function __construct(array $filter, ReportRequest $request)
    {
        $this->create();
        $this->setDimensionName($filter['dimensionName']);
        $this->setOperator($filter['operator']);
        $this->setExpression($filter['expression']);
        $this->setFilter();
        $this->set($request->get());
    }

    private function create()
    {
        $this->dimensionFilter = new Google_Service_AnalyticsReporting_DimensionFilter();
        $this->filterClause = new Google_Service_AnalyticsReporting_DimensionFilterClause();
    }

    private function setOperator(string $operator)
    {
        $this->dimensionFilter->setOperator($operator);
    }

    private function setDimensionName(string $dimensionName)
    {
        $this->dimensionFilter->setDimensionName($dimensionName);
    }

    private function setExpression(string $expression)
    {
        $this->dimensionFilter->setExpressions($expression);
    }

    private function setFilter()
    {
        $this->filterClause->setFilters($this->dimensionFilter);
    }

    private function set($request)
    {
        $request->setDimensionFilterClauses($this->filterClause);
    }
}
