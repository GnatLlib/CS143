-- This query selects the names of all the actors in the movie Die Another Day 
SELECT CONCAT(last,' ', first) FROM (Actor INNER JOIN(SELECT aid from (Movie INNER JOIN MovieActor on id = mid) WHERE Movie.title = 'Die Another Day')aids ON Actor.id = aids.aid);

-- This query gives the count of all the actors who appear in multiple movies
SELECT count(*) FROM (SELECT aid from MovieActor GROUP BY aid having COUNT(*) > 1)ids;

-- This query gives the title of movies that sell more than 1,000,000 tickets
SELECT title from (Movie inner join Sales on id = mid ) where ticketsSold > 1000000; 

-- This query gives the ticket sales of movies with a IMDB Rating lower than 10;
SELECT ticketsSold from (Sales inner join (SELECT * from (Movie inner join MovieRating on id = mid) where imdb < 11)Movies on Sales.mid = Movies.id);

-- This query gives the number of Actors that are dead;
SELECT count(*) FROM Actor where dod IS NOT NULL;