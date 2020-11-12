<?php
require("../clases/utilidades.class.php");
require("../clases/terminalesAndroid.class.php");

$objAndroid = new terminalesAndroid;
$objUtilities = new utilidades;

$con=$objUtilities->conexion();
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
 
<title>dispositivos conectados</title>
<link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
<script src="Bootstrap/jquery-3.1.1.min.js"></script>

<script src="Bootstrap/bootbox.min.js" language="javascript" type="text/javascript"></script>

  <link rel="stylesheet" href="datepicker/bootstrap-datetimepicker.min.css">
  <script src="datepicker/moment.js"></script>
  <script src="datepicker/moment-es.js"></script>
  <script src="datepicker/bootstrap-datetimepicker.min.js"></script>
  <script src="js/basicogmap.js" language="javascript" type="text/javascript"></script>


  <style>
       #map {
        height:70vh;
        width: 100%;
       }
       #emulacion {
        background-color: #F3F3F3;
        border:2px solid #DEDEDE;
        border-radius: 10px;
        margin: 0.2%;
       }
       .contenido {
        padding-left: 10px;
        padding-top: 10px;
       }

    </style>
</head>

<body>
	   
<div class="container-fluid">

  <div class="row align-items-start">

    <div id="map"></div>
    
	      <div class='row'>
            <div  class='col-xs-4 col-sm-3'>
              <a class="btn btn-success btn-sm" onClick="ultimo_todos(true)">Última Posicion</a>
            </div>
   
            <div class="col-xs-6 col-sm-5" id="emulacion">

                   <div class='col-xs-1 col-sm-1'>
                    <span class='glyphicon glyphicon-pause' style='color:#DAA836' onClick='pause1()'></span>
                   </div>
                
        
                   <div class='col-xs-1 col-sm-1'>
                     <span class='glyphicon glyphicon-stop' style='color:#E13E1B' onClick='stop()'></span>
                   </div>

                   <div class='col-xs-6 col-sm-4 col-md-3'>
                     <input type="range" name="Velocidad" min="0" max="10">
                   </div>
                   <div class='col-xs-1 col-sm-1'>
                     <span id="estado"></span>
                   </div>
            </div>
          </div>
        </div>  
           <script type="text/javascript">range()</script>
     

          
     
   <?php 
      $ban=false;

      $ok=$objAndroid->buscar_android($con);
        while(($datos = mysqli_fetch_assoc($ok))>0){ 
          $ban=true;
          $hora1 = "ahora1".$datos['ID_A'];
          $hora2 = "ahora2".$datos['ID_A'];
          $date  = "adate".$datos['ID_A'];

   echo " 
    <div class='row'>
      <div class='contenido'>
       <div id='$datos[ID_A]' class='col-xs-3 col-sm-1'>
       <b>Unidad</b><br>
            <i id='$datos[ID_A]'>$datos[nombre_a]</i>
       </div>
       
         <div class='col-xs-12 col-sm-4'>  
            
                 <div class='container'>
                     <div class='col-xs-12 col-sm-4' style='height:50px;'>
                         <div class='form-group'>
                             <div class='input-group date' id='$date'>
                                 <input type='text' class='form-control' />
                                 <span class='input-group-addon' >
                                     <span class='glyphicon glyphicon-calendar'>
                                     </span>
                                 </span>
                             </div>
                         </div>
                     </div>
                 </div>
          </div>

          <div class='col-xs-6 col-sm-3'>
                <div class='container'>
                  <div class='row'>
                    <div class='col-xs-12 col-sm-3'>
                      <div class='form-group'>
                        <div class='input-group date' id='$hora2'>
                          <input type='text' class='form-control'/>
                          <span class='input-group-addon' >
                             <span class='glyphicon glyphicon-time'></span>        
                          </span>
                        </div>
                      </div>
                    </div>
                
                  </div>
                </div>
          </div>

          <div class='col-xs-6 col-sm-3'>  
                 <div class='container'>
                  <div class='row'>
                    <div class='col-xs-12 col-sm-3'>
                      <div class='form-group'>
                        <div class='input-group date' id='$hora1'>
                          <input type='text' class='form-control'/>
                          <span class='input-group-addon'>
                             <span class='glyphicon glyphicon-time'></span>        
                          </span>
                        </div>
                      </div>
                    </div>
                
                  </div>
                </div>
          </div>

          <div class='col-xs-1 col-sm-1'>
            <a class='glyphicon glyphicon-play' onClick='recorridoAndroid($datos[ID_A])'></a>
          </div>
          <script type='text/javascript'>
              calendar($datos[ID_A]);
          </script>
        </div>
      </div>
    <hr>";

        }//while
        
        if (!$ban) {
          echo "<tr><td>No hay dispositivos agregados</td></tr>";
        }

      ?>
 
</div>
</div>
			
<script src="Bootstrap/bootstrap.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDuIzm7d8Gxxsg4ryZIRMcV9dyvVR8jKc&callback=initMap"></script>
<script>
  $(document).ready(function(){
      setTimeout(function() {
        ultimo_todos(true);
      }, 3000);
      
      //setInterval(function() {
        //ultimo_todos(true);
      //}, 10000);


  }); 
</script> 

</body>
</html>

