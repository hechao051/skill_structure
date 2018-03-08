#连接主服务器
	redis-cli -h 60.205.176.185 -p 6379
	查看配置 CONFIG GET *
#连接从服务器
	
#主从
	开启主从后slave会推荐设置为只读(redis.conf 该选项可以设置slave-read-only yes)
	master 设置了 masterauth ， 则需要修改masterauth <master-password>
#配置主从
	slaveof ip 端口
#关闭主从 
	SLAVEOF NO ONE


#redis 集群
	http://www.redis.cn/topics/cluster-tutorial.html


