<?php

namespace Panakour\Analytics\Core;

class Renderable
{
    private $reports;

    public function __construct(AnalyticsReporting $reports)
    {
        $this->reports = $reports->get();
    }

    public function render(): array
    {
        $myReport = [];
        for ($reportIndex = 0; $reportIndex < count($this->reports); $reportIndex++) {
            $report = $this->reports[$reportIndex];
            $header = $report->getColumnHeader();
            $dimensionHeaders = $header->getDimensions();
            $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
            $rows = $report->getData()->getRows();

            for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                $myReport[$rowIndex] = [];
                $row = $rows[$rowIndex];
                $dimensions = $row->getDimensions();
                $metrics = $row->getMetrics();

                if($dimensionHeaders && count($dimensionHeaders))
                {
                    for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
                        $dimensionName = $dimensionHeaders[$i];
                        $myReport[$rowIndex][$dimensionName] = $dimensions[$i];
                    }
                }

                for ($j = 0; $j < count($metricHeaders) && $j < count($metrics); $j++) {
                    $values = $metrics[$j];

                    for ($valueIndex = 0; $valueIndex < count($values->getValues()); $valueIndex++) {
                        $entry = $metricHeaders[$valueIndex];
                        $metricValue = $values->getValues()[$valueIndex];
                        $metricName = $entry->getName();
                        $myReport[$rowIndex][$metricName] = $metricValue;
                    }
                }
            }
        }

        return $myReport;
    }
}
