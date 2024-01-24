<p align="center"><img src="https://www.exads.com/images/brand/card.png" width="200" alt="EXADS Logo"></p>

# EXADS - PHP Exercises

<details open>
<summary><h2> :scroll: Exads </h2></summary>

Template for new projects using php and nginx inside docker containers

</details>

<!-- TABLE OF CONTENTS -->
<detailsm open>
  <summary>Table of Contents</summary>

-   [Prime Numbers](src/PrimeNumbers/README.md)
-   [ASCII Array](src/ASCIIArray/README.md)
-   [TV_Series](src/TVSeries/README.md)
-   [AB Testing](src/ABTesting/README.md)

</detailsm>

<details open>
<summary><h2> :desktop_computer: Start Project </h2></summary>

First clone the project:

```
git clone https://github.com/walternascimentobarroso/exads.git
```

Make the build

_:bulb: NOTE: Before next step, check the variables in `.env` file_

```
make build
make composer
```

To perform any exercise, access the project's bash
`make bash_php` or `docker-compose exec php bash` and run

```
php public/{activity}
```

_:bulb: NOTE: If the project is already compiled then just run the `make up` command_

</details>

<details open>
<summary><h2> :white_check_mark: Tests </h2></summary>

To run the tests, just type `make test` or `docker-compose exec php composer test`

![tests](make-test.png)

</details>

<details open>
<summary><h2> :hammer_and_pick: Tools </h2></summary>

-   [VSCode](https://code.visualstudio.com/)
-   [EditorConfig](https://editorconfig.org/)
-   [Docker](https://www.docker.com/)
-   [NGINX](https://www.nginx.com/)
-   [PHP](https://www.php.net/)
-   [PHPUnit](https://phpunit.de/)
-   [MySQL](https://www.mysql.com/)
-   [Composer](https://getcomposer.org/)
-   [Makefile](https://www.gnu.org/software/make/manual/make.html)

</details>

<details open>
<summary><h2> :open_file_folder: Folder Structure </h2></summary>

```
.
├── Makefile
├── README.md
├── composer.json
├── phpunit.xml
├── public
│   ├── ABTesting.php
│   ├── ASCIIArray.php
│   ├── PrimeNumbers.php
│   ├── TVSeries.php
│   └── index.php
├── src
│   ├── ABTesting
│   │   ├── AB.php
│   │   └── README.md
│   ├── ASCIIArray
│   │   ├── README.md
│   │   └── RandomAsciiArrayGenerator.php
│   ├── PrimeNumbers
│   │   ├── PrimeNumberPrinter.php
│   │   └── README.md
│   └── TVSeries
│       ├── Database.php
│       ├── README.md
│       ├── TVSeries.php
│       ├── TVSeriesSchedule.php
│       └── script.sql
└── tests
    ├── ABTesting
    │   └── ABTest.php
    ├── ASCIIArray
    │   └── RandomAsciiArrayGeneratorTest.php
    ├── PrimeNumbers
    │   └── PrimeNumberPrinterTest.php
    └── TVSeries
        ├── DatabaseTest.php
        ├── TVSeriesScheduleTest.php
        └── script.sql
```

</details>

<details open>
<summary><h2> :smiley_cat: Author </h2></summary>

-   [@walternascimentobarroso](https://walternascimentobarroso.github.io/)

</details>

---

Made with &nbsp;❤️&nbsp;
