<h2>Каталог</h2>

<?php foreach ($catalog as $item): ?>
    <div>

            <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
            <h3><a href="/product/card/?id=<?= $item['id'] ?>"><?= $item['name'] ?></a></h3>
            <p>price: <?= $item['price'] ?></p>
            <button data-id="<?= $item['id'] ?>" class="buy">Купить</button>

    </div>
<?php endforeach; ?>

<a href="/product/catalog/?page=<?= $page ?>">Еще</a>

<script>
    let buttons = document.querySelectorAll('.buy');
    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/basket/add/?id=' + id);
                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;
                }
            )();
        });
    });
</script>