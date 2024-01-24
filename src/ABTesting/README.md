# EXADS - PHP Exercises

<details open>
<summary><h2> :scroll: 4 - A/B Testing </h2></summary>

Exads would like to A/B test some promotional designs to see which provides the best conversion rate.
Write a snippet of PHP code that redirects end users to the different designs based on the data provided by [this library](https://packagist.org/packages/exads/ab-test-data).
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

</details>

<details open>
<summary><h2> :desktop_computer: Execute </h2></summary>

To directly execute it do the following in the root path:

```
make bash_php
```

so you will enter the project and within the project you can execute:

```
php public/ABTesting.php
```

</details>

<details open>
<summary><h2> :white_check_mark: Tests </h2></summary>

To run the tests, just type `make test` or `docker-compose exec php composer test` in the root path

</details>
