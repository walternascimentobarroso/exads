CREATE TABLE IF NOT EXISTS tv_series (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    channel VARCHAR(255) NOT NULL,
    gender VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS tv_series_intervals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_tv_series INT,
    week_day VARCHAR(10) NOT NULL,
    show_time TIME NOT NULL,
    FOREIGN KEY (id_tv_series) REFERENCES tv_series(id)
);

INSERT INTO tv_series (title, channel, gender) VALUES
    ('Game of Thrones', 'HBO', 'Fantasy'),
    ('Stranger Things', 'Netflix', 'Sci-Fi'),
    ('The Mandalorian', 'Disney+', 'Action');

INSERT INTO tv_series_intervals (id_tv_series, week_day, show_time) VALUES
    (1, 'Monday', '20:00:00'),
    (2, 'Tuesday', '19:30:00'),
    (3, 'Wednesday', '21:00:00');
