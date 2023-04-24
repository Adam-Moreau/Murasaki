# Murasaki

Murasaki is a website that has a personal purpose for the moment (nothing more is planned, but I am not closing any possibilities). Its purpose is to track and review my Japanese learning progress. Indeed, all stored kanjis are kanjis that I know. Thus, it allows to concretely track the progress.

For the moment, two major functionalities are planned: tables grouping kanjis by categories, filters, search fields, and memory exercises to practice specific categories of kanjis (under development).

The website does not require user login.

# Database creation (order is important as some table may content foreign keys) 


- category table

CREATE TABLE categories (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255)
);

- Kanji table

CREATE TABLE kanji (
  kanji_id INT AUTO_INCREMENT PRIMARY KEY,
  kanji_character VARCHAR(255) NOT NULL,
  kanji_meaning VARCHAR(255) NOT NULL,
  kanji_kunyomi VARCHAR(255),
  kanji_onyomi VARCHAR(255),
  kanji_romaji_writing VARCHAR(255),
  kanji_is_daily BOOLEAN NOT NULL DEFAULT FALSE,
  category_id INT,
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

- user table

CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  is_admin TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

- Kanji insertion example

INSERT INTO kanji (kanji_character, kanji_meaning, kanji_kunyomi, kanji_onyomi, kanji_romaji_writing, kanji_is_daily, category_id) VALUES ('山', 'mountain', 'やま', 'サン', 'yama', TRUE, 1);
