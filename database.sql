create table users
(
    id        int auto_increment
        primary key,
    full_name varchar(255) not null,
    email     varchar(255) not null,
    password  varchar(255) not null
);

