-- Création de la table 'users'
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT,
    uuid CHAR(36) DEFAULT (UUID()),
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    PRIMARY KEY (id)
);

-- Création de la table 'urls'
CREATE TABLE IF NOT EXISTS urls (
    id INT AUTO_INCREMENT,
    user_id INT,
    long_url TEXT,
    short_url VARCHAR(255),
    click_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    disabled BOOLEAN DEFAULT false,
    link_type ENUM('url', 'file') DEFAULT 'url',
    file_name VARCHAR(255),
    display_name VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
