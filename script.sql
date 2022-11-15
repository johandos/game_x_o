create table games
(
    id               bigint auto_increment comment 'Identificado unico'
        primary key,
    first_player_id  int  not null,
    second_player_id int  not null,
    positions        json not null
);

create table players
(
    id   bigint auto_increment comment 'Identificado unico'
        primary key,
    name varchar(45) not null
);


