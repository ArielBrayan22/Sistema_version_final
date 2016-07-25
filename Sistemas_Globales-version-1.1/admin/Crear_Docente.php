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
  <form method="post" action="">
  <center><input  type="submit" name='btn_Crear_Docente' value='Crear Docente' >
  <input type='submit' value='Listado de Docente' name='btn_Ver_Listado_Docente'></center>
  </form>
 
  <?php

  require('coneccion.php');
    //BOTON CREAR DOCENTES    
    if(isset($_POST['btn_Crear_Docente'])){
      
        echo "<form method='post' action=''>
        <table id='tabla_grande'>
        <tr><td>Nombre Completo</td><td><input type='text' size='80' name='txt_Nombre'></td></tr>
        <tr><td>Apellido Paterno</td><td><input type='text' size='80' name='txt_Apellido_P'></td></tr>
        <tr><td>Apellido Materno</td><td><input type='text' size='80' name='txt_Apellido_M'></td></tr>
        <tr><td>Profesiones</td><td><textarea type='text' rows='3' cols='82' name='txt_Profesion'></textarea></tr>
        <tr><td>Telefono</td><td><input type='text' name='txt_Telefono'></td></tr>
        <tr><td>Celular</td><td><input type='text' name='txt_Celular'></td></tr>
        <tr><td>Correo</td><td><input type='text' size='80' name='txt_Correo'></td></tr>
        <tr><td>Direccion</td><td><textarea type='text' rows='3' cols='82' name='txt_Direcion'> </textarea></td>
        <tr><td>CodSIS</td><td><input type='text' name='txt_User' ></td></tr>
        <tr><td>Password</td><td><input type='password' name='txt_Password'></td></tr>
        <tr><td></td><td><input type='submit' size='80' name='btn_Registrar_Docente' value='Crear Docente'></td></tr></tr>";


      echo "</table></form>";
     }
     
     if (isset($_POST['btn_Registrar_Docente']))
     {
        $Nombre=$_POST['txt_Nombre'];
        $Apellido_P=$_POST['txt_Apellido_P'];
        $Apellido_M=$_POST['txt_Apellido_M'];
        $Profesiones=$_POST['txt_Profesion'];
        $Telefono=$_POST['txt_Telefono'];
        $Celular=$_POST['txt_Celular'];
        $Correo=$_POST['txt_Correo'];
        $Direccion=$_POST['txt_Direcion'];
        $User_Login=$_POST['txt_User'];
        $User_Password=$_POST['txt_Password'];



       $query="INSERT INTO `docente` VALUES (NULL, '$Nombre',
       '$Apellido_P', 
       '$Apellido_M',
       '$Profesiones', 
       '$Telefono', 
       '$Celular', 
       '$Correo', 
       '$Direccion',
       '$User_Login',
       '$User_Password');";

       $resultado=mysql_query($query,$link);

       echo "<script>alert('Docente Creado Correctamente');</script>";


        
     }


    //BOTON LISTADO DOCENTES
      if(isset($_POST['btn_Ver_Listado_Docente'])){
        echo 
        '<table id="tabla_Buscador">
         <tr><td> 
         <button onclick="procesar()" id="procesar" class="btn_rec" ';     
        echo 
         '</button></td><td>
          <form method="post">
          <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el nombre del docente ">
          <input type="submit" class="btn_Buscar" name="btn_Buscar_Docentes" value="Buscar"></form>
          </td></tr></table>';
        echo "<h1> Lista de Todos los Docentes Creados</h1>";

        $query="SELECT * 
                 FROM docente ORDER BY `Nombre_Completo` ASC";
       $resultado=mysql_query($query,$link);
      
      while($row=mysql_fetch_array($resultado))
      {
        echo "<form method='post' action=''><table class='tabla_lista_docentes'>";
        
         echo "<tr><td id='td_caract'>Nombre Completo</td><td colspan='3'>".$row['Nombre_Completo']."</td></tr>";
         echo "<tr><td> Apellidos </td><td colspan='3'>".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</td></tr>";
         echo "<tr><td id='td_caract'>Profesion</td><td colspan='3'>".$row['Profesion']."</td></tr>";
         echo "<tr><td id='td_caract'>Telefono</td><td>".$row['Telefono']."</td>";
         echo "<td>Celular</td><td>".$row['Celular']."</td></tr>";
         echo "<tr><td id='td_caract'>Correo</td><td colspan='3'>".$row['Correo']."</td></tr>";
         echo "<tr><td id='td_caract'>Direccion</td><td colspan='3'>".$row['Direccion']."</td></tr>";
         echo "<tr><td id='td_caract'>CodSIS</td><td>".$row['User_Login']."</td>";
         echo "<td>Contrasena</td><td>".$row['Password']."</td></tr>
        
         <tr><td id='td_caract'>
         <input type='submit' name='btn_Editar_Docente' value='Editar'></td>
         <td colspan='3'><input type='submit' name='btn_Eliminar_Docente' value='Eliminar'>
         <input type='text' name='ID_Docente' style='visibility:hidden' value='".$row['ID_Docente'].
         "'</td></tr></table><p></p></form>";
      }
      echo "<p></p>";
        
      
     }
   
     if(isset($_POST['btn_Editar_Docente']))
     {
        $ID_Docente=$_POST['ID_Docente'];

        $query="SELECT * 
                 FROM docente WHERE ID_Docente=$ID_Docente";
        $resultado=mysql_query($query,$link);
        echo "<form method='post'><table id='tabla_grande'>";

       while($row=mysql_fetch_array($resultado))
       {
        echo "<input type='text' name='ID_Docente' style='visibility:hidden' value='".$ID_Docente."'></p>";
         echo "<tr><td>Nombre Completo</td>
              <td><input type='text' name='Nombre_Completo' value='".$row['Nombre_Completo']."'></td></tr>";

         echo "<tr><td>Apellido Paterno</td>
               <td><input type='text' name='Apellido_Paterno' value='".$row['Apellido_Paterno']."'></td></tr>";

         echo "<tr><td>Apellido Materno</td>
               <td><input type='text' name='Apellido_Materno' value='".$row['Apellido_Materno']."'></td></tr>";
         
         echo "<tr><td>Profesion</td>
         <td><input type='text' name='Profesion' value='".$row['Profesion']."' size='80'></td></tr>";
         
         echo "<tr><td>Telefono</td>
         <td><input type='text' name='Telefono' value='".$row['Telefono']."'></td></tr>";

         echo "<tr><td>Celular</td>
         <td><input type='text' name='Celular' value='".$row['Celular']."'></td></tr>";
         
         echo "<tr><td>Correo</td>
         <td><input type='text' name='Correo' value='".$row['Correo']."' size='60'></td></tr>";
         
         echo "<tr><td>Direccion</td>
         <td><textarea name='Direccion' cols='80' rows='3' >".$row['Direccion']."</textarea></td></tr>"; 

         echo "<tr><td>CodSIS</td><td><input name='User' value='".$row['User_Login']."'></td></tr>";

         echo "<tr><td>Contrasena</td>
         <td><input type='text' name='Contrasena' value='".$row['Password']."'></td></tr>";

         echo "<tr><td><input type='submit' value='Realizar Editado' name='btn_Realizar_Editado'></td></tr>";
       }
       echo "</table></form>";

      }

      //BOTON EDITADO A LA BASE DE DATOS
      if(isset($_POST['btn_Realizar_Editado'])){
         
          $ID_Docente=$_POST['ID_Docente'];
          $Nombre=$_POST['Nombre_Completo'];
          $Apellido_Paterno=$_POST['Apellido_Paterno'];
          $Apellido_Materno= $_POST['Apellido_Materno'];
          $Profesion=$_POST['Profesion']." ";
          $Telefono=$_POST['Telefono']." ";
          $Celular=$_POST['Celular']." ";
          $Correo=$_POST['Correo']." ";
          $Direccion=$_POST['Direccion'];
          $User=$_POST['User'];
          $Password=$_POST['Contrasena'];

         $query="UPDATE docente
         SET Nombre_Completo = '$Nombre',
             Apellido_Paterno = '$Apellido_Paterno',
             Apellido_Materno = '$Apellido_Materno', 
             Profesion = '$Profesion', 
             Telefono = '$Telefono', 
             Celular = '$Celular', 
             Correo = '$Correo',
             Direccion = '$Direccion',
             User_Login='$User',
             Password='$Password'
             WHERE ID_Docente =$ID_Docente;";
             
             $resultado=mysql_query($query,$link);

            echo "<script> alert('Datos Editados Correctamente');</script>";

      }
    
     
     if(isset($_POST['btn_Eliminar_Docente']))
     {
        $ID_Docente=$_POST['ID_Docente'];

        $query="DELETE FROM `docente` WHERE ID_Docente=$ID_Docente";
        $resultado=mysql_query($query,$link);
             echo "<script> alert('Datos Eliminados Correctamente');</script>";



      }

      if(isset($_POST['btn_Buscar_Docentes']))
      {
          $Text_a_Buscar=$_POST['txt_buscar_pg'];
         echo 
        '<table id="tabla_Buscador">
         <tr><td> 
         <button onclick="procesar()" id="procesar" class="btn_rec" ';     
        echo 
         '</button></td><td>
          <form method="post">
          <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el nombre del docente ">
          <input type="submit" class="btn_Buscar" name="btn_Buscar_Docentes" value="Buscar"></form>
          </td></tr></table>';
       
        echo "<h1> Resultado de Todos los Docentes Creados</h1>";

        $query="SELECT * 
                 FROM docente WHERE Nombre_Completo LIKE '%$Text_a_Buscar%' ORDER BY `Nombre_Completo` ASC";
       $resultado=mysql_query($query,$link);
      
       while($row=mysql_fetch_array($resultado))
       {
        echo "<form method='post' action=''><table class='tabla_lista_docentes'>";
        
         echo "<tr><td id='td_caract'>Nombre Completo</td><td colspan='3'>".$row['Nombre_Completo']."</td></tr>";
         echo "<tr><td> Apellidos </td><td colspan='3'>".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</td></tr>";
         echo "<tr><td id='td_caract'>Profesion</td><td colspan='3'>".$row['Profesion']."</td></tr>";
         echo "<tr><td id='td_caract'>Telefono</td><td>".$row['Telefono']."</td>";
         echo "<td>Celular</td><td>".$row['Celular']."</td></tr>";
         echo "<tr><td id='td_caract'>Correo</td><td colspan='3'>".$row['Correo']."</td></tr>";
         echo "<tr><td id='td_caract'>Direccion</td><td colspan='3'>".$row['Direccion']."</td></tr>";
         echo "<tr><td id='td_caract'>CodSIS</td><td>".$row['User_Login']."</td>";
         echo "<td>Contrasena</td><td>".$row['Password']."</td></tr>
        
         <tr><td id='td_caract'>
         <input type='submit' name='btn_Editar_Docente' value='Editar'></td>
         <td colspan='3'><input type='submit' name='btn_Eliminar_Docente' value='Eliminar'>
         <input type='text' name='ID_Docente' style='visibility:hidden' value='".$row['ID_Docente'].
         "'</td></tr></table><p></p></form>";
      }
      echo "<p></p>";
        
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

<?php  } 
else {
   header("location: Planes_Globales/index.php");
 } ?>