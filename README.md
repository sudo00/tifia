# tifia
Задания

1) Проанализировать базу данных, указать узкие места.

Не было индексов. Добавил:
Индекс поля login таблицы accounts
Индекс поля login таблицы trades

2) Построить дерево рефералов на основе поля partner_id таблицы Users
Построил по ссылке http://localhost:8080/v1/tree/view
![alt text](https://raw.githubusercontent.com/sudo00/tifia/master/Screenshot_7.png)

3) Написать скрипт, способный обсчитать реферальную сетку партнера по следующим критериям:
http://localhost:8080/v1/info/client-info?client_uid=78820214&close_time=2019-02-05
![alt text](https://raw.githubusercontent.com/sudo00/tifia/master/Screenshot_6.png)
