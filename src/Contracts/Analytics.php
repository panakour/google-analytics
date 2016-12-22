<?php

namespace Panakour\Analytics\Contracts;

use Panakour\Analytics\Builder\AnalyticsBuilder;

interface Analytics
{
    public function get(): array;

    public function getBuilder(): AnalyticsBuilder;

    public function setDateRange(string $startDate, string $endDate);

    public function setMaxResults(int $maxResults);

    public function setMetrics(array $metrics);

    public function setDimension(array $dimension);

    public function setDimensionFilter(string $dimensionName, string $operator, string $expression);

    public function setOrder(string $fieldName, string $orderType, string $sortType);
}
