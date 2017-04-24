INSERT INTO Actor(id)
Values(312);
-- This Insert violates the constraint that every Actor must a unique primary key since the id 312 already exists 
-- ERROR 1062 (23000): Duplicate entry '312' for key 'PRIMARY'

INSERT INTO Director(id)
Values(68622);
-- This Insert violates the constraint that every Director must a unique primary key since the id 68622 already exists 
-- ERROR 1062 (23000): Duplicate entry '68622' for key 'PRIMARY'

INSERT INTO Movie(id)
Values(4732);
-- This Insert violates the constraint that every Movie must a unique primary key since the id 4732 already exists 
-- ERROR 1062 (23000): Duplicate entry '4732' for key 'PRIMARY'

INSERT INTO Sales(mid)
Values(-100);
-- This Insert violates the foreign key constraint for mid in Sales because -100 is not a valid id of any Movie
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`Sales`, CONSTRAINT `Sales_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

INSERT INTO MovieGenre(mid)
Values(-100);
-- This Insert violates the foreign key constraint for mid in MovieGenre because -100 is not a valid id of any Movie
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

INSERT INTO MovieDirector(mid)
Values(-100);
-- This Insert violates the foreign key constraint for mid in MovieDirector because -100 is not a valid id of any Movie
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

INSERT INTO MovieDirector(did)
Values(-100);
-- This Insert violates the foreign key constraint for did in MovieDirector because -100 is not a valid id of any Director
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

INSERT INTO MovieActor(mid)
Values(-100);
-- This Insert violates the foreign key constraint for mid in MovieActor because -100 is not a valid id of any Movie
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

INSERT INTO MovieActor(aid)
Values(-100);
-- This Insert violates the foreign key constraint for aid in MovieActor because -100 is not a valid id of any Actor
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))

INSERT INTO MovieRating(mid, imdb)
Values(4732, 1000);
-- This violates the check constraint that imdb ratings must be between 0 and 100

INSERT INTO MovieRating(mid, rot)
Values(4732, 1000);
-- This violates the check constraint that rot ratings must be between 0 and 100

INSERT INTO Actor(dob, dod)
Values('1990-1-1', '1980-1-1')
-- This violates the check constraint that the dod for Actors must be after the dob