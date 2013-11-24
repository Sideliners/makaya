<div class="well well-small">
    <?php if(!isset($response)): ?>
    <h2 class="alert alert-success"><?=$page;?></h2>
    <?php else: ?>
    <?=$response;?>
    <?php endif; ?>

    <div>
        <div><h4>Summary of Transaction</h4></div>
        <div>
            <table class="table table-bordered table-condensed trans-history" style="background-color: #FFF !important;">
                <thead>
                    <tr>
                        <th><center>Item</center></th>
                        <th><center>Quantity</center></th>
                        <th><center>Item Price</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $item): ?>
                    <tr>
                        <td><?=$item->product_name;?></td>
                        <td><?=$item->item_qty;?></td>
                        <td><?=$item->price;?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><h4>Total</h4></td>
                        <td><center><h5><?=$item->total_price;?></h5></center></td>
                    </tr>
                </tfoot>
            </table>
        </div> <!-- table -->
    </div>
</div>
