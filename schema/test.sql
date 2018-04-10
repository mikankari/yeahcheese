insert into users (name, mail, hash) values
    ('ほげ', 'hoge@example.com', '9f56e761d79bfdb34304a012586cb04d16b435ef6130091a97702e559260a2f2');

insert into events (user_id, name, hash, publish_at, publish_end_at) values
    (1, 'ふが入園式', '9f56e761d79bfdb34304a012586cb04d16b435ef6130091a97702e559260a2f2', '2018-04-10 00:00:00', '2018-05-10 00:00:00');

insert into photos (event_id) values
    (1);
