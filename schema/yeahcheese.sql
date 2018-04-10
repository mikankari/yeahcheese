
create table users (
    id      serial  primary key,
    name    text    not null,
    mail    text    not null    unique,
    hash    text    not null
);

create table events (
    id              serial      primary key,
    user_id         int         not null,
    name            text        not null,
    hash            text        not null    unique,
    publish_at      timestamp    not null,
    publish_end_at  timestamp    not null
);

create table photos (
    id          serial  primary key,
    event_id    int     not null
);
