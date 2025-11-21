
USE GMS
CREATE TABLE USERLOGIN(
	Sl  int  ,
	userlog char(15) not NULL,
	userfull char(35) NULL,
	usersht char(5) NULL,
	passwd char(16) NULL,
	usersup char(3) NULL,
	userlevel varchar(3) NULL,
	Compcode  varchar(35),
	auddt datetime) 

insert into  USERLOGIN VALUES (1,'srini','srinivas','sri','srini','S','A',1)
create table deptmst (   deptcode int, Deptname varchar(50))
 insert into  deptmst VALUES (1,'ACCOUNTS')
   insert into  deptmst VALUES (2,'LOCATIONS')
    insert into  deptmst VALUES (3,'FILM SERVICE')
     insert into  deptmst VALUES (4,'MAYA')
      insert into  deptmst VALUES (5,'PURCHASE')
        insert into  deptmst VALUES (6,'IT')
      insert into  deptmst VALUES (7,'DLD')

create table compmst (   compcode int, companyname varchar(50))
   insert into  compmst VALUES (1,'USHAKIRON MOVIES PVT LTD')
   insert into  compmst VALUES (2,'DOLPHIN HOTELS PVT LTD')
    insert into  compmst VALUES (3,'EENADU-UEPL')
     insert into  compmst VALUES (4,'ETPL')
      insert into  compmst VALUES (5,'ETV BHARATH')
        insert into  compmst VALUES (6,'PRIYA DAIRY')
      insert into  compmst VALUES (7,'FOUDATION')
 create table reasons (rescode int ,reasonname varchar(100))
  insert into  reasons VALUES (1,'EVENT')
   insert into  reasons VALUES (2,'FILMS')
    insert into  reasons VALUES (3,'INTERVIEW')
     insert into  reasons VALUES (4,'LOCATION RECCI')
      insert into  reasons VALUES (5,'WEDDING')
        insert into  reasons VALUES (6,'VENDOR')
      insert into  reasons VALUES (7,'GENERAL VISITOR')
       insert into  reasons VALUES (8,'Delivery')
Create table RequestForm (
                      Reqno varchar (20),
                      deptcode int,
                      ReqDt datetime,
                      ReqForDt datetime,
                      Reqtime varchar(6),
                      Nos   int,
                      reason varchar(50),
                      guestname  varchar(100),
                      Reqsendername varchar(100),
                      ReqsenMobile varchar(12),
                      Reqsenmailid varchar(50),
                      Reqsenddt datetime,
                      resenddt datetime,
                      qrcode varchar(50),
                      usersht varchar(10),
                      compcode int,
                      auddt datetime )
                      
       create table Guestdetl(Gname varchar(50),idproof varchar(25),idno varchar(50),visitdt datetime,vechtype varchar(10),vechno varchar(15),auddt datetime )
       
       create table   GuestEntry(Gname varchar(50), Nos int,vechno varchar(15), reqno varchar(20),qrcode varchar(50) , usersht varchar(10),auddt datetime)    
                      
                      
                 
                      
     
