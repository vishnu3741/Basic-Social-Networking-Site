create table accounts (
    id serial PRIMARY KEY,
    email varchar(255) not null,
    name varchar(255) not null,
    password varchar(255),
    unique(email,name)
);

CREATE TABLE following (
    followed_by INTEGER not null REFERENCES accounts(id),
    follower_of INTEGER not null REFERENCES accounts(id)
);

CREATE TABLE feed_messages (
    sender_id INTEGER REFERENCES accounts(id),
    post text,
    tags varchar(255) ARRAY[10],
    time_stamp timestamp not null default now()
);

CREATE TABLE personal_messages (
    sender_id INTEGER REFERENCES accounts(id),
    receiver_id INTEGER REFERENCES accounts(id),
    sent_msg text,
    time_stamp timestamp not null default now()
);