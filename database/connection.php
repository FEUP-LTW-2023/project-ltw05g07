<?php function &getDatabaseConnection() : PDO {
    return new PDO('sqlite:../database/database.db');
} ?>