<?php

include './backend/config.php';
$lottery_result = [];
date_default_timezone_set('Asia/Kolkata');
$currentDate = date("Y-m-d");
$current_time = date("H:i:s");
$sql = "SELECT date, time, old_number, number as new_number FROM result where date = current_date() and time <= '$current_time'";
$result = $conn->query($sql);
$num_rows = $result->num_rows;
$count = 0;
if ($num_rows == 0) {
   $sql = "SELECT current_date() as date, time, number as old_number, 'wait..' as new_number FROM result where date = current_date()-1";
   $result = $conn->query($sql);
   while ($row = $result->fetch_assoc()) {
      array_push($lottery_result, $row);
   }
} else {
   while ($row = $result->fetch_assoc()) {
      array_push($lottery_result, $row);
      $count++;
      if ($count == $num_rows) {
         $sql = "SELECT current_date() as date, time, number as old_number, 'wait..' as new_number FROM result where date = current_date()-1 and time > '" . $row['time'] . "'";
         $result = $conn->query($sql);
         while ($row = $result->fetch_assoc()) {
            array_push($lottery_result, $row);
         }
      }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
   <meta charset="utf-8">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="pragma" content="no-cache" />
   <meta name="description" content="Kalkaji Lottery play game and lottery results of Kalkaji Lottery find lottery history results">
   <meta name="author" content="">
   <meta http-equiv="refresh" content="3600;url=https://kalkajilottery.com/cron/insert_result.php">

   <title>Kalkaji Lottery</title>
   
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- Custom fonts for this template -->
   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <!-- Custom styles for this template -->
   <link href="./assets/css/grayscale.min.css" rel="stylesheet">
   <link rel="stylesheet" href="./assets/css/style.css" type="text/css" media="screen" />
   <link rel="stylesheet" href="./assets/css/jquery.slotmachine.css" type="text/css" media="screen" />
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="./assets/js/slotmachine.js"></script>
   <script src="./assets/js/jquery.slotmachine.js"></script>
   <script>
      var myVar = setInterval(function() {
         myTimer()
      }, 1000);

      function myTimer() {
         var d = new Date();
         var t = d.toLocaleTimeString();
         document.getElementById("time").innerHTML = t;
      }
   </script>
   <style>
      .masthead {
         background-image: url(./assets/images/bg-1.webp);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
      }

      tr th {
         background-color: #002fff;
      }
      
      

      
.page_wrap {padding: 0px;
    width: 100%;}

      
      .banner_section2 .banner_wrap {
   max-width: 600px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: end;
    height: 100%;
    position: relative;
}
.banner_section2 .banner_wrap .circle_wrap {
    position: absolute;
    top: -3%;
    left: 22%;
    transform: translate(-50px, -50px);
    z-index: 0;
}
.banner_section2 .banner_wrap .circle_wrap .circle_img{
   animation: rotate-animation 10s infinite linear;
}
.banner_section2 .banner_heading{
   background:#000;
   color:#fff;
   text-align: center;
    font-weight: 600;
    padding:10px 0;
    box-shadow: 0px 10px 20px 4px #596b88;
}
.banner_section2{
    margin-bottom:50px;
}

@keyframes rotate-animation {
	0% {
		transform: rotate(0deg);
  }
  50% {
		transform: rotate(180deg);
	}
	100% {
		transform: rotate(360deg);
	}
}
.banner_section2 .banner_wrap .circle_wrap .circle_img{
       width: 140%;
}
.banner_section2 .banner_wrap .shiv_img {
       z-index: 2;
       width:100%;
}

 @media only screen and (max-width:750px) {
   .banner_section2 .banner_wrap .circle_wrap .circle_img {
    width: 110%;
}

.banner_section2 {
    margin-bottom: 0px !important;
    margin-top: 65px;
}
}

 @media only screen and (max-width:350px) {
      .banner_section2 .banner_wrap .circle_wrap .circle_img {
        width: 121%;
    }
}

   </style>
</head>

<body id="page-top" ng-app="LottoApp" ng-controller="HomeCtrl">
   <!-- Header -->
   <header class="masthead">
      <div class="container h-100 align-items-center">
         <div class="row mx-auto text-center mb-m">
         </div>
         <div class="row mx-auto text-center">
            <div class="col mx-auto" style="margin-top: 2px;  background: rgba(74,138,244,.2);">
               <div class="row">

                  <div class="col">
                     <h2 class="text-white glow"><b>Time Now</b></h2>
                  </div>
                  <div class="col">
                     <h2 class="text-white glow"><b>Date</b></h2>
                  </div>
               </div>
               <div class="row">

                  <div class="col">
                     <h4 class="text-white glow"><b><span id="time"></span></b></h4>
                  </div>
                  <div class="col">
                     <h4 class="text-white glow">
                        <script>
                           let currentDate = new Date();
                           let day = currentDate.toLocaleString("en-US", {
                              weekday: "long"
                           });
                           let month = currentDate.toLocaleString("en-US", {
                              month: "long"
                           });
                           let date = currentDate.getDate();
                           let year = currentDate.getFullYear();

                           document.write(`${day}|${date} ${month}  ${year}`);
                           let currentDateElement = document.getElementById("current-date");

                           setInterval(() => {
                              let currentDate = new Date();
                              let day = currentDate.toLocaleString("en-US", {
                                 weekday: "long"
                              });
                              let month = currentDate.toLocaleString("en-US", {
                                 month: "long"
                              });Current

                              let date = currentDate.getDate();
                              let year = currentDate.getFullYear();

                              currentDateElement.innerText = `${day}|${date} ${month}  ${year}`;
                           }, 1000);
                        </script>
                     </h4>
                  </div>
               </div>
            </div>
         </div>
         <div class="row mx-auto text-center">
            <div class="col mx-auto align-middle" style="margin-top: 2px; background: rgba(255,255,255,.2);">
            </div>
         </div>
         <div class="row mx-auto text-center">
            <div class="col">
               <div class="row" style="margin-top:10%;">
            
                  <div class="banner_section2">
                  
                  <div class="banner_wrap">
            <img class="shiv_img" src="./assets/images/mata-ji.webp" alt="">
            <div class="circle_wrap">
                <img class="circle_img" src="./assets/images/circle.png" alt="">
            </div>
            </div>
        </div>
        
        
               </div>
            </div>
         </div>
      </div>
   </header>
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <!-- Datatable -->
   <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
   <div class="page_wrap">
      <!-- banner -->
      <div id="user">Online: 0</div>
      <section class="banner_section">
         <h2 class="banner_heading text-center" style="background:#002fff;">Kalkaji Lottery</h2>
      </section>
      <section class="section">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="d-flex flex-column text-center">
                     <div class="img_wrap ">
                        <button class="btn btn mb-4 p-3" style="background-color: #002fff; color:white">Kalkaji
                           Lottery</button>
                           <?php
                  $sql = "SELECT number FROM result WHERE date <= '$currentDate' and time <= '$current_time' ORDER BY id DESC LIMIT 1";
                  $result = $conn->query($sql);
                  $data = $result->fetch_assoc();
                  ?>
                        <div class="img_box">
                           <img class="gift_img" src="./assets/images/matka.png" alt="">
                           <span id="count" data-aos="zoom-in" data-aos-easing="ease" data-aos-duration="1000" style="text-align: center; z-index:1; color: #002fff;"><?php echo $data ? $data['number'] : $data['number']; ?></span>
                        </div>
                     </div>
                     <div class="button_grup mt-4">
                        <button class="btn btn-danger p-3" id="clock" style="background-color: #002fff; color:white;">
                           11:30 AM
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="section pt-0">
         <div class="container-fluid px_0">
            <div class="row">
               <div class="col-md-12" data-aos="fade-up" data-aos-easing="ease" data-aos-delay="200" data-aos-duration="1000">
                  <div class="table_scroll">
                     <table id="table" class="table table-hover">
                        <thead>
                           <tr style="background-color: #FF0000; z-index: 1 ; position: relative;">
                              <th style="background: #002fff ">S.no</th>
                              <th style="background: #002fff">Game</th>
                              <th style="background: #002fff">Time</th>
                              <th style="background: #002fff">Old Number</th>
                              <th style="background: #002fff">New Number</th>
                           </tr>
                        </thead>
                        <tbody>

                           <?php $index = 1;
                           foreach ($lottery_result as $data) { ?>
                              <tr>
                                 <td><?php echo $index; ?></td>
                                 <td>Kalkaji Lottery</td>
                                 <td><?php echo $data['time']; ?></td>
                                 <td><?php echo $data['old_number']; ?></td>
                                 <td><?php echo $data['new_number']; ?></td>
                              </tr>
                           <?php $index++;
                           } ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                     </table>
                  </div>
               </div>
               <div class="row justify-content-center">
                  <div class="col-md-2">
                     <form action="" method="" class=" mt-5">
                        <select name="year" id="search_year">
                           <option value="">Select Year</option>
                           <option value="2023">2023</option>
                           <option value="2024">2024</option>
                        </select>
                        <button type="button" class="btn btn-danger m-2 p-3" style="background-color: #002fff; color:white;" onclick="get_daily_data('monthly', null)">Search</button>
                        <button type="button" class="btn btn-danger m-2 p-3" style="background-color: #002fff; color:white;" onclick="get_daily_data('yearly', null)">Search All</button>
                     </form>
                  </div>
               </div>
            </div>
      </section>

      <section class="section pt-0">
         <div class="container-fluid px_0">
            <h1 class="fw-bold text-center mb-3" data-aos="flip-left" data-aos-easing="ease" data-aos-duration="1000">
               Daily Chart</h1>
            <div class="row">
               <div class="col-md-12" data-aos="fade-up" data-aos-easing="ease" data-aos-delay="200" data-aos-duration="1000">
                  <div class="table_scroll">
                     <table id="table2" class="table table-hover">
                        <thead>
                           <tr>
                              <th style="background: #002fff">Date</th>
                              <th style="background: #002fff">10:00 AM</th>
                              <th style="background: #002fff"> 11:00 AM</th>
                              <th style="background: #002fff"> 12:00 PM</th>
                              <th style="background: #002fff"> 1:00 PM</th>
                              <th style="background: #002fff"> 2:00 PM</th>
                              <th style="background: #002fff"> 3:00 PM</th>
                              <th style="background: #002fff"> 4:00 PM</th>
                              <th style="background: #002fff"> 5:00 PM</th>
                              <th style="background: #002fff"> 6:00 PM</th>
                              <th style="background: #002fff"> 7:00 PM</th>
                              <th style="background: #002fff"> 8:00 PM</th>
                              <th style="background: #002fff"> 9:00 PM</th>
                              <th style="background: #002fff"> 10:00 PM</th>
                              <th style="background: #002fff"> 11:00 PM</th>

                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        </tfoot>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="section pt-0">
         <div class="container">
            <div class="card text-center" data-aos="fade-up" data-aos-easing="ease" data-aos-delay="200" data-aos-duration="1000">
               <div class="card-body p-lg-5">
                  <h1 class="fw-bold">36 Jodi</h1>
                  <div>
                     <span class="pills">18</span>
                     <span class="pills">90</span>
                     <span class="pills">73</span>
                     <span class="pills">27</span>
                     <span class="pills">33</span>
                     <span class="pills">59</span>
                     <span class="pills">05</span>
                     <span class="pills">87</span>
                     <span class="pills">01</span>
                     <span class="pills">30</span>
                     <span class="pills">34</span>
                     <span class="pills">67</span>
                     <span class="pills">10</span>
                     <span class="pills">53</span>
                     <span class="pills">99</span>
                     <span class="pills">76</span>
                     <span class="pills">14</span>
                     <span class="pills">06</span>
                     <span class="pills">00</span>
                     <span class="pills">85</span>
                     <span class="pills">91</span>
                     <span class="pills">23</span>
                     <span class="pills">48</span>
                     <span class="pills">90</span>
                     <span class="pills">12</span>
                     <span class="pills">09</span>
                     <span class="pills">60</span>
                     <span class="pills">89</span>
                     <span class="pills">56</span>
                     <span class="pills">82</span>
                     <span class="pills">79</span>
                     <span class="pills">57</span>
                     <span class="pills">67</span>
                     <span class="pills">65</span>
                     <span class="pills">35</span>
                     <span class="pills">76</span>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <footer>
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="copyright_text">
                     <p>©<span id="year"></span> copyright | Kalkaji Lottery</p>
                  </div>
               </div>
            </div>
         </div>
      </footer>
   </div>
   <!-- Bootsrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Jquery -->
   <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
   <!-- Data table -->
   <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/af-2.5.3/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/kt-2.8.2/r-2.4.1/sp-2.1.2/datatables.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <!-- Animation -->
   <script>
      // Get all span elements with class "pills"
      const pillSpans = document.querySelectorAll('.pills');

      // Generate random numbers and assign to each span
      pillSpans.forEach((span) => {
         const randomNumber = Math.floor(Math.random() * 100) + 1;
         span.textContent = randomNumber;
      });
      document.addEventListener("DOMContentLoaded", function() {
         const pillSpans = document.querySelectorAll('.pills');
         pillSpans.forEach((span) => {
            const randomNumber = Math.floor(Math.random() * 100) + 1;
            span.textContent = randomNumber;
         });
      });
   </script>
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   <!-- Custom  -->
   <script>
      $(document).ready(function() {
         // $('#table').dataTable();
         // $('#table2').dataTable();
         var currentTime = new Date();
         var hours = currentTime.getHours();
         var minutes = currentTime.getMinutes();
         var ampm = hours >= 12 ? 'PM' : 'AM';
         hours = hours % 12;
         hours = hours ? hours : 12;
         if (hours < 10) {
            hours = '0' + hours;
         }
         if (minutes < 10) {
            minutes = '0' + minutes;
         }
         var formattedTime = hours + ':' + minutes + ' ' + ampm;
         $("#currentTime").text(formattedTime);
         AOS.init();

         function generate() {
            var randomNum = Math.floor((Math.random() * 5000) + 1);
            var el = $('#user');
            el.html('Online : ' + randomNum);
            var delay = Math.floor(Math.random() * 1000) + 5000;
            setTimeout(generate, delay);
         }
         generate();
      });
      document.getElementById("year").innerHTML = new Date().getFullYear();
   </script>
   <script>
      function updateClock() {
         let date = new Date();
         let hours = date.getHours()  % 12 || 12; // add 1 hour and handle 12-hour clock
         let ampm = date.getHours() >= 12 ? 'PM' : 'AM'; // determine AM/PM
         let time = hours + " :00 " + ampm;
         document.getElementById("clock").innerText = time;
         document.getElementById("clock1").innerText = time;
      }

      setInterval(updateClock, 1000);
   </script>
   <script>
      function get_daily_data(type, default_year) {
         const year = default_year != null ? default_year : $("#search_year").val();
         $.ajax({
            url: "./backend/ajax/daily_chart.php",
            type: 'post',
            data: {
               year: year,
               type: type
            },
            success: function(res) {
               $("#table2 tbody").empty();
               let data = JSON.parse(res);
               if (data.length == 0) {
                  $("#table2 tbody").html(`<tr><td colspan='15'>No data found for year ${year}</td></tr>`);
                  return;
               }
               let html = "";
               data.forEach(function(arr, idx) {
                  html += "<tr class='ml32023-10-01 odd'>";
                  arr.forEach(function(obj, idx) {
                     if (idx == 0) {
                        var d = obj.date;
                        d = d.split('-');
                        html += '<td class="dtr-control sorting_1">' + d[2] + '-' + d[1] + '-' + d[0] + '</td>';
                     }
                     html += `
                        <td>${obj.number}</td>
                     `;
                  })
                  html += "</tr>";
               })
               $("#table2 tbody").html(html);
            }
         })
      }

      const d = new Date();
      const default_year = d.getFullYear();
      get_daily_data('monthly', default_year.toString());

   </script>
   
</body>

</html>