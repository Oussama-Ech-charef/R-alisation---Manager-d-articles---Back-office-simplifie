


CREATE TABLE users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE category (
    id_category INT PRIMARY KEY AUTO_INCREMENT,
	category_name VARCHAR(50) NOT NULL UNIQUE)
;

CREATE TABLE posts (
    id_post INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255) DEFAULT NULL,
    publish_date DATETIME DEFAULT CURRENT_TIMESTAMP, 
    status ENUM('draft', 'published') DEFAULT 'draft',
	id_user INT NOT NULL,
    id_category INT,
    CONSTRAINT fk_user FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_category FOREIGN KEY (id_category) REFERENCES category(id_category) ON DELETE SET NULL
);

CREATE TABLE comments (
    id_comment INT PRIMARY KEY AUTO_INCREMENT,
    comment_text TEXT NOT NULL,
    comment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_post INT NOT NULL,
    id_user INT NOT NULL,

    CONSTRAINT fk_post_comment 
        FOREIGN KEY (id_post) 
        REFERENCES posts(id_post) 
        ON DELETE CASCADE,

    CONSTRAINT fk_user_comment 
        FOREIGN KEY (id_user) 
        REFERENCES users(id_user) 
        ON DELETE CASCADE
);

INSERT INTO users (user_name, email, password) VALUES 
('alami', 'alami@mail.com', '1234'),
('mansouri', 'mansouri@mail.com', '1234'),
('idrissi', 'idrissi@mail.com', '1234');

INSERT INTO category (category_name) VALUES 
('Lifestyle'), 
('Technology'), 
('Education');

-- Inserting Posts
INSERT INTO posts (title, content, status, id_user, id_category) VALUES 
('Learning HTML TAGES', 'TExecution of a program requires an implementation. There are two main approaches for implementing a programming language – compilation, where programs are compiled ahead-of-time to machine code, and interpretation, where programs are directly executed. In addition to these two extremes, some implementations use hybrid approaches such as just-in-time compilation and bytecode interpreters.', 'published', 1, 2);
('Learning PHP OOP', 'This article explains the basics of Object-Oriented Programming in PHP.', 'published', 1, 2),
('Importance of Design', 'Good design is the key to the success of any web application.', 'published', 2, 1),
('Draft Post', 'This content is not visible to everyone because it is a draft.', 'draft', 3, 3);

-- Inserting Comments
INSERT INTO comments (comment_text, id_post, id_user) VALUES 
('Great explanation, thanks!', 1, 2),
('Very helpful topic, keep it up.', 1, 3);