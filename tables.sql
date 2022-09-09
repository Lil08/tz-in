CREATE TABLE posts
(
    id      int (10) AUTO_INCREMENT,
    user_id int(10) NOT NULL,
    title   varchar(255),
    body    varchar(500),
    PRIMARY KEY (id)
);

CREATE TABLE comments
(
    id      int (10) AUTO_INCREMENT,
    post_id int(10) NOT NULL,
    name    varchar(255),
    email   varchar(255),
    body    varchar(500),
    PRIMARY KEY (id),
    FOREIGN KEY (post_id) REFERENCES posts (id)
);