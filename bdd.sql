CREATE TABLE IF NOT EXISTS users (
    uuid CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
);

CREATE TABLE IF NOT EXISTS urls (
    uuid CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    user_uuid CHAR(36),
    long_url TEXT,
    short_url VARCHAR(255),
    click_count INT DEFAULT 0,
    disabled BOOLEAN DEFAULT false,
    link_type ENUM('url', 'file') DEFAULT 'url',
    file_name VARCHAR(255),
    display_name VARCHAR(255),
    FOREIGN KEY (user_uuid) REFERENCES users(uuid),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
