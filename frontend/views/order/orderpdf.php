<style>
    body {
        width: 210mm;
        height: 297mm;
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
</style>

<body>
    <div>
        <h1 class="brand-header">Saugat Computers</h1>
        <h1 class="brand-location">Hansi</h1>
    </div>
    <table>
        <tr>
            <td class="w33"></td>
            <td class="w33 left-line">Tax Invoice</td>
            <td class="w33 left-line">For Record</td>
        </tr>
    </table>

    <table>
        <tr>            
            <td>Address: <?= 
                $partyModel->street_address .','. 
                $partyModel->city.','. 
                $partyModel->location.','.
                $partyModel->state.','?>
                Pincode: <?= $partyModel->pincode ?></td>                       
        </tr>
    </table>
    
    
    <table>
        <tr>
            <td>Shipped From: 3, Ganesh Market, Near Chopta Bazzar, Inside badsi gate, Hansi, Hisar - 125033, Haryana </td>
        </tr>
    </table>
    <table>        
        <tr>
            <td class="w33">State: Haryana</td>
            <td class="w33 left-line">State Code: 06</td>
            <td class="w33 left-line">GSTIN Number: sfgs897897697</td>
        </tr>
    </table>
    <table>
        <tr>
            <th class="w33">Invoice No. <?= $model->id; ?></th>
            <th class="w33 left-line"></th>
            <th class="w33 left-line"></th>
        </tr>
        <tr>
            <td class="w33">
                <table>
                    <tr>
                        <td class="w33">Invoice Date:</td>
                        <td > <?= $model->created_at; ?> </td>
                    </tr>
                    <tr>
                        <td class="w33">Doc Ref:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="w33">PO Ref:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="w33">Payment Terms:</td>
                        <td>COD</td>
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
            <td class="w33 left-line">
                <table>
                    <tr>
                        <td class="w50">Special Instructions</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="w33">Place of Supply: </td>
            <td class="w33 left-line">State Code: 06</td>
            <td class="w33 left-line"> State: Haryana</td>
        </tr>
    </table>
    <table>
        <tr>
            <th class="w50">Bill to Address: <?= $partyModel->name; ?></th>
            <th class="w50 left-line">Delivery Address: <?= $partyModel->name; ?></th>
        </tr>
        <tr>
            <td class="w50">
                <table>
                    <tr>
                    <td>Address: <?= 
                        $partyModel->street_address .','. 
                        $partyModel->city.','. 
                        $partyModel->location.','.
                        $partyModel->state.','?>
                        Pincode: <?= $partyModel->pincode ?>
                    </td>  
                    </tr>
                    <tr><td><br></td></tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td class="w33">State (Code):</td>
                                    <td>Haryana(06)</td>
                                </tr>
                                <tr>
                                    <td class="w33">PAN No.</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="w33">Contact:</td>
                                    <td> 9996807592</td>
                                </tr>
                                <tr>
                                    <td class="w33">Email:</td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>
                        
                    </tr>
                </table>
            </td>
            <td class="w50 left-line">
                <table>
                    <tr>
                    <td>Address: <?= 
                        $partyModel->street_address .','. 
                        $partyModel->city.','. 
                        $partyModel->location.','.
                        $partyModel->state.','?>
                        Pincode: <?= $partyModel->pincode ?>
                    </td> 
                    </tr>
                    <tr><td><br></td></tr>
                    <tr>
                        <td>
                            <table>
                                    <tr>
                                        <td class="w33">State (Code):</td>
                                        <td>Haryana(06)</td>
                                    </tr>
                                    <tr>
                                        <td class="w33">LandMark: </td>
                                        <td> <?= $partyModel->street_address; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="w33">Contact:</td>
                                        <td> <?= $partyModel->phone; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="w33">Email:</td>
                                        <td><?= $partyModel->email; ?></td>
                                    </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <th class="w10">Sr. No.</th>
            <th class="w50">Product and Service Description</th>
            <th class="w10">Quantity</th>
            <th class="w10">IGST</th>
            <th class="w5"></th>
            <th>Gross Amount</th>
        </tr>
        <?php foreach($dataAmount as $index => $amount) { ?>
            <tr>
            <td class="w10"><?= $index+1;  ?></td>
            <td class="w50"><?= $dataItem[$index*2]; ?></td>
            <td class="w10"><?= $dataItem[$index*2+1]; ?></td>
            <td class="w10">18.0%</td>
            <td class="w5"></td>
            <td><?= $dataItem[$index*2+1]* $amount; ?></td>
        </tr>
         <?php } ?>
        
        <tr style="height: 50px">
            <td class="w10"></td>
            <td class="w50"></td>
            <td class="w10"></td>
            <td class="w10"></td>
            <td class="w5"></td>
            <td></td>
        </tr>

        <tr>
            <td class="w10"></td>
            <td class="w50">Sub Total:</td>
            <td class="w10"></td>
            <td class="w10 left-line"></td>
            <td class="w5"></td>
            <td><?= $model->amount; ?></td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td class="w70">
                <table>
                    <tr>
                        <!-- <td>Net Amount Payable (In Words): INR Eight Hundred Five and 0 Paise Only</td> -->
                    </tr>
                    
                    <tr><td><br></td></tr>
                    <tr>
                        <!-- <td>CD Total: 0.0, Total: 00.00, RD Total:0.00, FR Total: 0.00</td> -->
                    </tr>
                    <tr><td><br></td></tr>
                </table>
                
            </td>
            <td class="left-line">
                <table>
                    <tr>
                        <td><br></td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td class="w50">Round Off</td>
                        <td class="w50">0.00</td>
                    </tr>
                    <tr>
                        <td class="w50"><h3>Invoice Total</h3></td>
                        <td class="w50"><h3><?= $model->amount; ?></h3></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="w70">
                Customer Care: 9996807592, Email: sales@mokarte.in
            </td>
            <td class="left-line"></td>
        </tr>
        <tr>
            <td class="w70">
                Good Shipped / sold under this invoice are for personal use and for resale.
            </td>
            <td class="left-line"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="w50">GST payable on Reverse Charge basis.</td>
            <td class="w20">N.A.</td>
            <td class="w33 left-line">For Sample Company</td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="w70">
                Declaration: Certified that the particulars given above are true and correct.
            </td>
            <td class="left-line"></td>
        </tr>
        <tr>
            <td class="w70">
                    TDS Declaration: In terms.
            </td>
            <td class="left-line"></td>
        </tr>
        <tr>
            <td class="w70">
                <br>
                <br>
                <br>
                <br>
                <br>
            </td>
            <th class="left-line">
                <br>
                <br>
                <br>
                <br>
                Authorized Signatory
            </th>
        </tr>
    </table>
    <table>
        <tr>
            <td></td>
        </tr>
    </table>
</body>