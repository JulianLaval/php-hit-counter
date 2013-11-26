# PHP Hit Counter

Simple hit counter for tracking website traffic, using PHP (PDO) and a MySQL database to store information.

## Features

- Track hits per page
- Track total hits
- Track total unique visitors
- Track IP, user agent, and timestamp information
- View consolidated information with tables and graphs

## Usage

Add this snippet to the page you want to track:

    require_once('conn.php');
    require_once('counter.php');
	
    updateCounter("page name"); // Updates page hits
    updateInfo(); // Updates hit info

## Installation notes

Tested with PHP 5.4.16 and MySQL 5.1.72

- Make sure you have PHP Data Objects (PDO) enabled.
- Open up `conn.php` and add your database information where required.
- Run `install.php`. A message will be displayed if the installation was successful.
- Delete `install.php`.
- Add relevant code to the page you wish to track.
- Open `view.php` to view consolidated information (last 10 IP entries will displayed).

## Known issues

- Dygraphs fails to render for datasets with a large amount of points. 

## Acknowledgements

- Inspired by [PHP - Page hit counter](http://codebase.eu/source/code-php/ip-counter/)
- Includes the Dygraphs open source JavaScript library for graph rendering