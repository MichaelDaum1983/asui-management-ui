<!DOCTYPE HTML>
<!--**
 * Created by PhpStorm.
 * User: mrogowski
 * Date: 02.02.2018
 * Time: 14:30
 *-->
<?php //include_once 'inc/inc_db.php';
//      include_once 'functions/f_search.php';
//      include_once 'functions/f_right_side.php'; ?>
<html>

<head>
  <meta charset="utf-8"
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
          href="css/style.css">
    <link rel="stylesheet"
          href="css/navigation.css">
  <TITLE>BM CS -- BMSS Calculator</TITLE>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js">    </script>
</head>
<body>
<header>

</header>
<div class="body">

    <!-- Navigation Bar-->
    <div class="nav-container">
     <div class="logo"></div>
        <nav class="navigation">
            <ul class="nav-ul">
<!--                <li><a href='index.php'">Home</a></li>-->
<!--                <li><a href="#">New Incident</a></li>-->
<!--                <li><a href="#">New WebTraining</a></li>-->
<!--                <li><a href="#">Reports</a></li>-->
                <li><a href="bmsspricing.php">BMSS Price Calculator</a></li>
<!--                <li><a href="backend.php">Backend</a></li>-->
            </ul>
        </nav>
    </div>
    <!-- End of navigation -->
    <div class="space"></div> <!-- creates needed space, so no information is displayed behind the navigation-->

    <!-- Price Calulator-->
    <form action="" class="bmsspricing">
        <H1>Please Select the Customer Setup</H1>
        <fieldset style="width: 100%">
            <label for="herdsize">Select HerdSize (only Dairy Cows, Youngstock is included for free)</label><br>
            <select id="herdsize">
                <option value="1">1 -  200 Cows</option>
                <option value="2">1 -  500 Cows</option>
                <option value="3">1 - 1000 Cows</option>
                <option value="4">1 - 1500 Cows</option>
                <option value="5">1 - Unlimited Cows</option>
            </select>
            <br>
            <br>
            <label for="modules">Extra modules</label><br>
           <select id="modules"
                   multiple="multiple">
               <option value="1">Advanced</option>
               <option value="4">Link Nedap Velos licence 2(Tag data and graphs)</option>
               <option value="2">Country Link</option>
               <option value="3">Interface App</option>
           </select><br>
            <input type="button"
                   onclick = "calculate()"
                   value="Calculate">
        </fieldset>
    </form>
<div id="output" class="bmsspricing">

</div>
</div>
</body>
<script type="text/javascript">
    function calculate(){
        //Get Elements
        var selectedherdsize = document.getElementById("herdsize");
        var selectedmodules = document.getElementById("modules");
        //Create String
        var herdsize = selectedherdsize.value;
        //Check which Herdsize has been selected. Name and pricing will be stored within an array.
        if (herdsize == 1) {
            var herdsize_out = [
                "1 - 200 Cows",
                "415",
                "500",
                "650",
                "362"];
        }
        else if (herdsize == 2) {
            var herdsize_out = [
               "1 - 500 Cows",
                "546",
                "550",
                "730",
                "467"];
        }
        else if (herdsize == 3) {
            var herdsize_out = [
                "1 - 1000 Cows",
                "677",
                "600",
                "810",
                "572"];
        }
        else if (herdsize == 4) {
                var herdsize_out = [
                "1 - 1500 Cows",
                "809",
                "650",
                "890",
                "677"];
        }
        else if (herdsize == 5) {
            var herdsize_out = [
                "1 - Unlimited Cows",
                "940",
                "700",
                "970",
                "782"];
        }
        var ergebnis = "<H2>BMSS Price</H2><table style='margin: 0 auto'><th>Name</th><th>Price in €/Year</th><th>Price in US $/Year</th><th>Price in CAD $/Year</th><th>Price in Pound/Year</th>";
        ergebnis += "<tr><td>" + herdsize_out[0] +" </td><td> " + herdsize_out[1] +"  €</td><td>" + herdsize_out[2] +" $ US</td><td> " + herdsize_out[3] +" $ CAD</td><td> " + herdsize_out[4] +" £</td></tr>";
        //define variables for each currency and store the selected herdsize value. This var will be used later to add the price for each module
        var amount_euro = herdsize_out[1];
        var amount_usd = herdsize_out[2];
        var amount_cad = herdsize_out[3];
        var amount_pound = herdsize_out[4];

        var nummodules = document.getElementById("modules");
        for (i=0; i < nummodules.length; i++){
            actual_selected = modules[i];
            if (actual_selected.selected == true){
                actual_selected_val = actual_selected.value;
                if (actual_selected_val == 1) {
                    var module1 = [
                        "Advanced", //Name
                        "120", // Price Euro
                        "120", // Price USD
                        "150", // Price CAD Dollar
                        "95"]; // Price Pound
                    ergebnis += "<tr><td>" + module1[0] +"</td><td> " + module1[1] +"  €</td><td>" + module1[2] +" $ US</td><td> " + module1[3] +" $ CAD</td><td> " + module1[4] +" £</td></tr>";
                    amount_euro = amount_euro - - module1[1];
                    amount_usd = amount_usd - - module1[2];
                    amount_cad = amount_cad - - module1[3];
                    amount_pound = amount_pound - - module1[4];
                }
                else if (actual_selected_val == 2) {
                    var module2 = [
                        "Country Link", //Name
                        "120", // Price Euro
                        "120", // Price USD
                        "150", // Price CAD Dollar
                        "95"]; // Price Pound
                    ergebnis += "<tr><td>" + module2[0] +"</td><td> " + module2[1] +"  €</td><td>" + module2[2] +" $ US</td><td> " + module2[3] +" $ CAD</td><td> " + module2[4] +" £</td></tr>";
                    amount_euro = amount_euro - - module2[1];
                    amount_usd = amount_usd - - module2[2];
                    amount_cad = amount_cad - - module2[3];
                    amount_pound = amount_pound - - module2[4];
                }
                if (actual_selected_val == 3) {
                    var module3 = [
                        "HMX App", //Name
                        "95", // Price Euro
                        "95", // Price USD
                        "110", // Price CAD Dollar
                        "95"]; // Price Pound
                    ergebnis += "<tr><td>" + module3[0] +"</td><td> " + module3[1] +"  €</td><td>" + module3[2] +" $ US</td><td> " + module3[3] +" $ CAD</td><td> " + module3[4] +" £</td></tr>";
                    amount_euro = amount_euro - - module3[1];
                    amount_usd = amount_usd - - module3[2];
                    amount_cad = amount_cad - - module3[3];
                    amount_pound = amount_pound - - module3[4];
                }
                if (actual_selected_val == 4) {
                    var module4 = [
                        "Link Nedap Velos licence 2", //Name
                        "125", // Price Euro
                        "125", // Price USD
                        "150", // Price CAD Dollar
                        "89"]; // Price Pound
                    ergebnis += "<tr><td>" + module4[0] +"</td><td> " + module4[1] +"  €</td><td>" + module4[2] +" $ US</td><td> " + module4[3] +" $ CAD</td><td> " + module4[4] +" £</td></tr>";
                    amount_euro = amount_euro - - module4[1];
                    amount_usd = amount_usd - - module4[2];
                    amount_cad = amount_cad - - module4[3];
                    amount_pound = amount_pound - - module4[4];
                }
            }
        }
        ergebnis += "<tr><td class='tblsum'> Total </td><td class='tblsum'> " + amount_euro +"  €</td><td class='tblsum'>" + amount_usd +" $ US</td><td class='tblsum'> " + amount_cad +" $ CAD</td><td class='tblsum'> " + amount_pound +" £</td></tr>";
        ergebnis += "</table>";

        output = document.getElementById("output");
        output.innerHTML = ergebnis;
    }

</script>
</html>
