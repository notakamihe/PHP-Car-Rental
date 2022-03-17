-- SQL file to create the database for the car rental web project

DROP DATABASE IF EXISTS car_rental;
CREATE DATABASE car_rental;
USE car_rental;

-- Create tables

CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,

  PRIMARY KEY (id)
);

CREATE TABLE vehicles (
  id INT(11) NOT NULL AUTO_INCREMENT,
  vin VARCHAR(17) NOT NULL UNIQUE,
  name VARCHAR(255) NOT NULL,
  brand VARCHAR(255) NOT NULL,
  model VARCHAR(255) NOT NULL,
  year INT(4) NOT NULL,
  vehicle_type ENUM("subcompact", "compact", "mid-size", "full-size", "luxury", "sports", "suv", "minivan", "pickup") NOT NULL,
  price_per_day DECIMAL(10,2) NOT NULL,
  unlimited_mileage BOOLEAN NOT NULL,
  mileage_limit INT(11) NOT NULL,
  prepaid_gas BOOLEAN NOT NULL,

  PRIMARY KEY (id)
);

CREATE TABLE rentals (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  vehicle_id INT(11) NOT NULL,
  pickup_location VARCHAR(255) NOT NULL,
  pickup_time DATETIME NOT NULL,
  dropoff_location VARCHAR(255) NOT NULL,
  dropoff_time DATETIME NOT NULL,

  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
);

-- Populate tables

INSERT INTO users VALUES
(1, "John M Doe"),
(2, "Jane N Doe"),
(3, "Jill O Doe"),
(4, "Mike P Doe"),
(5, "Mark Q Doe"),
(6, "Bob R Doe"),
(7, "Sarah S Doe"),
(8, "Lily T Doe"),
(9, "Don U Doe");

INSERT INTO vehicles VALUES
(1, "11111111111111111", "Honda Civic", "Honda", "Civic", 2000, "compact", 20.00, 1, 0, 0),
(2, "22222222222222222", "Honda Accord", "Honda", "Accord", 2020, "mid-size", 150.00, 0, 200, 1),
(3, "33333333333333333", "Ford F-150", "Ford", "F-Series", 2018, "full-size", 90.00, 1, 0, 1),
(4, "44444444444444444", "Toyota Camry", "Toyota", "Camry", 2019, "mid-size", 50.00, 0, 300, 0),
(5, "55555555555555555", "Mitsubishi Mirage", "Mitsubishi", "Mirage", 1999, "subcompact", 35.00, 0, 100, 0),
(6, "66666666666666666", "Subaru Outback", "Subaru", "Outback", 2022, "suv", 110.00, 1, 0, 0),
(7, "77777777777777777", "Chevrolet Silverado 1500", "Chevrolet", "Silverado/Cheyenne", 2017, "pickup", 100.00, 0, 300, 1),
(8, "88888888888888888", "Chrysler Pacifica", "Chrysler", "Pacifica", 2017, "minivan", 85.00, 0, 250, 0),
(9, "99999999999999999", "Nissan GT-R", "Nissan", "GT-R", 2021, "sports", 500.00, 1, 0, 1),
(10, "10101010101010101", "Audi A8", "Audi", "A8", 2014, "luxury", 250.00, 1, 0, 1);

INSERT INTO rentals VALUES
(1, 1, 5, "9161 North Cleveland Lane, Pomona, CA 91766", "2022-03-01 10:00:00", "300 Harvard Ave., Santa Ana, CA 92704", "2022-03-02 17:00:00"),
(2, 9, 3, "332 Ramblewood Street, Chicopee, MA 01020", "2022-03-15 12:00:00", "7473 Williams Ave., Torrington, CT 06790", "2022-03-18 09:00:00"),
(3, 3, 1, "9220 Creekside St., Farmington, MI 48331", "2022-03-30 18:00:00", "867 South Academy Street, Grand Rapids, MI 49503", "2022-04-01 11:00:00"),
(4, 6, 10, "7424 Corona Court, Union City, CA 94587", "2022-03-11 15:30:00", "7546 S. Summer Court, Los Angeles, CA 90003", "2022-03-14 08:30:00"),
(5, 7, 2, "27 Johnson Street, New York, NY 10033", "2022-04-04 09:45:00", "7098 Pacific Lane, Bronx, NY 10456", "2022-04-06 10:00:00"),
(6, 8, 4, "2 Longbranch Lane, Laval-des-Rapides, QC H7N 3B2", "2022-04-10 14:00:00", "68 Silver Spear St., Manotick, ON K4M 4L2", "2022-04-11 13:00:00"),
(7, 2, 8, "23 Brandywine Street, Irving, TX 75062", "2022-04-17 11:30:00", "50 Magnolia St., San Antonio, TX 78210", "2022-04-20 07:00:00"),
(8, 4, 7, "232 Corona Court, Modesto, CA 95350", "2022-04-22 09:15:00", "15 10th Ave., Compton, CA 90221", "2022-04-30 21:00:00"),
(9, 5, 6, "7 North Street, SOUTH WEST LONDON, SW78 9IC", "2022-05-01 16:30:00", "53 The Grove, CAMBRIDGE, CB8 9FQ", "2022-05-05 08:00:00"),
(10, 1, 9, "40 Shady St., Orlando, FL 32811", "2022-05-09 12:30:00", "T481 Shady St., Tampa, FL 33604", "2022-05-12 15:00:00");

-- Create users and grant privileges
GRANT SELECT, INSERT, DELETE, UPDATE
ON car_rental.*
TO mgs_user@localhost
IDENTIFIED BY 'pa55word';
