<?php

return [
    'db_host' => getenv('DB_HOST') ?? 'localhost',
    'db_port' => getenv('DB_PORT') ?? '3306',
    'db_database' => getenv('DB_DATABASE') ?? 'url-shorter',
    'db_username' => getenv('DB_USERNAME') ?? 'root',
    'db_password' => getenv('DB_PASSWORD') ?? '',
];