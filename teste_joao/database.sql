CREATE TABLE clans(
    clan_id INT NOT NULL AUTO_INCREMENT,
    clan_name VARCHAR(100) NOT NULL,
    CONSTRAINT PKCLAN PRIMARY KEY (clan_id)
);

CREATE TABLE users(
    user_id INT NOT NULL AUTO_INCREMENT,
    clan_id INT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(200) NOT NULL,
    CONSTRAINT PKUSER PRIMARY KEY (user_id),
    CONSTRAINT FKUSERCLAN FOREIGN KEY (clan_id) REFERENCES clans(clan_id)
);

CREATE TABLE historic(
    match_id SERIAL,
    user_id INT NOT NULL,
    points INT NOT NULL,
    date_match TIMESTAMP NOT NULL,
    CONSTRAINT PKHISTORIC PRIMARY KEY(match_id),
    CONSTRAINT FKHISTORICUSER FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE clan_historic(
    match_id SERIAL,
    user_id INT NOT NULL,
    points INT NOT NULL,
    date_match TIMESTAMP NOT NULL,
    CONSTRAINT PKCLANHISTORIC PRIMARY KEY(match_id),
    CONSTRAINT FKCLANHISTORICUSER FOREIGN KEY (user_id) REFERENCES users(user_id)
); 