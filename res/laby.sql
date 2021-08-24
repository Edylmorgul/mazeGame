-- x,y,z : coordonnées (z=etage)

CREATE TABLE players (
        pid		SERIAL PRIMARY KEY,
        login		VARCHAR(32) NOT NULL,
        passwd		VARCHAR(128),
        email		VARCHAR(128),
        x		INTEGER,
        y		INTEGER,
        z		INTEGER);

-- association étage (z)/theme (BLUE, GREEN, BRICK, ...)

CREATE TABLE maps (
        mapid		SERIAL PRIMARY KEY,
        z		INTEGER,
        theme		VARCHAR(8));
 
-- message rédigé (type : chuchoter, dire, crier, ...)

CREATE TABLE msg (
        mid		SERIAL PRIMARY  KEY,
        msgfrom		INTEGER REFERENCES players(pid) ON DELETE CASCADE ON UPDATE CASCADE,
        msgtext		VARCHAR(256),
        ts		INTEGER,
        msgtype		INTEGER);

-- destinataires d'un message

CREATE TABLE msgto (
        mid		INTEGER REFERENCES msg(mid) ON DELETE CASCADE ON UPDATE CASCADE,
        msgto		INTEGER REFERENCES players(pid) ON DELETE CASCADE ON UPDATE CASCADE);

