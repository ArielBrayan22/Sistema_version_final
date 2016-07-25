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
   <link rel="stylesheet" type="text/css" href="estilo.css">
  <link rel="stylesheet" type="text/css" href="estilos1.css">

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
   <DIV ALIGN=RIGHT><a class="redireccion_salir" href="salir.php">salir</a></DIV>
	
	<aside id="menu">
    <div id="titulo"><a id="titulo" href="menu.php">Inicio</a></div>
    <div id="titulo">

    <a id="titulo" href="Plan_Global_Publico.php">Planes Globales</a>
    
    </div>
    <div id="titulo"><a id="titulo" href="Programa_Analitico_Publico.php">Programas Analiticos</a></div>
    <div id="titulo"><a id="titulo" href="Manual_de_Usuario.php">Manual de Usuario</a></div>
    
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
              echo "<tr><td>Cargo:</td><td>Docente</td></tr>";
              echo "<tr><td>Nivel Academico:</td><td>".$row['Profesion']."<td></tr>";
              echo "<tr><td>CodSIS:</td><td>".$row['User_Login']."<td></tr>";
           }
       ?>
    </table>
    
	</aside>

<article id="cuerpo">

 <form method="post" action="">
  <center><input type="submit" class="button_seleccion" name="btn_Materias" value="Lista de Materias Asignadas "></center>
  </form>

  
   <?php
 
     // CODIGO DE NUESTRO DOCENTE
       $CodigoD=$ID_User;
 
       require("coneccion.php");

       if(isset($_POST['btn_Materias']))
       {
          $sql="SELECT * FROM materia m, docente d,planglobal pg
                WHERE d.ID_Docente=$CodigoD AND pg.ID_Docente=d.ID_Docente 
                AND pg.ID_Materia=m.ID_Materia";

          $resultado=mysql_query($sql,$link);
          echo "
                <table id='tabla_Materias'>
                <tr>
                <td><center>Codigo<center></td>
                <td><center>Materia<center></td>
                <td>Cargo</td>
                <td>Grupo</td>
                <td>Imprimir</td>
                <td>Ver</td>
                <td>Editar</td>
                </tr>";

           echo "";
          while($row=mysql_fetch_array($resultado)){
         
          echo "
                <tr>
                <td> <input type='text' style='visibility:hidden' value='".$row['ID_PG']."' name='Cod_PG' size='2'>
              
                <center><input readonly class='id_materia' value='".$row['Codigo']."' name='txtCodM' size='5'>
                </center> </td>

                <td> <input type='text' style='visibility:hidden' value='".$row['ID_PG']."' name='Cod_PG' size='2'></br><center>".$row['Nombre_Materia']."</center></td>

                <td> <input type='text'  style='visibility:hidden' value='".$row['ID_PG']."' name='Cod_PG' size='2'></br><center>".$row['tipo']."</center></td>

                <form method='post' action='Imprimir_Plan_Global_Docente.php'>

                <td> <input type='text' style='visibility:hidden' value='".$row['ID_PG']."' name='Cod_PG' size='2'>
                <center>".$row['Grupo']."</center></td>

                <td><input type='text' style='visibility:hidden' value='".$row['ID_Materia']."' name='Cod_M' size='2'></br>

                <center><input type='submit' name='BtnImprimir' value='Imprimir'></center></td>
                
                </form><form method='post' action=''>

                <td><input type='text' style='visibility:hidden' value='".$row['ID_Materia']."' name='txt_Cod_M' size='2'></br>

                <center><input type='submit' name='btn_Ver_Materia' value='Ver'></center></td>

                <td><input type='text' style='visibility:hidden' value='".$row['ID_PG']."' name='txt_Cod_PG' size='2'></br>
                <center><input type='submit' name='btn_Editar_Materia' value='Editar'></center></td>
                </tr></form> ";
            }

            echo "</table>";
   
       }
       
  

       // BOTON VER MATERIA

       if(isset($_POST['btn_Ver_Materia'])){

          
          $Cod_M=$_POST['txt_Cod_M'];
          $Cod_PG=$_POST['txt_Cod_PG'];  
     
          require ("coneccion.php");
          
           echo '<center><P id="tabla_titulo" >UNIVERSIDAD MAYOR DE SAN SIMON </P>
                <P id="tabla_titulo" >FACULTAD DE CIENCIAS Y TECNOLOGIA</P>
                <hr id="linea_primaria"></hr>
                <h4 id="tabla_titulo">PLAN GLOBAL</h4>';

                  $consulta="SELECT DISTINCT * FROM materia m WHERE m.ID_Materia=$Cod_M";
  
                  $resultado=mysql_query($consulta);

                   while($row=mysql_fetch_array($resultado)){

                   echo '<h4 id="tabla_titulo">'.$row['Nombre_Materia'].'</h4>';}
                   echo '</center>';

                   echo '<hr id="linea_secundaria"></hr>';

 //I. DATOS DE IDENTIFICACION
                   echo '<H4 id="tabla_title">I. DATOS DE IDENTIFICACION</H4>';


    echo '<table id="tabla_Ident">';

          $consulta="SELECT DISTINCT * FROM materia m WHERE m.ID_Materia=$Cod_M";
  
          $resultado=mysql_query($consulta);

        while($row=mysql_fetch_array($resultado)){

           echo ' <tr><td><li type="square">Nombre de la materia :</li></td><td>'.
                $row['Nombre_Materia'].'</td></tr>
               <tr><td><li type="square">Codigo :</li></td><td>'
               .$row['Codigo'].'</td></tr>
               <tr><td><li type="square">Grupo :</li></td><td>'
               .$row['Grupo'].'</td></tr>
               <tr><td><li type="square">Carga horaria:</li></td><td>'
               .$row['Carga_Horaria'].'</td></tr>
               <tr><td><li type="square">Materias Relacionadas:</li></td><td>'
               .$row['Materias_Relacionadas'].'</td></tr>';

          }
         

    echo '<tr><td><li type="square">Docente :</li></td><td>
           <table>';
           
              $consulta="SELECT * FROM planglobal pg,materia m,docente d 
                   WHERE m.ID_Materia=$Cod_M AND pg.ID_Materia=m.ID_Materia 
                   AND pg.ID_Docente=d.ID_Docente";
  
        $resultado=mysql_query($consulta);

        while($row=mysql_fetch_array($resultado)){

           echo '<tr><td>'.$row['Nombre_Completo'].' '
                          .$row['Apellido_Paterno'].' '
                          .$row['Apellido_Materno'].' '
                          .'</td></tr>';
          }

    echo '</table
             </td></tr>';
  // MOSTRAR TELEFONOS
    echo '<tr><td><li type="square">Telefono :</li></td><td>
           <table>';

           $consulta="SELECT * FROM planglobal pg,materia m,docente d 
                      WHERE m.ID_Materia=$Cod_M AND pg.ID_Materia=m.ID_Materia 
                      AND pg.ID_Docente=d.ID_Docente";
  
        $resultado=mysql_query($consulta);

        while($row=mysql_fetch_array($resultado)){

           echo '<tr><td>'.$row['Telefono'].'</td></tr>';
          } 
          
    echo  '</table></td></tr>';

    //MOTRANDO CORREOS

    echo '<tr><td><li type="square">Correo :</li></td><td>
           <table>';

           $consulta="SELECT * FROM planglobal pg,materia m,docente d 
                      WHERE m.ID_Materia=$Cod_M AND pg.ID_Materia=m.ID_Materia 
                      AND pg.ID_Docente=d.ID_Docente";
  
        $resultado=mysql_query($consulta);

        while($row=mysql_fetch_array($resultado)){

           echo '<tr><td>'.$row['Correo'].'</td></tr>';
          } 
          
    echo  '</table></td></tr></table>';


    //MOSTRAR JUSTIFICACION

         echo '<H4 id="tabla_title">II. JUSTIFICACION</H4>'; 
        
         echo '<table id="tabla_Ident">';

          $query="SELECT * FROM justificacion j,planglobal pg 
                  WHERE j.ID_PG='$Cod_PG' AND j.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>'.$row['Justificacion'].'</td></tr>'; } 
          
          echo  '</table>';


  //MOSTRAR OBJETIVOS

           //MOSTRAR JUSTIFICACION

         echo '<H4 id="tabla_title">III. OBJETIVOS</H4>'; 
        
         echo '<table id="tabla_Ident">';

          $query="SELECT * FROM objetivo o,planglobal pg 
                  WHERE o.ID_PG='$Cod_PG' AND o.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>&bull; '.$row['Texto_Obj'].'</td></tr>'; } 
          
          echo  '</table>';

 //MOSTRAR SELECCION Y ORGANIZACION DE CONTENIDOS

          echo '<H4 id="tabla_title_large">IV. SELECCION Y ORGANIZACION DE CONTENIDOS</H4>'; 
        
        

          $query="SELECT COUNT(*) FROM unidad u,planglobal pg 
                  WHERE u.ID_PG='$Cod_PG' AND u.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query,$link);
          $u=mysql_result($resultado, 0, "COUNT(*)");
          
          $query1=" SELECT * FROM unidad u,planglobal pg 
                    WHERE u.ID_PG='$Cod_PG' AND u.ID_PG=pg.ID_PG";
          $resultado1=mysql_query($query1,$link);
          
         echo '<table id="tabla_Ident"><tr><td>';
        
         for ($i=0; $i <$u; $i++) { 
             
              
             mysql_result($resultado1, $i, "Unidad");
             $id_unidad=mysql_result($resultado1, $i, "ID_Unidad");
        
             echo '<h4> Unidad '.mysql_result($resultado1, $i, "Numero_Unidad").' .-
             '.mysql_result($resultado1, $i, "Unidad").'</h4>';


             //OBJETIVO
             $query2="SELECT COUNT(*) FROM seccion_objetivo WHERE ID_Unidad=$id_unidad";
             $resultado2=mysql_query($query2,$link);

             $n=mysql_result($resultado2, 0, "COUNT(*)");
             
             echo "</p>Objetivo(s) de las unidad:</br>";

              for ($j=0; $j <$n ; $j++) { 
                 
                  $query3="SELECT * FROM seccion_objetivo WHERE ID_Unidad=$id_unidad";
                  $resultado3=mysql_query($query3,$link);
                  
                   echo '&nbsp;&nbsp;&nbsp;&nbsp; &bull; '.mysql_result($resultado3, $j, "Objetivo").'</br>';
    
                }
                

             // CONTENIDO

                $query4="SELECT COUNT(*) FROM seccion_contenido WHERE ID_Unidad=$id_unidad";
                $resultado4=mysql_query($query4,$link);

                $m=mysql_result($resultado4, 0, "COUNT(*)");
                echo "</p>Contenido : </br>";
                 
                for ($k=0; $k <$m ; $k++) { 
                    $query5="SELECT * FROM seccion_contenido WHERE ID_Unidad=$id_unidad";
                    $resultado5=mysql_query($query5,$link);
                 
                 echo '&nbsp;&nbsp;&nbsp;&nbsp;'.mysql_result($resultado5, $k, "Contenido").'</br>';

                }
                
             }

             echo '</td></tr></table>';


        //MOSTRAMOS METODOLOGIAS

         echo '<H4 id="tabla_title">V. METODOLOGIAS</H4>'; 
        
         echo '<table id="tabla_Ident">';

          $query="SELECT * FROM metodologia m,planglobal pg 
                  WHERE m.ID_PG='$Cod_PG' AND m.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>&bull; '.$row['Metodologia'].'</td></tr>'; } 
          
          echo  '</table>';  

          //MOSTRAREMOS CRONOGRAMA O DURACIÓN EN PERIODOS ACADÉMICOS POR UNIDAD
         
          echo '<H4 id="tabla_title_large_2" >VI. CRONOGRAMA O DURACIÓN EN PERIODOS ACADÉMICOS POR UNIDAD</H4>'; 
        
         echo '<table id="tabla_Ident">';

          $query="SELECT * FROM planglobal pg,unidad u WHERE pg.ID_PG='$Cod_PG' AND pg.ID_PG=u.ID_PG";

          $resultado=mysql_query($query);
          echo '<tr><td id="titulo_tabla">Unidad</td>
                    <td id="titulo_tabla">Duracion </br> (Horas Academicas)</td>
                    <td id="titulo_tabla">Duracion en Semana</td></tr>';

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>&bull; '.$row['Unidad'].'</td><td id="td_Medio" >'.
                     $row['Hora_Academica'].'</td><td id="td_Medio">'.$row['Cant_Semana'].'</td></tr>'; } 
          
          echo  '</table>';  

          //MOSTRAREMOS CRITERIOS DE EVALUACION

          echo '<H4 id="tabla_title">VII. CRITERIOS DE EVALUACION</H4>'; 
        
          echo '<table id="tabla_Ident">';

          $query="SELECT * FROM criterio c,planglobal pg 
                  WHERE c.ID_PG='$Cod_PG' AND c.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>&bull; '.$row['Criterio'].'</td></tr>'; } 
          
          echo  '</table>';  
         
          //MOSTRAREMOS BIBLIOGRAFIA

          echo '<H4 id="tabla_title">VIII. BIBLIOGRAFIA</H4>'; 
        
          echo '<table id="tabla_Ident">';

          $query="SELECT * FROM bibliografia b,planglobal pg 
                  WHERE b.ID_PG='$Cod_PG' AND b.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>&bull; '.$row['texto'].'</td></tr>'; } 
          
          echo  '</table>'; 

       }


       
      // BOTON EDITAR MATERIA

       if(isset($_POST['btn_Editar_Materia'])){

         $Cod_Materia=$_POST['txt_Cod_M'];
         $Cod_PG=$_POST['txt_Cod_PG'];


       
        $query="SELECT * FROM planglobal pg,materia m,docente d 
        WHERE pg.ID_PG=$Cod_PG AND m.ID_Materia=$Cod_Materia AND pg.ID_Materia=m.ID_Materia 
        AND pg.ID_Docente=d.ID_Docente";

        $resultado=mysql_query($query,$link);
        echo "<form method='post' action=''>
       
        <div><table id='tabla_Identificacion'><tr><td colspan='2'>
        <center><h4> DATOS DE IDENTIFICACION </h4>
        <input type='text' value='".$Cod_PG."' name='txt_Cod_PG' style='visibility:hidden'>  
        <input type='text' value='".$Cod_Materia."' name='txt_Cod_M' style='visibility:hidden'> 
        </center></td></tr>";
        while ($row=mysql_fetch_array($resultado)) {
        
          echo " <tr><td>&bull; Nombre de la materia: </td>
          <td>".$row['Nombre_Materia']."</br></td></tr>";

          echo " <tr><td>&bull; Codigo: </td>
          <td>".$row['Codigo']."</br></td></tr>";

          echo " <tr><td>&bull; Grupo: </td>
          <td>".$row['Grupo']."</br></td></tr>";

          echo " <tr><td>&bull; Carga Horaria: </td>
          <td><input type='text' name='txt_Carga_Horaria' value='".$row['Carga_Horaria']."'></br></td></tr>";

          echo " <tr><td>&bull; Materias con las que se relaciona </td>
          <td>".$row['Materias_Relacionadas']."</br></td></tr>";
         
          echo '<tr><td>&bull; Docente: </td>
          <td><input type="text" name="txt_Nombre" value="'.$row['Nombre_Completo'].'">&nbsp;'
           .'<input type="text"  name="txt_Apellido_P" value="'.$row['Apellido_Paterno'].'">&nbsp;'
           .'<input type="text"  name="txt_Apellido_M" value="'.$row['Apellido_Materno'].'">&nbsp;</td></tr>';

          echo " <tr><td>&bull; Telefono: </td><td><input name='txt_Telefono' value='".$row['Telefono']."'></td></tr>";
          echo " <tr><td>&bull; Correo Electronico: </td><td><input name='txt_Correo' value='".$row['Correo']."' size='40'></td></tr>";
        }
          
        echo "<tr><td ><center><input type='submit' value='Editar' name='btn_Editar_Datos_Ident'></center></td>
        <td><center><input type='submit' value='Siguiente Paso' name='btn_Justificacion'></center></td></tr>
        </table></form></div>";
        
       }

       //BOTON EDITAR IDENTIFICACION
       if(isset($_POST['btn_Editar_Datos_Ident']))
       {
          $Carga_H=$_POST['txt_Carga_Horaria'];
          $Nombre=$_POST['txt_Nombre'];
          $Apellido_P=$_POST['txt_Apellido_P'];
          $Apellido_M=$_POST['txt_Apellido_M'];
          $Telefono=$_POST['txt_Telefono'];
          $Correo=$_POST['txt_Correo'];

          $Cod_Materia=$_POST['txt_Cod_M'];
          $Cod_PG=$_POST['txt_Cod_PG'];
          $CodigoD;

           $query1="UPDATE `docente` SET 
                   `Nombre_Completo` = '$Nombre',
                   `Apellido_Paterno` = '$Apellido_P', 
                   `Apellido_Materno` = '$Apellido_M',
                   `Telefono` = '$Telefono',
                   `Correo` = '$Correo'
                    WHERE `docente`.`ID_Docente` = $CodigoD;";

         $resultado=mysql_query($query1,$link);

         $query2="UPDATE `materia` SET `Carga_Horaria` = '$Carga_H' WHERE `materia`.`ID_Materia` =$Cod_Materia";

         $resultado2=mysql_query($query2,$link);

         echo "<script>alert('Datos Editados Correctamente');</script>";

         echo "<form method='post'>
               <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$Cod_PG."'>
               <input type='submit' name='btn_Editar_Materia' value='atras'>
               </form>";

         }


       // BOTON JUSTIFICACION

       if(isset($_POST['btn_Justificacion']))
       {
          $Cod_Materia=$_POST['txt_Cod_M'];
          $Cod_PG=$_POST['txt_Cod_PG'];       
       
        echo "<div><center><table id='tabla_justificacion'>
        <tr><td><center><h4> JUSTIFICACION </h4>
      
        </center></td></tr>";
        echo "<form method='post'>
       
        <tr><td><textarea cols='120' rows='3' name='txt_justificacion'
        placeholder='Ingresar nueva Justificaccion'></textarea>
        <input type='text' name='ID_PG' style='visibility:hidden' value='".$Cod_PG."'>
        <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_PG."'>
        </td></tr>
        <tr><td><center>
        <input type='submit' name='btn_Crear_Justificacion' value='Crear Justificaccion'>
        </center></td></tr>     
        </form>";


        $query="SELECT * FROM justificacion j
         WHERE   j.ID_PG='$Cod_PG'";

        $resultado=mysql_query($query,$link);
      
        while ($row=mysql_fetch_array($resultado)) {
              
              echo "<form method='post' action=''>
                <tr><td>
                <textarea name='txt_justificacion' cols='120' rows='15' >".$row['Justificacion']."</textarea>
                <input type='text' name='ID_PG' style='visibility:hidden' value='".$Cod_PG."'>
                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                <input type='text' name='ID_J' style='visibility:hidden'  value='".$row['Id_Justificacion']."'>
                </td></tr>
               <tr><td>
               <center><input type='submit' value='Eliminar' name='btn_Eliminar_Justificacion'>
               <input type='submit' value='Editar' name='btn_Editar_Justificacion'>
               </center>
               </form> </td></tr>";}

             echo "<form method='post'>
                   <tr><td><center>              
                   <input type='submit' name='btn_Editar_Materia' value='Anterior'>
                   <input type='submit' value='Siguiente' name='btn_Objetivos'>
                   </center>
                   <input type='text' name='txt_Cod_M' style='visibility:hidden' 
                   value='".$Cod_Materia."'>
                   <input type='text' name='txt_Cod_PG' style='visibility:hidden'
                   value='".$Cod_PG."'>
                   
                   </td></tr></table></center></form></div>";
       }

   //BOTON PARA CREAR UN NUEVA JUSTIFICACION 

      if(isset($_POST['btn_Crear_Justificacion'])){
        
        $Texto=$_POST['txt_justificacion'];
        $Cod_Materia=$_POST['txt_Cod_M'];
        $ID_PG=$_POST['ID_PG'];
        $CodigoD;

        $query="INSERT INTO `justificacion` (`Id_Justificacion`, `Justificacion`, `ID_PG`) VALUES (NULL,'$Texto','$ID_PG')";
        
        $resultado=mysql_query($query,$link);
        echo "<script>alert('Justificacion Creada Correctamente');</script>";

         echo "<form method='post'>
               <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
             
              <center> <input type='submit' name='btn_Justificacion' value='atras'></center>
               </form>";
        }

      
      //BOTON ELIMINAR JUSTIFICACION

      if(isset($_POST['btn_Eliminar_Justificacion'])){
        $ID_J=$_POST['ID_J'];
        $Cod_Materia=$_POST['txt_Cod_M'];
        $ID_PG=$_POST['ID_PG'];
        $CodigoD;

        $query="DELETE FROM `justificacion` WHERE Id_Justificacion='$ID_J'";
        $resultado=mysql_query($query,$link);
        echo "<script>alert('Justificacion Eliminada Correctamente');</script>";

         echo "<form method='post'>
               <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
               <center><input type='submit' name='btn_Justificacion' value='atras'></center>
               </form>";
      }

      //BOTON EDITAR JUSTIFICACION

      if(isset($_POST['btn_Editar_Justificacion']))
      { 
        $ID_J=$_POST['ID_J'];
        $Texto=$_POST['txt_justificacion'];
        $Cod_Materia=$_POST['txt_Cod_M'];
        $ID_PG=$_POST['ID_PG'];
        $CodigoD;
        $query="UPDATE `justificacion` SET `Justificacion` = '$Texto', `ID_PG` = '$ID_PG' 
                WHERE `justificacion`.`Id_Justificacion` = $ID_J;";

        $resultado=mysql_query($query,$link);
        echo "<script>alert('Justificacion Editada Correctamente');</script>";

        echo "<form method='post'>
               <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
               <center><input type='submit' name='btn_Justificacion' value='atras'></center>
               </form>";


      }

       // BOTON OBJETIVOS

       if(isset($_POST['btn_Objetivos'])){

        $Cod_Materia=$_POST['txt_Cod_M'];
        $ID_PG=$_POST['txt_Cod_PG'];
        $CodigoD;
      
       
        echo "<table id='tabla_Objetivo'><tr><td colspan='3'>
              <center><h4>OBJETIVOS</h4></center></td></tr>";

        echo "<form method='post'>
   
              <tr><td colspan='3'><textarea cols='120' rows='3'  name='txt_new_Objetivo'
              placeholder='Ingrese su nuevo Objetivo'></textarea>

              <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>

              <input type='text' name='ID_PG' style='visibility:hidden' value='".$ID_PG."'></td></tr>

              <tr><td colspan='3'><center>
              <input type='submit' value='Ingresar' name='btn_Ingresar_Objetivo'>
              </center></td></tr>";
           
        $query="SELECT * FROM objetivo
                WHERE ID_PG=$ID_PG";
       
        $resultado=mysql_query($query,$link);

        while ($row=mysql_fetch_array($resultado)) {
                      
            echo "<form method='post' action=''>    
                  <tr><td>
                  <textarea name='txt_Objetivo' cols='100' rows='3'>".$row['Texto_Obj']."</textarea>
                  <input type='text' name='ID_PG' style='visibility:hidden' value='".$ID_PG."'>
                  <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                  <input type='text' style='visibility:hidden' value='".$row['ID_Objetivos']."' name='txt_Cod_O'>
                  </td>
                  <td><input type='submit' name='btn_Editar_Objetivo' value='Editar'></td>
                  <td><input type='submit' name='btn_Eliminar_Objetivo' value='Eliminar'>
                  </form></td></tr>";
                }


             echo "
                   <form method='post' action=''>
                   
                   <tr><td colspan='3'>
                   <center>
                   <input type='submit' value='Anterior' name='btn_Justificacion'>
                   <input type='submit' value='Siguiente' name='btn_Contenidos'>
                   </center>
                   <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                   <input type='text' name='txt_Cod_M' style='visibility:hidden'  value='".$Cod_Materia."'>
                   </form></td></tr></table></form>";
         }
      

        //BOTON INGRESAR NUEVO OBJETIVO
        
        if(isset($_POST['btn_Ingresar_Objetivo'])){
        
         $Cod_Materia=$_POST['txt_Cod_M'];
         $ID_PG=$_POST['ID_PG'];
         $Txt_Objetivo=$_POST['txt_new_Objetivo'];

         $query="INSERT INTO `objetivo` (`ID_Objetivos`, `ID_PG`, `Texto_Obj`) 
                 VALUES (NULL, '$ID_PG','$Txt_Objetivo');";
         $resultado=mysql_query($query,$link);  
         
         echo "<script>alert('Se Inserto Correctamente');</script>";

         echo "<form method='post'>
               <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
               <center><input type='submit' name='btn_Objetivos' value='atras'></center>
               </form>";

       }
      
       //BOTON EDITAR OBJETIVOS

       if(isset($_POST['btn_Editar_Objetivo'])){
         $Cod_Materia=$_POST['txt_Cod_M'];
         $ID_PG=$_POST['ID_PG'];
         $ID_O=$_POST['txt_Cod_O'];
         $Txt_O=$_POST['txt_Objetivo'];

         $query="UPDATE `objetivo` SET `Texto_Obj` = '$Txt_O' WHERE ID_Objetivos=$ID_O";
         $resultado=mysql_query($query,$link);

         echo "<script>alert('Se edito Correctamente');</script>";

          echo "<form method='post'>
               <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
               <center><input type='submit' name='btn_Objetivos' value='atras'></center>
               </form>";
      
       }

       //BOTON ELIMINAR LOS OBJETIVOS

         if(isset($_POST['btn_Eliminar_Objetivo'])){
         
         $Cod_Materia=$_POST['txt_Cod_M'];
         $ID_PG=$_POST['ID_PG'];
         $ID_O=$_POST['txt_Cod_O'];
         $Txt_O=$_POST['txt_Objetivo'];

         $query="DELETE FROM objetivo WHERE ID_Objetivos=$ID_O";
         $resultado=mysql_query($query,$link);
         echo "<script>alert('Se elimino Correctamente');</script>";

         echo "<form method='post'>
               <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
               <center><input type='submit' name='btn_Objetivos' value='atras'></center>
               </form>";
       }   


      // BOTON INGRESO DE UNIDADES Y TEMAS 

       if(isset($_POST['btn_Contenidos']))
       {
          $ID_PG=$_POST['txt_Cod_PG'];
          $Cod_Materia=$_POST['txt_Cod_M'];
         echo "<center>
               <table id='tabla_Unidad'><tr><td><center><h4>CONTENIDOS</h4>
               </center></td</tr>";

         //BOTON DE CREACION DE UNIDAD
         echo "<tr><td>
               <form method='post' action=''>
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
               <center> 
               <input type='submit' name='btn_Ingresar_Nueva_Unidad' value='Ingresar Nueva Unidad'>
               </center>
               </form> </td></tr>";


        $query="SELECT COUNT(*) FROM unidad 
        WHERE ID_PG=$ID_PG";

        $resultado=mysql_query($query,$link);
        $u=mysql_result($resultado, 0, "COUNT(*)");
        //echo $u;
        $query1="SELECT * FROM unidad WHERE ID_PG=$ID_PG";
        $resultado1=mysql_query($query1,$link);
        
        
         for ($i=0; $i <$u; $i++) { 
             
              
             mysql_result($resultado1, $i, "Unidad");
             $id_unidad=mysql_result($resultado1, $i, "ID_Unidad");
        
             echo "<tr><td>

              <form method='post' action=''> 
              <input type='text' name='ID_Unidad' style='visibility:hidden' value='".$id_unidad."'>
              <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
              
              <table id='tabla_sub_Unidad'>
              <tr><td><h4>Unidad </h4><textarea cols='80' rows='3' name='txt_Unidad'>"
              .mysql_result($resultado1, $i, "Unidad")."</textarea></td>

              <td><h4>Numero</h4>
              <input type='text' size='3' value='".mysql_result($resultado1, $i, "Numero_Unidad")
                ."' name='txt_Numero_U'></td>

              <td><input type='submit' value='Editar' name='btn_Editar_Unidad'></br>
               <input type='submit' value='Agregar' name='Btn_Agregrar_Objetivos_Contenidos'></td>
              <td><input type='submit' value='Eliminar' name='btn_Eliminar_Unidad'></td>
              </tr></table></form>

                   </td></tr>";


             //OBJETIVO
             $query2="SELECT COUNT(*) FROM seccion_objetivo 
                     WHERE ID_Unidad=$id_unidad";
             $resultado2=mysql_query($query2,$link);

             $n=mysql_result($resultado2, 0, "COUNT(*)");
                    echo "<tr><td><h4>OBJETIVOS</h4> </td></tr>";
                for ($j=0; $j <$n ; $j++) { 
                 
                  $query3="SELECT * FROM seccion_objetivo 
                           WHERE ID_Unidad=$id_unidad";
                  $resultado3=mysql_query($query3,$link);
                   echo "<tr><td>

                   <form method='post' action=''> 
                   <input type='text' name='ID_Objetivo_U' style='visibility:hidden' value='".mysql_result($resultado3, $j, "ID_Objetivo")."'>
                   <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                   <table>
                   <tr><td><textarea cols='100' rows='3' name='txt_Objetivo'>"
                   .mysql_result($resultado3, $j, "Objetivo")."</textarea></td>
                   <td><input type='submit' value='Editar' name='btn_Editar_Objetivos_Unidad'></td>
                   <td><input type='submit' value='Eliminar' name='btn_Eliminas_Objetivos_Unidad'></td>
                   </tr>

                   </table></form>
                   
                   <tr><td>";
                }

             // CONTENIDO

                $query4="SELECT COUNT(*) FROM seccion_contenido 
                         WHERE ID_Unidad=$id_unidad";
                $resultado4=mysql_query($query4,$link);

                $m=mysql_result($resultado4, 0, "COUNT(*)");
                 echo "<tr><td><h4>CONTENIDOS</h4></td></tr>";
                 for ($k=0; $k <$m ; $k++) { 
                  $query5="SELECT * FROM seccion_contenido 
                           WHERE ID_Unidad=$id_unidad";
                  
                  $resultado5=mysql_query($query5,$link);
                 
                 echo "<tr><td>
                       <form method='post' action=''> 
                       
                       <input type='text' name='ID_Cont_U' style='visibility:hidden' value='"
                        .mysql_result($resultado5, $k, "ID_Contenido")."'>

                       <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                       <table>
                       <tr><td><textarea cols='100' rows='3' name='txt_Contenido'>"
                       .mysql_result($resultado5, $k, "Contenido")."</textarea></td>
                       <td><input type='submit' value='Editar' name='btn_Editar_Contenido_U'></td>
                       <td><input type='submit' value='Eliminar' name='btn_Eliminar_Contenido_U'></td>
                       </tr>
                       </table></form>
                      </td></tr>";
                }
             }

           
           
             echo "<tr><td><form method='post' action=''>

                    <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                    <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                    <center><input type='submit' name='btn_Objetivos' value='Anterior'>
                    <input type='submit' name='btn_Metodologias' value='Siguiente'></center>
                    </form></td></tr></table></center>";
         }

       
        //BOTON INSERTAR UNIDAD PARTE 1 

       if(isset($_POST['btn_Ingresar_Nueva_Unidad']))
       {
          $ID_PG=$_POST['txt_Cod_PG'];

          echo "<table id='tabla_Insertar_Unidad'>
          <tr><td><center><h4>INSERTAR NUEVA UNIDAD</h4></center></td></tr>";

          echo "<tr><td>
                <form method='post' action=''>

          <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
          <table id='tabla_Insertar_Unidad'>
          <tr><td>Unidad :</td><td><textarea name='txt_Unidad' cols='80' rows='3' ></textarea></td></tr>
          <tr><td>Numero de la Unidad :</td><td><input type='text'  name='txt_Numero_U' size='5'></td></tr>
          <tr><td>Duracion en Horas :</td><td><input type='text'  name='txt_Cant_Hrs' size='5'> (hrs)</td></tr>
          <tr><td>Duracion en Semanas :</td><td><input type='text'  name='txt_Num_Sem' size='5'> (semanas)</td></tr>

          <tr><td colspan='2'><input type='submit' value='Ingresar' name='btn_Registrar_Unidad'></td></tr>
          </tr></table></form>";

           echo "<form method='post'>
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                <center><input type='submit' name='btn_Contenidos' value='atras'></center>
                </form>

           </td></tr></table>";

        }  

         //BOTON REGISTRAR UNIDAD

        if(isset($_POST['btn_Registrar_Unidad'])){
         
         // echo "<center><table id='tabla_sub_Creacion_Unidad'>";

          $Txt_Unidad=$_POST['txt_Unidad'];
          $Num_U=$_POST['txt_Numero_U'];
          $ID_PG=$_POST['txt_Cod_PG'];
          $txt_Cant_Hrs=$_POST['txt_Cant_Hrs'];
          $txt_Num_Sem=$_POST['txt_Num_Sem'];


         $query="INSERT INTO `unidad` (`ID_Unidad`, `Unidad`, `Numero_Unidad`, `Hora_Academica`, `Cant_Semana`, `ID_PG`) 
                  VALUES (NULL, '$Txt_Unidad', '$Num_U', '$txt_Cant_Hrs', '$txt_Num_Sem', '$ID_PG');";
         mysql_query($query,$link);

         echo "<script>alert('Unidad Creada Exitosamente');</script>";
         $query2="SELECT * FROM planglobal WHERE ID_PG='$ID_PG'";
         $coneccion=mysql_query($query2,$link);
         
         while($row=mysql_fetch_array($coneccion))
         {
          $Cod_Materia=$row['ID_Materia'];
         }

         echo "<form method='post' action=''>

                    <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                    <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                    <center><input type='submit' name='btn_Contenidos' value='atras'></center>
                    </form>";
         
        }  

         //BTN EDITAR UNIDAD

        if(isset($_POST['btn_Editar_Unidad']))
         {
           //ECHO "Estoy en Editar Unidad";
           $ID_PG=$_POST['txt_Cod_PG'];
           $ID_Unidad=$_POST['ID_Unidad'];
           $text_U=$_POST['txt_Unidad'];
           $ID_Numero_U=$_POST['txt_Numero_U'];
           
           $query="UPDATE `unidad` SET `Unidad` = '$text_U', `Numero_Unidad` = 
           '$ID_Numero_U' WHERE `unidad`.`ID_Unidad` = $ID_Unidad;";
           
           $resultado=mysql_query($query,$link);

           echo "<script>alert('Edicion de Unidad Correcta')</script>";
           
           $query2="SELECT * FROM planglobal WHERE ID_PG='$ID_PG'";
           $coneccion=mysql_query($query2,$link);
         
           while($row=mysql_fetch_array($coneccion))
           {
            $Cod_Materia=$row['ID_Materia'];}

            echo "<form method='post' action=''>

                    <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                    <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                    <center><input type='submit' name='btn_Contenidos' value='atras'></center>
                    </form>";
         }

         //BOTON ELIMINAR UNIDAD

         if(isset($_POST['btn_Eliminar_Unidad']))
         {
            $text_U=$_POST['txt_Unidad'];
            $ID_Unidad=$_POST['ID_Unidad'];
            $ID_PG=$_POST['txt_Cod_PG'];
            $ID_Numero_U=$_POST['txt_Numero_U'];

           $query="SELECT * FROM `seccion_objetivo` WHERE ID_Unidad=$ID_Unidad";
           $resultado=mysql_query($query,$link);

           $query="DELETE FROM `seccion_contenido` WHERE ID_Unidad=$ID_Unidad";
           $resultado=mysql_query($query,$link);
           
           $query="DELETE FROM `unidad` WHERE ID_Unidad=$ID_Unidad";
           $resultado=mysql_query($query,$link);

           $query2="SELECT * FROM planglobal WHERE ID_PG='$ID_PG'";
           $coneccion=mysql_query($query2,$link);
         
           while($row=mysql_fetch_array($coneccion))
           {
            $Cod_Materia=$row['ID_Materia'];}

           echo "<form method='post'>
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                <center><input type='submit' name='btn_Contenidos' value='atras'></center>
                </form>";

           echo "<script>alert('Eliminacion de Unidad Correctamente');</script>";
         }

      // Btn_Agregrar_Objetivos_Contenidos
          
          if(isset($_POST['Btn_Agregrar_Objetivos_Contenidos']))
          {
               $ID_Unidad=$_POST['ID_Unidad'];
               $ID_PG=$_POST['txt_Cod_PG'];
              $query="SELECT * FROM unidad WHERE ID_Unidad='$ID_Unidad'";
              $coneccion=mysql_query($query);
              while($row=mysql_fetch_array($coneccion))
              { $Unidad=$row['Unidad'];}

              echo "<center>
              <table id='tabla_Insertar_Objetivo'><tr><td><h4>UNIDAD :".$Unidad."</td></tr>"; 

              echo "<tr><td>
              <form method='post'>
              <table>
              <input type='text' name='ID_Unidad' style='visibility:hidden' value='".$ID_Unidad."'>
              <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
              <tr><td><h4>Agregar Objetivos</h4></td></tr>
              <tr><td><textarea cols='70' rows='5' name='txt_Objetivo'> </textarea></td>
              <td><input type='submit' name='btn_Agregar_Unidad_Objetivo' value='Agregar'></td>
              </table></td></tr></td></tr></form>";

               echo "<tr><td>
              <form method='post'>
              <table>
              <input type='text' name='ID_Unidad' style='visibility:hidden' value='".$ID_Unidad."'>
              <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>   
              <tr><td><h4>Agregar Contenidos</h4></td></tr>
              <tr><td><textarea cols='70' rows='5' name='txt_Contenido'> </textarea></td>
              <td><input type='submit' name='btn_Agregar_Unidad_Contenido' value='Agregar'></td>
              </table></form></td></tr></td></tr></table>";
            
            $query2="SELECT * FROM planglobal WHERE ID_PG='$ID_PG'";
            $coneccion=mysql_query($query2,$link);
         
            while($row=mysql_fetch_array($coneccion))
            {
             $Cod_Materia=$row['ID_Materia'];}

            echo "<form method='post'>
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                <center><input type='submit' name='btn_Contenidos' value='atras'></center>
                </form>";


          }

        //btn_Agregar_Unidad_Objetivo
        
        if(isset($_POST['btn_Agregar_Unidad_Objetivo']))
        {
            $ID_Unidad=$_POST['ID_Unidad'];
            $ID_PG=$_POST['txt_Cod_PG'];
            $Objetivo=$_POST['txt_Objetivo'];

            $query="INSERT INTO `seccion_objetivo` (`ID_Objetivo`, `Objetivo`, `ID_Unidad`) 
                    VALUES (NULL, '$Objetivo', '$ID_Unidad');";
            $resultado=mysql_query($query,$link);

            echo "<script>alert('Datos ingresados Correctamente');</script>";

            echo "<form method='post'>
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                <input type='text' name='ID_Unidad' style='visibility:hidden' value='".$ID_Unidad."'>
                <center><input type='submit' name='Btn_Agregrar_Objetivos_Contenidos' value='atras'></center>
                </form>";

        }
         
        //btn_Agregar_Unidad_Contenido
        if(isset($_POST['btn_Agregar_Unidad_Contenido']))
        { 
            $ID_Unidad=$_POST['ID_Unidad'];
            $ID_PG=$_POST['txt_Cod_PG'];
            $Contenido=$_POST['txt_Contenido'];

            $query="INSERT INTO `seccion_contenido` (`ID_Contenido`, `Contenido`, `ID_Unidad`) 
                    VALUES (NULL, '$Contenido', '$ID_Unidad');";
            $resultado=mysql_query($query,$link);

            echo "<script>alert('Datos ingresados Correctamente');</script>";

            echo "<form method='post'>
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                <input type='text' name='ID_Unidad' style='visibility:hidden' value='".$ID_Unidad."'>
                <center><input type='submit' name='Btn_Agregrar_Objetivos_Contenidos' value='atras'></center>
                </form>";

        }


        //BOTON EDITAR OBJETIVOS DE UNIDAD 

         if(isset($_POST['btn_Editar_Objetivos_Unidad']))
         {
          
          $ID_Objetivo_U=$_POST['ID_Objetivo_U'];
          $ID_PG=$_POST['txt_Cod_PG'];
          $txt_Obj_U=$_POST['txt_Objetivo'];

          $query="UPDATE `seccion_objetivo` SET `Objetivo` = '$txt_Obj_U' 
          WHERE `seccion_objetivo`.`ID_Objetivo` = $ID_Objetivo_U;";
          $resultado=mysql_query($query,$link);
 
          $query2="SELECT * FROM planglobal WHERE ID_PG='$ID_PG'";
          $coneccion=mysql_query($query2,$link);
          
          while($row=mysql_fetch_array($coneccion))
          {$Cod_Materia=$row['ID_Materia'];}

          echo "<form method='post'>
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                <center><input type='submit' name='btn_Contenidos' value='atras'></center>
                </form>";
         }

        //BOTON ELIMINAR OBJETIVOS UNIDAD
         if(isset($_POST['btn_Eliminas_Objetivos_Unidad']))
         {
          
           $ID_Objetivo_U=$_POST['ID_Objetivo_U'];
        
           $ID_PG=$_POST['txt_Cod_PG'];
         
           $txt_Obj_U=$_POST['txt_Objetivo'];

          $query="DELETE FROM `seccion_objetivo` WHERE `seccion_objetivo`.`ID_Objetivo` = $ID_Objetivo_U;";
          $resultado=mysql_query($query,$link);

          $query2="SELECT * FROM planglobal WHERE ID_PG='$ID_PG'";
          $coneccion=mysql_query($query2,$link);
          
          while($row=mysql_fetch_array($coneccion))
          {$Cod_Materia=$row['ID_Materia'];}

          echo "<form method='post'>
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                <center><input type='submit' name='btn_Contenidos' value='atras'></center>
                </form>";

         }


        //BOTON EDITAR CONTENIDOS
    
         if(isset($_POST['btn_Editar_Contenido_U']))
         {
           
            $ID_Cont_U=$_POST['ID_Cont_U'];

            $text_Cont_U=$_POST['txt_Contenido'];
        
            $ID_PG=$_POST['txt_Cod_PG'];
         
          $query="UPDATE `seccion_contenido` SET `Contenido` = '$text_Cont_U' WHERE `seccion_contenido`.`ID_Contenido` = $ID_Cont_U;";
          $resultado=mysql_query($query,$link);

          $query2="SELECT * FROM planglobal WHERE ID_PG='$ID_PG'";
          $coneccion=mysql_query($query2,$link);
          
          while($row=mysql_fetch_array($coneccion))
          {$Cod_Materia=$row['ID_Materia'];}

          echo "<form method='post'>
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                <center><input type='submit' name='btn_Contenidos' value='atras'></center>
                </form>";
           
         }

         //BOTON ELIMINAR CONTENIDIO DE LA UNIDAD
         
         if(isset($_POST['btn_Eliminar_Contenido_U']))
         {
           
           $ID_Cont_U=$_POST['ID_Cont_U'];
           $text_Cont_U=$_POST['txt_Contenido'];
           $ID_PG=$_POST['txt_Cod_PG'];
         
          $query="DELETE FROM `seccion_contenido` WHERE `seccion_contenido`.`ID_Contenido` = $ID_Cont_U;";
          $resultado=mysql_query($query,$link);

          $query2="SELECT * FROM planglobal WHERE ID_PG='$ID_PG'";
          $coneccion=mysql_query($query2,$link);
          
          while($row=mysql_fetch_array($coneccion))
          {$Cod_Materia=$row['ID_Materia'];}

          echo "<form method='post'>
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
                <center><input type='submit' name='btn_Contenidos' value='atras'></center>
                </form>";
         }

     

       // BTON METODOLOGIAS
       
       if(isset($_POST['btn_Metodologias']))
       {
            $ID_PG=$_POST['txt_Cod_PG'];
            $Cod_Materia=$_POST['txt_Cod_M'];

            echo "<center><table id='tabla_Metodologia'>
            <tr><td colspan='3'><center><h4>METODOLOGIAS</h4></center></td></tr>";

            echo "<form method='post' action=''>
             <tr><td colspan='3'>
             <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
              <input type='text' name='txt_Cod_M' style='visibility:hidden' value='".$Cod_Materia."'>
             <center>
             <input type='submit' name='btn_Ingresar_Metodologias' value='Ingresar Nueva Metodologia'></center>
                 </form></td></tr>";
            
            $query="SELECT * FROM metodologia
             WHERE ID_PG=$ID_PG";
            $resultado=mysql_query($query,$link);
        
            while ($row=mysql_fetch_array($resultado)) {
            echo "
            <tr><td>
            <form method='post' action=''>
             <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
             .$Cod_Materia."'>
            <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
             .$ID_PG."'>
            <input type='text' name='ID_Metodologia' style='visibility:hidden' value='".$row['ID_Metod']."'>
             
            <textarea cols='100' rows='5'  name='txt_Metodologia'>".
             $row['Metodologia']."</textarea></td><td>

            <input type='submit' name='btn_Editar_Metodologia' value='Editar'></td><td>
            
            <input type='submit' name='btn_Eliminar_Metodologia' value='Eliminar'></td></tr>
            
            </form>";
           }
           //aniadimos el boton siguiente

           echo "<tr><td colspan='3'><form method='post'>
                 <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                 .$ID_PG."'>
                 <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                 .$Cod_Materia."'>
        
                 <center><input type='submit' value='Anterior' name='btn_Contenidos'>
                 <input type='submit' value='Siguiente' name='btn_Cronograma'></center>

                 </form></td></tr></table></center>";
            
       }

     //BOTON EDITAR METODOLOGIA

       if(isset($_POST['btn_Editar_Metodologia'])){

           $txt_Metodologia=$_POST['txt_Metodologia'];
           $ID_PG=$_POST['txt_Cod_PG'];
           $ID_Metod=$_POST['ID_Metodologia'];
           $Cod_Materia=$_POST['txt_Cod_M'];

           $query="UPDATE metodologia 
                   SET Metodologia = '$txt_Metodologia', ID_PG = '$ID_PG' 
                   WHERE ID_Metod = $ID_Metod;";
           $resultado=mysql_query($query,$link);

         echo "<script>alert('Edificion Realizada');</script>";
         
         echo "<form method='post' action=''>
               
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
               .$ID_PG."'>

               <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
               .$Cod_Materia."'>

               <center><input type='submit' value='atras' name='btn_Metodologias'></center>
               </form>";
       }

         if(isset($_POST['btn_Eliminar_Metodologia'])){

           $ID_PG=$_POST['txt_Cod_PG'];
           $ID_Metod=$_POST['ID_Metodologia'];
           $Cod_Materia=$_POST['txt_Cod_M'];

           $query="DELETE FROM `metodologia` WHERE ID_Metod = $ID_Metod";

           $resultado=mysql_query($query,$link);

           echo "<script>alert('Eliminacion Correcta');</script>";
         
            echo "<form method='post' action=''>
                  <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."'>
                   <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                 .$Cod_Materia."'>
                  <center><input type='submit' value='atras' name='btn_Metodologias'></center>
                 </form>";
       }

       //BOTON INGRESAR METODOLOGIA

       if(isset($_POST['btn_Ingresar_Metodologias'])){
            $ID_PG=$_POST['txt_Cod_PG'];
            $Cod_Materia=$_POST['txt_Cod_M'];

           echo "<center><table id='tabla_pequena'>
             <tr><td><h4>INGRESAR METODOLOGIA</h4></td></tr>";
             
           echo "<tr><td>
                 <form method='post' action=''>

                 <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                 .$ID_PG."'>
                  <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                 .$Cod_Materia."'>

                 <textarea  cols='100' rows='5' name='txt_Metodologia'></textarea></td></tr>
                
                 <tr><td><center><input type='submit' value='Ingresar Nueva' name='btn_Insertar_Metodologias'></center></td></tr>
                 
                 <tr><td><center><input type='submit' value='atras' name='btn_Metodologias'></center>
                 
                 </form></td></tr></table></center>";
       }

       if(isset($_POST['btn_Insertar_Metodologias'])){
        
           $ID_PG=$_POST['txt_Cod_PG'];
           $Cod_Materia=$_POST['txt_Cod_M'];
           $txt_Metodologia=$_POST['txt_Metodologia'];

           $query="INSERT INTO `metodologia`(`ID_Metod`, `Metodologia`, `ID_PG`) 
           VALUES (NULL,'$txt_Metodologia','$ID_PG')";
           $resultado=mysql_query($query,$link);

           echo "<script>alert('Metodologia Insertada Correctamente');</script>";
           echo "<form method='post' action=''>
               
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
               .$ID_PG."'>

               <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
               .$Cod_Materia."'>

               <center><input type='submit' value='atras' name='btn_Metodologias'></center>
               </form>";
       }

     //BOTON CRONOGRAMA

       if(isset($_POST['btn_Cronograma'])){
            
          $ID_PG=$_POST['txt_Cod_PG'];
          $Cod_Materia=$_POST['txt_Cod_M'];
          echo "<table id='tabla_grande'>
                <tr><td><center><h4>CRONOGRAMA</h4></center></td></tr> ";

          $query="SELECT * FROM unidad 
                  WHERE ID_PG='$ID_PG'";

          $resultado=mysql_query($query,$link);
          echo "<tr><td>
                <table class='tabla_Cronograma'>
                <tr><td>Unidad</td><td>Duracion (Horas Academicas)</td><td>Duracion en Semanas</td><td></td></tr>";
        
            while ($row=mysql_fetch_array($resultado)) {
                echo "<form method='post' action=''>

                <tr><td> <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='".$ID_PG."' size='2'></br> ".$row['Unidad']."</td> 

                <td> <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."' size='2'></br> <input size='5' type='text' name='txt_Horas' value='".$row['Hora_Academica']."'></td> 

                <td> <input type='text' name='ID_Unidad' style='visibility:hidden' value='".$row['ID_Unidad']."' size='2'></br> <input size='5' type='text' name='txt_Semanas' value='".$row['Cant_Semana']."'></td> 
                <td></br><input type='submit' name='btn_Editar_Cronograma' value='Editar'></td></tr>
                </form>";
            }

          echo "</table></td></tr>";
        
          echo "<tr><td>
                <form method='post' action=''>
                
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

                <center><input type='submit' value='Anterior' name='btn_Metodologias'>
                <input type='submit' value='Siguiente' name='btn_Criterios'></center>
                </form>
                </td></tr></table>";
         }
      //BOTON CRONOGRAMA EDITADO

      if(isset($_POST['btn_Editar_Cronograma'])){
       
       
       $ID_PG=$_POST['txt_Cod_PG'];
       $Cod_Materia=$_POST['txt_Cod_M'];
       $ID_Unidad=$_POST['ID_Unidad'];
       $txt_Horas=$_POST['txt_Horas'];
       $txt_Semanas=$_POST['txt_Semanas'];

       $query="UPDATE `unidad` SET `Hora_Academica` = '$txt_Horas', `Cant_Semana` = '$txt_Semanas' 
               WHERE ID_Unidad = $ID_Unidad;";
       $resultado=mysql_query($query,$link);

       echo "<script>alert('Edicion Correcta');</script>";
       echo "<form method='post' action=''>

             <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

             <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

             <center><input type='submit' value='atras' name='btn_Cronograma'></center>
             </form>";

       }


       //BOTON CRITERIOS 
       
        if(isset($_POST['btn_Criterios'])){
          
          $ID_PG=$_POST['txt_Cod_PG'];
          $Cod_Materia=$_POST['txt_Cod_M'];
      
        echo "<table id='tabla_grande'>
              <tr><td><center><h4> CRITERIOS DE EVALUACION </h4></center></td></tr>";

         echo "<tr><td>
               <form method='post' action=''>
              
               <center><textarea cols='100' rows='5' name='txt_Criterio'></textarea></center>
               
               <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
               .$ID_PG."'>
               
               <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
               . $Cod_Materia."'>

               </td></tr>

               <tr><td> 
               <center>
               <input type='submit' value='Insertar Nuevo Criterio' name='btn_Insertar_Criterio_Evaluacion'>
               </center>

               </form></td></tr>";
         
         $query="SELECT * 
                 FROM criterio c
                 WHERE c.ID_PG='$ID_PG'";
            $resultado=mysql_query($query,$link);
            
        
            while ($row=mysql_fetch_array($resultado)) {
                echo "<tr><td><form method='post' action=''>
                <table>
                
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>
                 <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                 .$Cod_Materia."'>
                <input type='text' name='ID_Criterio' style='visibility:hidden' value='".$row['ID_Criterio']."'>
                <tr><td><textarea cols='100' rows='5' name='txt_Criterio_Evaluacion' >".$row['Criterio']."</textarea></td> 
                <td><input type='submit' name='btn_Editar_Criterio' value='Editar'></td>
                <td><input type='submit' name='btn_Eliminar_Criterio' value='Eliminar'></td></tr>
                </table></form></td></tr>";
            }   

            echo "<tr><td><form method='post' action=''>
                 
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

                 <center><input type='submit' value='Anterior' name='btn_Cronograma'>
                 <input type='submit' value='Siguiente' name='btn_Siguiente_Bibliografia'></center>
                </form></td></tr></table>";    
       }

       //BOTON EDITAR CRITERIO

       if(isset($_POST['btn_Editar_Criterio'])){

           $Criterio=$_POST['txt_Criterio_Evaluacion'];
           $Cod_Materia=$_POST['txt_Cod_M'];
           $ID_PG=$_POST['txt_Cod_PG'];
           $ID_Criterio=$_POST['ID_Criterio'];

          $query="UPDATE `criterio` SET `Criterio` = '$Criterio', `ID_PG` = '$ID_PG' 
                  WHERE  `criterio`.`ID_Criterio` = $ID_Criterio;";
          $resultado=mysql_query($query,$link);

          echo "<script>alert('Edicion Correcta');</script>";
          
          echo "<form method='post' action=''>
                
                 <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

                 <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

                <center><input type='submit' value='atras' name='btn_Criterios'>
                </form></center>";
       }

       //BOTON ELIMINAR CRITERIO

        if(isset($_POST['btn_Eliminar_Criterio'])){

           $Criterio=$_POST['txt_Criterio_Evaluacion'];
           $Cod_Materia=$_POST['txt_Cod_M'];
           $ID_PG=$_POST['txt_Cod_PG'];
           $ID_Criterio=$_POST['ID_Criterio'];

          $query="DELETE FROM `criterio` WHERE `criterio`.`ID_Criterio` = $ID_Criterio";
          $resultado=mysql_query($query,$link);

          echo "<script>alert('Se Elimino Correctamente');</script>";
          
          echo "<form method='post' action=''>
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

                 <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

                <center><input type='submit' value='atras' name='btn_Criterios'>
                </form></center>";
       }


       //BOTON INSERTAR CRITERIO DE EVALUACION
       if(isset($_POST['btn_Insertar_Criterio_Evaluacion'])){
        
         $Cod_Materia=$_POST['txt_Cod_M'];
         $ID_PG=$_POST['txt_Cod_PG'];
         $txt_Criterio=$_POST['txt_Criterio'];

         $query="INSERT INTO `criterio` (`ID_Criterio`, `Criterio`, `ID_PG`) 
                 VALUES (NULL, '$txt_Criterio', '$ID_PG');";

         $resultado=mysql_query($query,$link);   

          echo "<script>alert('Datos Ingresados Correctamente');</script>";    

          echo "<form method='post' action=''>

              <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

              <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

              <center><input type='submit' value='atras' name='btn_Criterios'>
               </form></center>";
       }


       //BOTON BIBLIOGRAFIAS

        if(isset($_POST['btn_Siguiente_Bibliografia'])){
         
          $Cod_Materia=$_POST['txt_Cod_M'];
          $ID_PG=$_POST['txt_Cod_PG'];

         echo "<table id='tabla_grande'>
              <tr><td><center><h4>BIBLIOGRAFIAS </h4></center></td></tr>";

          echo "<tr><td>
               <form method='post' action=''>
              <center>
              <textarea name='txt_Bibliografia' cols='100' rows='3'></textarea></center>
              
              <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

              <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

              </td></tr>

              <tr><td><center><input type='submit' value='Insertar Nuevo Bibliografia' name='btn_Nueva_Bibliografia'></center>

              </form></td></tr>";
          
         $query="SELECT * 
                 FROM bibliografia 
                 WHERE ID_PG='$ID_PG'";
         $resultado=mysql_query($query,$link);

        
            while ($row=mysql_fetch_array($resultado)) {
                echo "<tr><td>
                <form method='post' action=''>
                <table>
              
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

                <input type='text' name='ID_Bibliografia' style='visibility:hidden' value='".$row['Id_Bibliografia']."'>

                <tr><td><textarea cols='100' rows='3' name='txt_Bibliografia' >".$row['texto']."</textarea></td> 

                <td><input type='submit' name='btn_Editar_Bibliografia' value='Editar'></td>
                <td><input type='submit' name='btn_Eliminar_Bibliografia' value='Eliminar'></td></tr>
                </table></form></td></tr>";
            }   

            echo "<tr><td>
                <form method='post' action=''>

                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>
                  
                <center><input type='submit' value='Anterior' name='btn_Criterios'>
                 
                <input type='submit' value='Terminar Editado' name='btn_Terminar_Editado'></center>
                
                </form><center></td></tr></table>" ;      
       }

       //BOTON INGRESO DE BIBLIOGRAFIAS
      
        if(isset($_POST['btn_Nueva_Bibliografia']))
        {  
           $Cod_Materia=$_POST['txt_Cod_M'];
           $ID_PG=$_POST['txt_Cod_PG'];
           $ID_txt_bibiografia=$_POST['txt_Bibliografia'];

           $query="INSERT INTO `bibliografia` (`Id_Bibliografia`, `texto`, `ID_PG`) 
                   VALUES (NULL,'$ID_txt_bibiografia', '$ID_PG');";
                     $resultado=mysql_query($query,$link);

           echo "<script>alert('Datos Ingresados Correctamente');</script>";

           echo "<form method='post' action=''>
              <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

              <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

                <center><input type='submit' value='atras' name='btn_Siguiente_Bibliografia'></center>
                </form>";
       }

       //BOTON EDITADO DE LAS BIBLIOGRAFIAS

        if(isset($_POST['btn_Editar_Bibliografia'])){
         
          $Bibliografia=$_POST['txt_Bibliografia'];
          $ID_Bibliografia=$_POST['ID_Bibliografia'];
          $Cod_Materia=$_POST['txt_Cod_M'];
          $ID_PG=$_POST['txt_Cod_PG'];
             
          $query="UPDATE bibliografia SET ID_PG= '$ID_PG', texto='$Bibliografia' 
           WHERE Id_Bibliografia = $ID_Bibliografia";

          $resultado=mysql_query($query,$link);

          echo "<script>alert('Edicion Correcta');</script>";
          
          echo "<form method='post' action=''>
              
                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

                <center>
                <input type='submit' value='atras' name='btn_Siguiente_Bibliografia'>
                </form></center>";
       }

       // BOTON ELIMINAR BIBLIOGRAFIA
     
        if(isset($_POST['btn_Eliminar_Bibliografia'])){
           $Bibliografia=$_POST['txt_Bibliografia'];
           $ID_Bibliografia=$_POST['ID_Bibliografia'];
           $Cod_Materia=$_POST['txt_Cod_M'];
            $ID_PG=$_POST['txt_Cod_PG'];

          $query="DELETE FROM `bibliografia` 
                  WHERE `bibliografia`.`Id_Bibliografia` =$ID_Bibliografia";

          $resultado=mysql_query($query,$link);

          echo "<script>alert('Eliminado Correctamente');</script>";
          
          echo "<form method='post' action=''>

                <input type='text' name='txt_Cod_PG' style='visibility:hidden' value='"
                .$ID_PG."'>

                <input type='text' name='txt_Cod_M' style='visibility:hidden' value='"
                .$Cod_Materia."'>

                <center><input type='submit' value='atras' name='btn_Siguiente_Bibliografia'>
                </form></center>";
        }

        if(isset($_POST['btn_Terminar_Editado']))
        {  
           $ID_PG=$_POST['txt_Cod_PG'];
           $CodigoD;
            
            $time = time();
            $anio =date("Y", $time);
            $mes =date("m", $time);
            $dia =date("d", $time);
            
           $fecha=$anio."-".$mes."-".$dia;
           $query="INSERT INTO `registro_editado_pg` (`ID_Registro`, `Estado`, `ID_PG`, `ID_Docente`,fecha) VALUES (NULL, 'Llenado', '$ID_PG', '$CodigoD','$fecha')";
           $resultado=mysql_query($query,$link);
           echo "<script>alert('Llenado o Editado Terminado');</script>";
          
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