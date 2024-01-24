<?php

use App\TVSeries\Database;
use PHPUnit\Framework\TestCase;

/**
 * Class DatabaseTest
 *
 * PHPUnit test class for testing the Database class functionality.
 */
class DatabaseTest extends TestCase
{
    /**
     * @var Database|null $database An instance of the Database class used for testing.
     */
    protected $database;

    /**
     * Common configuration performed before each test.
     */
    protected function setUp(): void
    {
        // Set up a Database instance with specific connection parameters for testing.
        $this->database = Database::getInstance('db', 'root', 'root', 'tv_series_db');

        // Start a transaction for each test to isolate changes made during the test.
        $this->database->query('START TRANSACTION');
    }

    /**
     * Common configuration performed after each test.
     */
    protected function tearDown(): void
    {
        // Drop the test table if it exists.
        $this->database->query("DROP TABLE IF EXISTS test_table");

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

    /**
     * @test
     * Test the createDatabase method to ensure it creates the specified database.
     */
    public function testCreateDatabase()
    {
        // Call the createDatabase method.
        $this->database->createDatabase();

        // Check if the 'tv_series_db' database exists in the list of databases.
        $this->assertTrue($this->database->query("SHOW DATABASES LIKE 'tv_series_db'")->rowCount() > 0);
    }

    /**
     * @test
     * Test the executeScript method to ensure it correctly executes SQL scripts.
     */
    public function testExecuteScript()
    {
        // Define a SQL script to create a test table.
        $script = "CREATE TABLE test_table (id INT, name VARCHAR(255));";

        // Execute the script using the executeScript method.
        $this->database->executeScript($script);

        // Check if the 'test_table' exists in the list of tables.
        $this->assertTrue($this->database->query("SHOW TABLES LIKE 'test_table'")->rowCount() > 0);
    }

    /**
     * @test
     * Test the query method to ensure it correctly executes SQL queries.
     */
    public function testQuery()
    {
        // Create a test table and insert a record using SQL queries.
        $this->database->executeScript("CREATE TABLE test_table (id INT, name VARCHAR(255));");
        $this->database->query("INSERT INTO test_table (id, name) VALUES (1, 'Test Name')");

        // Retrieve the record using a SELECT query.
        $result = $this->database->query("SELECT * FROM test_table WHERE id = 1");

        // Check if the result contains one row.
        $this->assertEquals(1, $result->rowCount());
    }
}
