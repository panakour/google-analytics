<?php

namespace Panakour\Analytics\Core;

use Google_Client;

class Client
{
    private $client;
    private $config;

    public function __construct($configFile, ReportRequest $request)
    {
        $this->config = $configFile;
        $this->create();
        $this->setAuthConfig();
        $this->setScopes();
        $this->setViewId($request->get());
    }

    private function create()
    {
        $this->client = new Google_Client();
    }

    private function setAuthConfig()
    {
        $this->client->setAuthConfig($this->config['credentials_json_file']);
    }

    private function setScopes()
    {
        $this->client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
    }

    private function setViewId($request)
    {
        $request->setViewId($this->config['view_id']);
    }

    public function get()
    {
        return $this->client;
    }
}
