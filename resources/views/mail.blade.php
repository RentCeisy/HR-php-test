<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<p>Номер заказа: {{$order_id}}</p>
<p>Стоимость: {{$cost}}</p>
<p>Состав заказа</p>
<ul>
    @foreach($products as $product)
        <li>{{$product->name}}</li>
    @endforeach
</ul>
</body>
</html>