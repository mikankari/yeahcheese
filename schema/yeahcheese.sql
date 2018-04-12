
CREATE TABLE users (
        id          SERIAL  PRIMARY KEY
    ,   name        TEXT    NOT NULL
    ,   email       TEXT    NOT NULL    UNIQUE
    ,   password    TEXT    NOT NULL
);

CREATE TABLE events (
        id                  SERIAL      PRIMARY KEY
    ,   user_id             INT         NOT NULL
    ,   name                TEXT        NOT NULL
    ,   password            TEXT        NOT NULL    UNIQUE
    ,   publish_start_at    TIMESTAMP   NOT NULL
    ,   publish_end_at      TIMESTAMP   NOT NULL
);

CREATE TABLE photos (
        id          SERIAL  PRIMARY KEY
    ,   event_id    INT     NOT NULL
);
