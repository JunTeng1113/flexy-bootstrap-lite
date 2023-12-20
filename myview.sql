create view v_salesorder
as
SELECT salesorder.orderid,empname,custname,orderdate,descript,sum(unitprice*qty*discount)
FROM salesorder,employee,customer,orderdetail,product
where salesorder.empid=employee.EmpId
and salesorder.CustId=customer.CustId
and salesorder.OrderId=orderdetail.OrderId
and orderdetail.ProdId=product.ProdID
group by salesorder.OrderId;