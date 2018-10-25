
<?php
    $this->title = 'Third Party Invoices';
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="thirdpartyinvoices-view">
<h1><?= \yii\helpers\Html::a($this->title, ['third-party-invoices']); ?></h1>


<div id="w0" class="grid-view">
    <div class="summary">Showing <b><?= count($invoices); ?></b> of <b><?= count($invoices); ?></b> items.</div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Party Name</th>
                <th>Amount</th>
                <th>Invoice No.</th>
                <th>Created At</th>            
        </thead>
        
        <tbody>
            <?php foreach ($invoices as $key => $invoice) { ?>
                <tr>
                    <td><?= $key+1; ?></td>
                    <td><?= ucwords($invoice->created_by); ?></td>
                    <td><?= $invoice->amount; ?></td>
                    <td><?= $invoice->oid; ?></td>
                    <td><?= $invoice->created_at; ?></td>
            <?php } ?>    
            
        </tbody>
        <?php if(count($invoices) == 0){?>
        <tbody>
            <tr><td colspan="7"><div class="empty">No results found.</div></td></tr>
        </tbody>
        <?php }?>
    </table>
</div>
</div>