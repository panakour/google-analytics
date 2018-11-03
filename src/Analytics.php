<?php

namespace Panakour\Analytics;

use Panakour\Analytics\Builder\AnalyticsBuilder;
use Panakour\Analytics\Builder\Director;

class Analytics implements \Panakour\Analytics\Contracts\Analytics
{
    private $analytics = [];

    private function buildData()
    {
        $director = new Director(new AnalyticsBuilder(), $this->analytics);
        $analytics = $director->get();

        return $analytics;
    }

    public function get(): array
    {
        return $this->buildData()->render;
    }

    public function getBuilder(): AnalyticsBuilder
    {
        return $this->buildData();
    }

    public function setDateRange(string $startDate, string $endDate)
    {
        $this->analytics[] = [
            'method'     => 'setDateRange',
            'parameters' => ['startDate' => $startDate, 'endDate' => $endDate],
        ];
    }

    public function setMaxResults(int $maxResults)
    {
        $this->analytics[] = [
            'method'     => 'setMaxResults',
            'parameters' => $maxResults,
        ];
    }

    public function setMetrics(array $metric)
    {
        $this->analytics[] = [
            'method'     => 'setMetric',
            'parameters' => $metric,
        ];
    }

    public function setDimension(array $dimension)
    {
        $this->analytics[] = [
            'method'     => 'setDimension',
            'parameters' => $dimension,
        ];
    }

    public function setDimensionFilter(string $dimensionName, string $operator, $expression)
    {
        $this->analytics[] = [
            'method'     => 'setDimensionFilter',
            'parameters' => ['dimensionName' => $dimensionName, 'operator' => $operator, 'expression' => $expression],
        ];
    }

    public function setOrder(string $fieldName, string $orderType, string $sortType)
    {
        $this->analytics[] = [
            'method'     => 'setOrder',
            'parameters' => ['fieldName' => $fieldName, 'orderType' => $orderType, 'sortType' => $sortType],
        ];
    }

    public function setAnalyticsReporting(array $params)
    {
        $this->analytics[] = [
            'method'     => 'setAnalyticsReporting',
            'parameters' => $params,
        ];
    }
}
