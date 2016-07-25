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
  <form method="post" actio="">
  <center><input  type="submit" name="btn_Plan_Global" value="Crear Plan Global">
  <input type='submit' value='Lista Planes Globales' name='btn_Ver_Planes_Globales'>

  <input type='submit' value='Kardex' name='btn_kardex_PG'>
  <input type='submit' value='Edicion y Llenado' name='btn_Registro_PG'>
 
  </center>
  </form>
 
  <?php

  require('coneccion.php');
        
    if(isset($_POST['btn_Plan_Global'])){
      
        echo "<form method='post' action=''>
        <h3>Seleccione la Facultad :</h3>
        <table id='tabla_grande'>
     
        <tr><td><select class='Select_Facultad' name='select_F[]'>";

      
        $query="SELECT * 
                 FROM facultad";
       $resultado=mysql_query($query,$link);
   
      while($row=mysql_fetch_array($resultado))
      {
         echo "<option value=".$row['ID_Facultad'].">".$row['Facultad']."</option>";
      }
        
      echo "</select></td><td><input type='submit' value='Ingresar' name='btn_Facultad'></td></tr></table></form>";
     }
    
    // BOTON FACULTAD 

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
             <tr><td>Seleccione la Carrera :</td><td><select class='Select_Facultad' name='select_C[]'>";
             $query="SELECT * 
             FROM carrera 
             WHERE id_facultad=$ID_Facultad";
            $resultado=mysql_query($query,$link);
            while($row=mysql_fetch_array($resultado))
            {
              echo "<option value='".$row['ID_Carrera']."'>".$row['nombre_carrera']."</option>";
            }


         echo "</select></td>
              <td><input type='submit' name='btn_Carrera' value='Ingresar'></td></tr>

              <tr><td colspan='3'><center><input type='submit' value='atras' name='btn_Plan_Global'></center></td></tr>

              </table>
              </form>";

 
        }

        //BOTON CARRERAS

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
          echo "<form method='post'>
             <table id='tabla_grande'>
             <tr><td>Seleccione Materia :</td><td><select class='Select_Facultad' name='select_M[]'>";
             $query="SELECT * 
             FROM materia 
             WHERE ID_Carrera=$ID_Carrera ORDER BY Nombre_Materia ASC ";
            $resultado=mysql_query($query,$link);
            while($row=mysql_fetch_array($resultado))
            {
              echo "<option value='".$row['ID_Materia']."'>".$row['Nombre_Materia']." - Grupo - ".
              $row['Grupo']."</option>";
            }

          echo "</select></td><td><input type='submit' name='btn_Materia' value='Ingresar'></td></tr></table>
               </form>";
        
          echo "<form method='post'><center>
                <input type='submit' value='atras' name='btn_Facultad'>
                <select class='Select_Facultad' name='select_F[]' style='visibility:hidden'><option value='".$ID_Facu."'>
                </option></select></center></form>";
           
        }

    //BTON MATERIA

         if(isset($_POST['btn_Materia']))
         {

          $Seleccion_M=$_POST['select_M'];

          for ($i=0;$i<count($Seleccion_M);$i++) 
            {  $ID_Materia=$Seleccion_M[$i];} 

          //echo $ID_Materia;

          $query="SELECT * FROM materia 
                  WHERE ID_Materia=$ID_Materia";

          $resultado=mysql_query($query,$link);
          
          echo "<h3>".mysql_result($resultado, 0, "Nombre_Materia")."</h3>";
           $ID_Carrera=mysql_result($resultado, 0, "ID_Carrera");

             echo "<form method='post'> <table id='tabla_grande'>
           
             <tr><td>Seleccione al Docente :</td><td><select class='Select_Facultad' name='select_D[]'>";
            
             $query="SELECT * FROM `docente` ORDER BY `docente`.`Nombre_Completo` ASC";
             $resultado=mysql_query($query,$link);

            while($row=mysql_fetch_array($resultado))
            {
              echo "<option value='".$row['ID_Docente']."'>".
              $row['Nombre_Completo']." ".
              $row['Apellido_Paterno']." ".
              $row['Apellido_Materno']."</option>";
            }


         echo "</select></td></tr>
         <tr><td>Seleccione el tipo :</td><td><select name='select_tipo[]' class='Select_Facultad'>
         <option value='Normal'>Normal
         </option>
         <option vale='Titular'>Titular
         </option>
         <select></td></tr></tr>
         <td colspan='2'><input type='submit' name='btn_Crear_Plan_Global' value='Crear Plan Global'>
         <input type='text' value='$ID_Materia' name='txt_ID_Materia' style='visibility:hidden'>
            
             </td></tr></table>
         </form>";

        // echo "<center><input type='submit' value='atras'></center>";

          echo "<form method='post'><center>
                <input type='submit' value='atras' name='btn_Carrera'>
                <select class='Select_Facultad' name='select_C[]' style='visibility:hidden'><option value='".$ID_Carrera."'>
                </option></select></center></form>";

         }

     //BOTON CREAR PLAN GLOBAL

         if(isset($_POST['btn_Crear_Plan_Global']))
         {
          // echo "nesecito el ID_DOCENTE - ID_MATERIA y se creara un nuevo plan globla";
             $Select_D=$_POST['select_D'];
               for ($i=0;$i<count($Select_D);$i++) 
            {  $ID_Docente=$Select_D[$i];} 

            // echo $ID_Docente;

              $Select_C=$_POST['select_tipo'];
               for ($i=0;$i<count($Select_C);$i++) 
            {  $Tipo=$Select_C[$i];} 
            //echo $Tipo."</p>";

             $ID_Materia=$_POST['txt_ID_Materia'];

             $query="INSERT INTO planglobal 
             (ID_PG,tipo,ID_Materia,ID_Docente) 
             VALUES (NULL, '".$Tipo."', '".$ID_Materia."', '".$ID_Docente."');";
             $resultado=mysql_query($query,$link);
            echo "<script>alert('Plan Global Creado Exitosamente');</script>";

         }
         

         if(isset($_POST['btn_Ver_Planes_Globales'])){

          echo '<table id="tabla_Buscador">
                <tr><td> 
                <button onclick="procesar()" id="procesar" class="btn_rec" ';
               
                echo '</button></td><td>
                <form method="post">
                <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el Plan Global a Buscar">
                <input type="submit" class="btn_Buscar" name="Buscar_PG" value="Buscar"></form>
                </td></tr></table>';

          echo "<H3>LISTADO DE PLANES GLOBLAES</H3>";

          $query="SELECT * FROM planglobal pg, materia m, docente d
                   WHERE pg.ID_PG AND PG.ID_Materia=M.ID_Materia AND pg.ID_Docente=d.ID_Docente ORDER BY m.Nombre_Materia ASC";
          
          $resultado=mysql_query($query,$link);
          echo "";

          while($row=mysql_fetch_array($resultado))
          {
              echo "<center><table class='tabla_lista_docentes'><form method='post' action=''>
                    
                     <tr><td id='td_caract'>Materia</td><td colspan='3'>".$row['Nombre_Materia']."</td></tr>

                     <tr><td  id='td_caract'>Codigo</td><td>".$row['Codigo']."</td><td>Grupo</td><td>".
                     $row['Grupo']."</td></tr>

                     <tr><td  id='td_caract'>Tipo de Docente </td><td colspan='3'>".$row['tipo']."</td></tr>

                     <tr><td  id='td_caract'>Docente asignado </td><td colspan='3'>".$row['Nombre_Completo']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</td></tr>

                     <tr><td  id='td_caract'> <input type='submit' value='Editar' name='btn_Editar_PG'></td>

                     <td colspan='3'><input type='submit' value='Eliminar' name='btn_Eliminar_PG'>

                     <input type='text' value='".$row['ID_PG']."' name='txt_ID_PG' style='visibility:hidden'>

                     </td></tr>

                    </table> </form></center><p></p>";
          }

          echo "  ";
         }

         //BOTON EDITAR PG

        if(isset($_POST['btn_Editar_PG']))
        {
            $ID_PG_Editado=$_POST['txt_ID_PG'];

            echo "<h3>EDICION DEL PLAN GLOBAL</h3>";

            $query="SELECT * FROM planglobal pg, materia m, docente d
                   WHERE pg.ID_PG=$ID_PG_Editado AND PG.ID_Materia=M.ID_Materia AND pg.ID_Docente=d.ID_Docente";
            
           
            echo "  <table id='tabla_grande'>";
             $resultado=mysql_query($query,$link);

             while($row=mysql_fetch_array($resultado))
             {
              echo "<form method='post' action=''>
                    
                     
                     
                     <tr><td>Materia </td><td colspan='3'>".$row['Nombre_Materia']."</td></tr>

                     <tr><td>Codigo </td><td colspan='3'>".$row['Codigo']."</td></tr>

                     <tr><td>Tipo </td><td>".$row['tipo']." </td><td> Cambiar a :

                     <select name='select_tipo_PG[]'>
                     <option></option>
                     <option value='Normal'>Normal</option>
                     <option value='Titular'>Titular</option>
                     </select></td></tr>

                     <tr><td>Docente : </td><td>".$row['Nombre_Completo']." "
                     .$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</td><td colspan='2'>
                      Cambiar a :";
                    
                     
                        $query1="SELECT COUNT(*) FROM docente";
                        $resultado1=mysql_query($query1,$link);

                        $n=mysql_result($resultado1, 0, "COUNT(*)");

                        $query2="SELECT * FROM docente";
                        $resultado2=mysql_query($query2,$link);
                        echo "<select name='doc[]'>";
                        for ($i=0; $i <$n ; $i++) { 
                         
                                 echo" <option></option>
                                  <option value=".mysql_result($resultado2, $i, "ID_Docente").">".
                                            mysql_result($resultado2, $i, "Nombre_Completo")." ".
                                            mysql_result($resultado2, $i, "Apellido_Paterno")." ".
                                            mysql_result($resultado2, $i, "Apellido_Materno")." ".
                                            "</option>";
                               
                                
                        }
                     
                     echo "  </select></td></tr>
                     <tr><td colspan='4'><center><input type='submit' value='Editar' name='btn_PG_Cambios'>
                     <input type='text' value='".$row['ID_PG']."' name='txt_ID_PG' style='visibility:hidden'>

                     </td></tr>
                    
                     </form>";
              }

              echo "  </table>"; 
         
        }

  
        //BOTON REALIZAR CAMBIOS EN PLAN GLOBAL 
        if(isset($_POST['btn_PG_Cambios']))
        {

           $ID_PG=$_POST['txt_ID_PG'];
         
          $Selec_Docente=$_POST['doc'];

          for ($i=0;$i<count($Selec_Docente);$i++) 
          { $Doc_Selec=$Selec_Docente[$i];
             } 

          $Doc_Selec;
        
          $Selec_Tipo=$_POST['select_tipo_PG'];

          for ($j=0;$j<count($Selec_Tipo);$j++) 
          { $Tipo_Selec=$Selec_Tipo[$j];
             } 

           $Tipo_Selec;
        

        if($Tipo_Selec!=""){
          $query="UPDATE `planglobal` SET 
                 `tipo` = '$Tipo_Selec'
                 WHERE `planglobal`.`ID_PG` = $ID_PG;";
                 mysql_query($query,$link);
          echo "
           <script>alert('Datos Editados Correctamente');</script>";

        }
         
         if($Doc_Selec!=""){
          $query="UPDATE `planglobal` SET 
                  `ID_Docente` = '$Doc_Selec' 
                 WHERE `planglobal`.`ID_PG` = $ID_PG;";
                 mysql_query($query,$link);
          echo "
           <script>alert('Datos Editados Correctamente');</script>";

        }

        if($Doc_Selec=="" && $Tipo_Selec==""){
           echo "
           <script>alert('Seleccione algun Dato para Editar');</script>";
        }
        
       
       
       echo "<form method='post'>
             <input type='text' name='txt_ID_PG' style='visibility:hidden' value='".$ID_PG."'>
             <center><input type='submit' name='btn_Editar_PG' value='Volver al Editado'></center>
             </form>";


      }

    //BOTON ELIMINAR PG 

    if(isset($_POST['btn_Eliminar_PG'])){
      
      $ID_PG=$_POST['txt_ID_PG'];
      $query="DELETE FROM `planglobal` WHERE ID_PG=$ID_PG";
      mysql_query($query,$link);
       echo "<script>alert('Plan Gobal Eliminado');</script>";
    }

       //BOTON KARDEX 
    if(isset($_POST['btn_kardex_PG']))
    {
        echo '<table id="tabla_Buscador">
                <tr><td> 
                <button onclick="procesar()" id="procesar" class="btn_rec" ';
               
                echo '</button></td><td>
                <form method="post">
                <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el Plan Global a Buscar">
                <input type="submit" class="btn_Buscar" name="btn_Buscar_Kardex" value="Buscar"></form>
                </td></tr></table>';

      echo "<h1>KARDEX de Planes Globales</h1>";
      
      $sql="SELECT * FROM kardex";

      $resultado=mysql_query($sql,$link);
      while($row=mysql_fetch_array($resultado))
      {  
         echo "<form method='post'><table id='tabla_grande'>";
         
         $ID_PG=$row['ID_PG_K'];
         $tipo=$row['tipo_K'];
         $ID_Materia=$row['ID_Materia_K'];
         $ID_Docente=$row['ID_Docente_K'];
       

        $sql="SELECT * FROM materia WHERE ID_Materia='$ID_Materia'";
        $resultado1=mysql_query($sql,$link);
        while($row1=mysql_fetch_array($resultado1))
        {   $Materia=$row1['Nombre_Materia'];
            $grupo=$row1['Grupo'];
            echo "<tr><td id='td_caract'>Plan Global de :</td><td>$Materia</td></tr>";
            echo "<tr><td id='td_caract'>Grupo :</td><td>$grupo</td></tr>";
            
            $sql="SELECT * FROM docente WHERE ID_Docente='$ID_Docente'";

              $resultado2=mysql_query($sql,$link);
              while($row2=mysql_fetch_array($resultado2))
              {
                $Docente=$row2['Nombre_Completo']." "
                       .$row2['Apellido_Paterno']." ".$row2['Apellido_Materno'];
                echo "<tr><td id='td_caract'>Docente</td><td>$Docente</td></tr>";

                echo "<tr><td id='td_caract'>Tipo :</td><td>$tipo</td></tr>";
                echo "<tr><td colspan='2'><input type='submit' value='Restaurar' name='btn_Recuperar_PG'>
                 <input type='text' name='txt_Cod_Kardex' style='visibility:hidden' value='"
                .$row['ID_Kardex']."'>

                </td></tr>
                </table></form></p></p>";
              }
             //tercer while
         }
        //segundo while
      }
    //primer while
     }
  //condicion

     if(isset($_POST['btn_Recuperar_PG']))
     {
        
      $ID_K=$_POST['txt_Cod_Kardex'];
      
      $sql="SELECT * FROM kardex WHERE ID_Kardex='$ID_K'";

      $resultado=mysql_query($sql,$link);
      while($row=mysql_fetch_array($resultado))
      {  
        // echo "<form method='post'><table id='tabla_grande'>";
         
        $ID_PG=$row['ID_PG_K'];
        $tipo=$row['tipo_K'];
        $ID_Materia=$row['ID_Materia_K'];
        $ID_Docente=$row['ID_Docente_K'];
        
        $sql2="INSERT INTO `planglobal` (`ID_PG`, `tipo`, `ID_Materia`, `ID_Docente`) VALUES ('$ID_PG', '$tipo', '$ID_Materia', '$ID_Docente')";

        $resultado2=mysql_query($sql2,$link);

        $sql3="DELETE FROM `kardex` WHERE `kardex`.`ID_Kardex` = $ID_K";
        $resultado3=mysql_query($sql3,$link);


        echo "<script>alert('Restauracion de datos Correcta');</script>";

       }
     }

     if(isset($_POST['btn_Registro_PG']))
     { 
      echo 
      '<table id="tabla_Buscador">
                <tr><td> 
                <button onclick="procesar()" id="procesar" class="btn_rec" ';
               
                echo '</button></td><td>
                <form method="post">
                <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el Plan Global a Buscar que fue Llenado/Modificado">
                <input type="submit" class="btn_Buscar" name="btn_Buscar_Bitacora" value="Buscar"></form>
                </td></tr></table>';
      echo "<h1> Bitacora de Registro y Editado de Planes Globales </h1>";
         
      // echo "<table id='tabla_grande'>";
       $time = time();
       $anio =date("Y", $time);
       $mes =date("M", $time);
       $dia =date("d", $time);
       
       $query="SELECT * FROM registro_editado_pg";
       $resultado=mysql_query($query,$link);

        while($row=mysql_fetch_array($resultado))
        {
            $Estado=$row['Estado'];
            $ID_PG=$row['ID_PG'];
            $ID_Docente=$row['ID_Docente'];
            $fecha=$row['fecha'];

         
            //echo "<tr><td>".."</td></tr>";
            $query1="SELECT * FROM planglobal WHERE ID_PG=$ID_PG";
            $resultado1=mysql_query($query1,$link);
           
            while($row1=mysql_fetch_array($resultado1))
            {   $ID_Materia=$row1['ID_Materia'];
                $tipo=$row1['tipo'];

                $query2="SELECT * FROM materia WHERE ID_Materia=$ID_Materia";
                $resultado2=mysql_query($query2,$link);

               while($row2=mysql_fetch_array($resultado2)) 
                {
                  echo "<table id='tabla_grande'>";
                  echo "<tr><td id='td_caract'>Plan Global</td><td>".$row2['Nombre_Materia']."</td></tr>";
                  echo "<tr><td id='td_caract'>Grupo</td><td>".$row2['Grupo']."</td></tr>";

                  echo "<tr><td id='td_caract'>Estado</td><td> Llenado / Editado </td></tr>";
                  echo "<tr><td id='td_caract'>Fecha</td><td> ".$fecha."</td></tr>";

                  $ID_Carrera=$row2['ID_Carrera'];
                  
                  $query4="SELECT * FROM carrera WHERE ID_Carrera=$ID_Carrera";
                  $resultado4=mysql_query($query4,$link);

                  while($row4=mysql_fetch_array($resultado4)) 
                  {
                    $Carrera=$row4['nombre_carrera'];
                    echo "<tr><td id='td_caract'>Carrera</td><td>".$Carrera."</td></tr>";

                    // MOSTRAR DOCENTE 
                    $query3="SELECT * FROM docente WHERE ID_Docente=$ID_Docente";
                    $resultado3=mysql_query($query3,$link);

                    while($row3=mysql_fetch_array($resultado3)) 
                    {
                    
                      $Docente=$row3['Nombre_Completo']." ".$row3['Apellido_Paterno']." ".$row3['Apellido_Materno'];
                      echo "<tr><td id='td_caract'>Tipo</td><td>".$tipo."</td></tr>";
                      echo "<tr><td id='td_caract'>Docente</td><td>".$Docente."</td></tr></table></p></p>";
                    }

                  }
                }          
              }
            }
         }

            // Buscador de planes globales

        if(isset($_POST['Buscar_PG']))
        {
           $Text_a_Buscar=$_POST['txt_buscar_pg'];

          echo '<table id="tabla_Buscador">
                <tr><td> 
                <button onclick="procesar()" id="procesar" class="btn_rec" ';
               
                echo '</button></td><td>
                <form method="post">
                <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el Plan Global a Buscar">
                <input type="submit" class="btn_Buscar" name="Buscar_PG" value="Buscar"></form>
                </td></tr></table>';

          echo "<H3>RESULTADO DE PLANES GLOBLAES</H3>";

          $query="SELECT * FROM planglobal pg, materia m, docente d
                   WHERE  m.Nombre_Materia='$Text_a_Buscar' AND pg.ID_PG AND PG.ID_Materia=M.ID_Materia AND pg.ID_Docente=d.ID_Docente ORDER BY m.Nombre_Materia ASC";
          
          $resultado=mysql_query($query,$link);
          echo "";

          while($row=mysql_fetch_array($resultado))
          {
              echo "<center><table class='tabla_lista_docentes'><form method='post' action=''>
                    
                     <tr><td id='td_caract'>Materia</td><td colspan='3'>".$row['Nombre_Materia']."</td></tr>

                     <tr><td  id='td_caract'>Codigo</td><td>".$row['Codigo']."</td><td>Grupo</td><td>".
                     $row['Grupo']."</td></tr>

                     <tr><td  id='td_caract'>Tipo de Docente </td><td colspan='3'>".$row['tipo']."</td></tr>

                     <tr><td  id='td_caract'>Docente asignado </td><td colspan='3'>".$row['Nombre_Completo']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</td></tr>

                     <tr><td  id='td_caract'> <input type='submit' value='Editar' name='btn_Editar_PG'></td>

                     <td colspan='3'><input type='submit' value='Eliminar' name='btn_Eliminar_PG'>

                     <input type='text' value='".$row['ID_PG']."' name='txt_ID_PG' style='visibility:hidden'>

                     </td></tr>

                    </table> </form></center><p></p>";
          }

         }

         // BUSCADOR KARDEX

         if(isset($_POST['btn_Buscar_Kardex']))
         {
            echo '<table id="tabla_Buscador">
                <tr><td> 
                <button onclick="procesar()" id="procesar" class="btn_rec" ';
               
                echo '</button></td><td>
                <form method="post">
                <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el Plan Global a Buscar">
                <input type="submit" class="btn_Buscar" name="btn_Buscar_Kardex" value="Buscar"></form>
                </td></tr></table>';

      echo "<h1>Resultados de Planes Globales en KARDEX</h1>";

           $Text_a_Buscar=$_POST['txt_buscar_pg'];

           $sql="SELECT * FROM kardex";

           $resultado=mysql_query($sql,$link);
           while($row=mysql_fetch_array($resultado))
           {  
             echo "<form method='post'><table id='tabla_grande'>";
         
             $ID_PG=$row['ID_PG_K'];
             $tipo=$row['tipo_K'];
             $ID_Materia=$row['ID_Materia_K'];
             $ID_Docente=$row['ID_Docente_K'];
           

              $sql="SELECT * FROM materia WHERE Nombre_Materia='$Text_a_Buscar' AND ID_Materia='$ID_Materia'";
              $resultado1=mysql_query($sql,$link);
              while($row1=mysql_fetch_array($resultado1))
              {   $Materia=$row1['Nombre_Materia'];
                  $grupo=$row1['Grupo'];
                  echo "<tr><td id='td_caract'>Plan Global de :</td><td>$Materia</td></tr>";
                  echo "<tr><td id='td_caract'>Grupo :</td><td>$grupo</td></tr>";
                  
                  $sql="SELECT * FROM docente WHERE ID_Docente='$ID_Docente'";

                    $resultado2=mysql_query($sql,$link);
                    while($row2=mysql_fetch_array($resultado2))
                    {
                      $Docente=$row2['Nombre_Completo']." "
                             .$row2['Apellido_Paterno']." ".$row2['Apellido_Materno'];
                      echo "<tr><td id='td_caract'>Docente</td><td>$Docente</td></tr>";

                      echo "<tr><td id='td_caract'>Tipo :</td><td>$tipo</td></tr>";
                      echo "<tr><td colspan='2'><input type='submit' value='Restaurar' name='btn_Recuperar_PG'>
                       <input type='text' name='txt_Cod_Kardex' style='visibility:hidden' value='"
                      .$row['ID_Kardex']."'>

                      </td></tr></form>";
                       echo " </table> <p></p><p></p>";
              }

             //tercer while
         }
        //segundo while
      }
    //primer while
   }

         //BUSQUEDA BITACORA 
         if(isset($_POST['btn_Buscar_Bitacora']))
         {
             $Text_a_Buscar=$_POST['txt_buscar_pg'];
              echo 
             '<table id="tabla_Buscador">
                <tr><td> 
                <button onclick="procesar()" id="procesar" class="btn_rec" ';
               
              echo '</button></td><td>
                <form method="post">
                <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el Plan Global a Buscar que fue Llenado/Modificado">
                <input type="submit" class="btn_Buscar" name="btn_Buscar_Bitacora" value="Buscar"></form>
                </td></tr></table>';
              echo "<h1> Resultado de Registro y Editado de Planes Globales </h1>";
         
      // echo "<table id='tabla_grande'>";
       $time = time();
       $anio =date("Y", $time);
       $mes =date("M", $time);
       $dia =date("d", $time);
       
       $query="SELECT * FROM registro_editado_pg";
       $resultado=mysql_query($query,$link);

        while($row=mysql_fetch_array($resultado))
        {
            $Estado=$row['Estado'];
            $ID_PG=$row['ID_PG'];
            $ID_Docente=$row['ID_Docente'];
            $fecha=$row['fecha'];

         
            //echo "<tr><td>".."</td></tr>";
            $query1="SELECT * FROM planglobal WHERE ID_PG=$ID_PG";
            $resultado1=mysql_query($query1,$link);
           
            while($row1=mysql_fetch_array($resultado1))
            {   $ID_Materia=$row1['ID_Materia'];
                $tipo=$row1['tipo'];

                $query2="SELECT * FROM materia WHERE ID_Materia=$ID_Materia AND Nombre_Materia='$Text_a_Buscar'";
                $resultado2=mysql_query($query2,$link);

               while($row2=mysql_fetch_array($resultado2)) 
                {
                  echo "<table id='tabla_grande'>";
                  echo "<tr><td id='td_caract'>Plan Global</td><td>".$row2['Nombre_Materia']."</td></tr>";
                  echo "<tr><td id='td_caract'>Grupo</td><td>".$row2['Grupo']."</td></tr>";

                  echo "<tr><td id='td_caract'>Estado</td><td> Llenado / Editado </td></tr>";
                  echo "<tr><td id='td_caract'>Fecha</td><td> ".$fecha."</td></tr>";

                  $ID_Carrera=$row2['ID_Carrera'];
                  
                  $query4="SELECT * FROM carrera WHERE ID_Carrera=$ID_Carrera";
                  $resultado4=mysql_query($query4,$link);

                  while($row4=mysql_fetch_array($resultado4)) 
                  {
                    $Carrera=$row4['nombre_carrera'];
                    echo "<tr><td id='td_caract'>Carrera</td><td>".$Carrera."</td></tr>";

                    // MOSTRAR DOCENTE 
                    $query3="SELECT * FROM docente WHERE ID_Docente=$ID_Docente";
                    $resultado3=mysql_query($query3,$link);

                    while($row3=mysql_fetch_array($resultado3)) 
                    {
                    
                      $Docente=$row3['Nombre_Completo']." ".$row3['Apellido_Paterno']." ".$row3['Apellido_Materno'];
                      echo "<tr><td id='td_caract'>Tipo</td><td>".$tipo."</td></tr>";
                      echo "<tr><td id='td_caract'>Docente</td><td>".$Docente."</td></tr></table></p></p>";
                    }

                  }
                }          
              }
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
<?php  } 
else {
   header("location: Planes_Globales/index.php");
 } ?>