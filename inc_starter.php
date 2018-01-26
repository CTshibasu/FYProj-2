<?php
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(-1);

  include '/Applications/MAMP/htdocs/SessionCURL/appUI/funBlocks/test_session.php';

  // now this will be a reference for the activity sessions
  // this will require function calls from php scripts
  // for each of the cards sections:

  // call the functions for 5 sections: tunes, sessions, events, recordings & discussions
  // here, it'd be preferable to dump data from the top of the php script
  // and then print in different sections throughout the page
  // 5 items per function call.

  // firstly, tune activity: note, to decode returned JSON
  $tuneAct = act_streams("tunes");
  $ta = json_decode($tuneAct, 1);

  // then the next one is recording activities
  $recAct = act_streams("recordings");
  $ra = json_decode($recAct, 1);

  // sessions activities
  $seshAct = act_streams("sessions");
  $sa = json_decode($seshAct, 1);

  // events
  $evAct = act_streams("events");
  $ea = json_decode($evAct, 1);

  // discussions
  $disAct = act_streams("discussions");
  $da = json_decode($disAct, 1);

  // in order to improve on the dashboard section, it would be preferable
  // to manipulate the messages with the display names and display dates...

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="../../appUI/bootstrap-4.0.0/favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <!-- https://code.jquery.com/jquery-3.2.1.slim.min.js -->
    <!-- https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js -->
    <!-- https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js -->
    <link href="../../appUI/bootstrap-4.0.0/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
    <!-- <script src="http://code.jquery.com/jquery-2.0.2.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
    <script src="../../appUI/bootstrap-4.0.0/js/dist/tooltip.js"></script>
    <script src="../../appUI/bootstrap-4.0.0/js/dist/popover.js"></script>
    <!-- <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script> -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script> -->
  </head>

  <body>
    <!-- <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Dashboard</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Help</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">Overview <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Reports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Analytics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Export</a>
            </li>
          </ul>

          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#">Nav item</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Nav item again</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">One more nav</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Another nav item</a>
            </li>
          </ul>

          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#">Nav item again</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">One more nav</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Another nav item</a>
            </li>
          </ul>
        </nav> -->

        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
          <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">myTune</a>
          <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="#">Sign out</a>
            </li>
          </ul>
        </nav>

        <!-- <nav class="navbar navbar-expand navbar-dark bg-dark">
          <a class="navbar-brand" href="#">Always expand</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample02">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-md-0">
              <input class="form-control" type="text" placeholder="Search">
            </form>
          </div>
        </nav> -->

        <div class="container-fluid">
          <div class="row" style="background-color: #E5F0EF">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
              <div class="sidebar-sticky">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">
                      <span data-feather="home"></span>
                      Dashboard <span class="sr-only">(current)</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="file"></span>
                      My TuneBook
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="shopping-cart"></span>
                      Popular Tunes
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="users"></span>
                      Discussions (Temporary)
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="bar-chart-2"></span>
                      Sessions & Events
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="layers"></span>
                      Integrations
                    </a>
                  </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                  <span>Saved reports</span>
                  <a class="d-flex align-items-center text-muted" href="#">
                    <span data-feather="plus-circle"></span>
                  </a>
                </h6>
                <ul class="nav flex-column mb-2">
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="file-text"></span>
                      Current month
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="file-text"></span>
                      Last quarter
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="file-text"></span>
                      Social engagement
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="file-text"></span>
                      Year-end sale
                    </a>
                  </li>
                </ul>
              </div>
            </nav>

          <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
            <div style="width: 1000px; margin:0 auto; margin-left: 450px;">
              <h1>Activity Dashboard</h1>
              <button type="button" class="example-popover btn btn-lg btn-danger" data-toggle="popover" style="margin-left: 350px; margin-top:-80px;" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">About</button>
            </div>

          <!-- <section class="row text-center placeholders">
            <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <div class="text-muted">Something else</div>
            </div>
            <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
          </section> -->

          <!-- the first row -->
          <div class="row" style="margin-top: -3px;">
            <div class="col-sm-6">
              <div class="card">

                <h5 class="card-header">Tune Activities <img src="../../appUI/open-iconic-master/png/musical-note-2x.png"> <a href="#" class="card-link">See More activities</a></h5>

                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <!-- pull php and loop through array -->
                    <?php
                      // now go through the discussion activity result
                      for($i = 0; $i < count($ta["items"]); $i++){
                        // now print out...
                        // echo ($i+1).". ".$ta["items"][$i]["title"].'<br>';
                    ?>
                      <li class="list-group-item"><?=($i+1).". ".$ta["items"][$i]["title"]?></li>
                    <?php

                      }
                    ?>
                  </ul>
                  <!-- Link for the card at the end of the each card -->
                </div>

              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">

                <h5 class="card-header">Recording Activities <img src="../../appUI/open-iconic-master/png/media-play-2x.png"> <a href="#" class="card-link">See More activities</a></h5>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <!-- pull php and loop through array -->
                    <?php
                      // now go through the discussion activity result
                      for($i = 0; $i < count($ra["items"]); $i++){
                        // now print out...
                        // echo ($i+1).". ".$ta["items"][$i]["title"].'<br>';
                    ?>
                      <li class="list-group-item"><?=($i+1).". ".$ra["items"][$i]["title"]?></li>
                    <?php

                      }
                    ?>
                  </ul>
                  <!-- Link for the card at the end of the each card -->
                </div>

              </div>
            </div>

          </div>

          <!-- second row of the activity -->
          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-6">
              <div class="card">

                <h5 class="card-header">Sessions Activities <img src="../../appUI/open-iconic-master/png/microphone-2x.png"> <a href="#" class="card-link">See More activities</a></h5>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <!-- pull php and loop through array -->
                    <?php
                      // now go through the discussion activity result
                      for($i = 0; $i < count($sa["items"]); $i++){
                        // now print out...
                        // echo ($i+1).". ".$ta["items"][$i]["title"].'<br>';
                    ?>
                      <li class="list-group-item"><?=($i+1).". ".$sa["items"][$i]["title"]?></li>
                    <?php

                      }
                    ?>
                  </ul>
                  <!-- Link for the card at the end of the each card -->
                </div>

              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">

                <h5 class="card-header">Events Activities <img src="../../appUI/open-iconic-master/png/people-2x.png"> <a href="#" class="card-link">See More activities</a></h5>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <!-- pull php and loop through array -->
                    <?php
                      // now go through the discussion activity result
                      for($i = 0; $i < count($ea["items"]); $i++){
                        // now print out...
                        // echo ($i+1).". ".$ta["items"][$i]["title"].'<br>';
                    ?>
                      <li class="list-group-item"><?=($i+1).". ".$ea["items"][$i]["title"]?></li>
                    <?php

                      }
                    ?>
                  </ul>
                  <!-- Link for the card at the end of the each card -->
                </div>

              </div>
            </div>
            
        </div>

          <!-- the third row of the activity -->
          <div class="row" style="margin-top: -50px;">
            <div class="col-sm-6">
              <div class="card text-center">
                <h5 class="card-header">Discussions <img src="../../appUI/open-iconic-master/png/comment-square-2x.png"> <a href="#" class="card-link">See More activities</a></h5>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <!-- pull php and loop through array -->
                    <?php
                      // now go through the discussion activity result
                      for($i = 0; $i < count($da["items"]); $i++){
                        // now print out...
                        // echo ($i+1).". ".$ta["items"][$i]["title"].'<br>';
                    ?>
                      <li class="list-group-item"><?=($i+1).". ".$da["items"][$i]["title"]?></li>
                    <?php

                      }
                    ?>
                  </ul>
                  <!-- Link for the card at the end of the each card -->
                </div>
                <!-- <div class="card-footer text-muted">
                  2 days ago
                </div> -->
              </div>
            </div>            
          </div>

        </main>

        <!-- horizontal margin -->
        <!-- <hr> -->

        <!-- for the genre chart, possibly could be the... -->
        <!-- for this section, I'd choose to make a div and have it contain -->
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" style="margin-top: 100px;">

          <!-- the title -->
          <div style="width: 1000px; margin:0 auto; margin-left: 500px;">
            <h1>Genre Explorer</h1>
            <button type="button" id="butte" class="btn btn-lg btn-danger" data-toggle="popover" style="margin-left: 280px; margin-top:-80px;" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">About</button>
          </div>

          <!-- test section -->
          <div style="width: 1000px; height: 1000px; margin:0 auto;">
            <!-- for the pie chart -->
            <canvas id="myChart"></canvas>

            <!-- holds the data for the piechart response -->
            <!-- <textarea id="netCap" style="width: 1000px; height: 400px; margin-top: 10px;"></textarea> -->

            <!-- create a form with hidden inputs -->
            <form id="genreForm" method="post" class="labelForm" action="funCall.php">
              <input type="hidden" id ="inputGenre" value="" name="label">
            </form>

            <!-- card for the dynamic switch of genres -->
            <div class="card" style="margin-top: 20px;">
              <h5 class="card-header" id="fillText">Genres</h5>
              <div class="card-body">
                <h5 class="card-title">Description</h5>
                <p class="card-text" id="descSection">Click on the Pie chart segments for some info!</p>
                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
              </div>
              <div class="card-footer text-muted" id="sourcer">Source: </div>
            </div>

            <!-- beneath here may lie a suggestion -->
          </div>

        </main>

      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script>window.jQuery || document.write('<script src="../../appUI/bootstrap-4.0.0/assets/js/vendor/jquery.min.js"><\/script>')</script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../../appUI/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    
  </body>

  <!-- JavaScript for the Genre explorer -->
  <script type="text/javascript">
        var data = {
          datasets: [{
            data: [50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50],
            backgroundColor: [
              "8033FF",
              "#46BFBD",
              "#FDB45C",
              "#C70039",
              "33FFDD",
              "FF3399",
              "FFCA33",
              "33FF9F",
              "33ECFF",
              "FFF633",
              "FF3F33"

            ]
          }],
          labels: [
            "Slip_Jig",
            "Reel",
            "Jigs",
            "Mazurkas",
            "Hornpipes",
            "Slides",
            "Three-twos",
            "Polkas",
            "Waltzes",
            "Barndances",
            "Strathspeys"
          ]
        };

        // for the data chart for the body, i.e. pie chart
        $(document).ready(
          function() {
            var canvas = document.getElementById("myChart");
            var ctx = canvas.getContext("2d");
            var myNewChart = new Chart(ctx, {
              type: 'doughnut',
              data: data
            });

            canvas.onclick = function(evt) {
              // start of the onclick function

              // preventDefault
              evt.preventDefault();

              var activePoints = myNewChart.getElementsAtEvent(evt);
              if (activePoints[0]) {
                var chartData = activePoints[0]['_chart'].config.data;
                var idx = activePoints[0]['_index'];

                // label will be a key part in this post-jquery
                var label = chartData.labels[idx];
                var value = chartData.datasets[0].data[idx];

                var url = "http://example.com/?label=" + label + "&value=" + value;

                // first create a form using jquery
                // var form = $('.labelForm');

                // now we will go onto filling the form with the value of the label 
                // populate the input with the label
                var g = $('#inputGenre').val(label);
                var same = $('input[name="label"]').val();

                // now have to submit the form with the input on it and send it off
                // post-jquery / AJAX
                // $.ajax = ({
                //             type: "POST",
                //             url: 'funCall.php',
                //             data: $('.labelForm').serialize(),
                //             dataType: "json",
                //             success: function(data){
                //                 alert('success!');
                //                 $('#fillText').html(same);
                //             },
                //             error: function(jqXHR, textStatus, errorThrown)
                //             {
                //                 alert("There was an error submitting your details");
                //                 //if fails    
                //             }
                // });

                var $form = $('.labelForm'),
                           formURL = $form.attr( "action" );
                           postData = $form.serialize();
                
                           var result = $.ajax({
                               data: postData,
                               type: 'POST',
                               dataType: "json",
                               url : formURL,
                               global: false,
                               async:false,
                           success:function(data, textStatus, jqXHR)
                           {
                              alert('success!');
                              // alert(data.description);
                              // $('#netCap').val(data);

                              $('#fillText').html(data.genre);
                              $('#descSection').html(data.description);
                              $('#sourcer').html("Source: "+"<a href="+data.ref+">Click for more</a>")



                           },
                           error: function(jqXHR, textStatus, errorThrown)
                           {
                               alert("There was an error submitting your details");//if fails    
                           }
                           }).responseText;



                console.log(same);
                // console.log(desc);
                // alert(url);

                // create a dismissible popover
                // $('.btn').popover({
                //   
                //   container: 'body'
                // });

                
              }
              // end of onclick function
            };

            // popover
            // $('.btn').on('click', function () {
            //   $(this).popover({
            //     container: 'body',
            //     trigger: 'focus'
            //   })
            // });

          });

    </script>
</html>

