<style>
    body {
        width: 210mm;
        /* height: 297mm;         */
    }

    table {
        width: 100%;
        /* border: 1px solid black; */
        border-collapse: collapse;
        /* border-top: 0px; */
    }

    th,tr,td {
        width: 100%;
        /* border: 1px solid black; */
        vertical-align: baseline;
    }

    tr {
        border: 1px solid black;
        border-bottom: 0;
    }

    td > table  tr {
        border: 0;
    }

    .left-line {
        border-left: 1px solid black;
    }

    td{
        font-size: 12px;
    }

    .w5  { width: 5%;  }
    .w10 { width: 10%; }
    .w20 { width: 20%; }
    .w30 { width: 30%; }
    .w33 { width: 33%; }
    .w50 { width: 50%; }
    .w70 { width: 70%; }

    h1 {
        display: inline-block;
    }

    .brand-header {
        float: left;
    }

    .brand-location {
        float: right;   
    }

    .brand-header, .brand-location {
        margin-top: 0;
    }
</style>
<body style="width: 210mm;">
    <div>
        <h1 class="brand-header" style="display: inline-block;float: left;margin-top: 0;"><?= ucwords($firmModel->name);  ?></h1>
        <h1 class="brand-location" style="display: inline-block;float: right;margin-top: 0;"><?= ucwords($firmModel->city); ?></h1>
    </div>
    <table style="width: 100%;border-collapse: collapse;">
        <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <td class="w33" style="width: 33%;vertical-align: baseline;font-size: 12px;"></td>
            <td class="w33 left-line" style="width: 33%;vertical-align: baseline;font-size: 12px;border-left: 1px solid black;">Tax Invoice</td>
            <td class="w33 left-line" style="width: 33%;vertical-align: baseline;font-size: 12px;border-left: 1px solid black;">For:</td>
        </tr>
    </table>
    <table style="width: 100%;border-collapse: collapse;">
        <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
        <td style="width: 100%;vertical-align: baseline;font-size: 12px;">Shipped From: <?= $firmModel->address . ',' . ucwords($firmModel->city) . ',' . ucwords($firmModel->location) . ' - ' . $firmModel->pincode .','. ucwords($firmModel->state);?> </td>
        </tr>
    </table>
    <table style="width: 100%;border-collapse: collapse;">        
        <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <td class="w33" style="width: 33%;vertical-align: baseline;font-size: 12px;">State: <?= ucwords($firmModel->state); ?></td>
            <td class="w33 left-line" style="width: 33%;vertical-align: baseline;font-size: 12px;border-left: 1px solid black; display:block;">Pin Code: <?= $firmModel->pincode; ?></td>
            <td class="w33 left-line" style="width: 33%;vertical-align: baseline;font-size: 12px;border-left: 1px solid black;">GSTIN Number: ----</td>
        </tr>
    </table>
    <table style="width: 100%;border-collapse: collapse;">
        <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <th class="w33" style="width: 33%;vertical-align: baseline;">Invoice No. <?= $model->oid; ?></th>
            <th class="w70 left-line" style="width: 70%;vertical-align: baseline;border-left: 1px solid black;"></th>
            <!-- <th class="w33 left-line"></th> -->
        </tr>
        <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <td class="w33" style="width: 33%;vertical-align: baseline;font-size: 12px;">
                <table style="width: 100%;border-collapse: collapse;">
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <td class="w50" style="width: 50%;vertical-align: baseline;font-size: 12px;">Invoice Date:</td>
                        <td style="width: 100%;vertical-align: baseline;font-size: 12px;"> <?= $model->created_at; ?> </td>
                    </tr>
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <td class="w50" style="width: 50%;vertical-align: baseline;font-size: 12px;">Doc Ref:</td>
                        <td style="width: 100%;vertical-align: baseline;font-size: 12px;"></td>
                    </tr>
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <td class="w50" style="width: 50%;vertical-align: baseline;font-size: 12px;">PO Ref:</td>
                        <td style="width: 100%;vertical-align: baseline;font-size: 12px;"></td>
                    </tr>
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <td class="w50" style="width: 50%;vertical-align: baseline;font-size: 12px;">Payment Mode:</td>
                        <td style="width: 100%;vertical-align: baseline;font-size: 12px;"><?= $model->paymentMode[$model->payment_mode]; ?></td>
                    </tr>
                </table>
            </td>
            <!-- <td class="w33 left-line">
            
                <table>
                    <tr>
                        <td class="w33">Delivery Terms</td>
                        <td>Door Delivery</td>
                    </tr>                    
                    
                    
                    <tr>
                        <td class="w33">Transporter</td>
                        <td> Delhivery Private Limited</td>
                    </tr>
                    <tr>
                        <td class="w33">Ship Via</td>
                        <td>Air-Ecom Courier</td>
                    </tr>
                    <tr>
                        <td class="w33">Docket No.</td>
                        <td>7679676676</td>
                    </tr>
                    <tr>
                        <td class="w33">EWB No.</td>
                        <td></td>
                    </tr>
                </table>
            </td> -->
            <td class="w70 left-line" style="width: 70%;vertical-align: baseline;font-size: 12px;border-left: 1px solid black;">
            <table style="width: 100%;border-collapse: collapse;">
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <th class="w50" style="width: 50%;vertical-align: baseline;">Bill to Address: <?= $partyModel->name; ?></th>
                    </tr>
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <td class="w50" style="width: 50%;vertical-align: baseline;font-size: 12px;">
                            <table style="width: 100%;border-collapse: collapse;">
                                <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                                    <td style="width: 100%;vertical-align: baseline;font-size: 12px;">
                                        Address: <?= 
                                            $partyModel->street_address .', '. 
                                            $partyModel->city.', '. 
                                            $partyModel->location.', '.
                                            $partyModel->state.', '?>
                                        Pincode: <?= $partyModel->pincode ?>
                                    </td>  
                                </tr>
                                <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                                    <td style="width: 100%;vertical-align: baseline;font-size: 12px;">
                                        <table style="width: 100%;border-collapse: collapse;">
                                            <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                                                <td class="w33" style="width: 33%;vertical-align: baseline;font-size: 12px;">State:</td>
                                                <td style="width: 100%;vertical-align: baseline;font-size: 12px;"> <?= $partyModel->state; ?></td>
                                            </tr>
                                            <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                                                <td class="w33" style="width: 33%;vertical-align: baseline;font-size: 12px;">PAN No.:</td>
                                                <td style="width: 100%;vertical-align: baseline;font-size: 12px;"></td>
                                            </tr>
                                            <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                                                <td class="w33" style="width: 33%;vertical-align: baseline;font-size: 12px;">Contact:</td>
                                                <td style="width: 100%;vertical-align: baseline;font-size: 12px;"><?= $partyModel->phone; ?></td>
                                            </tr>
                                            <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                                                <td class="w33" style="width: 33%;vertical-align: baseline;font-size: 12px;">Email:</td>
                                                <td style="width: 100%;vertical-align: baseline;font-size: 12px;"><?= $partyModel->email; ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    
                                </tr>
                            </table>
                        </td>                        
                    </tr>
                </table>                
            </td>
        </tr>
    </table>
    <table style="width: 100%;border-collapse: collapse;">
        <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <th class="w10" style="width: 10%;vertical-align: baseline;">Sr. No.</th>
            <th class="w50" style="width: 50%;vertical-align: baseline;">Product and Service Description</th>
            <th class="w10" style="width: 10%;vertical-align: baseline;">Quantity</th>
            <th class="w10" style="width: 10%;vertical-align: baseline;"></th>
            <th class="w5" style="width: 5%;vertical-align: baseline;"></th>
            <th style="width: 100%;vertical-align: baseline;">Gross Amount</th>
        </tr>
        <?php $subTotal = 0; ?>
        <?php foreach($dataAmount as $index => $amount) { ?>
            <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <td class="w10" style="width: 10%;vertical-align: baseline;font-size: 12px;"><?= $index+1;  ?></td>
            <td class="w50" style="width: 50%;vertical-align: baseline;font-size: 12px;"><?= $dataItem[$index*2]; ?></td>
            <td class="w10" style="width: 10%;vertical-align: baseline;font-size: 12px;"><?= $dataItem[$index*2+1]; ?></td>
            <td class="w10" style="width: 10%;vertical-align: baseline;font-size: 12px;"></td>
            <td class="w5" style="width: 5%;vertical-align: baseline;font-size: 12px;"></td>
            <td style="width: 100%;vertical-align: baseline;font-size: 12px;"><?= $dataItem[$index*2+1]* $amount; ?></td>
            <?php $subTotal += $dataItem[$index*2+1]* $amount; ?>
        </tr>
         <?php } ?>
        
         <tr style="height: 30px;width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <td class="w10" style="width: 10%;vertical-align: baseline;font-size: 12px;"></td>
            <td class="w50" style="width: 50%;vertical-align: baseline;font-size: 12px;"></td>
            <td class="w10" style="width: 10%;vertical-align: baseline;font-size: 12px;"></td>
            <td class="w10" style="width: 10%;vertical-align: baseline;font-size: 12px;"></td>
            <td class="w5" style="width: 5%;vertical-align: baseline;font-size: 12px;"></td>
            <td style="width: 100%;vertical-align: baseline;font-size: 12px;"></td>
        </tr>

        <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <td class="w10" style="width: 10%;vertical-align: baseline;font-size: 12px;"></td>
            <td class="w50" style="width: 50%;vertical-align: baseline;font-size: 12px;">Sub Total:</td>
            <td class="w10" style="width: 10%;vertical-align: baseline;font-size: 12px;"></td>
            <td class="w10 left-line" style="width: 10%;vertical-align: baseline;font-size: 12px;border-left: 1px solid black;"></td>
            <td class="w5" style="width: 5%;vertical-align: baseline;font-size: 12px;"></td>
            <td style="width: 100%;vertical-align: baseline;font-size: 12px;">&#x20B9; <?= $subTotal; ?></td>
        </tr>
    </table>
    
    <table style="width: 100%;border-collapse: collapse;">
        <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <td class="w70" style="width: 70%;vertical-align: baseline;font-size: 12px;display: block; width: 552px;">
                <table style="width: 100%;border-collapse: collapse;">
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <!-- <td>Net Amount Payable (In Words): INR Eight Hundred Five and 0 Paise Only</td> -->
                    </tr>
                    
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;"><td style="width: 100%;vertical-align: baseline;font-size: 12px;"><br></td></tr>
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <!-- <td>CD Total: 0.0, Total: 00.00, RD Total:0.00, FR Total: 0.00</td> -->
                    </tr>
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;"><td style="width: 100%;vertical-align: baseline;font-size: 12px;"><br></td></tr>
                </table>
                
            </td>
            <td class="left-line" style="width: 100%;vertical-align: baseline;font-size: 12px;border-left: 1px solid black;">
                <table style="width: 100%;border-collapse: collapse;">
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <td class="w70" style="width: 70%;vertical-align: baseline;font-size: 12px;"><br></td>
                        <td class="w30" style="width: 30%;vertical-align: baseline;font-size: 12px;"><br></td>
                    </tr>
                    <?php if($subTotal-$model->amount) {?>
                        <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <td class="w70" style="width: 70%;vertical-align: baseline;font-size: 12px;"><span>Discount</span></td>
                        <td class="w30" style="width: 30%;vertical-align: baseline;font-size: 12px;"><span>- <?= $model->currencySymbol; ?> <?= $subTotal-$model->amount;?></span></td>
                    </tr>
                    <?php } ?>
                    <tr style="width: 100%;vertical-align: baseline;border: 0;border-bottom: 0;">
                        <td class="w70" style="width: 70%;vertical-align: baseline;font-size: 12px;"><h3>Invoice Total</h3></td>
                        <td class="w30" style="width: 30%;vertical-align: baseline;font-size: 12px;"><h3><?= $model->currencySymbol; ?> <?= $model->amount; ?></h3></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width: 100%;border-collapse: collapse;">
        <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <td class="w70" style="width: 70%;vertical-align: baseline;font-size: 12px; width: 552px; display: block;">
                Customer Care: <?= $firmModel->phone; ?>, Email: <?= $firmModel->email; ?>
                <br>
                Good Shipped / sold under this invoice are for personal use and for resale..
                <br>
                Declaration: Certified that the particulars given above are true and correct.
                <br>
                TDS Declaration: N.A.
            </td>
            <th class="left-line" style="width: 100%;vertical-align: baseline;border-left: 1px solid black;">
                Authorized Signatory
                <br>
                <br>                
            </th>
        </tr>
    </table>
    <table style="width: 100%;border-collapse: collapse;">
        <tr style="width: 100%;vertical-align: baseline;border: 1px solid black;border-bottom: 0;">
            <td style="width: 100%;vertical-align: baseline;font-size: 12px;"></td>
        </tr>
    </table>
</body>
