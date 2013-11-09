<div class="well well-small">
	<h3><?=$page_title;?><span class="pull-right"><small style="font-size: 10px;"><strong>Important</strong> : Cookies must be enabled to your browser</small></span></h3>
    
    <?php if ($orders): ?>
	<table class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th>Image</th>
                <th>Item</th>
                <th><center>Item Price</center></th>
                <th><center>Quantity</center></th>
                <th><center>Total</center></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $item): ?>
            <tr>
                <td><img src="<?=$imgpath.$item['image'];?>" style="max-width: 64px;" /></td>
                <td><?=$item['name'];?>&nbsp;&nbsp;<small><a data-item-id="<?=$item['rowid'];?>" class="remove-item btn-link" role="button" data-toggle="tooltip" data-original-title="remove" data-placement="top" onmouseover="$(this).tooltip('show')"><i class="icon-remove"></i></a></small></td>
                <td><center>$ <?=$item['price'];?></center></td>
                <td>
                    <center>
                        <div class="input-append" id="update-qty-<?=$item['rowid']?>">
                            <input type="number" name="qty[]" value="<?=$item['qty'];?>" class="item-qty input-mini item-qty text-center" />
                            <button id="<?=$item['rowid']?>" class="btn update-qty" role="button"><i class="icon-refresh"></i></button>
                        </div>
                    </center>
                </td>
                <td><center>$ <?=$item['subtotal'];?></center></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><h4>Total</h4></td>
                <td><center><h4><?=$this->cart->total_items();?></h4></center></td>
                <td><center><h4>$ <?=$this->cart->total();?></h4></center></td>
            </tr>
        </tfoot>
    </table>
    <div class="clearfix">
        <div class="pull-left">
            <form method="post"><button type="submit" class="btn" name="remove_cart_items">Remove all items</button></form>
        </div>

        <div class="pull-right">
            <a href="javascript:alert('Paypal Payment')" class="btn btn-warning">Checkout via Paypal</a>
            <a href="<?=site_url('cart/checkout')?>" class="btn btn-info">Checkout</a>
        </div>
    </div>
    <?php else: ?>
    	0 items in your Cart
    <?php endif; ?>
</div>
