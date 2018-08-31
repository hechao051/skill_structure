
db.getCollection('runoob').find({})

日期时间查询
// 第一种
db.runoob.update(
　　{"name":"refactor"},
　　{
　　　　"$set":
　　　　{
　　　　　　"birthday":new Date("1989/10/26")
　　　　}
　　},
        true
)

db.runoob.find({"birthday":{"$gt":new Date("2018/10/01")}})

// 第二种
db.runoob.update(
　　{"name":"refactor"},
　　{
　　　　"$set":
　　　　{
　　　　　　"birthday":new Date("2018-10-26")
　　　　}
　　},
        true
)

db.runoob.find({"birthday":{"$gt":new Date("2018/10/01")}})




###聚合查询
操作符介绍：
	$project：包含、排除、重命名和显示字段
	$match：查询，需要同find()一样的参数
	$limit：限制结果数量
	$skip：忽略结果的数量
	$sort：按照给定的字段排序结果
	$group：按照给定表达式组合结果
	$unwind：分割嵌入数组到自己顶层文件

###mongodb 教程
https://docs.mongodb.com/manual/reference/operator/update-field/

###参考文档
https://blog.csdn.net/congcong68/article/details/51619882

###聚合
https://docs.mongodb.com/manual/reference/command/nav-aggregation/
https://docs.mongodb.com/manual/reference/aggregation-commands-comparison/

###中文教程
http://www.mongodb.org.cn/manual/aggregation/


###测试上的mongodb
/usr/local/bin/mongod -> /usr/local/src/mongodb-3.4.4/bin/mongod*


