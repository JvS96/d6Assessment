<?php
include_once 'database/db_queries.php';

$retrieve_items = retrieve_items();
$retrieve_services = retrieve_services();

$taxRate = 6.250;
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="script/scripts.js"></script>
</head>
<body>
<header>
    <h1>Alien Tech</h1>
</header>
<form action="/controllers/api_action.php" method="POST">
    <div class="container">
        <div class="row">
            <div class="col">
                <span>127 Mars Avenue</span><br>
                <span>Mars Topia</span><br>
                <span>Phone: 012 345 6789</span><br>
                <span>Fax: 098 765 4321</span><br>
                <span>Website: MarsOverlords.ai</span>
            </div>
            <div class="col">
                <table class="meta" style="width: 100%;">
                    <tr>
                        <th><span>Date</span></th>
                        <td><input type="text" id="todays_date" name="todays_date" value="<?php echo date("d/m/Y") ?>" disabled="disabled" style="width: 100%"></td>
                    </tr>
                    <tr>
                        <th><span>Invoice #</span></th>
                        <td><input type="text" id="invoice_number" name="invoice_number" value="INV<?php echo date("dmY") . rand(10,10000)?>" disabled="disabled" style="width: 100%"></td>
                    </tr>
                    <tr>
                        <th><span>Customer ID</span></th>
                        <td><input type="text" id="customer_id" name="customer_id" value="ID<?php echo rand(10,10000)?>" disabled="disabled" style="width: 100%"></td>
                    </tr>
                    <tr>
                        <th><span>Due Date</span></th>
                        <td><input type="text" id="due_date" name="due_date" value="<?php echo Date('d/m/y', strtotime('+30 days')) ?>" disabled="disabled" style="width: 100%"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="background-color: #A6A6A6; width: 50%">
            <b style="padding: 3px">Bill To</b>
        </div>
        <div class="row" style="width: 30%">
            <div class="col">
                <input class="inputst" type="text" id="client_name" name="client_name" placeholder="Name">
                <input class="inputst" type="text" id="client_company_name" name="client_company_name" placeholder="Company">
                <input class="inputst" type="text" id="client_street_address" name="client_street_address" placeholder="Street Address">
                <input class="inputst" type="text" id="client_city" name="client_city" placeholder="City">
                <input class="inputst" type="text" id="client_phone" name="client_phone" placeholder="Phone">
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="inventory" id="invoice_table">
                    <thead>
                    <tr>
                        <th><span>Description</span></th>
                        <th><span>Taxed</span></th>
                        <th><span>Amount</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Service Fee</td>
                        <td></td>
                        <td>
                            <?php
                            foreach ($retrieve_services AS $retrieve_service){
                                if ($retrieve_service['id'] == 1){?>
                                    <input type="number" id="service_rate" name="service_rate" value="<?php echo $service_rate = $retrieve_service['rate'] ?>" disabled="disabled" style="width: 100%">
                            <?php
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Labor (@ 75/hour)</td>
                        <td></td>
                        <td>
                            <?php
                            foreach ($retrieve_services AS $retrieve_service){
                                if ($retrieve_service['id'] == 2){
                                    ?>
                                    <input type="number" id="service_rate" name="service_rate" value="<?php echo $labor_rate = $retrieve_service['rate'] ?>" disabled="disabled" style="width: 100%">
                                    <?php
                                }
                            }

                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="invoice_item_data" id="invoice_item_data" style="width: 100%">
                                <option value="none">None</option>
                                <?php
                                foreach ($retrieve_items AS $retrieve_item){
                                    ?>
                                    <option value="<?php echo $item_id = $retrieve_item['id'] ?>"><?php echo $retrieve_item['name'] ?></option>
                                    <?php
                                }
                                ?>
                        </td>
                        <td>

                        </td>
                        <td>
                            <input type="number" id="item_rate" name="item_rate" value="" style="width: 100%">
                            <?php $item_rate = $_POST['item_rate'] ?>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!--    <input class="btn btn-success" type="button" onclick="addTableRow()" value="Add Item">-->
    <article>
        <h1>Recipient</h1>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row" style="background-color: #A6A6A6; width: 100%">
                        <b style="padding: 3px">Additional Notes:</b>
                    </div>
                    <div class="row">
                        <ol type="1">
                            <li>Payment due in 30 Days.</li>
                            <li>Please use invoice number as reference.</li>
                        </ol>
                    </div>
                </div>
                <div class="col">
                    <table class="balance" style="width: 100%;">
                        <tr>
                            <th><span contenteditable>Sub Total</span></th>
                            <?php $totalAmount = $service_rate + $labor_rate + $item_rate; ?>
                            <td><span><?php echo $totalAmount ?></span></td>
                        </tr>
                        <tr>
                            <th><span contenteditable>Taxable</span></th>
                            <?php $taxableAmount = $totalAmount / (1 + $taxRate); ?>
                            <td><span><?php echo $taxableAmount = round($taxableAmount, 2); ?></span></td>
                        </tr>
                        <tr>
                            <th><span contenteditable>Tax Rate</span></th>
                            <td><span><?php echo $taxRate . "%"; ?></span></td>
                        </tr>
                        <tr>
                            <th><b contenteditable>Total</b></th>
                            <td><span><?php echo $totalDue = $totalAmount + $taxableAmount; ?></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </article>
    <input class="btn btn-success" type="submit" value="Generate Invoice">
</form>

</body>
</html>