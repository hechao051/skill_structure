### 索引
- 分析查询:通过这个查询可以分析查询语句的索引使用情况

```
explain select * from xxx where id = xxx
```

### 索引建立
- 建议一般情况下不要在字符串列建立索引，如果非要使用字符串索引，可以采用以下两种方法：

```
1.只是用字符串的最左边n个字符建立索引，推荐n<=10;比如index left(address,8),但是需要知道前缀索引不能在order by中使用，也不能用在索引覆盖上。
2.对字符串使用hash方法将字符串转化为整数，address_key=hashToInt(address)，对address_key建立索引，查询时可以用如下查询where address_key = hashToInt(‘beijing,china’) and address = ‘beijing,china’;
```

