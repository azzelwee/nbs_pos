<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

// Get the current date in mm/dd/yyyy format


?>

<div class="receipt1">
<?php
    $longText1 = "
               ABACUS BOOK AND CARD CORP.   </br>       
                   NBS OUTLET STORE       </br>        
        2nd Floor National Book Store Superbranch   </br>
            General Roxas St, Araneta Center      </br> 
                Socorro Cubao, Quezon City          </br>
            VAT Registered TIN: 000-299-299-212      </br>
                MIN: 17102610031446661            </br>
                Serial No.: AT17-ST0529            </br>
            ACCREDTN: 041-208117451-000086-11210     </br>";

    echo $longText1;
?>
</div>

<div class="receipt2">
<?php
    date_default_timezone_set('Asia/Manila');

    $currentDate = date("m/d/Y");
    $time = date("H:i:s");

    $longText2 = "
    <p>
    </br>
        <div class=\"apart\">
        $currentDate &nbsp&nbsp&nbsp $time  </br> 
        </div>
        TrxNo : 29990001000001          </br>
        Clerk: 110366 Term. No.: 0002  </br>
        </br>
        No. of Items 0</br>
        Amount Due                                0.00</br>
        Change -> 0.00</br>
        </br>
        **********************************************
        </br>
        Join Laking National for free!        </br>  
        </br>                             
        Visit :        </br>                               
        lakingnational.nationalbookstore.com.ph     </br>  
        for more details or download the app in    </br>   
        your phone's app store.                       
        </br>
        **********************************************
        </br>
        Tax Info                   
        </br>
        </br>
        Non-Vatable                              61.50</br>
        Vatable                                   0.89</br>
        VAT Zero-Rated Sale                       0.00</br>
        VAT Exempt Sale                           0.00</br>
        VAT(12%)                                  0.11</br>
        Total Sales                              62.50</br>
        </br>                        
        BUYER'S NAME : ___________________ </br>                      
        ADDRESS : _________________________    </br>                              
        TIN : _____________________________    </br>                              
        </br>                                                 
        </p>";
    
 echo $longText2;
?>        
</div>

<div class="receipt3">
<?php
    $longText3 =                                    
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
        echo $longText3;
        ?>
</div>
