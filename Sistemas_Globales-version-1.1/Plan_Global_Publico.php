<html lang='spa'>
<head>
  <title>Sistema de Planes Globales</title>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

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
    <button onclick="procesar()" id="procesar" class="btn_rec" style=" background: url('icon_rv1.png'); width:32px; height:32px; border-color:white;"></button></td><td>
    <form method="post">
    <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el Plan Global a Buscar">
    <input type="submit" class="btn_Buscar" name="Buscar_PG" value="Buscar"></form>
   </td></tr></table>
     
   

   <form method="post" action="">
    <center>
    <table id="Tabla_Seleccion_Carrera">
    <tr><td>
    <input type="submit" class="button_seleccion"  value="Seleccione el Plan Global" name="Btn_Buscar_Facultad">
    </td></tr>
    </table></center>
   </form>

     <?php
    
    $Facultad;
    $Carrera_Main;
    $Materia;
    if(isset($_POST['Btn_Buscar_Facultad']))
    {
     
     require('coneccion.php');
     $query="SELECT * FROM facultad";
     $resultado=mysql_query($query,$link);
     
     echo '<form method="post" action="">
     <table id="Tabla_Seleccion_Carrera">
     <tr><td><h3>Seleccione la Facultad</h3></td></tr>
       
     <tr><td><select class="Select_Facultad" name="Select_F[]">';
       
     while($row=mysql_fetch_array($resultado))
     { 

      echo '<option value="'.$row['ID_Facultad'].'">'.$row['Facultad'].'</option>'; 
 
      }

      echo '</select></td><td><input type="submit" value="Buscar" name="Btn_Buscar_Carrera"></td></tr>
            </table>
            </form>';
      }
      

    if(isset($_POST['Btn_Buscar_Carrera']))
    {


        $Seleccion_F=$_POST['Select_F'];

       for ($i=0;$i<count($Seleccion_F);$i++) 
       {  $Facultad=$Seleccion_F[$i];} 
       
    
     require('coneccion.php');
     $query="SELECT * FROM carrera WHERE id_facultad='$Facultad'";

     $resultado=mysql_query($query,$link);

      while($row0=mysql_fetch_array($resultado))
     { $f=$row0['facultad'];}

     echo '<h3> '.$f.' :</h3>';
     
     echo '<form method="post" action="">
    
     <tr><td>Seleccione la Carrera</td>
       
     <td><select class="Select_Carrera" name="Select_C[]">';
     
     $resultado=mysql_query($query,$link);
     while($row=mysql_fetch_array($resultado))
     {
        
      echo '<option value="'.$row['ID_Carrera'].'">'.$row['nombre_carrera'].'</option>'; 
 
      }

      echo '</select></td><td><input type="submit" value="Buscar" name="Btn_Buscar_Nivel"></td></tr>
          
            </form>';

      }


    if(isset($_POST['Btn_Buscar_Nivel']))
     {

     
       $Seleccion_C=$_POST['Select_C'];
  
       for ($i=0;$i<count($Seleccion_C);$i++) 
       {  $Carrera=$Seleccion_C[$i];} 
    
       require('coneccion.php');

       $query0="SELECT * FROM carrera WHERE ID_Carrera=$Carrera";

       $query="SELECT DISTINCT Nivel_Materia FROM materia WHERE ID_Carrera='$Carrera' 
       ORDER BY `materia`.`Nivel_Materia` ASC";

       $resultado=mysql_query($query0,$link);

        while($row0=mysql_fetch_array($resultado))
       {
        
        echo '<h3> Carrera de : '.$row0['nombre_carrera'].'</h3>'; 
 
       }
     
       echo '<form method="post" action="">
       
       <input class="input_Carrera" type="text" value="'.$Carrera.'" name="txtCarrera" style="visibility:hidden"  value="Norway" readonly size="50"></br>
       <tr><td>Seleccione el nivel</td></tr>
       
       <tr><td><select class="Select_Nivel" name="Select_N[]">';
   

       $resultado=mysql_query($query,$link);
       while($row=mysql_fetch_array($resultado))
       {echo '<option value="'.$row['Nivel_Materia'].'">'.$row['Nivel_Materia'].'</option>'; }

        echo '</select></td><td><input type="submit" value="Mostrar" name="Btn_Buscar_Materia"></td>
        </td></tr>
            </table>
            </form>';
      }
      

      if(isset($_POST['Btn_Buscar_Materia']))
      {
        
         $S_Carrera=$_POST['txtCarrera'];
         $Seleccion_N=$_POST['Select_N'];

         //echo "$S_Carrera </br>";

      for ($i=0;$i<count($Seleccion_N);$i++) 
       { 
          $Nivel=$Seleccion_N[$i];
        } 

          //echo $Nivel;
       
       require('coneccion.php');

        $query0="SELECT * FROM carrera WHERE ID_Carrera=$S_Carrera";

        $resultado=mysql_query($query0,$link);

       while($row0=mysql_fetch_array($resultado))
       {
        // echo $row0['nombre_carrera']; 
        $Carrera=$row0['nombre_carrera'];}


       echo '<form method="post" action="">
             <h3 id="titulo_niveles">Carrera de : <input class="input_Carrera" type="text" value="'.$Carrera.
             '" name="txtCarrera" value="Norway" readonly size="50"></h3>';
       echo '<h3 id="titulo_niveles">Nivel : <input class="input_Carrera" type="text" value="'.$Nivel.
             '" name="txtNivel" value="Norway" readonly size="50"></h3>';

       $query="SELECT * FROM materia m, planglobal pg
               where pg.ID_Materia=m.ID_Materia AND m.ID_Carrera=$S_Carrera AND m.Nivel_Materia='$Nivel'";

       $resultado=mysql_query($query,$link);
     
      echo ' <tr><td>Materias</td></tr>
             <tr><td><select class="Select_Materia" name="Select_M[]">';
     

       while($row=mysql_fetch_array($resultado))
       { 
          echo "el ID".$row['Nombre_Materia'];
     
        echo '<option value="'.$row['ID_PG'].'">'.$row['tipo'].' - '.$row['Nombre_Materia'].' - Grupo :'.
        $row['Grupo'].'</option>'; }

        echo '</select></td><td><input type="submit" value="Mostrar" name="Btn_Buscar_Materias"></td>
        </td></tr>
            </table>
            </form>';

            
      }

      if(isset($_POST['Btn_Buscar_Materias'])){
        
      
       $Seleccion_M=$_POST['Select_M'];
    
  
       for ($i=0;$i<count($Seleccion_M);$i++) 
       {  $ID_PG=$Seleccion_M[$i];} 

       //echo "es =".$ID_Materia."</br>";

       require ("coneccion.php");     

       $query="SELECT * FROM materia m, planglobal pg
               WHERE pg.ID_PG='$ID_PG' AND pg.ID_Materia=m.ID_Materia";

       $resultado=mysql_query($query,$link);

       while($row=mysql_fetch_array($resultado))
       {
         echo "<h3 id='titulo_materia'> Materia :".$row['Nombre_Materia']."</h3>"; 
         $ID_Materia=$row['ID_Materia'];
       }

       $Select_Carrera=$_POST['txtCarrera'];

       $query="SELECT * FROM materia WHERE ID_Materia=$ID_Materia";

       $resultado=mysql_query($query,$link);
     

       while($row=mysql_fetch_array($resultado))
       {
            
        echo '<form method="post" action="">
     
              <table id="tabla_Seleccion_Materia">
              <tr><td id="td_Materia"> Materia </td>
              <td id="td_Materia"> Grupo </td>
              <td id="td_Materia">Seleccion</td>
              <td id="td_Materia">Imprimir</td></tr>

              <tr>
              <td>'.$row['Nombre_Materia'].'
              <input type="text" value="
              '.$row['ID_Materia'].'" name="txt_ID_Materia" size="5" style="visibility:hidden"></td>

               <td><center>'.$row['Grupo'].'</center></td>
              
               <td><center>
               <input type="submit" value="Plan Global" name="Btn_Plan_Global"></br>

               <input type="submit" value="Programa Analitico" name="Btn_Programa_Analitico">
               </center> </form></td>
           
               <form method="POST" action="Imprimir_Plan_Global.php">
               <input type="text" value="'.$row['ID_Materia'].'"name="txt_ID_Materia" 
                 size="5" style="visibility:hidden"> 
                <td></br>
                 <input type="submit" value="Imprimir PG" name="BtnImprimir_PG"> 
               </form>

               <form method="post" action="imprimir_Programa_Analitico.php">
              
               <input type="submit" value="Imprimir PA" name="BtnImprimir_PA"></td></tr>
               </table>
               <input type="text" value="'.$row['ID_Materia'].'" name="txt_ID_Materia" size="5" style="visibility:hidden">
               </form>';
        
 
       }
           

      }
      
      if(isset($_POST['Btn_Plan_Global']))
      {
       // echo "Aca el plan global </br>";
        $Cod_M=$_POST['txt_ID_Materia'];  
     
        require ("coneccion.php");

          $consulta="SELECT * FROM materia m ,planglobal pg 
                     WHERE m.ID_Materia=$Cod_M AND pg.ID_Materia=m.ID_Materia";
          $resultado=mysql_query($consulta);
          while($row=mysql_fetch_array($resultado)){
                $Cod_PG=$row['ID_PG'];
            }
      


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
               .$row['Carga_Horaria'].' hrs/mes</td></tr>
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
                  WHERE j.ID_PG='$Cod_PG' AND pg.tipo='Titular' AND j.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>'.$row['Justificacion'].'</td></tr>'; } 
          
          echo  '</table>';


  //MOSTRAR OBJETIVOS

           //MOSTRAR JUSTIFICACION

         echo '<H4 id="tabla_title">III. OBJETIVOS</H4>'; 
        
         echo '<table id="tabla_Ident">';

          $query="SELECT * FROM objetivo o,planglobal pg 
                  WHERE o.ID_PG='$Cod_PG' AND pg.tipo='Titular' AND o.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>&bull; '.$row['Texto_Obj'].'</td></tr>'; } 
          
          echo  '</table>';

 //MOSTRAR SELECCION Y ORGANIZACION DE CONTENIDOS

          echo '<H4 id="tabla_title_large">IV. SELECCION Y ORGANIZACION DE CONTENIDOS</H4>'; 
        
        

          $query="SELECT COUNT(*) FROM unidad u,planglobal pg 
                  WHERE u.ID_PG='$Cod_PG' AND pg.tipo='Titular' AND u.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query,$link);
          $u=mysql_result($resultado, 0, "COUNT(*)");
          
          $query1=" SELECT * FROM unidad u,planglobal pg 
                    WHERE u.ID_PG='$Cod_PG' AND pg.tipo='Titular' AND u.ID_PG=pg.ID_PG";
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
                  WHERE m.ID_PG='$Cod_PG' AND pg.tipo='Titular' AND m.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>&bull; '.$row['Metodologia'].'</td></tr>'; } 
          
          echo  '</table>';  

          //MOSTRAREMOS CRONOGRAMA O DURACIÓN EN PERIODOS ACADÉMICOS POR UNIDAD
         
          echo '<H4 id="tabla_title_large_2" >VI. CRONOGRAMA O DURACIÓN EN PERIODOS ACADÉMICOS POR UNIDAD</H4>'; 
        
         echo '<table id="tabla_Ident">';

          $query="SELECT * FROM planglobal pg,unidad u WHERE pg.ID_PG='$Cod_PG' AND pg.tipo='Titular' AND pg.ID_PG=u.ID_PG";

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
                  WHERE c.ID_PG='$Cod_PG' AND pg.tipo='Titular' AND c.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>&bull; '.$row['Criterio'].'</td></tr>'; } 
          
          echo  '</table>';  
         
          //MOSTRAREMOS BIBLIOGRAFIA

          echo '<H4 id="tabla_title">VIII. BIBLIOGRAFIA</H4>'; 
        
          echo '<table id="tabla_Ident">';

          $query="SELECT * FROM bibliografia b,planglobal pg 
                  WHERE b.ID_PG='$Cod_PG' AND pg.tipo='Titular' AND b.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>&bull; '.$row['texto'].'</td></tr>'; } 
          
          echo  '</table>';   
      }
     
      //BOTON IMPRIMIR

      if(isset($_POST['BtnImprimir']))
      {
        $Cod_M=$_POST['txt_ID_Materia'];  
        require ("coneccion.php");
        $consulta="SELECT * FROM materia m ,planglobal pg 
                     WHERE m.ID_Materia=$Cod_M AND pg.ID_Materia=m.ID_Materia";
        $resultado=mysql_query($consulta);
        
        while($row=mysql_fetch_array($resultado)){
                $Cod_PG=$row['ID_PG'];}


      echo '<center><a id="redireccion_imprimir" href="Imprimir_Plan_Global.php? Cod_PG='.$Cod_PG.'&Cod_M='.$Cod_M.'">Realizar Impresion</a></center>'; 


      

      }

      if(isset($_POST['Btn_Programa_Analitico']))
      { 
         require ("coneccion.php");
         $code_Mat=$_POST['txt_ID_Materia'];

         $query="SELECT * FROM planglobal WHERE ID_Materia='$code_Mat'";
         $resultado=mysql_query($query,$link);
         
         while($row=mysql_fetch_array($resultado))
         {
            $Cod_PG=$row['ID_PG'];
         }

        echo '<table>
         <tr><td><img src="img pa.PNG"></td>
         <td><H1 id="titulo_PA">UNIVERSIDAD MAYOR DE SAN SIMON</H1></BR>
             <H1 id="titulo_PA">FACULTAD DE CIENCIAS Y TECNOLOGIA</H1</td></tr>
        </table>';
         
         echo "<hr></hr>";

         echo "<CENTER><h1>PROGRAMA ANALITICO</h1></CENTER>";

         echo "<h3 id='titulos_PA'> IDENTIFICACION</h3>";

         echo "
         <table id='tabla_PA'>
         <tr><td>
         <table id='tabla_Ident_PA'>";
           $query="SELECT * FROM materia WHERE ID_Materia='$code_Mat'";
         $resultado=mysql_query($query,$link);
         
         while($row=mysql_fetch_array($resultado))
         {
              echo "<tr><td>Asignatura :</td><td>".$row['Nombre_Materia']."</td></tr>";
                  
              echo "<td>Codigo :</td><td>".$row['Codigo']."</td>";
         }
         
         
         $query="SELECT * FROM materia m,carrera c WHERE ID_Materia='$code_Mat' AND c.ID_Carrera=m.ID_Carrera";
         $resultado=mysql_query($query,$link);
         
         while($row=mysql_fetch_array($resultado))
         {
              echo "<tr><td>Carreras</td><td>".$row['nombre_carrera']."</td></tr>";
         }
         
         echo "<tr><td>Gestion</td><td>1-2016</td></tr>";
         echo "<tr><td>Semestre</td><td>PRIMER</td></tr>";
         
         $query="SELECT * FROM materia 
                 WHERE ID_Materia='$code_Mat' ";
         $resultado=mysql_query($query,$link);
         
         while($row=mysql_fetch_array($resultado))
         {
            echo "<tr><td>Carga Horaria</td><td>".$row['Carga_Horaria']." hrs/mes</td></tr>";
            $Departamento=$row['Departamento'];
         }


         echo "</table></td>";
          

         echo "<td><table id='tabla_Ident_PA'>";
         echo "<tr><td>Departamento :</td><td>$Departamento</td></tr>";
                 $query="SELECT * FROM planglobal pg,docente d 
                         WHERE pg.ID_Materia='$code_Mat' AND pg.ID_Docente=d.ID_Docente";
                 $resultado=mysql_query($query,$link);
                 
                 while($row=mysql_fetch_array($resultado))
                 {
                      echo "<tr><td>Docentes</td><td>".$row['Nombre_Completo']
                            ."".$row['Apellido_Paterno']."".
                            $row['Apellido_Materno']."</td></tr>";
                 }  

         echo "</table></td></tr></table>";


       echo "<h3 id='titulos_PA'> CONTENIDO ANALITICO</h3>";


           $Cod_PG;
          $query="SELECT COUNT(*) FROM unidad u,planglobal pg 
                  WHERE u.ID_PG='$Cod_PG' AND u.ID_PG=pg.ID_PG AND pg.ID_Materia='$code_Mat'";

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



             // CONTENIDO

                $query4="SELECT COUNT(*) FROM seccion_contenido WHERE ID_Unidad=$id_unidad";
                $resultado4=mysql_query($query4,$link);

                $m=mysql_result($resultado4, 0, "COUNT(*)");
              
                for ($k=0; $k <$m ; $k++) { 
                    $query5="SELECT * FROM seccion_contenido WHERE ID_Unidad=$id_unidad";
                    $resultado5=mysql_query($query5,$link);
                 
                 echo '&nbsp;&nbsp;&nbsp;&nbsp; * &nbsp;'.mysql_result($resultado5, $k, "Contenido").'</br>';

                }
                
             }

         echo '</table>';

         echo "<h3 id='titulos_PA'> BIBLIOGRAFIA</h3>";

         echo '<table id="tabla_Ident">';

          $query="SELECT * FROM bibliografia b,planglobal pg 
                  WHERE b.ID_PG='$Cod_PG' AND pg.tipo='Titular' AND b.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

               echo '<tr><td>&bull; '.$row['texto'].'</td></tr>'; } 
          
          echo  '</table>';}
    
      // Buscador de planes globales

        if(isset($_POST['Buscar_PG']))
        {
           require('coneccion.php');
           $Text_a_Buscar=$_POST['txt_buscar_pg'];

           if($Text_a_Buscar!=null){
           $sql="SELECT * FROM materia 
                WHERE  Nombre_Materia='$Text_a_Buscar'";
             $resultado=mysql_query($sql);

            while($row=mysql_fetch_array($resultado))
            {
             echo "<form method='post'><table id='tabla_pg_resultados'>";
             $ID_Materia=$row['ID_Materia'];
             $ID_Carrera=$row['ID_Carrera'];
             echo "<tr><td id='td_conpact'>Materia :</td><td>".$row['Nombre_Materia']."</td></tr>";
             echo "<tr><td id='td_conpact'>Grupo :</td><td>".$row['Grupo']."</td></tr>";
             echo "<tr><td id='td_conpact'>Nivel :</td><td>".$row['Nivel_Materia']."</td></tr>";
            
              $sql1="SELECT * FROM carrera WHERE ID_Carrera='$ID_Carrera'";
              $resultado1=mysql_query($sql1);
              while($row1=mysql_fetch_array($resultado1)){
                  $carrera=$row1['nombre_carrera'];
                echo "<tr><td id='td_conpact'>Carrera :</td><td>".$row1['nombre_carrera']."</td></tr>";
                  
                   $sql2="SELECT * FROM planglobal pg, docente d
                          WHERE pg.ID_Materia='$ID_Materia' AND pg.ID_Docente=d.ID_Docente";
                   
                   $resultado2=mysql_query($sql2);
              
                 while($row2=mysql_fetch_array($resultado2)){
                 $ID_PG=$row2['ID_PG'];
                 echo "<tr><td id='td_conpact'>Tipo :</td><td>".$row2['tipo']."</td></tr>";
                 echo "<tr><td id='td_conpact'>Docente :</td><td>".$row2['Nombre_Completo']."</td></tr>";
                 echo "<tr><td id='td_conpact'><input type='submit' class='btn_examinar' value='examinar' name='Btn_Buscar_Materias'></td>
                      <td>
                      <select name='Select_M[]' style='visibility:hidden'><option value='".$ID_PG."'>".$ID_PG."</option>
                      </select> <input type='text' value='$carrera' name='txtCarrera' style='visibility:hidden'></td></tr>";
              }
             }
              echo "</table></form>";
            }
           //final del else
           
           }
         else{ 
               echo "<script>alert('Escriba Correctamente para Buscar su Plan Global');</script>";
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

 