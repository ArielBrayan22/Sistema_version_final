<?php
 session_start();
 

 if(isset($_SESSION['Alias']))
 {
    $Alias_User=$_SESSION['Alias'];
    $Password_User=$_SESSION['Password'];
    $ID_User=$_SESSION['ID'];
  ?> 

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
       <li><a href="Operaciones_Manual_de_Usuario.php">Ayuda</a></li>
             <li><a href="identificacion.php">Contactanos</a></li>
      </ul>
    </nav><!-- / nav -->
  </header><!-- / #main-header -->
   <hr></hr>
   <DIV ALIGN=RIGHT><a class="redireccion_salir" href="salir.php">salir</a></DIV>
  
   <aside id="menu">
     
    <div id="titulo"><a id="titulo" href="menu_root.php">Inicio</a></div>

    <div id="titulo"><a id="titulo" href="Crear_Plan_Global.php">Crear Plan Global</a></div>
    <div id="titulo"><a id="titulo" href="Crear_Materia.php">Crear Materia</a></div>
    <div id="titulo"><a id="titulo" href="Crear_Docente.php">Crear Docente</a></div>

     <div id="titulo"><a id="titulo" href="Plan_Global_Publico.php">Planes Globales</a></div>
    <div id="titulo"><a id="titulo" href="Programa_Analitico_Publico.php">Programas Analiticos</a></div>
    <div id="titulo"><a id="titulo" href="Operaciones_Manual_de_Usuario.php">Manual de Usuario</a></div>
      
   
     <table id="tabla_user">
      <?php
           require ("coneccion.php");
           $query="SELECT * FROM `docente` WHERE ID_Docente=$ID_User";
          
           $resultado=mysql_query($query,$link);
   
           while($row=mysql_fetch_array($resultado))
           {
              echo "<tr><td></td><td><img src='user.jpg' width='120' height='120'></td></tr>";
              echo "<tr><td>Usuario:</td><td>".$row['Nombre_Completo']." "
              .$row['Apellido_Paterno']."".$row['Apellido_Materno']."</td></tr>";
              echo "<tr><td>Cargo:</td><td>Administrador</td></tr>";
              echo "<tr><td>Nivel Academico:</td><td>".$row['Profesion']."<td></tr>";
              echo "<tr><td>CodSIS:</td><td>".$row['User_Login']."<td></tr>";
           }
       ?>
    </table>
    
  </aside>

<article id="cuerpo">
 <center><h1>Videos Tutoriales</h1></center>

 <center>
 <form method="post" action="">
   
   <input type="submit" value="Lista de Videos" name="btn_lista_Video">

 </form>
 </center>

<?php

  /*if(isset($_POST['btn_Agregar_Video'])){

    echo '<form method="post" enctype="multipart/form-data">

          <table id="tabla_grande">
          <tr><td id="td_conpact"><h5>Escriba el titulo :</h5></td><td><input class="titulo" type="text" name="txt_titulo" size="87"  ></td></tr>
          <tr><td id="td_conpact"><h5>Seleccion </br>del video :</h5></td><td><input type="file" name="archivo"></td></tr>        
          <tr><td id="td_conpact"><h5>Caracteristicas :</h5></td><td><textarea name="text" rows="4" cols="90">
          </textarea></td></tr>
          <tr><td colspan="2"><center><input type="submit" name="boton" value="Subir Video"></center></td></tr>
          
          </table>
          </form>';

  }

     $formatos=array('.mpg', '.MPG', '.mpeg', '.MPEG', '.jpg','.gif', '.png','.mp4'.'AVI'); 
 
  if (isset($_POST['boton'])) {
    
     $text_caract=$_POST['text'];  
     $text_titulo=$_POST['txt_titulo'];
     $nombreArchivo=$_FILES['archivo']['name'];

     $nombreTmpArchivo=$_FILES['archivo']['tmp_name'];

     $ext=substr($nombreArchivo,strrpos($nombreArchivo, '.'));
     
     if(in_array($ext,$formatos))
     {
       if(move_uploaded_file($nombreTmpArchivo,"videos/$nombreArchivo"))
       {
         require("coneccion.php");
         $sql="INSERT INTO `video` (`ID_Video`, `Titulo`, `Nombre`, `Caracteristica`) 
         VALUES (NULL, '$text_titulo', '$nombreArchivo', '$text_caract');";
         $coneccion=mysql_query($sql);
         echo "se realizo";

       }
        else {
          echo "Video Subido Correctamente";
        }
      
    }
  }*/

  if(isset($_POST['btn_lista_Video']))
  {
    //echo "listar";
     $directorio="videos";
    
          require("coneccion.php");
          $sql="SELECT * FROM video";
          $coneccion=mysql_query($sql);

          while ($row=mysql_fetch_array($coneccion)) {
              $ID_video=$row['ID_Video'];
              $titulo=$row['Titulo'];
              $archivo=$row['Nombre'];
              $caract=$row['Caracteristica'];
              $video="<center><video src='videos/$archivo' width='500' height='300' controls></video></center>";

           echo "<form method='post'><center><table id='tabla_pequena'>";

           echo "<tr><td id='td_conpact'>titulo</td><td><h3>$titulo</h3></td></tr>";
           echo "<tr><td colspan='2'>$video</td></tr>";
           echo "<tr><td id='td_conpact'>caracteristicas</td><td>$caract</td></tr>";  

           echo "</table></center></form>";     
        }

      }

      if(isset($_POST['btn_eliminar_video']))
      {
         echo $id=$_POST['ID_Video'];
         echo $video=$_POST['Nombre_Video'];

         require("coneccion.php");
         $sql="DELETE FROM `video` WHERE `video`.`Nombre` = '$video'";
         mysql_query($sql);
         unlink("videos/$video");

      }
 
 ?>

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

<?php  } 
else {
   header("location: Planes_Globales/index.php");
 } ?>