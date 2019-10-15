use often;

-- table holding all entries
create table entry (
    ID int auto_increment,
    date date,
    start time,
    end time,
    break time,
    exp time,
    note text,

    primary key (ID)
)