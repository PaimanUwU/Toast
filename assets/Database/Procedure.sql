USE ToastDB;

-- Insert 5 profiles
INSERT INTO PROFILE (Profile_Name, Profile_Email, Profile_Desc, Profile_Password, Profile_Image_ID) VALUES
('Jimi Hendrix', 'jimi@example.com', 'Legendary guitarist known for his electrifying performances', 'asdf', 'GUID-1'),
('Eric Clapton', 'eric@example.com', 'Guitar god with a career spanning decades', 'asdf', 'GUID-2'),
('Jimmy Page', 'jimmy@example.com', 'Led Zeppelin’s mastermind with iconic riffs', 'asdf', 'GUID-3'),
('Eddie Van Halen', 'eddie@example.com', 'Revolutionary guitarist with unparalleled technique', 'asdf', 'GUID-4'),
('Carlos Santana', 'carlos@example.com', 'Latin rock legend with a unique sound', 'asdf', 'GUID-5');

-- Insert 10 posts for each profile with random likes and descriptions as recipes
DELIMITER //

CREATE PROCEDURE InsertPosts()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE j INT DEFAULT 1;
    DECLARE k INT DEFAULT 1;
    DECLARE profile_id INT DEFAULT 1;
    DECLARE post_id INT DEFAULT 1;

    -- Loop through each profile
    WHILE profile_id <= 5 DO
        -- Insert 10 posts for each profile
        WHILE i <= 10 DO
            INSERT INTO POST (Post_Title, Post_Desc, Post_Content, Post_Likes, Post_Dislikes, Post_Image_ID, Profile_ID) 
            VALUES (
                CONCAT('Recipe ', i, ' by Profile ', profile_id), 
                CONCAT('This is the recipe description for post ', i, ' by profile ', profile_id), 
                CONCAT('Full recipe content for post ', i, ' by profile ', profile_id), 
                FLOOR(RAND() * 100), -- Random likes between 0 and 99
                FLOOR(RAND() * 50),  -- Random dislikes between 0 and 49
                CONCAT('GPID-', (profile_id - 1) * 10 + i), 
                profile_id
            );
            SET post_id = LAST_INSERT_ID();

            -- Insert 3 comments for each post
            WHILE k <= 3 DO
                INSERT INTO POST_COMMENT (Post_Comment_Content, Profile_ID, Post_ID) 
                VALUES (
                    CONCAT('This is comment ', k, ' on post ', i, ' by profile ', profile_id), 
                    profile_id, 
                    post_id
                );
                SET k = k + 1;
            END WHILE;
            SET k = 1;

            SET i = i + 1;
        END WHILE;
        SET i = 1;
        SET profile_id = profile_id + 1;
    END WHILE;
END //

DELIMITER ;

-- Call the procedure to insert posts and comments
CALL InsertPosts();
