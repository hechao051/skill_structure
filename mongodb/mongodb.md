MongoDB简介:
    MongoDB（来自于英文单词“Humongous”，中文含义为“庞大”）是可以应用于各种规模的企业、各个行业以及各类应用程序的开源数据库
    https://www.mongodb.com/cn
    #mongo php api
    http://php.net/manual/zh/set.mongodb.php
#ＭongoDB 文档
切换或者创建数据库
    use DATABASE_NAME
    如果数据库不存在，则创建数据库，否则切换到指定数据库

删除当前数据库
    db.dropDatabase()
    删除当前数据库，默认为 test，你可以使用 db 命令查看当前数据库名。

show tables

#插入文档
    db.test.insert({title: 'MongoDB 教程', 
        description: 'MongoDB 是一个 Nosql 数据库',
        by: '菜鸟教程',
        url: 'http://www.runoob.com',
        tags: ['mongodb', 'database', 'NoSQL'],
        likes: 100
    })

    eg: 创建test 文档
    db.test.insert({title:'test',url:'http://www.runoob.com',describe:'describe describe'});

    以上实例中 test 是我们的集合名，如果该集合不在该数据库中， MongoDB 会自动创建该集合并插入文档

#查找文档
db.test.find()

也可以定义一个变量:
document=({title: 'MongoDB 教程', 
    description: 'MongoDB 是一个 Nosql 数据库',
    by: '菜鸟教程',
    url: 'http://www.runoob.com',
    tags: ['mongodb', 'database', 'NoSQL'],
    likes: 100
});

#更新文档
    db.test.update({'title':'MongoDB 教程'},{$set:{'title':'MongoDB'}})
    只更新第一条记录：
    db.test.update( { "count" : { $gt : 1 } } , { $set : { "test2" : "OK"} } );
    全部更新：
    db.test.update( { "count" : { $gt : 3 } } , { $set : { "test2" : "OK"} },false,true );
    只添加第一条：
    db.test.update( { "count" : { $gt : 4 } } , { $set : { "test5" : "OK"} },true,false );
    全部添加加进去:
    db.test.update( { "count" : { $gt : 5 } } , { $set : { "test5" : "OK"} },true,true );
    全部更新：
    db.test.update( { "count" : { $gt : 15 } } , { $inc : { "count" : 1} },false,true );
    只更新第一条记录：
    db.test.update( { "count" : { $gt : 10 } } , { $inc : { "count" : 1} },false,false );

#删除文档
    db.test.remove({'_id': ObjectId("5a7295e4e5f19fb511d3d338")})
    删除第一条找到的记录
    db.test.remove(DELETION_CRITERIA,1)

#条件比较语句
    (>) 大于 - $gt
    (<) 小于 - $lt
    (>=) 大于等于 - $gte
    (<= ) 小于等于 - $lte

    等于
        {<key>:<value>}
        db.test.find({"by":"菜鸟教程"}).pretty()
        where by = '菜鸟教程'
    小于
        {<key>:{$lt:<value>}}
        db.test.find({"likes":{$lt:50}}).pretty()
        where likes < 50
    小于或等于
        {<key>:{$lte:<value>}}
        db.test.find({"likes":{$lte:50}}).pretty()
        where likes <= 50
    大于
        {<key>:{$gt:<value>}}
        db.test.find({"likes":{$gt:50}}).pretty()
        where likes > 50
    大于或等于
        {<key>:{$gte:<value>}}
        db.test.find({"likes":{$gte:50}}).pretty()
        where likes >= 50
    不等于
        {<key>:{$ne:<value>}}
        db.test.find({"likes":{$ne:50}}).pretty()
        where likes != 50

#MongoDB AND 条件
    db.test.find({key1:value1, key2:value2}).pretty()

#MongoDB OR 条件
    需要total 和　or 中条件中的一个都成立才能查出来！
    db.test.find(
       {
           total: {$gt: 10},
          $or: [
             {title: 'test 41'}, {'_id':ObjectId("5a72ad45e5f19fb511d3d33d")}
          ]
       }
    ).pretty()

#模糊查询
db.student.find({name:{$regex:/joe/}})

#MongoDB 操作符 $type
    Double  1, String  2, Object  3, Array   4, Binary data 5, Object id   7
    Boolean 8, Date    9, Null    10, Regular Expression  11, JavaScript  13, Symbol  14, JavaScript (with scope) 15, 32-bit integer  16, Timestamp   17, 64-bit integer  18, Min key 255, Max key 127
    eg:
    获取 "col" 集合中 title 为 String 的数据：
    db.col.find({"title" : {$type : 2}})

#分页
    第一个参数是查询条件，第二个参数是指定返回行
    db.test.find({},{"title":'',_id:'', describe: ''}).limit(2).skip(2)

#排序
    根据id 排序(其中 1 为升序排列，而-1是用于降序排列)
    db.test.find({},{"title":'',_id:'', describe: ''}).sort({'_id':1})

#索引
    参考: http://www.runoob.com/mongodb/mongodb-indexing.html
    ensureIndex({KEY:1}) 方法(其中 1 为升序排列，而-1是用于降序排列)
    db.test.ensureIndex({"title":1,"description":-1}) // 复合索引

#MongoDB 聚合　
    http://www.runoob.com/mongodb/mongodb-aggregate.html

#复制　备份主从
    http://www.runoob.com/mongodb/mongodb-replication.html

#分片
    http://www.runoob.com/mongodb/mongodb-sharding.html

#备份恢复
    参考: http://www.runoob.com/mongodb/mongodb-mongodump-mongorestore.html
    mongodump命令来备份MongoDB数据
    备份
    mongodump -h dbhost -d dbname -o dbdirectory
    恢复
    mongodb使用 mongorestore 命令来恢复备份的数据
        mongorestore -h <hostname><:port> -d dbname <path>

###lunix unlimit 设置
    安装教程: https://docs.mongodb.com/manual/tutorial/install-mongodb-on-ubuntu/

    安装mongo

    sudo service mongod stop
    sudo service mongod restart

    mongo --version

Specify the Recommended ulimit Settings, as in the following example:

    limit fsize unlimited unlimited  # (file size)
    limit cpu unlimited unlimited    # (cpu time)
    limit as unlimited unlimited     # (virtual memory size)
    limit nofile 64000 64000         # (open files)
    limit nproc 64000 64000          # (processes/threads)

    to restart server ...


###卸载mongo
    sudo apt-get purge mongodb-org*
    sudo rm -r /var/log/mongodb
    sudo rm -r /var/lib/mongodb


##mongo 用户角色权限
    https://www.jianshu.com/p/79caa1cc49a5

    mongo --host 127.0.0.1 --port 27017
    mongo -host 127.0.0.1 --port 27017

    获取用户
    db.getUsers({})

    db.createUser(
      {
        user: "root",
        pwd: "root",
        roles: [ { role: "userAdminAnyDatabase", db: "test" } ]
      }
    )



导数据
mongoimport --db test --collection zips --file zips.json --drop
mongoimport --db test --collection restaurants --file primer-dataset.json --drop
