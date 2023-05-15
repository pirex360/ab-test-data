# A/B Testing

## Description / Problem

An Ads company would like to A/B test some promotional designs to see which provides the best conversion rate.

Write a snippet of PHP code that redirects end users to the different designs based on the data provided by this library: [packagist.org/exads/ab-test-data](https://packagist.org/packages/exads/ab-test-data)

The data will be structured as follows:

```
  "promotion" => [
    "id" => 1,
    "name" => "main",
    "designs" => [
        [ "designId" => 1, "designName" => "Design 1", "splitPercent" => 50 ],
        [ "designId" => 2, "designName" => "Design 2", "splitPercent" => 25 ],
        [ "designId" => 3, "designName" => "Design 3", "splitPercent" => 25 ],
    ]
  ]
```

The code needs to be object-oriented and scalable. The number of designs per promotion may vary.

## Installation

Clone this repository: `https://github.com/pirex360/ab-testing.git`

## Usage

PHP Version `8.1.x`
Run the PHP script using the command line: `php index.php`

## Tests

To run the unit tests for the `ABTesting` class, use PHPUnit: `./vendor/bin/phpunit`

This will runs **5** tests with **12** assertions.

![Tests](/img/tests.png)

## Demonstration

![Demo](/img/demo.gif)
