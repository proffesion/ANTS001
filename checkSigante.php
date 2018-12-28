<?php 
include 'app_data/php/head_no_css.php';

if (loggedin()) {

$date = $today_date;
$user = $user_id;

// chech form the sign table if there is some where tou are assigned ti sign 
// - check1
$query_CheckOne = $mysqli->query("SELECT `date` FROM `deposit` WHERE `checkOne`='$user' AND `checkOneSign`='0'");
if ($query_CheckOne->num_rows != null) {
    while ($row = $query_CheckOne->fetch_array()) {
        $date = $row["date"];
        ?>
            <div class="pop_deposit_section">
            <section class="content">
                <p>Please Check the depodit form of <b><?php echo @$date ?></b> <br>
                and sign as <b>CHECKEED BY (1)</b></p>
            </section>

            <a href="deposit.php?date=<?php echo @$date ?>">
                <section class="button-sectiio">
                    <b class=" fa fa-angle-right"></b>
                </section>
            </a>
            <section class="clear-both">x</section>
            </div>
        <?php

    }
}


// - check 2
$query_CheckTwo = $mysqli->query("SELECT `date` FROM `deposit` WHERE `checkTwo`='$user' AND `checkTwoSign`='0'");
if ($query_CheckTwo->num_rows != null) {
    while ($row = $query_CheckTwo->fetch_array()) {
        $date = $row["date"];
        ?>
            <div class="pop_deposit_section">
            <section class="content">
                <p>Please Check the depodit form of <b><?php echo @$date ?></b> <br>
                and sign as <b>CHECKEED BY (2)</b></p>
            </section>

            <a href="deposit.php?date=<?php echo @$date ?>">
                <section class="button-sectiio">
                    <b class=" fa fa-angle-right"></b>
                </section>
            </a>
            <section class="clear-both">x</section>
            </div>
        <?php

    }
}

// - Approved by
$query_aprovedBy = $mysqli->query("SELECT `date` FROM `deposit` WHERE `aprovedBy`='$user' AND `aprovedBySign`='0'");
if ($query_aprovedBy->num_rows != null) {
    while ($row = $query_aprovedBy->fetch_array()) {
        $date = $row["date"];
        ?>
            <div class="pop_deposit_section">
            <section class="content">
                <p>You need to Approve form the deposit form <br> of <b><?php echo @$date ?></b></p>
            </section>

            <a href="deposit.php?date=<?php echo @$date ?>">
                <section class="button-sectiio">
                    <b class=" fa fa-angle-right"></b>
                </section>
            </a>
            <section class="clear-both">x</section>
            </div>
        <?php

    }
}

} // if logged in


?>