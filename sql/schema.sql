CREATE DATABASE IF NOT EXISTS blog_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE blog_db;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    slug VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    image VARCHAR(512),
    views INT DEFAULT 0,

    status ENUM('draft', 'published') DEFAULT 'published',

    published_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_articles_created (created_at),
    INDEX idx_articles_views (views),
    INDEX idx_articles_published (published_at)
);

CREATE TABLE article_category (
    article_id INT NOT NULL,
    category_id INT NOT NULL,

    PRIMARY KEY (article_id, category_id),

    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,

    INDEX idx_ac_article (article_id),
    INDEX idx_ac_category (category_id)
);
