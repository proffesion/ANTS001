
<?php
include 'head_no_css.php';
secured();
$sel_id = $_POST['sel_id'];

if(isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] == 'Divers') {
    $type = 'Divers';
    $typRedirect = '&t=D';
} else {
  $type = 'Invitation';
  $typRedirect = '';
}

?>

         <!-- <h2>Balance</h2> -->
       <?php @$BalanceQuerySearch = "SELECT * FROM `balance_table` WHERE `item`='$type' AND `sell_id`='$sel_id'"; ?>

         <table class="table balance-table-result" border="0">
           <tbody>
             <tr>
               <!-- <th> # </th> -->
               <th> Date </th>
               <th> E-id </th>
               <th> <b class="fa fa-money" style="font-size: 21px;" title="Payment Type"></b> </th>
               <th> Pay Frw </th>
               <th> Pay $ </th>
               <th> Pay Fco </th>
               <th> Total (type)</th>
               <th> Total (Frw)</th>
             </tr>

         <?php
         $results = $mysqli->query("$BalanceQuerySearch");

         if ($results->num_rows == NULL) {
       ?>
        <style>
          .balance-table-result { display: none; }
           .btnhide { display: none; }

          .modal-body-curent {
          margin: 0px;
          padding: 0px;
          }
        </style>




       <?php
         } else {
           $x = 0;

             while($row = $results->fetch_array()) {
               // @$Bal_b_id = $row["balance_id"];
               @$Bal_date = $row["date"];
               // @$Bal_item = $row["item"];
               @$Bal_item_id = $row["item_id"];
               @$Bal_sell_id = $row["sell_id"];
               // @$Bal_comment = $row["comment"];
               @$Bal_client_name = $row["client_name"];
               // @$Bal_closed = $row["closed"];
               @$Bal_paym_typ = $row["paym_typ"];
               // @$Bal_Rate_R = $row["Rate_R"];
               // @$Bal_Rate_Fc = $row["Rate_Fc"];
               @$Bal_Pay_Fr = $row["Pay_Fr"];
               @$Bal_Pay_Dol = $row["Pay_Dol"];
               @$Bal_Pay_fc = $row["Pay_fc"];
               @$Bal_Total_Available = $row["Total_Available"];
               @$Bal_Total_Available_Rw = $row["Total_Available_Rw"];
         ?>
           <tr>
           <td> <?php echo @$Bal_date; ?> </td>
           <td> <?php echo @$Bal_item_id; ?> </td>
           <td> <?php echo @$Bal_paym_typ; ?> </td>

           <td> <?php echo @$Bal_Pay_Fr; ?> Frw</td>
           <td> <?php echo @$Bal_Pay_Dol; ?> $</td>
           <td> <?php echo @$Bal_Pay_fc; ?> Fc</td>

           <td> <?php echo @$Bal_Total_Available; ?> <?php echo @$paym_typ; ?></td>
           <td> <?php echo @$Bal_Total_Available_Rw; ?> Frw</td>
          </tr>

       <?php
       @$total_Bal_Pay_Fr += $Bal_Pay_Fr;
       @$total_Bal_Pay_Dol += $Bal_Pay_Dol;
       @$total_Bal_Rate_Fc += $Bal_Pay_fc;

       @$total_Bal_Total_Available += $Bal_Total_Available;
       @$total_Bal_Total_Available_Rw += $Bal_Total_Available_Rw;

        }

         ?>
         <style>
           .error-dv-nw { display: none; }
         </style>
         <?php
       }
       ?>

       <tr>
         <!-- <td> &nbsp;</td> -->
         <td> &nbsp; </td>
         <td> &nbsp; </td>
         <td> &nbsp; </td>
         <td> <?php echo @$total_Bal_Pay_Fr; ?> Frw</td>
         <td> <?php echo @$total_Bal_Pay_Dol; ?> $</td>
         <td> <?php echo @$total_Bal_Rate_Fc; ?> Fc</td>

         <td> &nbsp; </td>
         <td bgcolor="lightblue"><b> <?php echo @$total_Bal_Total_Available_Rw; ?> Frw</b></td>
       </tr>
       </tbody></table>

           <a class="btnhide" href="add_balance.php?sid=<?php echo $sel_id . $typRedirect; ?>" target="_parent">
               <button type="button" class="btn btn-success">  <b class="fa fa-plus"></b> &nbsp;Add Balance </button>
           </a>
           <br>

<?php
  $balance_payment_type = retrieve_data('paym_typ','selling_e','s_id',$sel_id);

    $balance_is = $balance_was -

  $balance_was = @retrieve_data('balance','selling_e','s_id',$sel_id);
  // find the balance wich depend on the payment-type
  if ($balance_payment_type == 'frw') { // in Rwandans
       $balance_was_total = $balance_was;
  } elseif ($balance_payment_type == 'dol') { // dolar
       $balance_was_total = @retrieve_data('balance','selling_e','s_id',$sel_id);
  } elseif ($balance_payment_type == 'fc') {
       $balance_was_total = @retrieve_data('balance','selling_e','s_id',$sel_id);
  }


?>

 <div class="error-dv-nw">
     <table class="error-table-nw">
       <tr>
         <td>
           <h2>Oooops !!</h2>
           <h3>No Balance Found</h3>
           <p> There is no balance
           <br> for this sell in the database
           <br> <i>Click <b>Add Balance</b> to add one.
           </p>
           <a href="add_balance.php?sid=<?php echo $sel_id . $typRedirect; ?>" target="_parent">
               <button type="button" class="btn btn-primary">Add Balance</button>
           </a>
         </td>
         <td>
           <h1 class="fa fa-file-o"></h1>
         </td>
       </tr>
     </table>
 </div>
