CREATE TABLE Movie(
    id INT,
    title VARCHAR(100),
    year INT,
    rating VARCHAR(10),
    company VARCHAR(50),
    PRIMARY KEY (id)
) ENGINE = INNODB;
-- id is a Primary Key Constraint for Movies
CREATE TABLE Actor(
    id INT,
    last VARCHAR(20),
    first VARCHAR(20),
    sex VARCHAR(6),
    dob DATE,
    dod DATE,
    PRIMARY KEY (id),
    CHECK (dod >= dob)
) ENGINE = INNODB;
-- id is a Primary Key Constraint for Actors and check that dod occurs after dob

CREATE TABLE Sales(
    mid INT,
    ticketsSold INT,
    totalIncome INT,
    FOREIGN KEY (mid) references Movie(id)
) ENGINE = INNODB;
-- mid is a Foreign Key Constraint for Sales related to Movie(id)

CREATE TABLE Director(
    id INT,
    last VARCHAR(20),
    first VARCHAR(20),
    dob DATE,
    dod DATE,
    PRIMARY KEY (id)
) ENGINE = INNODB;
-- id is a Primary Key Constraint for Directors
CREATE TABLE MovieGenre(
    mid INT,
    genre VARCHAR(20),
    FOREIGN KEY (mid) references Movie(id)
) ENGINE = INNODB;
-- mid is a Foreign Key Constraint for MovieGenre related to Movie(id)
CREATE TABLE MovieDirector(
    mid INT,
    did INT,
    FOREIGN KEY (mid) references Movie(id), 
    FOREIGN KEY (did) references Director(id) 
)ENGINE = INNODB;
-- mid is a Foreign Key related to Movie(id) and did is a Foreign Key related to Director(id)
CREATE TABLE MovieActor(
    mid INT,
    aid INT,
    role VARCHAR(50),
    FOREIGN KEY (mid) references Movie(id),
    FOREIGN KEY (aid) references Actor(id)
)ENGINE = INNODB;
-- mid is a Foreign Key related to Movie(id) and aid is a Foreign Key related to Actor(id)
CREATE TABLE MovieRating(
    mid INT,
    imdb INT,
    rot INT,
    FOREIGN KEY (mid) references Movie(id),
    CHECK (imdb >= 0 AND imdb <= 100),
    CHECK (rot >= 0 AND rot <= 100)
)ENGINE = INNODB;
-- check that imdb and rot ratings are in the correct range 
CREATE TABLE Review(
    name VARCHAR(20),
    time TIMESTAMP,
    mid INT,
    rating INT,
    comment VARCHAR(500),
    FOREIGN KEY (mid) references Movie(id)
)ENGINE = INNODB;
-- mid is a foreign key related to Movie(id)
CREATE TABLE MaxPersonID(
    id INT
)ENGINE = INNODB;

CREATE TABLE MaxMovieID(
    id INT
)ENGINE = INNODB;

