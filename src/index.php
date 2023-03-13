<!DOCTYPE html>
<html>

<head>
   <title>jQuery UI Sortable - Example</title>
   <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
   <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

   <!-- TODO: Lägg till styles -->
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@600&display=swap');

      .listWrapper {
         display: flex;
         flex-direction: row;
         background-color: #F5A0C0;
         justify-content: space-evenly;
         padding: 2em;
         height: 80vh;
      }

      #todo, #doing, #done {
         font-family: Raleway;
         border: 1px solid black;
         border-radius: 5px;
         padding: 2em;
         background-color: #FADCE7; 
      }

      h3 {
         font-size: 2rem;
      }


   </style>

   <!-- TODO: lägg till JQuery för att connecta de olika listorna 
   och för att posta id och state till "/api/update_tasks.php" --> 
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
   <script>
      $(function() {
             $( "#todo, #doing, #done" ).sortable({
      connectWith: ".connectedList",
      receive: function(event, ui) {

         var id = ui.item.attr('id');

         var state = this.id;

         console.log($(ui.item).attr('id')); 
         console.log(this.id);

            $.post("/api/update_tasks.php",
            {
               id: id,
               state: state
            });



      }
    }).disableSelection();
      });
   </script>
</head>

<?php
require("includes/conn_mysql.php");
require("includes/tasks_functions.php");

$connection = dbConnect();
$allTodos = getAllTodos($connection);
$allDoing = getAllDoing($connection);
$allDone = getAllDone($connection);

dbDisconnect($connection);
?>

<body>
   <section class="listWrapper">
   <ul id="todo" class="connectedList">
      <h3>Todo</h3>
      <?php
      foreach ($allTodos as $item) {
         print('<li class="default" ');
         print('id="');
         print($item['id'] . '">');
         print($item['name']);
         print('</li>');
      }
      ?>
   </ul>
   <ul id="doing" class="connectedList">
      <h3>Doing</h3>
      <?php
      foreach ($allDoing as $item) {
         print('<li class="default" ');
         print('id="');
         print($item['id'] . '">');
         print($item['name']);
         print('</li>');
      }
      ?>
   </ul>
   <ul id="done" class="connectedList">
      <h3>Done</h3>
      <?php
      foreach ($allDone as $item) {
         print('<li class="default" ');
         print('id="');
         print($item['id'] . '">');
         print($item['name']);
         print('</li>');
      }
      ?>
   </ul>
   </section>
</body>

</html>