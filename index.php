<?php
// Connect to DB
 $con = mysqli_connect('162.241.219.131','tinyfee4_Team','k-k)6ih8URbs','tinyfee4_sources');

//  Form handling
//  ** page needs to reload to be able to use an zip integer input from a form because
//  chart is loaded on page load.  This would require separating the chart code in a separate file and re-loading
//  it when a zip is submitted.  For now the zip value is hard-coded.  May also be able to call js function
//  that graphs the chart again.**
//  ** Any null values in the database will cause the chart not to load, hence why I am using a zip code as
//  a hard-coded example that does not have any null values.  Could probably be solved with null coelesce operator ** 

// $zip = $_POST['zip'] ?? NULL;

?>

<!DOCTYPE html>
<html>
<head>
<title>Tiny Feet Toolkit</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Climate Action Plan, toolkit, Green House Gas Emissions, Colorado, Tiny Feet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);

  function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Sector', 'GHG Emissions'],
  // This php block makes a query, connects to the db, executes it, returns values array as $row
  // which needs to be parsed to have it's values associated with the column titles. It fills in the rest of the
  // matrix being used as an input for the arrayToDataTable() function.
  <?php
    $zip = 81631;
    $dataQuery = "SELECT * from v_sectorAllTotalGHG_zip WHERE zip = "."$zip";
    $row = mysqli_fetch_array(mysqli_query($con,$dataQuery));
    echo "['cement_and_manufacturing',{$row['cement_and_manufacturing']}],
          ['waste',{$row['waste']}],
          ['electricity_commercial',{$row['electricity_commercial']}],
          ['electricity_industrial',{$row['electricity_industrial']}],
          ['electricity_residential',{$row['electricity_residential']}],
          ['naturalGas_commercial',{$row['naturalGas_commercial']}],
          ['naturalGas_industrial',{$row['naturalGas_industrial']}],
          ['naturalGas_residential',{$row['naturalGas_residential']}],
          ['transportation_PV_gas',{$row['transportation_PV_gas']}],
          ['transportation_PV_diesel',{$row['transportation_PV_diesel']}],
          ['transportation_trucks_gas',{$row['transportation_trucks_gas']}],
          ['transportation_trucks_diesel',{$row['transportation_trucks_diesel']}],
          ['aviation',{$row['aviation']}]
        ";
    ?>
  ]);

  var options = {
  title: 'All Sector GHG Emissions',
    pieHole: 0.5,
            pieSliceTextStyle: {
              color: 'black',
            },
            legend: 'none',
  };
  
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart12"));
  chart.draw(data,options);
  }

  </script>

<style>
body {font-family: Arial;}
html {background-color:#e6ffe6}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc; /*ccc*/
  background-color: #b9ffe7; /*f1f1f1*/
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #99ffdd;/*#ddd;*/
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #7fffd4;/*#ccc;*/
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
#main-header{
      text-align:center;
      background-color:green;
      color:white;
      padding:10px;
}
#main-footer{
      text-align:center;
      font-size:18px;
}

.btn {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 30px;
  cursor: pointer;
  font-size: 20px;
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}

</style>
</head>
<body>

  <header id="main-header">
    <h1>Tiny Feet Toolkit</h1>
  </header>

<center><p>A toolkit to help create Climate Action Plans</p></center>

<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Home')" id="defaultOpen">Home</button>
  <button class="tablinks" onclick="openTab(event, 'Emissions Estimation')">Emissions Estimation</button>
  <button class="tablinks" onclick="openTab(event, 'Recommend Actions')">Recommend Actions</button>
  <button class="tablinks" onclick="openTab(event, 'Toolkit')">Toolkit</button>
  <button class="tablinks" onclick="openTab(event, 'News')">News</button>
  <button class="tablinks" onclick="openTab(event, 'chartData')">Pie Chart</button>
</div>

<div id="Home" class="tabcontent">
  <h3>Home</h3>
  <p>Home will have general about us. This includes Background, and an Overview and How to do things</p>
  <a href="blastersmall.png">
      <img src="blastersmall.png" alt="Blaster Logo" width="200">
    </a>
  <a href="Western_Colorado_Mountaineers_logo.png">
      <img src="Western_Colorado_Mountaineers_logo.png" alt="Western Logo" width="200">
    </a>
</div>

<div id="Emissions Estimation" class="tabcontent">
  <h3>Emissions Estimation</h3>
  <p>Emissions Estimation will display a heat map of Colorado by zip code with the data from out database. It will also have an option to download the data from our database?</p> 

  <iframe src="http://tinyfeettoolkit.com/map/" style="height:45vw;width:100%;" title="Iframe Example"></iframe>
  <br>
  <br>
  <br>
  <button class="btn"><i class="fa fa-download"></i> Download All Data</button>
</div>

<div id="Recommend Actions" class="tabcontent">
  <h3>Recommend Actions</h3>
  <p>Recommend Actions will list an explanation of all recommended actions and their impact. It shows the general recommendations we will provide on the website as well as our sources for all recommendations. Finally it will have links to other actions and resources.</p>
</div>



<div id="Toolkit" class="tabcontent">
  <h3>Toolkit</h3>
  <p>Community Action and Emissions will have the input of the user's zip, city, or county and display in a table, pie chart, etc the emissions of that region. There will be an option to export the region specific data as well. Then the user will fill out an action survey and will be provided recommended community actions based on emission results and survey data.</p>

      <!-- Forms-->
    <form action="Gillian-test-3.php" method="post">
      <div>
        <label>Zip Code/City/County</label>
        <input type="number" name="region_ID" placeholder="Enter Location">
        <input type="submit" name="submit_location" value="Submit">
      </div>
      <br>
    </form>
    <form action="fake.php" mehtod="post">
      <h4>Action Survey</h4>
      <div>
        <label>Question01:</label>
        <input type="text" name="Question01" placeholder="answer">
      </div>
      <br>
      <div>
        <label>Question02:</label>
        <input type="text" name="Question02" placeholder="answer">
      </div>
      <br>
      <div>
        <label>Long Response:</label>
        <textarea name="message" placeholder="Enter Message Here"></textarea>
      </div>
      <br>
      <div>
        <label>Question03:</label>
        <select name="Question03">
          <option value="answer01">answer01</option>
          <option value="answer02">answer02</option>
          <option value="answer03">answer03</option>
        </select>
      </div>
      <br>
        <div>
          <label>Number Question04:</label>
          <input type="number" name="Question04" placeholder="###">
        </div>
        <br>
        <div>
          <label>Date Question?:</label>
          <input type="date" name="birthday">
        </div>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>

</div>

<div id="News" class="tabcontent">
  <h3>News</h3>
  <p>Relevant news articles and other resources.</p>
</div>

<div id="chartData" class="tabcontent">
<h1>See All Sector Data For A Chosen Zip Code</h1>
<!-- <form action="/" method="POST">
    <label>Enter Zip Code</label>
    <input name="zip" type="number" min="80001" max="81658">
    <input type="submit">
</form> -->
  <!--Div that will hold the pie chart-->
  <div id="columnchart12" style="width: 100%; height: 1000px;"></div>
</div>

<script>
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>

</body>
</html> 
