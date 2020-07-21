<h1>PHP开源商城</h1>
在线体验 http://demo.tanchengjin.com

功能
- [x] 支持多语言
- [x] 普通商品下单购买
- [ ] 优惠券
- [ ] 秒杀
- [ ] 团购

Dependence
- PHP >=7.4 or PHP >=7.3
- redis
- swoole
- mysql


Install 安装

Docker
````
cp .env.docker .env
````

创建数据表
```
docker exec -it shop-php php artisan migrate
```
生成基本数据
```
docker exec -it shop-php php artisan db:seed
```
生成测试数据
```
docker exec -it shop-php php artisan db:seed --class=TestSeeder
```


