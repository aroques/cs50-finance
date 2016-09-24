<table class="table table-striped">
    <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
    <?php $cash = 0;?>
    <?php foreach ($positions as $stock): ?>
        <?php    
            // Get total value of shares of current stock
            $total = $stock["shares"] * $stock["price"];
            $total = number_format($total, 2, '.', ',');
        ?>
        <tr>
            <td><?= $stock["symbol"] ?></td>
            <td><?= $stock["name"] ?></td>
            <td><?= $stock["shares"] ?></td>
            <td><?= "$" . $stock["price"] ?></td>
            <td><?= "$" . $total ?></td>
        </tr>
    <?php endforeach ?>
    <tr>
        <?php $cash_array = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]); ?>
        <?php $cash = $cash_array[0]["cash"] ?>
        <?php $cash = number_format($cash, 2, '.', ','); ?>
        <td colspan="4">CASH</td><td><?= "$" . $cash ?></td>
    </tr>
    </tbody>
</table>
