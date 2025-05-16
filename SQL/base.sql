DROP DATABASE forumclindecke;
CREATE DATABASE forumclindecke;
USE forumclindecke;

CREATE TABLE user(
    id_user INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(50) NOT NULL,
    nickName VARCHAR(50) NOT NULL,
    password VARCHAR(127) NOT NULL,
    pathImg VARCHAR(127) NOT NULL DEFAULT 'default.png',
    registrationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
 
CREATE TABLE category(
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE topic(
    id_topic INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id INT UNSIGNED,
    category_id INT,
    isClose BOOLEAN NOT NULL,
    FOREIGN KEY (category_id) REFERENCES category(id_category) ON DELETE SET NULL, 
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE SET NULL
);

CREATE TABLE post (
    id_post INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    topic_id INT,
    user_id INT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE SET NULL, 
    FOREIGN KEY (topic_id) REFERENCES topic(id_topic) ON DELETE CASCADE
);

CREATE TABLE likes (
    post_id INT NOT NULL,
    user_id INT UNSIGNED,
    PRIMARY KEY (post_id, user_id),
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES post(id_post) ON DELETE CASCADE
);

