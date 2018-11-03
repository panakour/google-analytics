<?php

namespace Panakour\Analytics\Builder;

interface GoogleAnalyticsBuilder
{
    public function create();

    public function get(): AnalyticsBuilder;

    public function addRequest();

    public function addClient();

    public function setDateRange(array $dateRange);

    public function setMaxResults(int $maxResults);

    public function setMetric(array $metric);

    public function setDimension(array $dimension);

    public function setDimensionFilter(array $filter);

    public function setOrder(array $order);

    public function setAnalyticsReporting(array $params = []);

    public function setAnalyticsData();
}
