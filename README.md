## Задание №1
1. Добавить новый продукт «Rust» с возможностью положить его в корзину
2. Добавить в проекте нового пользователя student
3. Добавить страницу с описанием всех товаров

## Задание №2
1. Для файлов из папки src, составить полную диаграмму классов
2. Выделить три процесса, происходящих в системе. Изобразите для них диаграммы последовательностей

Диаграммы находятся в файле `Diagrams.md` и в папке `_resources`

## Задание №3
1. Какие принципы нарушены в проекте? Укажите конкретные файлы и объясните почему.

- Нарушается принцип Principle Of Least Astonishment в https://github.com/fiaso/mai-pattern/blob/master/src/Service/Product/Product.php#L9, https://github.com/fiaso/mai-pattern/blob/master/src/Model/Entity/Product.php#L7, https://github.com/fiaso/mai-pattern/blob/master/src/Model/Repository/Product.php - несколько классов называется одинаково, вызывается друг из друга и имеют похожие названия методов (getAll, fetchAll). Это вызывает путаницу.

- Нарушается принцип YAGNI в https://github.com/fiaso/mai-pattern/blob/master/src/Model/Entity/Product.php#L78 - эта функция не используется нигде в проекте.

- Нарушается принцип DRY в https://github.com/fiaso/mai-pattern/blob/master/src/Model/Repository/Product.php#L25 и https://github.com/fiaso/mai-pattern/blob/master/src/Model/Repository/Product.php#L40 - строки абсолютно совпадают, их можно вынести в отдельную функцию, как сделано в Model/Repository/User createUser().

2. Где в проекте уместно избавиться от магических чисел и нарушен «Закон Деметры»? Напишите почему.

- Magic numbers:
https://github.com/fiaso/mai-pattern/blob/master/src/View/product/list.html.php#L27 - тут можно заменить 3 на константу/переменную product_list_width.


3. Добавьте страницу со списком всех пользователей. Она видна только авторизованным пользователям с ролью admin.

## Задание №4
1. Создайте страницу личного кабинета пользователя
2. На созданной странице добавить информацию:
* Дата рождения
* Сумму последнего оплаченного заказа
3. Используя SOLID принципы, добавьте каждому пользователю следующие виды скидок:
* На заказ более 40000 скидка 10%
* За 5 дней до и после дня рождения скидка 5%
* На заказ курса по Delphi скидка 8%
