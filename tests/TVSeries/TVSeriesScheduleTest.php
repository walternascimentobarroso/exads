<?php

use App\TVSeries\Database;
use App\TVSeries\TVSeriesSchedule;
use PHPUnit\Framework\TestCase;

class TVSeriesScheduleTest extends TestCase
{
    protected $database;
    protected $tvSeriesSchedule;

    protected function setUp(): void
    {
        // Set up a Database instance with specific connection parameters for testing.
        $this->database = Database::getInstance('db', 'root', 'root', 'tv_series_db');
        $this->tvSeriesSchedule = new TVSeriesSchedule($this->database);

        // Create the test database and execute the SQL script.
        $this->database->createDatabase();
        $scriptPath = __DIR__ . '/script.sql';
        $script = file_get_contents($scriptPath);
        $this->database->executeScript($script);

        // Start a transaction for each test to isolate changes made during the test.
        $this->database->query('START TRANSACTION');
    }

    protected function tearDown(): void
    {
        // Rollback the transaction to undo any changes made during the test.
        $this->database->query('ROLLBACK');

        // Reset the singleton instance to null after each test.
        $reflection = new ReflectionClass(Database::class);
        $instanceProperty = $reflection->getProperty('instance');
        $instanceProperty->setAccessible(true);
        $instanceProperty->setValue(null, null);

        // Close the database connection after each test.
        $this->database->close();
    }

    public function testGetNextAirTime()
    {
        // Test without parameters
        $result1 = $this->tvSeriesSchedule->getNextAirTime();
        $this->assertStringContainsString("Next air time for", $result1);

        // Test with datetime parameter
        $result2 = $this->tvSeriesSchedule->getNextAirTime('2024-01-25 10:30:00');
        $this->assertStringContainsString("Next air time for 'Stranger Things' is", $result2);

        // Test with title parameter
        $result3 = $this->tvSeriesSchedule->getNextAirTime(null, 'The Mandalorian');
        $this->assertStringContainsString("Next air time for 'The Mandalorian' is", $result3);

        // Test with datetime and title parameters
        $result4 = $this->tvSeriesSchedule->getNextAirTime('2024-01-23 12:00:00', 'Game of Thrones');
        $this->assertStringContainsString("Next air time for 'Game of Thrones' is", $result4);

        // Test without next display schedules
        $result5 = $this->tvSeriesSchedule->getNextAirTime('2023-01-01 00:00:00', 'Nonexistent Series');
        $this->assertStringContainsString("No upcoming air time found for 'Nonexistent Series'", $result5);
    }
}
