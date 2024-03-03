CREATE TABLE registration(Id int primary key auto_increment, RegID char(15) UNIQUE, name text not null, gender text not null, 
dob text not null, address text not null, mobile text not null, mobileKey char(250) UNIQUE, email text not null,
emailKey char(250) UNIQUE, school text not null, schoolAddres text not null, schoolRep text not null, schoolContact text 
not null, sid text, gid text, status int default 1, create_at timestamp default CURRENT_TIMESTAMP, update_at timestamp null 
on update CURRENT_TIMESTAMP);
ALTER TABLE registration ADD COLUMN infoKey char(250) unique null;
ALTER TABLE registration ADD COLUMN Story longtext null;
ALTER TABLE registration ADD COLUMN Ingredients char(250) null;
ALTER TABLE registration ADD COLUMN Link char(250) null;
ALTER TABLE registration ADD COLUMN LinkKey char(250) unique null;
ALTER TABLE registration ADD COLUMN approverID int null;
ALTER TABLE registration ADD COLUMN SchoolEmail text not null;
ALTER TABLE registration ADD COLUMN nameKey char(250) null;