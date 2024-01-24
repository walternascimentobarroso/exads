<?php

namespace App\TVSeries;

/**
 * Class TVSeriesSchedule
 *
 * Represents a class for managing TV series schedules and retrieving
 * information about the next air time.
 */
class TVSeriesSchedule
{
    /**
     * @var Database $db An instance of the Database class used
     * for database interactions.
     */
    private $db;

    /**
     * TVSeriesSchedule constructor.
     *
     * @param Database $db An instance of the Database class for handling database interactions.
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Retrieves information about the next air time for a TV series.
     *
     * @param string|null $dateTime The base date and time for finding the next air time (in 'Y-m-d H:i:s' format).
     * @param string|null $title The title of the TV series for which to find the next air time.
     * @return string A message indicating the next air time or a message stating that no upcoming air time was found.
     */
    public function getNextAirTime($dateTime = null, $title = null)
    {
        // If $dateTime is not provided, use the current date and time.
        $dateTime = ($dateTime === null) ? new \DateTime() : new \DateTime($dateTime);
        $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
        $formattedDate = $dateTime->format('Y-m-d');

        // Build the SQL query to find the next air time for the specified TV series.
        $query = "SELECT title, CONCAT(week_day, ' ', show_time) as next_air_time
                FROM tv_series_db.tv_series
                JOIN tv_series_db.tv_series_intervals ON tv_series.id = tv_series_intervals.id_tv_series
                WHERE STR_TO_DATE(CONCAT('$formattedDate', CONCAT(week_day, ' ', show_time)), '%Y-%m-%d %W %H:%i:%s') > :formattedDateTime
                " . ($title ? "AND tv_series.title = :title" : "") . "
                ORDER BY STR_TO_DATE(CONCAT('$formattedDate', CONCAT(week_day, ' ', show_time)), '%Y-%m-%d %W %H:%i:%s') ASC
                LIMIT 1;";


        // Prepare the parameter bindings for the query
        $bindings = [':formattedDateTime' => $formattedDateTime];

        // Add Binding to title only if title exists
        ($title) ? $bindings[':title'] = $title : null;

        // Execute the query using the Database class.
        $result = $this->db->query($query, $bindings);

        // Process the query result and generate a response message.
        if ($result && $result->rowCount() > 0) {
            $row = $result->fetch(\PDO::FETCH_ASSOC);
            return "Next air time for '{$row['title']}' is {$row['next_air_time']}";
        }

        // Return a message indicating that no upcoming air time was found.
        return "No upcoming air time found" . ($title ? " for '{$title}'" : "");
    }
}
