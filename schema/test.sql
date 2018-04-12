INSERT INTO users (name, email, password) VALUES
    ('ほげ', 'hoge@example.com', 'd74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1');

INSERT INTO events (user_id, name, password, publish_start_at, publish_end_at) VALUES
    (1, 'ふが入園式', 'd74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1', '2018-04-10 00:00:00', '2018-05-10 00:00:00');

INSERT INTO photos (event_id) VALUES
    (1);
