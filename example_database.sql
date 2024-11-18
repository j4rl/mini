-- Create tblblog table
CREATE TABLE tblblog (
    blogID INT AUTO_INCREMENT PRIMARY KEY,
    header VARCHAR(255) NOT NULL,
    ingress TEXT NOT NULL,
    text TEXT NOT NULL,
    author INT NOT NULL,
    added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create tblUser table
CREATE TABLE tblUser (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    userlevel INT NOT NULL,
    realname VARCHAR(255) NOT NULL
);

-- Create tbltext table
CREATE TABLE tbltext (
    textID INT AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    author INT NOT NULL,
    blogID INT NOT NULL,
    added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert example data into tblblog
INSERT INTO tblblog (header, ingress, text, author) VALUES
('First Blog Post', 'This is the ingress of the first blog post.', 'This is the text of the first blog post.', 1),
('Second Blog Post', 'This is the ingress of the second blog post.', 'This is the text of the second blog post.', 2);

-- Insert example data into tblUser
INSERT INTO tblUser (username, password, userlevel, realname) VALUES
('user1', 'password1', 10, 'User One'),
('user2', 'password2', 100, 'User Two');

-- Insert example data into tbltext
INSERT INTO tbltext (text, author, blogID) VALUES
('This is a comment on the first blog post.', 1, 1),
('This is another comment on the first blog post.', 2, 1),
('This is a comment on the second blog post.', 1, 2);
