<?php

namespace Panakour\Analytics\Core;

class Dimension
{
    private $dimension;

    public function __construct(array $dimension, ReportRequest $request)
    {
        $this->create($dimension);
        $this->set($request->get());
    }

    private function create(array $dimensions)
    {
        foreach ($dimensions as $dimension) {
            $this->dimension[]['name'] = $dimension;
        }
    }

    private function set($request)
    {
        $request->setDimensions($this->dimension);
    }
}
