<h2>Каталог</h2>

<?php foreach ($catalog as $item):?>
        <div>
            <form action="/basket/add/" method="post">
                <input type="text" name="id" value="<?=$item['id']?>" hidden>
                <h3><a href="/product/card/?id=<?=$item['id']?>"><?=$item['name']?></a></h3>
                <p>price: <?=$item['price']?></p>
                <button type="submit">Купить</button>
            </form>
        </div>
<?endforeach;?>

<a href="/product/catalog/?page=<?=$page?>">Еще</a>