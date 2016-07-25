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
  <center><input  type="submit" name='btn_Crear_Materia' value='Crear Materia' >
  <input type='submit' value='Listado de Materias' name='btn_Ver_Listado_Materias'></center>
  </form>
 
  <?php

  require('coneccion.php');
        
    if(isset($_POST['btn_Crear_Materia'])){
      
        echo "<form method='post' action=''>
        <table id='tabla_grande'>
        <tr><td>Seleccione la Facultad </td><td><select name='select_F[]' class='Select_Facultad'>";

      
        $query="SELECT * 
                 FROM facultad";
       $resultado=mysql_query($query,$link);
   
      while($row=mysql_fetch_array($resultado))
      {
         echo "<option value=".$row['ID_Facultad'].">".$row['Facultad']."</option>";
      }
        
      echo "</select></td><td><input type='submit' value='Ingresar' name='btn_Facultad'></td></tr></table></form>";
     }


     if(isset($_POST['btn_Facultad'])){
        $Seleccion_F=$_POST['select_F'];

       for ($i=0;$i<count($Seleccion_F);$i++) 
       {  $ID_Facultad=$Seleccion_F[$i];} 

         $query="SELECT * FROM facultad 
         WHERE ID_Facultad=$ID_Facultad";

        $resultado=mysql_query($query,$link);
        echo "<h3>".mysql_result($resultado, 0, "Facultad")."</h3>";

        
        echo "<form method='post'>
             <table id='tabla_grande'>
             <tr><td>Seleccione la Carrera :</td><td><select name='select_C[]' class='Select_Facultad'>";
             $query="SELECT * 
             FROM carrera 
             WHERE id_facultad=$ID_Facultad";
            $resultado=mysql_query($query,$link);
            while($row=mysql_fetch_array($resultado))
            {
              echo "<option value='".$row['ID_Carrera']."'>".$row['nombre_carrera']."</option>";
            }


         echo "</select></td><td><input type='submit' name='btn_Carrera' value='Crear Materia en'></td></tr></table>
         </form>";

          echo "<form method='post'><center>
                <input type='submit' value='atras' name='btn_Crear_Materia'>
                </form>";

         }


        if(isset($_POST['btn_Carrera']))
        {
            $Seleccion_C=$_POST['select_C'];

          for ($i=0;$i<count($Seleccion_C);$i++) 
            {  $ID_Carrera=$Seleccion_C[$i];} 

          //echo "el ID DE LA CARRERA :".$ID_Carrera."";
          
          
          $query="SELECT * FROM carrera 
                  WHERE id_carrera=$ID_Carrera";

          $resultado=mysql_query($query,$link);
          
          echo "<h3>".mysql_result($resultado, 0, "nombre_carrera")."</h3>";
          $ID_Facu=mysql_result($resultado, 0, "ID_Facultad");

          echo "<h3>Ingrese los Datos de la Nueva Materia :</h3>";

          echo "<form method='post' action=''>
                <table id='tabla_grande'>
               

                <tr><td>Nombre Materia</td><td><input type='text' size='80' name='txt_Nombre_M'></td></tr>
                <tr><td>Codigo</td><td><input type='text' name='txt_Codigo_M'></td></tr>
                <tr><td>Nivel</td><td><input type='text' size='5' name='txt_Nivel_M'></td></tr>
                <tr><td>Grupo</td><td><input type='text' size='5' name='txt_Grupo_M'></td></tr>
                <tr><td>Carga Horaria</td><td><input type='text' name='txt_Carga_M'> hrs/mes</td></tr>
                <tr><td>Materias Relacionadas</td><td><textarea name='txt_Materias_R' cols='85' rows='3'> </textarea></td></tr>
                <tr><td>Departamento</td><td><input type='text' name='txt_Departamento_M' size='80'></td></tr>
                <tr><td></td><td><input type='submit' name='btn_Ingresar_Materia' value='Crear Materia'>  <input type='text' value='$ID_Carrera' name='txt_Codigo_C' style='visibility:hidden'> </td></tr>
                
                </table></form>";

          echo "<form method='post'><center>
          <input type='submit' value='atras' name='btn_Facultad'>
          <select class='Select_Facultad' name='select_F[]' style='visibility:hidden'><option value='".$ID_Facu."'>
          </option></select>
          </form>";
         
        }

        if(isset($_POST['btn_Ingresar_Materia'])){
          //echo "materia ingresada correctamente";
          $Nombre_M=$_POST['txt_Nombre_M'];
          $Codigo_M=$_POST['txt_Codigo_M'];
          $Grupo_M=$_POST['txt_Grupo_M'];
          $Nivel_M=$_POST['txt_Nivel_M'];
          $CargaH_M=$_POST['txt_Carga_M'];
          $Materias_R=$_POST['txt_Materias_R'];
          $Departamento_M=$_POST['txt_Departamento_M'];
          $ID_Carrera=$_POST['txt_Codigo_C'];


          $query="INSERT INTO `materia` (`ID_Materia`, `Nombre_Materia`, `Codigo`, `Grupo`, 
                                         `Nivel_Materia`, `Carga_Horaria`, `Materias_Relacionadas`,`Departamento`,`ID_Carrera`) 
          VALUES (NULL, '$Nombre_M', '$Codigo_M', '$Grupo_M', '$Nivel_M', '$CargaH_M', '$Materias_R','$Departamento_M','$ID_Carrera');";
          $resultado=mysql_query($query,$link);

          echo "<script>alert('Materia Creada Correctamente');</script>";

        }

        // BOTON LISTADO DE MATERIAS

         if(isset($_POST['btn_Ver_Listado_Materias']))
         {
           
        echo 
        '<table id="tabla_Buscador">
         <tr><td> 
         <button onclick="procesar()" id="procesar" class="btn_rec" ';     
        echo 
         '</button></td><td>
          <form method="post">
          <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el nombre del materia ">
          <input type="submit" class="btn_Buscar" name="btn_Buscar_Materias" value="Buscar"></form>
          </td></tr></table>';
        echo "<h1> Lista de todas las Materias</h1>";

          $query="SELECT * FROM materia m,carrera c WHERE m.ID_Carrera=c.ID_Carrera
                  ORDER BY m.Nivel_Materia ASC";
          
          $resultado=mysql_query($query,$link);
          echo "";

          while($row=mysql_fetch_array($resultado))
          {
              echo "<form method='post' action=''> <table class='tabla_lista_docentes'>
                      <tr><td id='td_caract'>Materia</td><td colspan='7'>".$row['Nombre_Materia']."</td></tr>
                      <tr><td id='td_caract'>Codigo</td><td>".$row['Codigo']."</td>
                      <td>Grupo</td><td>".$row['Grupo']."</td>
                      <td>Nivel</td> <td>".$row['Nivel_Materia']."</td>
                      <td>Carga Horaria</td><td>".$row['Carga_Horaria']." hrs/mes</td></tr>
                      <tr><td id='td_caract'>Materias Relacionadas</td><td colspan='7'>
                      ".$row['Materias_Relacionadas']."</td></tr>
          			
          			  <tr><td>Carrera</td><td colspan='7'>".$row['nombre_carrera']."</td></tr>

                      <tr><td id='td_caract'>Departamento</td><td colspan='7'>
                      ".$row['Departamento']."</td></tr>
                    
                     <tr><td id='td_caract'> <input type='submit' value='Editar' name='btn_Editar_M'></td>
                     <td colspan='7'> <input type='submit' value='Eliminar' name='btn_Eliminar_M'>
                     <input type='text' value='".$row['ID_Materia']."' name='txt_ID_M' style='visibility:hidden'>
                      </td></tr>
                     </form> </table></p>";
          }

         echo "<p></p>";
         }


         if(isset($_POST['btn_Editar_M'])){
          echo "<H3>Editado de Materia</H3>";
          $ID_Materia=$_POST['txt_ID_M'];

           $query="SELECT * FROM materia 
                  WHERE ID_Materia=$ID_Materia";

          $resultado=mysql_query($query,$link);

          while($row=mysql_fetch_array($resultado))
          {
              echo "<form method='post' action=''><table id='tabla_pequena'>
                    
                   
                     <tr><td>Materia </td><td><input type='text' size='100' name='txt_Nombre_M' value='".$row['Nombre_Materia']."'></td></tr>
                     <tr><td>Codigo</td><td><input name='txt_Codigo_M' value='".$row['Codigo']."'></td></tr>
                     <tr><td>Grupo</td><td><input name='txt_Grupo_M' value='".$row['Grupo']."'></td></tr>
                     <tr><td>Nivel</td><td><input name='txt_Nivel_M' value='".$row['Nivel_Materia']."'></td></tr>
                     <tr><td>Carga Horaria</td><td><input name='txt_Carga_M' value='".$row['Carga_Horaria']."'> hrs/mes</td></tr>
                     <tr><td>Materias Relacionadas</td><td><textarea cols='100' rows='5' name='txt_Materias_R'>".$row['Materias_Relacionadas']."</textarea></td></tr>
                     
                     <tr><td>Departamento</td><td><input name='txt_Departamento_M' value='".$row['Departamento']."' size='70'></td></tr>

                     <tr><td>Cambiar Carrera</td><td> <input type='submit' value='Cambiar de Carrera' name='btn_Cambiar_Carrera'>
                    
                     <input type='text' value='".$row['ID_Materia']."' name='txt_ID_M' style='visibility:hidden'>

                     </td></tr> 
                     <tr><td colspan='2'><center> <input type='submit' value='Editar' name='btn_Editar_Materia'></center>
                      
                     </td></tr>
                     </form>";
          }

          echo "  </table>";
         }

      
      if(isset($_POST['btn_Editar_Materia']))
      {
        //echo "MATERIA EDITADA CORRECTAMENTE";
           $ID_Materia=$_POST['txt_ID_M'];
           $Nombre_M=$_POST['txt_Nombre_M'];
           $Codigo_M=$_POST['txt_Codigo_M'];
           $Grupo_M=$_POST['txt_Grupo_M'];
           $Nivel_M=$_POST['txt_Nivel_M'];
           $CargaH_M=$_POST['txt_Carga_M'];
           $Materias_R=$_POST['txt_Materias_R'];
           $Departamento_M=$_POST['txt_Departamento_M'];
           

          $query="UPDATE `materia` 
                 SET `Nombre_Materia` = '$Nombre_M',
                     `Codigo` = '$Codigo_M', 
                     `Grupo` = '$Grupo_M', 
                     `Nivel_Materia` = '$Nivel_M',
                     `Carga_Horaria` = '$CargaH_M',
                     `Materias_Relacionadas` = '$Materias_R',
                     `Departamento` = '$Departamento_M'

                      WHERE `materia`.`ID_Materia` = $ID_Materia;";

          $resultado=mysql_query($query,$link);

          echo "<script>alert('Materia Editada Correctamente');</script>";

      }
 


     if(isset($_POST['btn_Cambiar_Carrera']))
     {
        echo "<h3>SELECCIONE LA FACULTAD</h3>";
         $Codigo_M=$_POST['txt_ID_M'];

        echo "<form method='post' action=''>
        <table id='tabla_grande'>
        
        <tr><td>Seleccione la Facultad :</td><td><select name='select_F[]' class='Select_Facultad'>";
       
        $query="SELECT * FROM facultad";
        $resultado=mysql_query($query,$link);
   
      while($row=mysql_fetch_array($resultado))
      {
         echo "<option value=".$row['ID_Facultad'].">".$row['Facultad']."</option>";
      }
        
      echo "</select></td>
           <td><input type='submit' value='Ingresar' name='btn_Facultad_Materia'>
           <input type='text' value='". $Codigo_M."' name='txt_ID_M' style='visibility:hidden' size='5'></td>
           </tr></table></form>";
     }


     if(isset($_POST['btn_Facultad_Materia'])){
         $Seleccion_F=$_POST['select_F'];
         $Codigo_M=$_POST['txt_ID_M'];

       for ($i=0;$i<count($Seleccion_F);$i++) 
       {  $ID_Facultad=$Seleccion_F[$i];} 

         $query="SELECT * FROM facultad 
         WHERE ID_Facultad=$ID_Facultad";

        $resultado=mysql_query($query,$link);
        echo "<h3>".mysql_result($resultado, 0, "Facultad")."</h3>";

        
        echo "<form method='post'>
             <table id='tabla_grande'>
            
             <tr><td>Seleccione la Carrera :</td><td><select name='select_C[]' class='Select_Facultad'>";
             $query="SELECT * 
             FROM carrera 
             WHERE id_facultad=$ID_Facultad";
            $resultado=mysql_query($query,$link);
            while($row=mysql_fetch_array($resultado))
            {
             
               echo "<option value='".$row['ID_Carrera']."'>".$row['nombre_carrera']."</option>";
            }

         echo "</select></td><td><input type='submit' name='btn_Carrera_Cambio' value='Cambiar'>
              <input type='text' value='". $Codigo_M."' name='txt_ID_M' style='visibility:hidden' size='5'>
         </td></tr></table>
         </form>";
       }
       
        if(isset($_POST['btn_Carrera_Cambio']))
        {
               $Codigo_M=$_POST['txt_ID_M'];
               $Seleccion_C=$_POST['select_C'];

          for ($i=0;$i<count($Seleccion_C);$i++) 
            {  $ID_Carrera=$Seleccion_C[$i];} 

          //echo "el ID DE LA CARRERA :".$ID_Carrera."";
          $query="UPDATE `materia` SET `ID_Carrera` = '$ID_Carrera' WHERE `materia`.`ID_Materia` = $Codigo_M;";
          $resultado=mysql_query($query,$link);
          
          $query="SELECT * FROM carrera WHERE id_carrera=$ID_Carrera";
          $resultado=mysql_query($query,$link);
          echo "<center>Se cambio a la carrera de :<h3>".mysql_result($resultado, 0, "nombre_carrera")."</h3></center>";
          echo "<script>alert('Se Cambio Correctamente');</script>";

          }


       // BOTON ELIMINAR MATERIA

        if(isset($_POST['btn_Eliminar_M']))
        {
            $ID_Materia=$_POST['txt_ID_M'];
            $query="DELETE FROM `materia` WHERE ID_Materia=$ID_Materia";
            $resultado=mysql_query($query,$link);
            echo "<script>alert('Se Cambio Correctamente');</script>";
        }

        //BOTON BUSCAR MATERIAS

        if(isset($_POST['btn_Buscar_Materias'])){
        $Text_a_Buscar=$_POST['txt_buscar_pg'];
        echo 
        '<table id="tabla_Buscador">
         <tr><td> 
         <button onclick="procesar()" id="procesar" class="btn_rec" ';     
        echo 
         '</button></td><td>
          <form method="post">
          <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el Plan Global a Buscar que fue Llenado/Modificado">
          <input type="submit" class="btn_Buscar" name="btn_Buscar_Materias" value="Buscar"></form>
          </td></tr></table>';
        echo "<h1>Resultados de Buscar Materia </h1>";

          $query="SELECT * FROM materia m,carrera c WHERE m.ID_Carrera=c.ID_Carrera AND m.Nombre_Materia='$Text_a_Buscar'
                  ORDER BY m.Nivel_Materia ASC";
          
          $resultado=mysql_query($query,$link);
          echo "";

          while($row=mysql_fetch_array($resultado))
          {
              echo "<form method='post' action=''> <table class='tabla_lista_docentes'>
                      <tr><td id='td_caract'>Materia</td><td colspan='7'>".$row['Nombre_Materia']."</td></tr>
                      <tr><td id='td_caract'>Codigo</td><td>".$row['Codigo']."</td>
                      <td>Grupo</td><td>".$row['Grupo']."</td>
                      <td>Nivel</td> <td>".$row['Nivel_Materia']."</td>
                      <td>Carga Horaria</td><td>".$row['Carga_Horaria']." hrs/mes</td></tr>
                      <tr><td id='td_caract'>Materias Relacionadas</td><td colspan='7'>
                      ".$row['Materias_Relacionadas']."</td></tr>
                      <tr><td>Carrera</td><td colspan='7'>".$row['nombre_carrera']."</td></tr>
                    
                     <tr><td id='td_caract'> <input type='submit' value='Editar' name='btn_Editar_M'></td>
                     <td colspan='7'> <input type='submit' value='Eliminar' name='btn_Eliminar_M'>
                     <input type='text' value='".$row['ID_Materia']."' name='txt_ID_M' style='visibility:hidden'>
                      </td></tr>
                     </form> </table></p>";
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