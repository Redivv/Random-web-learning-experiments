drop DATABASE gamebook_test;
create DATABASE gamebook_test;

CREATE TABLE gamebook_test.game(
    id int(10) unsigned auto_increment,
    title varchar(50),
    image_path varchar(255),
    primary key (id)
);

CREATE TABLE gamebook_test.user(
    id INT(10) unsigned auto_increment,
    username VARCHAR(50),
    primary key (id)
);

CREATE TABLE gamebook_test.rating(
    user_id int(10) unsigned,
    game_id int(10) unsigned,
    score TINYINT(1),
    PRIMARY KEY (user_id, game_id)
);

INSERT INTO gamebook_test.user VALUES(1,'anna');
INSERT INTO gamebook_test.game VALUES(1,'Game 5','');
INSERT INTO gamebook_test.rating VALUES(1,1,5);

