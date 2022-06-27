<h2>Корзина</h2>

<?php if (!empty($basket)):?>
        <?php foreach ($basket as $item):?>
                <div id="<?= $item['basket_id'] ?>">
                    <h3><a href="/product/card/?id=<?=$item['id']?>"><?=$item['name']?></a></h3>
                    <p>price: <?=$item['price']?></p>

                    <button data-id="<?= $item['basket_id']?>" class="delete">Удалить</button>
                </div>
        <?endforeach;?>
    <?php else: ?>
    Корзина пуста
<?php endif; ?>


<script>
    let buttons = document.querySelectorAll('.delete');
    buttons.forEach((e) => {
        e.addEventListener('click', () => {
            let id = e.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/basket/delete/?id=' + id)
                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;
                    document.getElementById(id).remove();
                }
            )()
        })
    })
</script>