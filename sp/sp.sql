drop procedure if exists test;
delimiter //
create procedure test()
begin
    select "This is my first stored procedure!!" as "Title";

end//

drop procedure if exists test1;
delimiter $
create procedure test1()
begin
    declare age int default 10;
    
    set age=age+10;

    select concat("您的年齡:",age);

end$



drop procedure if exists test2;
delimiter $
create procedure test2()
begin
    declare vname varchar(20) default "";
    declare vjob varchar(20) default "";
    
    SELECT empname,jobtitle into vname,vjob from employee where empid='00001';

    select concat(vname, "是一位", vjob);

end$

drop procedure if exists test3;
delimiter $
create procedure test3()
begin
    declare age int default 15;
    declare words varchar(20) default "";
    
    if age <=11 then
        set words="小屁孩";
    elseif age >=12 and age <=17 then  
        set words="青少年";
    elseif age >=18 and age <=29 then  
        set words="青年";
    else
        set words="老頭";
    end if;    

    select concat(age, "是", words);

end$

drop procedure if exists test4;
delimiter $
create procedure test4(in age int)
begin
    
    declare words varchar(20) default "";
    
    if age <=11 then
        set words="小屁孩";
    elseif age >=12 and age <=17 then  
        set words="青少年";
    elseif age >=18 and age <=29 then  
        set words="青年";
    else
        set words="老頭";
    end if;    

    select concat(age, " 是 ", words);

end$



drop procedure if exists test5;
delimiter $
create procedure test5(in age int,out words varchar(20))
begin    
        
    if age <=11 then
        set words="小屁孩";
    elseif age >=12 and age <=17 then  
        set words="青少年";
    elseif age >=18 and age <=29 then  
        set words="青年";
    else
        set words="老頭";
    end if;        

end$


drop procedure if exists test6;
delimiter $
create procedure test6(in age int,out words varchar(20))
begin    
        
    case    
    when age <=11 then
        set words="小屁孩";
    when age >=12 and age <=17 then  
        set words="青少年";
    when age >=18 and age <=29 then  
        set words="青年";
    else
        set words="老頭";
    end case;        

end$


drop procedure if exists test7;
delimiter $
create procedure test7(in n int)
begin    

  declare num int default 0;      
repeat
    set num=num+n;
    set n=n-1;

until n=0 
end repeat;

select num;

end$




drop procedure if exists post_inventory;
delimiter $
create procedure post_inventory()
begin    

    declare tmp_orderid varchar(10) default "";
    declare tmp_prodid varchar(10) default "";
    declare tmp_qty int default 0;
    declare done int default 0;
    declare t_error int default 0;

declare cur cursor for 
    SELECT orderid,ProdId,qty FROM orderdetail  where post=0 order by orderid;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;    
declare continue handler for sqlexception set t_error = 1;

open cur;

repeat
fetch cur into tmp_orderid,tmp_prodid,tmp_qty;
    
    start transaction;

    update inv set stock=stock-tmp_qty where prodid=tmp_prodid;
    update orderdetail set post=1 where orderid=tmp_orderid and prodid=tmp_prodid;
    if t_error=1 then 
        rollback;
        select "Rolling Back!!" as status;
    else
        commit; 
    end if; 
until done=1
end repeat;

close cur;
end$


drop trigger if exists check_emp_ins;

DELIMITER $$
CREATE TRIGGER check_emp_ins
BEFORE INSERT
ON mmisdb.employee FOR EACH ROW
BEGIN

    declare dd int default 0;
    declare hh int default 0;

    set dd=dayofweek(now());
    set hh=hour(now());

    if dd <=1 or dd >=7 or hh <8 or hh > 18 then
           signal sqlstate '45000' set message_text = "非上班時間";
    end if;

END $$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER tr_name
AFTER UPDATE
ON mmisdb.product FOR EACH ROW
BEGIN
	
    insert into product_log (NewPrice,OldPrice,NewCost,OldCost)
          values (NEW.unitprice,OLD.unitprice,NEW.cost,OLD.cost);

END $$
DELIMITER ;

