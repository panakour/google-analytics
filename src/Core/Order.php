<?php

namespace Panakour\Analytics\Core;

use Google_Service_AnalyticsReporting_OrderBy;

class Order
{
    private $ordering;

    public function __construct(array $order, ReportRequest $request)
    {
        $this->create($order);
        $this->set($request->get());
    }

    public function create(array $order)
    {
        $this->ordering = new Google_Service_AnalyticsReporting_OrderBy();
        $this->ordering->setFieldName($order['fieldName']);
        $this->ordering->setOrderType($order['orderType']);
        $this->ordering->setSortOrder($order['sortType']);
    }

    public function set($request)
    {
        $request->setOrderBys($this->ordering);
    }
}
