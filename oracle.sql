create table u_admin
(
user_id number(32) not null primary key,
user_name varchar(64) not null,
user_email varchar(128) not null,
user_password varchar(128) not null,
user_gender varchar(3) not null,
create_time date default SYSDATE
);

insert into u_admin(user_id,user_name,user_email,user_gender) values('admin','admin@qq.com','admin','男');
insert into u_admin values(seq_u_admin.nextval,'admin','admin@qq.com','admin','男',SYSDATE);

create table notice
(
notice_id number(32) not null primary key,
title varchar(128) not null,
text varchar(255) not null,
create_time date default SYSDATE
);
insert into notice values(seq_notice.nextval,'2018go','no pains,no gains',SYSDATE);


create table u_notebook
(
notebook_id number(16) not null primary key,
n_title varchar(255) not null,
n_text varchar(255) not null,
create_time date default SYSDATE
);

insert into u_notebook values(seq_u_notebook.nextval,'love','happy,optimistic,passion',SYSDATE);

update u_admin set user_email='123@qq.com' where user_id=75;