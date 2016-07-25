<html>
<head>
  <title>Sistema de Planes Globales</title>
  <link rel="stylesheet" type="text/css" href="Style.css">
  <link rel="stylesheet" type="text/css" href="Styles_funciones.css">
</head>
<body>
  <header id="main-header">
    <a id="logo-header" href="#">
      <span class="site-name">PLANES GLOBALES Y PROGRAMAS ANALITICOS</span>
    </a> <!-- / #logo-header -->
 
    <nav>
      <ul>
        <li><a href="Manual_de_Usuario.php">Ayuda</a></li>
        <li><a href="identificacion.php">Contactanos</a></li>
      </ul>
    </nav><!-- / nav -->
  </header><!-- / #main-header -->
  <hr></hr>
  <aside id="menu">
    <div id="titulo"><a id="titulo" href="index.php">Inicio</a></div>
    <div id="titulo"><a id="titulo" href="Plan_Global_Publico.php">Planes Globales</a></div>
   
    <div id="titulo"><a id="titulo" href="Manual_de_Usuario.php">Manual de Usuario</a></div>
    
    <form method="post" action="redireccion.php">
    <table id="tabla">
    <tr > <td id="t">usuario</td>
         <td id="t"><input type ="text" name="Txt_User" size="30" class="Txt_Input" placeholder="Nombre Usuario"></td></tr>
    <tr > <td id="t">password</td>
        <td id="t"><input type ="password" name="Password_User" size="30" class="Txt_Input" placeholder="Contrasenia"></td></tr>
        <tr><td id="t">cargo</td><td id="t">
        <select class="tipo_usuario" name="select[]">
          
          <option value=""></option>  
          <option value="Docente">Docente</option>
          <option value="Administrador">Administrador</option>
        </select></td></tr>
    <tr > <td id="t"  colspan="2"><center><input type ="submit" name="BtnIngreso" value="Ingresar" size="30" class="Bottom"></center></td></tr>

  </table>
  </form>

  </aside>

<article id="cuerpo">

     
        <table id="tabla_Buscador">
        <tr><td> 
        <button onclick="procesar()" id="procesar" class="btn_rec"></button></td><td>
       
        <form method="post">
        <input type="text" class="Txt_Buscar" size="75" id="texto" name="txt_buscar_pg" 
               placeholder="Escriba el Plan Global a Buscar">
        <input type="submit" class="btn_Buscar" name="Buscar_Video" value="Buscar">
       
        </form></td></tr></table>
        

   <?php
    
     if(isset($_POST['Buscar_Video']))
     {  $text=$_POST['txt_buscar_pg'];
        $directorio="Sistemas_Globales-version-1.1\admin\videos";
    
          require("coneccion.php");
          $sql="SELECT * FROM video  WHERE Caracteristica LIKE '%$text%' OR Titulo LIKE '%$text%' ORDER BY `Caracteristica` ASC ";
          $coneccion=mysql_query($sql);

          while ($row=mysql_fetch_array($coneccion)) {
              $ID_video=$row['ID_Video'];
              $titulo=$row['Titulo'];
              $archivo=$row['Nombre'];
              $caract=$row['Caracteristica'];
              $video="<center><video src='videos/$archivo' width='500' height='300' controls></video>";
 
           echo "<form method='post'><center><table id='tabla_pequena'>";

           echo "<tr><td id='td_conpact'>titulo</td><td><h3>$titulo</h3></td></tr>";
           echo "<tr><td colspan='2'>$video</td></tr>";
           echo "<tr><td id='td_conpact'>caracteristicas</td><td>$caract</td></tr>";
           echo "</table></center>";
       }
     }
   

     if(isset($_POST['Mostrar_Todos']))
     {
       $directorio="Sistemas_Globales-version-1.1\admin\videos";
    
          require("coneccion.php");
          $sql="SELECT * FROM video";
          $coneccion=mysql_query($sql);

          while ($row=mysql_fetch_array($coneccion)) {
              $ID_video=$row['ID_Video'];
              $titulo=$row['Titulo'];
              $archivo=$row['Nombre'];
              $caract=$row['Caracteristica'];
              $video="<video src='admin/videos/$archivo' width='500' height='300' controls></video></center>";

           echo "<form method='post'><center><table id='tabla_pequena'>";

           echo "<tr><td id='td_conpact'>titulo</td><td><h3>$titulo</h3></td></tr>";
           echo "<tr><td colspan='2'>$video</td></tr>";
           echo "<tr><td id='td_conpact'>caracteristicas</td><td>$caract</td></tr>";
           echo "</table></center>";
         }

     }
   ?>
  

<script type="text/javascript">

  var recognition;
  var recognizing = false;
  if (!('webkitSpeechRecognition' in window)) {
    alert("¡API no soportada!");
  } else {

    recognition = new webkitSpeechRecognition();
    recognition.lang = "es-VE";
    recognition.continuous = true;
    recognition.interimResults = true;

    recognition.onstart = function() {
      recognizing = true;
      console.log("empezando a eschucar");
    }
    recognition.onresult = function(event) {

     for (var i = event.resultIndex; i < event.results.length; i++) {
      if(event.results[i].isFinal)
        document.getElementById("texto").value += event.results[i][0].transcript;
        }
      
      //texto
    }
    recognition.onerror = function(event) {
    }
    recognition.onend = function() {
      recognizing = false;
      document.getElementById("procesar").innerHTML = "";
      console.log("terminó de eschucar, llegó a su fin");

    }

  }

  function procesar() {

    if (recognizing == false) {
      recognition.start();
      recognizing = true;
      document.getElementById("procesar").innerHTML = "";
    } else {
      recognition.stop();
      recognizing = false;
      document.getElementById("procesar").innerHTML = "";
    }
  }
</script>

</article>

</body>


<footer>




<article id="footer">
<hr>
 <center>

 <h3 id="titulo_footer">Paginas Amigas</br>
 <a id="link_footer" href=""> Fcyt </a>
 <a id="link_footer" href=""> Umss </a>
 <a id="link_footer" href=""> Saga </a>
 <a id="link_footer" href=""> Moodle </a>
 <a id="link_footer" href=""> Caroline </a>
 </h3>
 

 </center>


</article>



</footer>
</html>