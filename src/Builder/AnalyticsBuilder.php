<?php

namespace Panakour\Analytics\Builder;

use Panakour\Analytics\Core\AnalyticsReporting;
use Panakour\Analytics\Core\Client;
use Panakour\Analytics\Core\DateRange;
use Panakour\Analytics\Core\Dimension;
use Panakour\Analytics\Core\DimensionFilter;
use Panakour\Analytics\Core\MaxResults;
use Panakour\Analytics\Core\Metric;
use Panakour\Analytics\Core\Order;
use Panakour\Analytics\Core\Renderable;
use Panakour\Analytics\Core\ReportRequest;

class AnalyticsBuilder implements GoogleAnalyticsBuilder
{
    private $analytics;

    public function create()
    {
        $this->analytics = new self();
    }

    public function get(): self
    {
        return $this->analytics;
    }

    public function addRequest()
    {
        $this->analytics->request = new ReportRequest();
    }

    public function addClient()
    {
        $this->analytics->client = new Client(config('analytics'), $this->analytics->request);
    }

    public function setDateRange(array $dateRange)
    {
        $this->analytics->dateRange = new DateRange($dateRange, $this->analytics->request);
    }

    public function setMaxResults(int $maxResults)
    {
        $this->analytics->maxResults = new MaxResults($maxResults, $this->analytics->request);
    }

    public function setMetric(array $metric)
    {
        $this->analytics->metric = new Metric($metric, $this->analytics->request);
    }

    public function setDimension(array $dimension)
    {
        $this->analytics->dimension = new Dimension($dimension, $this->analytics->request);
    }

    public function setDimensionFilter(array $filter)
    {
        $this->analytics->dimensionFilter = new DimensionFilter($filter, $this->analytics->request);
    }

    public function setOrder(array $order)
    {
        $this->analytics->order = new Order($order, $this->analytics->request);
    }

    public function setAnalyticsReporting(array $params = [])
    {
        $this->analytics->analyticsReporting = new AnalyticsReporting($this->analytics->client, $this->analytics->request, $params);
    }

    public function setAnalyticsData()
    {
        if (!property_exists($this->analytics, 'analyticsReporting')) {
            $this->setAnalyticsReporting();
        }
        $this->analytics->render = (new Renderable($this->analytics->analyticsReporting))->render();
    }
}
