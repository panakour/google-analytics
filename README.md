[![StyleCI](https://styleci.io/repos/77175016/shield?branch=master)](https://styleci.io/repos/77175016)
[![Latest Stable Version](https://poser.pugx.org/panakour/analytics/v/stable)](https://packagist.org/packages/panakour/analytics)
[![Total Downloads](https://poser.pugx.org/panakour/analytics/downloads)](https://packagist.org/packages/panakour/analytics)
[![License](https://poser.pugx.org/panakour/analytics/license)](https://packagist.org/packages/panakour/analytics)

# Get easily whatever data you want from google analytics API V4 using laravel php framework.

This package helps php developers to use Google Analytics API V4 with convenient way. 
The code is clean and was written with good OOP practices.
Any help to improve this package would be appreciated.

The package is compatible with laravel framework.


## Installation

Install the package via composer:
``` shell
composer require panakour/analytics
```
To use it with laravel add the GoogleAnalyticsServiceProvider to the `config/app.php`:
```php
'providers' => [
...
Panakour\Analytics\GoogleAnalyticsServiceProvider::class
]
```

If you want to use the facade of the package add it to the `config/app.php`:
```php
'aliases' => [
...
'Analytics' => Panakour\Analytics\Facades\Analytics::class
]
```
Copy the analytics config file with the command:
``` shell
php artisan vendor:publish --provider="Panakour\Analytics\GoogleAnalyticsServiceProvider"
```
For those who have a credential with google analytics api continue here otherwise look at [how to create credential with google analytics api](#create-credential-with-google-analytics-api-v4).

Be sure that you have `service-account-credentials.json` file within `storage\app\google-analytics\`.

Add the view id to `.env` file: 
```
GOOGLE_ANALYTICS_VIEW_ID=324235464
```

## Usage

#### You can get analytics data simply using the facade 
`Panakour\Analytics\Facades\Analytics`

##### To get all sessions of the last week
`Analytics::get();` 

##### To get all sessions depends on the specific date range
```php
Analytics::setDateRange('2016-10-01', '2016-11-25');
Analytics::get();
```

##### To get whatever data you want

```php
Analytics::setDateRange('2016-10-01', '2016-11-25');
Analytics::setMaxResults(20);
Analytics::setMetrics(['ga:entrances', 'ga:pageviews', 'ga:bounceRate']);
Analytics::setDimension(['ga:pagePath', 'ga:pageTitle']);
Analytics::setDimensionFilter('ga:pagePath', 'REGEXP', '/i-want-to-get-all-data-that-has-this-page-path');
Analytics::setOrder('ga:pageviews', 'VALUE', 'DESCENDING');
return Analytics::get();
```

`setMetrics` and `setDimension` methods accept an array containing the wanted metrics and dimension. Available [metrics and dimensions](https://developers.google.com/analytics/devguides/reporting/core/dimsmets)

`setDimensionFilter` accept 3 parameters. First parameter get the dimension name in which you want to filter analytics data. Second parameter get the [operator](https://developers.google.com/analytics/devguides/reporting/core/v4/rest/v4/reports/batchGet#operator) (REGEXP, BEGINS_WITH, ENDS_WITH and more) you want. Third parameter get the expression. For example if you want to get all analytics data in which the page path include `play` or `simple` words you can use: `Analytics::setDimensionFilter('ga:pagePath', 'REGEXP', '(\/play\/|\/simple\/)');`

If you want to get analytics data for multiple pages in a single request by their exact paths, you can use the 'IN_LIST' operator and pass an array of paths as the third parameter. E.g. 
`Analytics::setDimensionFilter('ga:pagePath', 'IN_LIST', ['/i-want-data-for-this-path', '/and/this-path-too']);`

`setOrder` method accept 3 parameters. First parameter get the name in which you want to order the data. Second get [OrderType](https://developers.google.com/analytics/devguides/reporting/core/v4/rest/v4/reports/batchGet#ordertype) usually `VALUE`. Third get the [SortOrder](https://developers.google.com/analytics/devguides/reporting/core/v4/rest/v4/reports/batchGet#sortorder) usually `ASCENDING` or `DESCENDING`.

#### Get data using Analytics contract 
`Panakour\Analytics\Contracts\Analytics`

Instead of facade you can get analytics data using the Analytics interface:
```php
use Panakour\Analytics\Contracts\Analytics;

class GoogleAnalyticsController
{
    //inject analytics interface
    public function get(Analytics $analytics)
    {
        $analytics->setDateRange('2016-12-01', '2016-12-20');
        $analytics->setMaxResults(11);
        $analytics->setMetrics(['ga:pageviews', 'ga:uniquePageviews', 'ga:avgTimeOnPage', 'ga:entrances', 'ga:bounceRate']);
        $analytics->setDimension(['ga:pagePath', 'ga:pageTitle']);
        $analytics->setDimensionFilter('ga:pagePath', 'REGEXP', '(\/this-value-in-path\/|\/or-this-value-in-path\/)');
        $analytics->setOrder('ga:pageviews', 'VALUE', 'DESCENDING');
        return $analytics->get();
    }
}    
```

## Create credential with google analytics api v4
Guide from google analytics api v4: https://developers.google.com/analytics/devguides/reporting/core/v4/quickstart/service-php
 - Create a project using [Google API Console](https://console.developers.google.com/start/api?id=analyticsreporting.googleapis.com&credential=client_key):
  - Open the [Service accounts page](https://console.developers.google.com/permissions/serviceaccounts). If prompted, select your project that you have created and click open.
 - Click `Create service account`.
 - In the Create service account window, type a name for the service account, and select Furnish a new private key. In the key type select JSON and then click create. If you want to grant G Suite domain-wide authority to the service account, also select Enable G Suite Domain-wide Delegation.
 - Copy Service account ID you have created and then go to [google analytics admin panel](https://analytics.google.com/analytics/web/#management/Settings) select `User Management` and add the account you have copied with the permissions that you want.
 - Your new public/private key pair is generated and downloaded to your machine; it serves as the only copy of this key. You are responsible for storing it securely.
 - Rename the **json** file to `service-account-credentials.json`.
 - To get the **view id** you can use the [account explorer](https://ga-dev-tools.appspot.com/account-explorer/) or from google analytics `view settings` from [admin panel](https://analytics.google.com/analytics/web/#management/Settings).
