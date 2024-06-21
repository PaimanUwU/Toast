-- Create the database if it doesn't exist
CREATE DATABASE ToastDB;

-- Select the database to use
USE ToastDB;

-- Create TAGS table to store tag categories
CREATE TABLE TAGS (
    Tag_ID INT AUTO_INCREMENT PRIMARY KEY,
    Tag_Category VARCHAR(255) NOT NULL UNIQUE
);

-- Create PROFILE table to store user profiles
CREATE TABLE PROFILE (
    Profile_ID INT AUTO_INCREMENT PRIMARY KEY,
    Profile_Name VARCHAR(255) NOT NULL,
    Profile_Email VARCHAR(255) NOT NULL UNIQUE,
    Profile_Desc TEXT,
    Profile_Password VARCHAR(255) NOT NULL,
    Profile_Image_ID VARCHAR(255) DEFAULT NULL
);

-- Create POST table to store posts (recipes)
CREATE TABLE POST (
    Post_ID INT AUTO_INCREMENT PRIMARY KEY,
    Post_Title VARCHAR(255) NOT NULL,
    Post_Desc TEXT,
    Post_Content TEXT NOT NULL,
    Post_Likes INT DEFAULT 0,
    Post_Dislikes INT DEFAULT 0,
    Post_Image_ID VARCHAR(255) DEFAULT NULL,
    Profile_ID INT,
    FOREIGN KEY (Profile_ID) REFERENCES PROFILE(Profile_ID),
    INDEX (Profile_ID)
);

-- Create POST_HISTORY table to store history of post edits
CREATE TABLE POST_HISTORY (
    Post_History_ID INT AUTO_INCREMENT PRIMARY KEY,
    Post_History_Date DATE NOT NULL,
    Post_History_Time TIME NOT NULL,
    Post_ID INT,
    Profile_ID INT,
    FOREIGN KEY (Post_ID) REFERENCES POST(Post_ID),
    FOREIGN KEY (Profile_ID) REFERENCES PROFILE(Profile_ID),
    INDEX (Post_ID),
    INDEX (Profile_ID)
);

-- Create ADMIN table to store admin users
CREATE TABLE ADMIN (
    Admin_ID INT AUTO_INCREMENT PRIMARY KEY,
    Admin_Password VARCHAR(255) NOT NULL,
    Admin_Name VARCHAR(255) NOT NULL
);

-- Create POST_COMMENT table to store comments on posts
CREATE TABLE POST_COMMENT (
    Post_Comment_ID INT AUTO_INCREMENT PRIMARY KEY,
    Post_Comment_Content TEXT NOT NULL,
    Profile_ID INT,
    Post_ID INT,
    FOREIGN KEY (Profile_ID) REFERENCES PROFILE(Profile_ID),
    FOREIGN KEY (Post_ID) REFERENCES POST(Post_ID),
    INDEX (Profile_ID),
    INDEX (Post_ID)
);

-- Create FOLLOWER table to store follower-followee relationships
CREATE TABLE FOLLOWER (
    Follower_ID INT AUTO_INCREMENT PRIMARY KEY,
    Follower_Profile_ID INT,
    Followee_Profile_ID INT,
    Follow_Date DATE NOT NULL,
    FOREIGN KEY (Follower_Profile_ID) REFERENCES PROFILE(Profile_ID),
    FOREIGN KEY (Followee_Profile_ID) REFERENCES PROFILE(Profile_ID),
    INDEX (Follower_Profile_ID),
    INDEX (Followee_Profile_ID)
);

-- Image ID formats: "GUID-<id>" for user, "GPID-<id>" for post

-- Example Image IDs:
-- User image ID: "GUID-123"
-- Post image ID: "GPID-456"
