<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Корзина</title>
    <link rel="stylesheet" href="">
</head>
<body>

<h2>Товары в корзине</h2>
<?php if (empty($basket)): ?>
    <p>Корзина пуста!</p>
<?php else: ?>
    <table class="table">
        <?php foreach ($basket as $item): ?>
            <tr>
                <td>
                    <?= $item['product']['title'] ?>
                </td>
                <td>
                    <?= $item['qty'] ?>
                </td>
                <td>
                    <>Удалить</>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>