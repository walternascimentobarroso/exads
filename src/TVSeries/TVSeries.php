<?php

namespace App\TVSeries;

class TVSeries
{

    /**
     * Main function
     */
    public function main()
    {
        $database = Database::getInstance('db', 'root', 'root', 'tv_series_db');
        $database->createDatabase();

        $scriptPath = __DIR__ . '/script.sql';
        $script = file_get_contents($scriptPath);

        $database->executeScript($script);

        $tvSeriesSchedule = new TVSeriesSchedule($database);
        $result = $tvSeriesSchedule->getNextAirTime();
        echo $result . PHP_EOL;
        $database->close();
    }
}
