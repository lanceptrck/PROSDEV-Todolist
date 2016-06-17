<?php
  session_start();
  include 'functions.php';
  loadAll();
  $searched = "";
  if(isset($_SESSION["username"])){
    $loggedIn_account = getAccount($_SESSION["username"]);

    //include 'post_task.php';

  }
  else{
    echo "You are not logged in.";
    header('Refresh: 2; URL=index.php');
    exit; 
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Bootstrap stuff -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <!-- Link to CSS file -->
        <link rel="stylesheet" href="css/index.css">
        <link rel="shortcut icon" href="img/todoico.ico">

        <title>
            TODO.PH | Main
        </title>

        <!-- Script for functions -->
        <script>
            // JQUERY
            $(document).ready(function(){

                $('#logoutHref').on('click', function(){
                    window.location = "index.jsp";
                });
            });

        </script>
        <script>
    			$(document).ready(function(){

    			    $("#addTask").click(function(){
    			    	var x = $("#task").val();
                var dueDate = $("#taskDate").val();

    			        $("#taskList").append('<li class='+ '"list-group-item"'+ '>'+ x + ' due on ' + dueDate + ' <button class="btn btn-default glyphicon glyphicon-remove pull-right deleteMe"> </button> </li>');
    			        console.log(x);
    			    });
    			});


          $(document).on('click', '.deleteMe',function(){
              $(this).closest("li").remove();

          });

    		</script>
        <style>
          .margin12 {
              margin-top: 12px;
          }

          .margin11 {
              margin-top: 11.5px;
          }
        </style>
    </head>
    <body>

        <div class="container-fluid">

            <!-- The HEADER and the buttons/links in it -->
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">

                        <!-- Brand (aka the app name) -->
                        <a href="#" class="navbar-brand"><img src="img/todoph logo.png"></a>

                        <!-- Buttons -->
                        <ul class="nav navbar-nav navbar-right" id="topheaderlink">
                            <!-- Add new task BUTTON -->
                            <li>
                                <a href="#">
                                <button type="button" class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-target="#myModal">
                                    <span class=" glyphicon glyphicon-edit" aria-hidden="true"></span> Write new task 
                                </button>
                                </a>
                            </li>
                            <!-- Settings BUTTON -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $loggedIn_account->getFullname(); ?>
                                    <span class="glyphicon glyphicon-user pull-left"></span>
                                </a>
                                <ul  class="dropdown-menu">
                                    <li><a id="logoutHref" name="logoutHref" href="logout.php">Log Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Profile <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
               
                                    
                              </ul>
                            </li>
                        </ul>
                    </div>
                </div><!-- /container-fluid -->
            </nav><!-- /navbar top header END OF HEADER-->


            <!-- BODY CONTENT -->
            <div class="row grid-divider">
              <div class="col-sm-4">
                  <div class="col-padding">
                <form>
                    <div class="card">
                      <ul id = "taskList" class="list-group list-group-flush">
                        <li class="list-group-item">
                           <h4> <span class=" glyphicon glyphicon-briefcase" aria-hidden="true"></span> My Tasks <button class="btn btn-default glyphicon glyphicon-plus pull-right"> </button> </h4> 
                          <div class="row center-block">
                            <div class="col-md-10 ">

                              <?php

                                $myTasks = loadTaskById($loggedIn_account->getAccid());

                                for($i = 0; $i<count($myTasks); $i++)
                                {
                                  $title = $myTasks[$i]->getTitle();
                                  $sched = $myTasks[$i]->getSchedule();
                                  echo "<li class='list-group-item'> " . $title ." due on " . $sched .  " <button class='btn btn-default glyphicon glyphicon-remove pull-right deleteMe'> </button> </li> </li>";
                                }

                              ?>
                 

                            
                            </div>
                          </div>

                        </li>

                      </ul>
                    </div>
                  
              </form>
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="col-padding">
                <form>
                    <div class="card">
                      <ul id = "sharedTaskList" class="list-group list-group-flush">
                        <li class="list-group-item">
                           <h4> <span class=" glyphicon glyphicon-gift" aria-hidden="true"></span> Shared Tasks</h4>
                          <div class="row center-block">
                            <div class="col-md-10 ">
                            
                            </div>
                          </div>

                        </li>

                      </ul>
                    </div>
                  
              </form>
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="col-padding">
                
                    <div class="card">
                      <ul id = "sharedTaskList" class="list-group list-group-flush">
                        <li class="list-group-item">
                           <h4>  <span class=" glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Accomplished Tasks </h4> 
                          <div class="row center-block">
                            <div class="col-md-10 ">
                            
                            </div>
                          </div>

                        </li>

                      </ul>
                    </div>
                  
                  </div>
              </div>
    </div>
    </div>


            <!-- /container-fluid BODY -->

        <!-- Task -->
        <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Task</h4>
      </div>
      <div class="modal-body">
              <div>
              <div class="row">
                <form method = "POST" action = "post_task.php">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="card">
                      <ul id = "" class="list-group list-group-flush">
      

            
                            <div class="col-md-10 ">
                              <fieldset class="form-group">
                                <input type="text" name="taskName" class="form-control margin12" id="task" placeholder="Name of your task">
                                <input type="datetime-local" class="form-control margin12" id="taskDate" name="taskDate">
                               </label>
                                
                              </fieldset>
                            </div>
               


                      </ul>
                    </div>
                  </div>
                  <div class="col-md-3"></div>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" id="addTask" class="btn btn-primary" value="Proceed">

                </form>
      </div>
    </div>
  </div>
</div>
    </body>
</html>
