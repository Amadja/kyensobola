CREATE DATABASE IF NOT EXISTS kyensobola CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kyensobola;

CREATE TABLE users (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 email VARCHAR(190) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('user','admin') NOT NULL DEFAULT 'user',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE profiles (
 user_id INT UNSIGNED PRIMARY KEY,
 full_name VARCHAR(150) NOT NULL,
 headline VARCHAR(200) DEFAULT '',
 bio TEXT,
 phone VARCHAR(40) DEFAULT '',
 country VARCHAR(80) DEFAULT 'Uganda',
 city VARCHAR(100) DEFAULT 'Kampala',
 hourly_rate DECIMAL(12,2) NULL,
 photo VARCHAR(255) DEFAULT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE categories (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL UNIQUE,
 icon VARCHAR(20) DEFAULT '✦'
);

CREATE TABLE skills (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 category_id INT UNSIGNED NOT NULL,
 name VARCHAR(100) NOT NULL UNIQUE,
 FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE user_skills (
 user_id INT UNSIGNED NOT NULL,
 skill_id INT UNSIGNED NOT NULL,
 PRIMARY KEY(user_id,skill_id),
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(skill_id) REFERENCES skills(id) ON DELETE CASCADE
);

CREATE TABLE jobs (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 user_id INT UNSIGNED NOT NULL,
 category_id INT UNSIGNED NOT NULL,
 title VARCHAR(180) NOT NULL,
 description TEXT NOT NULL,
 location VARCHAR(150) DEFAULT 'Remote',
 budget_min DECIMAL(12,2) NULL,
 budget_max DECIMAL(12,2) NULL,
 currency VARCHAR(10) DEFAULT 'UGX',
 status ENUM('open','closed') DEFAULT 'open',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(category_id) REFERENCES categories(id)
);

CREATE TABLE applications (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 job_id INT UNSIGNED NOT NULL,
 user_id INT UNSIGNED NOT NULL,
 cover_letter TEXT NOT NULL,
 status ENUM('pending','shortlisted','accepted','rejected') DEFAULT 'pending',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_application(job_id,user_id),
 FOREIGN KEY(job_id) REFERENCES jobs(id) ON DELETE CASCADE,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO categories(name,icon) VALUES
('Technology','💻'),('Creative','🎨'),('Education','📚'),('Music','🎸'),
('Home & Care','🏠'),('Trades','🔧'),('Business','💼'),('Events','🎤'),
('Transport','🚗'),('Agriculture','🌱'),('Beauty & Fashion','✂️'),('Other','✨');

INSERT INTO skills(category_id,name) SELECT id,'Web Design' FROM categories WHERE name='Technology';
INSERT INTO skills(category_id,name) SELECT id,'PHP Development' FROM categories WHERE name='Technology';
INSERT INTO skills(category_id,name) SELECT id,'Graphic Design' FROM categories WHERE name='Creative';
INSERT INTO skills(category_id,name) SELECT id,'Video Editing' FROM categories WHERE name='Creative';
INSERT INTO skills(category_id,name) SELECT id,'Photography' FROM categories WHERE name='Creative';
INSERT INTO skills(category_id,name) SELECT id,'Tutoring' FROM categories WHERE name='Education';
INSERT INTO skills(category_id,name) SELECT id,'Luganda Lessons' FROM categories WHERE name='Education';
INSERT INTO skills(category_id,name) SELECT id,'Swahili Lessons' FROM categories WHERE name='Education';
INSERT INTO skills(category_id,name) SELECT id,'Guitar Training' FROM categories WHERE name='Music';
INSERT INTO skills(category_id,name) SELECT id,'Vocal Training' FROM categories WHERE name='Music';
INSERT INTO skills(category_id,name) SELECT id,'Babysitting' FROM categories WHERE name='Home & Care';
INSERT INTO skills(category_id,name) SELECT id,'Nanny Services' FROM categories WHERE name='Home & Care';
INSERT INTO skills(category_id,name) SELECT id,'Cleaning' FROM categories WHERE name='Home & Care';
INSERT INTO skills(category_id,name) SELECT id,'Plumbing' FROM categories WHERE name='Trades';
INSERT INTO skills(category_id,name) SELECT id,'Electrical Work' FROM categories WHERE name='Trades';
INSERT INTO skills(category_id,name) SELECT id,'Mechanic' FROM categories WHERE name='Trades';
INSERT INTO skills(category_id,name) SELECT id,'Social Media Management' FROM categories WHERE name='Business';
INSERT INTO skills(category_id,name) SELECT id,'Event Support' FROM categories WHERE name='Events';
INSERT INTO skills(category_id,name) SELECT id,'Driving' FROM categories WHERE name='Transport';
INSERT INTO skills(category_id,name) SELECT id,'Farming Assistance' FROM categories WHERE name='Agriculture';
INSERT INTO skills(category_id,name) SELECT id,'Tailoring' FROM categories WHERE name='Beauty & Fashion';
