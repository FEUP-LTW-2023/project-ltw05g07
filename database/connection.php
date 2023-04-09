<?php function &getDatabaseConnection() : PDO {
    return new PDO('sqlite:database/news.db');
} ?>