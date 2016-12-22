<?php

namespace Panakour\Analytics\Builder;

class Director
{
    private $builder;

    public function __construct(GoogleAnalyticsBuilder $builder, array $analytics)
    {
        $this->builder = $builder;
        $this->build($analytics);
    }

    public function build($analytics)
    {
        $this->createBuilder();
        $this->buildAnalytics($analytics);
        $this->buildReport();
    }

    public function createBuilder()
    {
        $this->builder->create();
        $this->builder->addRequest();
        $this->builder->addClient();
    }

    public function buildAnalytics($analytics)
    {
        foreach ($analytics as $analytic) {
            call_user_func([$this->builder, $analytic['method']], $analytic['parameters']);
        }
    }

    public function buildReport()
    {
        $this->builder->addAnalyticsReporting();
        $this->builder->setAnalyticsData();
    }

    public function get(): AnalyticsBuilder
    {
        return $this->builder->get();
    }
}
