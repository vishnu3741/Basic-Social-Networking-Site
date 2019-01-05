create table messages ( time serial, sender_id integer not null references accounts(id), receiver_id integer not null references accounts(id), message varchar(300));
