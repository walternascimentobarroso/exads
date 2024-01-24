# EXADS - PHP Exercises

<details open>
<summary><h2> :scroll: 3 - TV Series </h2></summary>

Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:

```
tv_series -> (id, title, channel, gender);
tv_series_intervals -> (id_tv_series, week_day, show_time);
```

-   Provide the SQL scripts that create and populate the DB;
    Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
    inputted time-date, and that can be optionally filtered by TV Series title.

</details>

<details open>
<summary><h2> :desktop_computer: Execute </h2></summary>

To directly execute it do the following in the root path:

```
make bash_php
```

so you will enter the project and within the project you can execute:

```
php public/TVSeries.php
```

</details>

<details open>
<summary><h2> :white_check_mark: Tests </h2></summary>

To run the tests, just type `make test` or `docker-compose exec php composer test` in the root path

</details>
