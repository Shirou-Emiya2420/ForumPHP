DROP DATABASE forumclindecke;
CREATE DATABASE forumclindecke;
USE forumclindecke;

CREATE TABLE user(
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(50) NOT NULL,
    nickName VARCHAR(50) NOT NULL,
    password VARCHAR(127) NOT NULL,
    registrationDate DATETIME NOT NULL
);
 
CREATE TABLE category(
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE topic(
    id_topic INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    creationDate DATETIME NOT NULL,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    isClose BOOLEAN NOT NULL,
    FOREIGN KEY (category_id) REFERENCES category(id_category),
    FOREIGN KEY (user_id) REFERENCES user(id_user)
);

CREATE TABLE post (
    id_post INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    creationDate DATETIME NOT NULL,
    topic_id INT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id_user),
    FOREIGN KEY (topic_id) REFERENCES topic(id_topic)
);

