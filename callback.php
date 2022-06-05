<?php
require './processor.php';
$txnid = $_GET['txnid'];

$ch = curl_init('https://drtether.com/api/v1/transaction/'.$txnid);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );

$response = curl_exec($ch);

curl_close($ch);

$responseAsArray = json_decode($response, true);
$confirm = $responseAsArray['confirmed'];
$used = $responseAsArray['used'];
$amount = $responseAsArray['amount'];
$hash = $responseAsArray['hash'];
$towallet = $responseAsArray['to'];

?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dr.Tether | Done!</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="css/style.css" rel="stylesheet">
    <style> 
        p {
        white-space: nowrap; 
        width: 300px; 
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: center;
        }
    </style>
</head>



<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <center><img src="./images/logo-page.png" width="175" height="175"></center> 
                                    <?php
                                    //$confirm = 1 (Transaction DONE!)
                                    //$used = 0 (The transaction hash never used on the website)
					//You can add below code to this 'IF' for cheching your wallet address in txn
					// && $towallet == $trc20address
                                        if ($confirm == 1 && $used == 0)
                                        {
                                            //Do any thing you want to do after payment
                                            echo '<h4 class="text-center mb-4">Transaction Confirmed!</h4>';
                                        }else{
                                            //payment not complated
                                            echo '<h4 class="text-center mb-4">Transaction Not Confirmed!</h4>';
                                        }
                                    ?>
									<h5 class="text-center mb-4">Value: <?php echo $amount; ?> USDT</h5>
									<h5 class="text-center mb-4">Your payment transaction Hash is:</h5>
									<center>
									<p class="text-center mb-4"><a href="https://tronscan.org/#/transaction/<?php echo $hash; ?>"><?php echo $hash; ?></a></p>
									</center>
									<h5 class="text-center mb-4">You can take screenshot and Click on hash to check transaction details.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>

</body>
</html>
