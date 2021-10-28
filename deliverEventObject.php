<?php
   /*is identical to require except PHP will check if the file has already been included, and if so , not require it again
*/
require_once('connection.php');
require_once('event.php');

//PHP object assigned to an instance of the connection class
$connection = new Connection();
//open connection 
$conn = $connection->open();
//SQL query that selects the name, description, presenter, date and time columns from the wdv341_events table where the presenter is "Teddy Allen"
$sql = "SELECT name,description,presenter, date,time FROM wdv341_events  WHERE presenter='Teddy Allen' ";
//prepares sql statment template to be sent to database
$statement_obj = $conn->prepare($sql);
//database executes the statement
$statement_obj->execute();
//returns an array indexed by column name as returned in your result set
$results = $statement_obj->fetch(PDO::FETCH_ASSOC); 
//close connection
$conn = $connection->close();
//instantiate new event object
$phpOutputObj = new Event();
//set event object properties
$phpOutputObj->set_eventName($results['name']);
$phpOutputObj->set_eventDescription($results['description']);
$phpOutputObj->set_eventPresenter($results['presenter']);
$phpOutputObj->set_eventDate($results['date']);
$phpOutputObj->set_eventTime($results['time']);

//empty array
$phpEventsArray = [];  
//add event object to array
array_push($phpEventsArray, $phpOutputObj);
//encode Associative Array into JSON Object
$jsonOutputObj = json_encode($phpEventsArray);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="This is a web page that uses PHP to output MYSQL data to PHP array to a JSON string">
  <meta name="keywords" content="PHP, JSON">
  <meta name="author" content="Joshua Allen">
  <title>Formatting JSON Output</title>
  <script>
    //turn JSON Object into a Javascript Array
    var jsArray = <?php echo $jsonOutputObj; ?>;
  </script>
  <style>
     *,:after,:before{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}body{font:normal 15px/25px 'Open Sans',Arial,Helvetica,sans-serif;color:#444;text-align:left}h1,h2,h3{font-weight:400}h1{font:normal 40px/120px 'Open Sans',Arial,Helvetica,sans-serif;text-align:center;color:#444;margin:0}h1 span{color:#484c9b}h2{font-size:25px;line-height:30px;color:#484c9b;margin:50px 0 10px}h3{font-size:18px;line-height:35px;margin:50px 0 0}a{color:#484c9b;text-decoration:none}a:focus,a:hover{text-decoration:underline}p{margin:0 0 2rem}p span{color:#aaa}header{width:98%;margin:40px auto 0;border-bottom:1px solid #ddd;padding-bottom:40px;text-align:center}header p{margin:0}section{width:95%;max-width:910px;margin:40px auto}pre{background:#f9f9f9;padding:10px;font-size:12px;border:1px solid #eee;white-space:pre-wrap;border-radius:10px}table{border:1px solid #eee;background:#f9f9f9;width:100%;border-collapse:collapse;border-spacing:0;margin-bottom:3rem}thead{background:#5965af;color:#fff}tbody tr td,thead td{padding:.5rem .75rem}tbody tr:nth-child(even){background:#efefef}tbody tr td:first-child{padding-left:1.25rem}tbody tr td:first-child,tbody tr td:nth-child(3),thead td:first-child,thead td:nth-child(3){width:15%}tbody tr td:nth-child(2),thead td:nth-child(2){width:20%}tbody tr td:last-child,thead td:last-child{width:50%}@media only screen and (min-width:768px){body{font-size:20px;line-height:30px}h2{font-size:30px;line-height:45px}h3{font-size:22px;line-height:45px;margin-top:50px}p{margin-bottom:2rem}h1{font-size:60px}pre{padding:20px;font-size:15px}}
     thead th {
       width: 20%;
     }
     main {
       margin-bottom: 150px;
     }
     footer {
       border-top: 1px solid #ddd;
       height: 70px;
     }
     #jsonDelivery::before {
        content: 'JSON:';
        color: red;
        font-size: 25px;
     }
     #jsonDelivery {
       margin-bottom: 90px;
     }
     header {
       margin-bottom: 30px;
     }
  </style>
</head>
<body>
  <header>WDV341 Formatting JSON Output</header>
  <main><div id="jsonDelivery"></div>
  <table>
  <caption>WDV341 Events Table</caption>
    <thead>
    <th>Event Name</th><th>Event Description</th><th>Event Presenter</th><th>Event Date</th><th>Event Time</th>
    </thead>
    <tbody>
    <tr><td id="eventName"></td><td id="eventDescription"></td><td id="eventPresenter"></td><td id="eventDate"></td><td id="eventTime"></td></tr>
    </tbody>
       </table>
  </main>
  <footer>
    <p> &#169; WDV341</p>
    <address>Contact us: wdv341@341.com 
    </address>
  </footer>
  <script>
    document.getElementById("eventName").innerHTML = jsArray[0].eventName;
    document.getElementById("eventDescription").innerHTML = jsArray[0].eventDescription;
    document.getElementById("eventPresenter").innerHTML = jsArray[0].eventPresenter;
    document.getElementById("eventDate").innerHTML = jsArray[0].eventDate;
    document.getElementById("eventTime").innerHTML = jsArray[0].eventTime;
    document.getElementById("jsonDelivery").innerHTML = JSON.stringify(jsArray);
  </script>
</body>
</html>

 
      

     
    
      

     
      
      
    
    
  
  
  
