-- auto-generated definition
create table matches
(
    id         int auto_increment
        primary key,
    host_id    int                                 null,
    host_goal  int       default 0                 null,
    away_id    int                                 null,
    away_goal  int       default 0                 null,
    week       int                                 null,
    status     int(2)    default 0                 null,
    updated_at timestamp default CURRENT_TIMESTAMP null
);


-- auto-generated definition
create table teams
(
    id              int auto_increment
        primary key,
    name            varchar(255)                        null,
    pts_point       int       default 0                 null,
    matches         int       default 0                 null,
    wins            int       default 0                 null,
    losses          int       default 0                 null,
    draws           int       default 0                 null,
    goal_difference int       default 0                 null,
    updated_at      timestamp default CURRENT_TIMESTAMP null
);

