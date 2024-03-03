CREATE TABLE registration_stg(Id int primary key auto_increment, name text not null, gender text not null, dob text not null,
 address text not null, mobile text not null, email text not null, school text not null, schoolAddres text not null, 
 schoolRep text not null, schoolContact text not null, reference char(15), sid text, gid text, status int 
 default 2, create_at timestamp default CURRENT_TIMESTAMP, update_at timestamp null on update CURRENT_TIMESTAMP);
ALTER TABLE registration_stg ADD COLUMN infoKey char(250) null;
ALTER TABLE registration_stg ADD COLUMN Story longtext null;
ALTER TABLE registration_stg ADD COLUMN Ingredients char(250) null;
ALTER TABLE registration_stg ADD COLUMN Link char(250) null;
ALTER TABLE registration_stg ADD COLUMN rejectReason char(250) null;
ALTER TABLE registration_stg ADD COLUMN approverID int null;
ALTER TABLE registration_stg ADD COLUMN SchoolEmail text not null;
ALTER TABLE registration_stg ADD COLUMN housekeep bool default 0;
ALTER TABLE registration_stg ADD COLUMN nameKey char(250) null;