<?php function getDateTimeFromString(string $dateString) : DateTime {
    return DateTime::createFromFormat(
        'Y-m-d H:i:s',
        $dateString,
        new DateTimeZone('Europe/Lisbon')
    );
} ?>