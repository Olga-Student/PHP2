<div class="row row-cols-1 row-cols-md-3">

    <?php foreach ($products as $product): ?>
        <div class="card mb-3" style="width: 18rem;">
            <div class="card-body">

                <!-- <a href="#">
                     <img src="/img//$product['link']?>" height="110" width="125"></a>-->
                <h5 class="card-title" style="text-align: center"><?= $product->title ?></h5>
                <p class="card-text" ><?= $product->description ?></p>
                <p class="card-text" style="text-align: center"><?= $product->price ?></p>


            </div>
            <div class="card-footer">
                <a href="/product/card/?id=<?= $product->id;?>" class="btn btn-primary">Посмотреть</a>

            </div>
        </div>
    <?php endforeach; ?>
</div>
