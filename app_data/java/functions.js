$('.folder-div-containner figure').each(function(i) {
    setTimeout(function() {
        $('.folder-div-containner figure').eq(i).addClass('showing');
    }, 80 * (i + 1));
});

$('.head a').each(function(i) {
    setTimeout(function() {
        $('.head a').eq(i).addClass('showing');
    }, 100 * (i + 1));
});

$('.fading-containner .fading-item').each(function(i) {
    setTimeout(function() {
        $('.fading-containner .fading-item').eq(i).addClass('showing');
    }, 100 * (i + 1));
});



$(function() {
    $('a').each(function() {
        if ($(this).prop('href') == window.location.href) {
            $(this).addClass('current');
        }
    });


});



////// these are for the click buttoms
$('.main-search-button').on('click', function search_div() {
    $('.search-div').toggleClass('search-show');
    $('.contents-div').toggleClass('contents-div-search');
    // $('.overlar_div').toggleClass('show');
});

////// these are for the click buttoms
$('.conveter-button').on('click', function search_div() {
    $('.conveter-containner').show();
});



////// these are for the click buttoms
$('.report-err-butt').on('click', function search_div() {
    $('.fixed-error-report').toggleClass('show');
});
$('.report-err-butt').on('click', function search_div() {
    $('.fixed-error-report').toggleClass('show');
});


$('.show-errors').on('click', function search_div() {
    $('.main-error-div-fixed').toggleClass('show');
});


// $('.submit-butt').on('click', function search_div() {
//     $('.loading-img').toggleClass('show');
// });

$('.loading-img').on('click', function search_div() {
    $('.loading-img').removeClass('show');
    $('.loading-img').addClass('hide');
});

// $('.img-zm').on('click', function search_div() {
//   $('.img-zm').toggleClass('img-zoom-full');
// });


function loaderDisplay(val = null, size = '2rem') {
    return `
    <section class="loaderDisplay">
    <h4 class='fa fa-spinner rotateIn animated infinite'></h4>
    <p class="fadeIn animated"> Loading.. </p>
    </section>
    `;
}


function sendErr(val, typ) {
    var divShow = document.getElementById('err_pop');
    divShow.innerHTML = "<iframe src='send_error.php?er=" + val + "&typ=" + typ + "' class='fadeIn animated' width='100%' height='100%'></iframe>";
}



// alert("hshsssh");


function showInfos(id) {
    var divShow = document.getElementById('itm_small_info');
    divShow.innerHTML = "<iframe src='small_info_frame.php?id=" + id + "'></iframe>";
}

$('.show-inf').on('click', function() {
    $('.riight-small-result').addClass('show');
    $('.contents-div').addClass('contents-div_riight-small-result');
});

function closeShowInfo() {
    var divShow = document.getElementById('itm_small_info');
    divShow.innerHTML = "close";
}

$('.close-inf-div').on('click', function() {
    $('.riight-small-result').removeClass('show');
    $('.contents-div').removeClass('contents-div_riight-small-result');
});

/////////////////////////////////////////
function sellDetails(val) {
    var display = document.getElementById('iframeDispayDiv');
    document.getElementById('mainContentsDiv').style.display = 'none';
    document.getElementById('SearchResult').style.display = 'block';


    // request for the data
    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "app_data/php/detailsSell.php";  // the file to look for the data
      var vars = "id="+val;
      request.open("POST", url, true); 

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("iframeDispayDiv").innerHTML = return_data;
          // load_Descission();
        }
      }
      // Send the data to PHP now... and wait for response to update the iframeDispayDiv div
      request.send(vars); // Actually execute the request
      document.getElementById("iframeDispayDiv").innerHTML = loaderDisplay();

}



// this display the stock pop up
function stockDetails(val) {
    var display = document.getElementById('iframeDispayDiv');
    document.getElementById('mainContentsDiv').style.display = 'none';
    document.getElementById('SearchResult').style.display = 'block';


    // request for the data
    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "app_data/php/detailsStock.php";  // the file to look for the data
      var vars = "id="+val;
      request.open("POST", url, true); 

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("iframeDispayDiv").innerHTML = return_data;
          // load_Descission();
        }
      }
      // Send the data to PHP now... and wait for response to update the iframeDispayDiv div
      request.send(vars); // Actually execute the request
      document.getElementById("iframeDispayDiv").innerHTML = loaderDisplay();

}


function sellDiversDetails(val) {
    var display = document.getElementById('iframeDispayDiv');
    document.getElementById('mainContentsDiv').style.display = 'none';
    document.getElementById('SearchResult').style.display = 'block';
    // display.innerHTML = '<iframe src="app_data/php/detailsDiverSell.php?id=' + val + '" name="contents_iframe" width="100%" height="" style="z-index:0;margin:0px;"></iframe>';



    // request for the data
    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "app_data/php/detailsDiverSell.php";  // the file to look for the data
      var vars = "id="+val;
      request.open("POST", url, true); 

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("iframeDispayDiv").innerHTML = return_data;
          // load_Descission();
        }
      }
      // Send the data to PHP now... and wait for response to update the iframeDispayDiv div
      request.send(vars); // Actually execute the request
      document.getElementById("iframeDispayDiv").innerHTML = loaderDisplay();


}


function ProductDetails(val) {
    var display = document.getElementById('iframeDispayDiv');
    document.getElementById('mainContentsDiv').style.display = 'none';
    document.getElementById('SearchResult').style.display = 'block';


    // request for the data
    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "app_data/php/detailsProduct.php";  // the file to look for the data
      var vars = "id="+val;
      request.open("POST", url, true); 

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
          document.getElementById("iframeDispayDiv").innerHTML = return_data;
          // load_Descission();
        }
      }
      // Send the data to PHP now... and wait for response to update the iframeDispayDiv div
      request.send(vars); // Actually execute the request
      document.getElementById("iframeDispayDiv").innerHTML = loaderDisplay();
}

// LOAD THE POPUP FOR THE BALANCE
function balanceDetails(id,type) {
    var display = document.getElementById('iframeDispayDiv');
    document.getElementById('mainContentsDiv').style.display = 'none';
    document.getElementById('SearchResult').style.display = 'block';


    // request for the data
    var request = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "app_data/php/detailsBalance.php";  // the file to look for the data
    var vars = "id=" + id + "&type=" + type;
    request.open("POST", url, true);

    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            document.getElementById("iframeDispayDiv").innerHTML = return_data;
            // load_Descission();
        }
    }
    // Send the data to PHP now... and wait for response to update the iframeDispayDiv div
    request.send(vars); // Actually execute the request
    document.getElementById("iframeDispayDiv").innerHTML = loaderDisplay();


}



function balanceModal(val, type = 'Invitation') {

    // request for the data
    var request = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
    var url = "app_data/php/balancePop.php";  // the file to look for the data
    var vars = "sel_id=" + val + "&type=" + type;
      request.open("POST", url, true); 

      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
          var return_data = request.responseText;
            document.getElementById("modalBalanceContainner").innerHTML = return_data;
          // load_Descission();
        }
      }
      // Send the data to PHP now... and wait for response to update the modalBalanceContainner div
      request.send(vars); // Actually execute the request
    document.getElementById("modalBalanceContainner").innerHTML = loaderDisplay();


}

////////////////////////////////////



function HideSearchDivContent() {
    document.getElementById('SearchResult').style.display = 'none';
    document.getElementById('mainContentsDiv').style.display = 'block';
    var display = document.getElementById('iframeDispayDiv');
    display.innerHTML = 'closed';

}


$('.user-view-pop-but').on('click', function() {
    $('.pop-user-info').addClass('show');
    $('.Overlay-Close-Pop').addClass('show');
    $('.pop-it').removeClass('bounceOut animated');
    $('.pop-it').addClass('bounceIn animated');

});

$('.Overlay-Close-Pop').on('click', function() {
    // $('.pop-it').removeClass('show');
    $('.Overlay-Close-Pop').removeClass('show');
    $('.pop-it').removeClass('bounceIn animated');
    $('.pop-it').addClass('bounceOut animated');

    // $('.contents-div').removeClass('contents-div_riight-small-result');
});

$('.print-sett-show').on('click', function() {
    $('.print-sett').toggleClass('show');
});
// $('.print-sett').hide();


$('.click').on('click', function() {
    $('.search-result-row').addClass('selected_result');
    // alert('hahah');
});

function headReport() {
    var TextU = document.getElementById('textHead').value;
    var displayT = document.getElementById('dispHead');
    displayT.innerHTML = TextU;
}


function printDeposit() {
    var printTypeSel = document.getElementById('printTypeSel').value;
    // .deposit-form-table {}
    // .invitation-deposit {}

    if (printTypeSel == 'all') {
        $('.deposit-form-table').show();
        $('.invitation-deposit').show();
        $('.balance-deposit').show();
    } else if (printTypeSel == 'invitation') {
        $('.invitation-deposit').show();
        $('.deposit-form-table').hide();
        $('.balance-deposit').hide();
    } else if (printTypeSel == 'deposit') {
        $('.deposit-form-table').show();
        $('.invitation-deposit').hide();
        $('.balance-deposit').hide();
    } else if (printTypeSel == 'balance') {
        $('.balance-deposit').show();
        $('.invitation-deposit').hide();
        $('.deposit-form-table').hide();
    } else if (printTypeSel == 'IB') {
        $('.balance-deposit').show();
        $('.invitation-deposit').show();
        $('.deposit-form-table').hide();
    }
}




// function chart(val) {
//   var sell = document.getElementsByClassName('sell_ch');
//   var design = document.getElementsByClassName('design_ch');
//   var invitation = document.getElementsByClassName('invitation_ch');
//   // ('className')
//     // alert(val);
//     // sell.addClass('hide');
//    sell.style.display='none';
//   // if (val != 0) {
//   // }
// }

$('.chart_sell_butt').on('click', function() {
    $('.sell_ch').show();
    $('.design_ch').hide();
    $('.invitation_ch').hide();
    $('.divers_ch').hide();
});

$('.chart_design_butt').on('click', function() {
    $('.sell_ch').hide();
    $('.design_ch').show();
    $('.invitation_ch').hide();
    $('.divers_ch').hide();
});

$('.chart_inv_butt').on('click', function() {
    $('.sell_ch').hide();
    $('.design_ch').hide();
    $('.divers_ch').hide();
    $('.invitation_ch').show();
});

$('.chart_diver_butt').on('click', function() {
    $('.sell_ch').hide();
    $('.design_ch').hide();
    $('.invitation_ch').hide();
    $('.divers_ch').show();
});

$('.chart_all_butt').on('click', function() {
    $('.sell_ch').show();
    $('.design_ch').show();
    $('.invitation_ch').show();
    $('.divers_ch').show();
});
// $('.contents-div').removeClass('contents-div_riight-small-result');

////// these are for the click buttoms
$('.search-option').on('click', function() {
    $('.report-controls').toggleClass('show');
});


// ------------------------------------------------------------------

// rete function
function change_rate_receive(rw, co, from, to, amount) {
    // dol -> dolar
    //  fc -> congolais
    //  rw ->  rwandans
    if (from == 'dol' && to == 'fc') { // (1)
        return amount * co; // formula

    } else if (from == 'dol' && to == 'rw') { // (2)
        return amount * rw; // formula

    } else if (from == 'fc' && to == 'dol') { // (3)
        return amount / co; // formula

    } else if (from == 'fc' && to == 'rw') { // (4)
        return (amount / co) * rw;

    } else if (from == 'rw' && to == 'dol') { // (5)
        return amount / rw; // formula


    } else if (from == 'rw' && to == 'fc') { // (6)
        return (amount / rw) * co; // formula

    }
}

function processF() {

    // rate variavles textbox
    var rateRw = document.getElementById('rateRw');
    var rateCo = document.getElementById('rateCo');
    var paymentType = document.getElementById('paymentType');

    var priceUnitD = document.getElementById('priceUnitD'); // Price Units
    var priceUnitR = document.getElementById('priceUnitR'); // Price Units
    var priceUnitFc = document.getElementById('priceUnitFc'); // Price Units


    var quantity = document.getElementById('quantity'); // quantity

    var inCashDol = document.getElementById('inCashDol'); // input dollar
    var inCashRw = document.getElementById('inCashRw'); // input Rwandans
    var inCashFc = document.getElementById('inCashFc'); // input congo

    var balCashDol = document.getElementById('balCashDol'); // input balance dolar
    var balCashRw = document.getElementById('balCashRw'); // input balance rw
    var balCashFc = document.getElementById('balCashFc'); // input balance Fc

    // TOTAL PRICE
    var totalPrice = document.getElementById('totalPrice'); // sum from the input in a selected type
    var totalPriceRw = document.getElementById('totalPriceRw'); // the sum of the input in Rw

    // TOTAL AVAILABLE
    var totalAvailable = document.getElementById('totalAvailable'); // sum from the input in a selected type
    var totalAvailableRw = document.getElementById('totalAvailableRw'); // the sum of the input in Rw




    var totalBalRw = document.getElementById('totalBalRw'); // sum from the input

    // CASH IN HAND laber
    var inCashDolLabel = document.getElementById('inCashDolLabel'); // input dollar
    var inCashRwLabel = document.getElementById('inCashRwLabel'); // input Rwandans
    var inCashFcLabel = document.getElementById('inCashFcLabel'); // input congo

    var totalBalanceType = document.getElementById('totalBalanceType'); // this will store the balance in a given type
    var cashTypDisplay = document.getElementById('cashTypDisplay');
    var balTypDisplay = document.getElementById('balTypDisplay');

    // inCashRwLabel.innerHTML = "you are the next";

    // --------
    var minTot; // minnimum variable of total price
    var minAva; // minnimum variable of avariable price
/*  */
    // CALCULATE THE SUM INPUT IN RWANDANS
    // translate the receive cash nto Rwandans
    var inCashDolNew = change_rate_receive(rateRw.value, rateCo.value, 'dol', 'rw', inCashDol.value); // change Dol to RW
    var inCashFcNew = change_rate_receive(rateRw.value, rateCo.value, 'fc', 'rw', inCashFc.value); // change Cong to RW
    var inCashRwNew = inCashRw.value; // is a selected type
    var sumInput = Number(inCashRwNew) + Number(inCashFcNew) + Number(inCashDolNew); // this is the summ of all input

    if (paymentType.value == 'frw') { //************************************************************************************
        // TOTAL PRICE

        // resset the balance to Zero
        balCashFc.value = 0;
        balCashDol.value = 0;
        balCashRw.value = 0;

        // changing the oppacity of the rest of data
        $('.frw-cont').removeClass('opacity-low');
        $('.frw-cont').addClass('pulse animated');

        // hide the -cont
        $('.dol-cont').addClass('opacity-low');
        $('.fc-cont').addClass('opacity-low');



        // Finding the Price total Type
        totalPrice.value = quantity.value * priceUnitR.value; // this will depend on a selected value

        // changing the total price in Rwandans
        tpRw = quantity.value * priceUnitR.value; // no need of special function
        totalPriceRw.value = tpRw.toFixed(2)

        // TOTAL AVAILABLE
        // Finding the total available Type
        totalAvailable.value = sumInput.toFixed(2); // this will depend on a selected value

        // changing the total available in Rwandans
        totalAvailableRw.value = sumInput.toFixed(2); // no need of special function

        // DISPLAY FOR LABEL IN CASH
        if (sumInput >= Number(totalPriceRw.value)) {
            // alert('payment done');
            inCashRwLabel.innerHTML = '0';
            inCashDolLabel.innerHTML = '0';
            inCashFcLabel.innerHTML = '0';
        } else {
            var cash2 = Number(totalPriceRw.value) - sumInput;
            inCashRwLabel.innerHTML = cash2.toFixed(2);
            inCashDolLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
            inCashFcLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
        }

        // CALCULATE THE BALANCE RW
        if (sumInput >= Number(totalPriceRw.value)) {
            balCashRw.value = '0';
        } else {
            var cashx1 = Number(totalPriceRw.value) - sumInput;
            balCashRw.value = cashx1.toFixed(2);
        }

        // NEW ..... LABEL AFTER TEXT AREAaa
        cashTypDisplay.innerHTML = "Frw"; // displaying the value
        cashTypDisplay1.innerHTML = "Frw"; // displaying the value
        cashTypDisplay2.innerHTML = "Frw"; // displaying the value

        // removing the class on the PU
        $('.puRwGrpup').addClass('has-success');
        $('.puDolGrpup').removeClass('has-success');
        $('.puFcGrpup').removeClass('has-success');

        $('.popover').show(); // show the popup


    } else if (paymentType.value == 'dol') { //************************************************************************************
        // SELECTED IN DOLARS

        // resset the balance to Zero
        balCashFc.value = 0;
        balCashDol.value = 0;
        balCashRw.value = 0;

        // changing the oppacity of the rest of data
        $('.dol-cont').removeClass('opacity-low');
        $('.dol-cont').addClass('pulse animated');

        // hide the -cont
        $('.frw-cont').addClass('opacity-low');
        $('.fc-cont').addClass('opacity-low');


        // TOTAL PRICE
        // Finding the Price total Type
        totalPrice.value = (quantity.value * priceUnitD.value).toFixed(2); // this will depend on a selected value

        // changing the total price in Rwandans
        totalPriceRw.value = change_rate_receive(rateRw.value, rateCo.value, 'dol', 'rw', totalPrice.value).toFixed(2);

        // TOTAL AVAILABLE
        // Finding the total available Type
        var cvg = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', sumInput);
        totalAvailable.value = cvg.toFixed(2); // this will depend on a selected value

        // display the total available in Rwandans
        totalAvailableRw.value = sumInput.toFixed(2); // no need of special function

        // DISPLAY FOR LABEL IN CASH
        if (sumInput >= Number(totalPriceRw.value)) {
            // alert('payment done');
            inCashRwLabel.innerHTML = '0';
            inCashDolLabel.innerHTML = '0';
            inCashFcLabel.innerHTML = '0';
        } else {
            var cash2 = Number(totalPriceRw.value) - sumInput;
            inCashRwLabel.innerHTML = cash2.toFixed(2);
            inCashDolLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
            inCashFcLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
        }

        // CALCULATE THE BALANCE RW
        if (sumInput >= Number(totalPriceRw.value)) {
            balCashDol.value = '0';
        } else {
            var cash2 = Number(totalPriceRw.value) - sumInput;
            balCashDol.value = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
        }

        // NEW ..... LABEL AFTER TEXT AREAaa
        cashTypDisplay.innerHTML = "$"; // displaying the value
        cashTypDisplay1.innerHTML = "$"; // displaying the value
        cashTypDisplay2.innerHTML = "$"; // displaying the value

        // removing the class on the PU
        $('.puRwGrpup').removeClass('has-success');
        $('.puDolGrpup').addClass('has-success');
        $('.puFcGrpup').removeClass('has-success');

        $('.popover').show(); // show the popup


    } else if (paymentType.value == 'fc') { //************************************************************************************
        // SELECTED IN DOLARS


        // resset the balance to Zero
        balCashFc.value = 0;
        balCashDol.value = 0;
        balCashRw.value = 0;


        // changing the oppacity of the rest of data
        $('.fc-cont').removeClass('opacity-low');
        $('.fc-cont').addClass('pulse animated');

        // hide the -cont
        $('.frw-cont').addClass('opacity-low');
        $('.dol-cont').addClass('opacity-low');



        // TOTAL PRICE
        // Finding the Price total Type
        totalPrice.value = (quantity.value * priceUnitFc.value).toFixed(2); // this will depend on a selected value

        // changing the total price in Rwandans
        totalPriceRw.value = change_rate_receive(rateRw.value, rateCo.value, 'fc', 'rw', totalPrice.value).toFixed(2);

        // TOTAL AVAILABLE
        // Finding the total available Type
        var cvg = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', sumInput);
        totalAvailable.value = cvg.toFixed(2); // this will depend on a selected value

        // display the total available in Rwandans
        totalAvailableRw.value = sumInput.toFixed(2); // no need of special function

        // DISPLAY FOR LABEL IN CASH
        if (sumInput >= Number(totalPriceRw.value)) {
            // alert('payment done');
            inCashRwLabel.innerHTML = '0';
            inCashDolLabel.innerHTML = '0';
            inCashFcLabel.innerHTML = '0';
        } else {
            var cash2 = Number(totalPriceRw.value) - sumInput;
            inCashRwLabel.innerHTML = cash2.toFixed(2);
            inCashDolLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'dol', cash2).toFixed(2);
            inCashFcLabel.innerHTML = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
        }

        // CALCULATE THE BALANCE RW
        if (sumInput >= Number(totalPriceRw.value)) {
            balCashFc.value = '0';
        } else {
            var cash2 = Number(totalPriceRw.value) - sumInput;
            balCashFc.value = change_rate_receive(rateRw.value, rateCo.value, 'rw', 'fc', cash2).toFixed(2);
        }

        // NEW ..... LABEL AFTER TEXT AREAaa
        cashTypDisplay.innerHTML = "Fc"; // displaying the value
        cashTypDisplay1.innerHTML = "Fc"; // displaying the value
        cashTypDisplay2.innerHTML = "Fc"; // displaying the value

        // removing the class on the PU
        $('.puRwGrpup').removeClass('has-success');
        $('.puDolGrpup').removeClass('has-success');
        $('.puFcGrpup').addClass('has-success');

        $('.popover').show(); // show the popup



    }
    // sell progress
    var sell_progress = document.getElementById('sell-progress');

    if (Number(totalAvailableRw.value) > Number(totalPriceRw.value)) {
        sell_progress.innerHTML = "<u class='fa fa-star'></u> <u class='fa fa-star'></u> <u class='fa fa-star'></u> <u class='fa fa-star'></u> <u class='fa fa-star'></u>";
        sell_progress.style.color = "#02bf08";

    } else if (totalAvailableRw.value == totalPriceRw.value) {
        sell_progress.innerHTML = "<u class='fa fa-star'></u> <u class='fa fa-star'></u> <u class='fa fa-star'></u> <u class='fa fa-star'></u> <u class='fa fa-star-o'></u>";
        sell_progress.style.color = "#03A9F4";

    } else {
        sell_progress.innerHTML = "<u class='fa fa-star-half-o'></u> <u class='fa fa-star-o'></u> <u class='fa fa-star-o'></u> <u class='fa fa-star-o'></u> <u class='fa fa-star-o'></u>";
        sell_progress.style.color = "red";


    }


    // work with the balance select
    if (balCashDol.value == 0 && balCashRw.value == 0 && balCashFc.value == 0) {
        document.getElementById('cashTypeSelect').innerHTML = `
        <option value="Done">Done</option>
        <option value="Avance">Avance</option>
        `;
    } else {
        document.getElementById('cashTypeSelect').innerHTML = `
        <option value="Avance">Avance</option>
        <option value="Done">Done</option>
        `;
    }

} // end of main functions




// for the pop up
var win = null;

function NewWindow(mypage, myname, w, h, scroll) {
    LeftPosition = 20;
    TopPosition = (screen.height) ? (screen.height - h) / 2 : 0;
    settings =
        'height=' + h + ',width=' + w + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=' + scroll + ',resizable'
    win = window.open(mypage, myname, settings)
    win.focus()
}


// datechangevisible
function datechangevisible() {
    $('.date-display').addClass('date-changed');
}










// used to display errors
function errorShow(body, type = 0) {
    var ErrorContainner = document.getElementById('errorPopContainner');
    if (type == '1') {
        ErrorContainner.innerHTML += `
      <div class="alert alert-success alert-dismissible zoomIn animated" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Well done!</strong> ${body}
      </div>    
    `;
    } else {
        ErrorContainner.innerHTML += `
      <div class="alert alert-warning alert-dismissible shake animated" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong>  ${body}
      </div>    
    `;
    }

    setInterval(function () {
        ErrorContainner.innerHTML = ''; 
    }, 9000);

}






$('.image-stock-pop').on('click', function search_div() {
    $('.image-stock-pop').toggleClass('image-pop');
});

