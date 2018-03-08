
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

