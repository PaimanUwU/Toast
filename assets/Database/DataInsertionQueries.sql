use toastdb;

-- Insertion queries for tags
INSERT INTO TAGS (Tag_Category) VALUES 
('#Pancakes'),
('#Waffles'),
('#Omelettes'),
('#Smoothies'),
('#Breakfast Burritos'),
('#French Toast'),
('#Granola'),
('#Breakfast Sandwiches'),
('#Muffins'),
('#Quiche'),
('#Breakfast Casseroles'),
('#Crepes'),
('#Bagels'),
('#Frittatas'),
('#Avocado Toast'),
('#Oatmeal'),
('#Breakfast Bowls'),
('#Scrambled Eggs'),
('#Hash Browns'),
('#Breakfast Tacos'),
('#Croissants'),
('#Yogurt Parfaits'),
('#Sausages'),
('#Bacon'),
('#Breakfast Pizza'),
('#Chia Pudding'),
('#Smoothie Bowls'),
('#Scones'),
('#Biscuits'),
('#Breakfast Salad');

-- Insertion queries for profiles
INSERT INTO PROFILE (Profile_Name, Profile_Email, Profile_Desc, Profile_Password, Profile_Image_ID) VALUES 
('Jimi Hendrix', 'jimi@example.com', 'Legendary guitarist known for his iconic performances.', 'asdf', 1),
('Eric Clapton', 'eric@example.com', 'Renowned guitarist with a distinguished career spanning decades.', 'asdf', 1),
('Jimmy Page', 'jimmy@example.com', 'Legendary guitarist and founder of Led Zeppelin.', 'asdf', 1),
('Slash', 'slash@example.com', 'Iconic guitarist known for his work with Guns N Roses and Velvet Revolver.', 'asdf', 1),
('Eddie Van Halen', 'eddie@example.com', 'Innovative guitarist known for his technical prowess and influential style.', 'asdf', 1);

-- Insertion queries for posts
INSERT INTO POST (Post_Title, Post_Desc, Post_Content, Post_Likes, Profile_ID, Post_Image_ID) VALUES
('Post Title 1', 'Recipe description for post 1', 'Post content for post 1', 20, 1, 1),
('Post Title 2', 'Recipe description for post 2', 'Post content for post 2', 15, 1, 1),
('Post Title 3', 'Recipe description for post 3', 'Post content for post 3', 30, 1, 1),
('Post Title 4', 'Recipe description for post 4', 'Post content for post 4', 10, 1, 1),
('Post Title 5', 'Recipe description for post 5', 'Post content for post 5', 25, 1, 1),
('Post Title 6', 'Recipe description for post 6', 'Post content for post 6', 18, 2, 1),
('Post Title 7', 'Recipe description for post 7', 'Post content for post 7', 22, 2, 1),
('Post Title 8', 'Recipe description for post 8', 'Post content for post 8', 27, 2, 1),
('Post Title 9', 'Recipe description for post 9', 'Post content for post 9', 35, 2, 1),
('Post Title 10', 'Recipe description for post 10', 'Post content for post 10', 40, 2, 1),
('Post Title 11', 'Recipe description for post 11', 'Post content for post 11', 33, 3, 1),
('Post Title 12', 'Recipe description for post 12', 'Post content for post 12', 28, 3, 1),
('Post Title 13', 'Recipe description for post 13', 'Post content for post 13', 17, 3, 1),
('Post Title 14', 'Recipe description for post 14', 'Post content for post 14', 19, 3, 1),
('Post Title 15', 'Recipe description for post 15', 'Post content for post 15', 24, 3, 1),
('Post Title 16', 'Recipe description for post 16', 'Post content for post 16', 38, 4, 1),
('Post Title 17', 'Recipe description for post 17', 'Post content for post 17', 42, 4, 1),
('Post Title 18', 'Recipe description for post 18', 'Post content for post 18', 31, 4, 1),
('Post Title 19', 'Recipe description for post 19', 'Post content for post 19', 26, 4, 1),
('Post Title 20', 'Recipe description for post 20', 'Post content for post 20', 37, 4, 1),
('Post Title 21', 'Recipe description for post 21', 'Post content for post 21', 45, 5, 1),
('Post Title 22', 'Recipe description for post 22', 'Post content for post 22', 50, 5, 1),
('Post Title 23', 'Recipe description for post 23', 'Post content for post 23', 29, 5, 1),
('Post Title 24', 'Recipe description for post 24', 'Post content for post 24', 32, 5, 1),
('Post Title 25', 'Recipe description for post 25', 'Post content for post 25', 36, 5, 1);

-- Insertion queries for comments
INSERT INTO POST_COMMENT (Post_Comment_Content, Profile_ID, Post_ID) VALUES
('Comment 1 for post 1', 1, 1),
('Comment 2 for post 1', 2, 1),
('Comment 3 for post 1', 3, 1),
('Comment 1 for post 2', 1, 2),
('Comment 2 for post 2', 2, 2),
('Comment 3 for post 2', 3, 2),
('Comment 1 for post 3', 1, 3),
('Comment 2 for post 3', 2, 3),
('Comment 3 for post 3', 3, 3),
('Comment 1 for post 4', 1, 4),
('Comment 2 for post 4', 2, 4),
('Comment 3 for post 4', 3, 4),
('Comment 1 for post 5', 1, 5),
('Comment 2 for post 5', 2, 5),
('Comment 3 for post 5', 3, 5),
('Comment 1 for post 6', 2, 6),
('Comment 2 for post 6', 3, 6),
('Comment 3 for post 6', 4, 6),
('Comment 1 for post 7', 2, 7),
('Comment 2 for post 7', 3, 7),
('Comment 3 for post 7', 4, 7),
('Comment 1 for post 8', 2, 8),
('Comment 2 for post 8', 3, 8),
('Comment 3 for post 8', 4, 8),
('Comment 1 for post 9', 2, 9),
('Comment 2 for post 9', 3, 9),
('Comment 3 for post 9', 4, 9),
('Comment 1 for post 10', 2, 10),
('Comment 2 for post 10', 3, 10),
('Comment 3 for post 10', 4, 10);
