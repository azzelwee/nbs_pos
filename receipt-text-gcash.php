<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("../connections/connection.php");
$con = connection();

$sql = "SELECT * FROM product_list ";
$product = $con->query($sql) or die($con->error);
$results = $product->fetch_all(MYSQLI_ASSOC);
$searchResults = $_SESSION['search_results'];


date_default_timezone_set('Asia/Manila');
$currentDate = date("m/d/Y");
$date = date("mdY");
$time = date("H:i:s");
$totalQty = $_COOKIE['totalQty'];
$totalAmount = $_COOKIE['total_amount'];
$formattedTotal = number_format((float)$totalAmount, 2, '.', '');

$number = "29990001000001";
$date = str_replace(' ', '', $date);
$number = str_replace(' ', '', $number);

$results = $_SESSION['search_results'];

if (isset($_SESSION['remainingAmount'])) {
    $remainingAmount = $_SESSION['remainingAmount'];
    $change = number_format($remainingAmount, 2);
} else {
    // Handle the case when 'remainingAmount' is not set in the session
    $remainingAmount = 0; // or some default value
    $change = number_format($remainingAmount, 2);
}

$vat = $totalAmount * 0.12 / 1.12;
$vattable = $totalAmount / 1.12;

$formattedVattable = number_format($vattable, 2);
$formattedVat = number_format($vat, 2);
?>

<div class="receipt1">
<?php
    $longText1 = "<p>
               ABACUS BOOK AND CARD CORP.   </br>       
                   NBS OUTLET STORE       </br>        
        2nd Floor National Book Store Superbranch   </br>
            General Roxas St, Araneta Center      </br> 
                Socorro Cubao, Quezon City          </br>
            VAT Registered TIN: 000-299-299-212      </br>
                MIN: 17102610031446661            </br>
                Serial No.: AT17-ST0529            </br>
            ACCREDTN: 041-208117451-000086-11210     </br>

            </p>";
    echo $longText1;
?>
</div>

<div class="receipt2">
<?php
    $longText2 = "
    </br>
        <div class=\"apart\">
            <p>$currentDate</p>
            <p>$time</p>  </br> 
        </div>

        
        TrxNo &nbsp&nbsp&nbsp : $date$number
        </br>

        <div class=\"apart2\">
           <p> Clerk &nbsp&nbsp&nbsp&nbsp&nbsp: 110366 </p>
           <p> Term. No.: 0002 </p>
        </br>
        </div>
";
    
 echo $longText2;
?>        
</div>

<div class="productGenerated">
    <?php
    foreach ($results as $row) {
    ?>
        <div class="productReceipt">
            <div class="columnReceipt1">
                <?php echo $row['qty']; ?> &nbsp
            </div>

            <div class="columnReceipt2">
                <?php echo $row['upc']; ?> @ <?php echo $row['srp']; ?>
                <br>
                <?php echo substr($row['item'], 0, 20); ?>
            </div>

            <div class="columnReceipt3">
                <p>
                <?php echo number_format($row['amount'], 2); ?> <?php echo $row['type']; ?>
                </p>    
            </div>

        </div>

    <?php
    }
    ?>
</div>


<div class="receipt3">
<?php
    $longText3 =                                    
     "      
        <div class=\"apart3\">
            <p>No. of Items: </p> 
            <p>$totalQty </p>
        </div>

        <div class=\"apart3\">
            <p> Amount Due: </p>
            <p> $formattedTotal </p>
            
        </div>
        <p>Change -> $change</br>";
        echo $longText3;
        ?>
</div>

<div class="receipt3">
        <?php
            include 'processPayment-gcash.php';
            processPaymentGcash();
        ?>
        </div>

<div class="receipt3">
<?php
    $longText3 =                                    
     "

        </br>
        ********************************************************************
        </br>
        Join Laking National for free!        </br>  
        </br>                             
        Visit :        </br>                               
        lakingnational.nationalbookstore.com.ph     </br>  
        for more details or download the app in    </br>   
        your phone's app store.                       
        </br>
        ********************************************************************
        </br>
        <p style=\"text-align:center;\">Tax Info</p>              
        </br>

        <div class=\"taxApart1\">
            <p>Non-Vatable </p> 
            <p>0.00 </p>
        </div>

        <div class=\"taxApart1\">
            <p>Vatable </p> 
            <p>$formattedVattable </p>
        </div>

        <div class=\"taxApart1\">
            <p>VAT Zero-Rated Sale  </p> 
            <p>0.00 </p>
        </div>

        <div class=\"taxApart1\">
            <p>VAT Exempt Sale </p> 
            <p>0.00 </p>
        </div>
        
        <div class=\"taxApart1\">
            <p>VAT(12%) </p> 
            <p>$formattedVat</p>
        </div>

        <div class=\"taxApart1\">
            <p>Total Sales </p> 
            <p>$formattedTotal</p>
        </div>
        </br>                        
        BUYER'S NAME : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ </br>                      
        ADDRESS : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _    </br>                              
        TIN : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _   </br>                              
        </br>                                                 
        </p>";
        echo $longText3;
        ?>
</div>



<div class="receipt4">
<?php
    $longText4 =                                    
     "   DATA EDGE CORPORATION     </br>        
        4th Floor Quad Alpha Centrum 125 Pioneer St  </br>
        Highway Hills, Mandaluyong City        </br>
        TIN: 208-117-451-000           </br>  
        ACCREDTN: 041-208117451-000086-11210     </br>
        DATE ISSUED: 06/28/2005            </br>
        AND VALID UNTIL 07/31/2025          </br>
        Permit No.: FP102017-116-0143501-00212    </br>
        </br>
        All items that are on        </br>     
        clearance sale have been       </br>    
        fully marked down due to           </br>
        various reasons, including         </br> 
        any damage that may not be          </br>
        physically apparent.             </br>
        These items are sold on            </br>
        as AS IS basis. Thus, items          </br>
        sold are considered              </br>
        as final sale.                </br>
        </br>
        Regular items may be returned or       </br>
        exchanged within 7 days            </br>
        from the date of purchase.          </br>
        Any regular item returned must be       </br>
        in the same condition at the time of     </br>
        purchase and in the original packaging.    </br>
        Please present a copy of the         </br>
        receipt upon return or exchange.       </br>
        </br>
        SI No.: 0421202429990002000012";
        echo $longText4;
        ?>
</div>
