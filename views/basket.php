<h2>Корзина</h2>

<?php if (!empty($basket)):?>
        <?php foreach ($basket as $item):?>
                <div>
                    <h3><a href="/product/card/?id=<?=$item['id']?>"><?=$item['name']?></a></h3>
                    <p>price: <?=$item['price']?></p>
                    <button>Удалить</button>
                </div>
        <?endforeach;?>
    <?php else: ?>
    Корзина пуста
<?php endif; ?>