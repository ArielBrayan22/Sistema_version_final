<?php
 session_start();
 

 if(isset($_SESSION['Alias']))
 {
    $Alias_User=$_SESSION['Alias'];
    $Password_User=$_SESSION['Password'];
    $ID_User=$_SESSION['ID'];
  ?> 

<html lang='spa'>
<head>
  <title>Sistema de Planes Globales</title>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <div id="titulo"><a id="titulo" href="Plan_Global_Publico.php">Planes Globales</a></div>
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

   <table id="tabla_Buscador">
   <tr><td> 
    <button onclick="procesar()" id="procesar" class="btn_rec" style=" background: url('icon_rv1.png'); width:32px; height:32px; border-color:white;"></button></td><td>
    <form method="post">
    <input type="text" class="Txt_Buscar" size="85" id="texto" name="txt_buscar_pg" placeholder="Escriba el Plan Global a Buscar">
    <input type="submit" class="btn_Buscar" name="Buscar_PG" value="Buscar"></form>
   </td></tr></table>

   <form method="post" action="">
    <center><table class="tabla_seleccion_pg">
    <tr><td><center><input type="submit" class="button_seleccion" value="Seleccion de Plan Global" name="Btn_Buscar_Facultad"></center></td></tr>
    </table></center>
   </form>


     <?php
    
    $Facultad;
    $Carrera_Main;
    $Materia;
    require('coneccion.php');

 //BOTON FACULTAD

    if(isset($_POST['Btn_Buscar_Facultad']))
    {
     $query="SELECT * FROM facultad";
     $resultado=mysql_query($query,$link);
     
     echo '<form method="post" action="">
     <center><table id="Tabla_Seleccion_Carrera">
     <tr><td><h3>Seleccione la Facultad</h3></td>
     <td></td></tr>
       
     <tr><td><select class="Select_Facultad" name="Select_F[]">';
     
     
     while($row=mysql_fetch_array($resultado))
     { 

      echo '<option value="'.$row['ID_Facultad'].'">'.$row['Facultad'].'</option>'; 
 
      }

      echo '</select></td><td><input type="submit" value="Buscar" name="Btn_Buscar_Carrera"></td></tr>
            </table></center>
            </form>';
      }
      
 // BOTON CARRERA
    if(isset($_POST['Btn_Buscar_Carrera']))
    {
       $Seleccion_F=$_POST['Select_F'];
        
       for ($i=0;$i<count($Seleccion_F);$i++) 
       {  $Facultad=$Seleccion_F[$i];} 
       
       $query="SELECT * FROM carrera WHERE id_facultad='$Facultad'";

       $resultado=mysql_query($query,$link);
 
       while($row0=mysql_fetch_array($resultado))
       { $f=$row0['facultad'];}

       echo '<center><table><tr><td><h3> Facultad : '.$f.'</h3></td></tr>';
     
       echo '<form method="post" action="">
    
       <tr><td>Seleccione la Carrera :</td>
       
       <td><select class="Select_Facultad" name="Select_C[]">';
     
       $resultado=mysql_query($query,$link);
     
       while($row=mysql_fetch_array($resultado))
       {
        
        echo '<option value="'.$row['ID_Carrera'].'">'.$row['nombre_carrera'].'</option>'; 
 
       }

        echo '</select></td><td><input type="submit" value="Buscar" name="Btn_Buscar_Nivel"></td></form><form method="post">
          <td>
          <input type="submit" name="Btn_Buscar_Facultad" value="atras">
          </td></tr></form>
          </table></center>';
     
      }
   
    //BOTON NIVEL

    if(isset($_POST['Btn_Buscar_Nivel']))
     {

       $Seleccion_C=$_POST['Select_C'];
  
       for ($i=0;$i<count($Seleccion_C);$i++) 
       {  $Carrera=$Seleccion_C[$i];} 
    
       $query0="SELECT * FROM carrera WHERE ID_Carrera=$Carrera";

       $query="SELECT DISTINCT Nivel_Materia FROM materia WHERE ID_Carrera='$Carrera' ORDER BY `materia`.`Nivel_Materia` ASC";

       $resultado=mysql_query($query0,$link);

       echo "<center><table id='tabla_nivel'>";

       while($row0=mysql_fetch_array($resultado))
       { $facultad=$row0['id_facultad'];
        echo '<tr><td colspan="3"><h3> Carrera de : '.$row0['nombre_carrera'].'</h3></td></tr>'; }
     
       echo '<form method="post" action="">
         
       <tr><td>
       Seleccione el nivel :
       <input type="text" value="'.$Carrera.'" name="txtCarrera" size="5" style="visibility:hidden">
       </td></tr>
       <tr><td><select class="Select_Nivel" name="Select_N[]">';

       $resultado=mysql_query($query,$link);

       while($row=mysql_fetch_array($resultado))
       { 
        echo '<option class="Select_Nivel" value="'.$row['Nivel_Materia'].'">Nivel '.$row['Nivel_Materia'].
             '</option>';
       }

        echo '</select></td>
              <td><input type="submit" value="Mostrar" name="Btn_Buscar_Materia"></td>
              </form><form method="post">
              <td><input type="submit" value="atras" name="Btn_Buscar_Carrera"></td></tr>
             
              <input type="text" name="Select_F" style="visibility:hidden" 
              value='.$facultad.'>
              </table></form></center>';
      }
      
   //BOTON MATERIA SEGUN NIVEL
      if(isset($_POST['Btn_Buscar_Materia']))
      {
        
         $S_Carrera=$_POST['txtCarrera'];
         $Seleccion_N=$_POST['Select_N'];

         //echo "$S_Carrera </br>";

       for ($i=0;$i<count($Seleccion_N);$i++) 
       { 
          $Nivel=$Seleccion_N[$i];
        } 

        $query0="SELECT * FROM carrera WHERE ID_Carrera=$S_Carrera";

        $resultado=mysql_query($query0,$link);

       while($row0=mysql_fetch_array($resultado))
       {
        // echo $row0['nombre_carrera']; 
        $Carrera=$row0['nombre_carrera'];}


       echo '<form method="post" action="">
       <center><table class="tabla_materias_nivel">
       <tr><td colspan="3"><h3 class="etiqueta_h3">Carrera de : '
       .$Carrera.'</h3></td></tr>';

       echo '<tr><td colspan="3"><h3 class="etiqueta_h3" >Nivel : '.$Nivel.'</h3></td></tr>';

       $query="SELECT * FROM materia m, planglobal pg
               where pg.ID_Materia=m.ID_Materia AND m.ID_Carrera=$S_Carrera AND m.Nivel_Materia='$Nivel'";

       $resultado=mysql_query($query,$link);
     
       echo '
      
       <tr><td colspan="3">Seleccione la Materia</td></tr>
       
       <tr><td><select class="Select_Facultad" name="Select_M[]">';

       while($row=mysql_fetch_array($resultado))
       { 
        echo "el ID".$row['ID_Materia'];
     
         echo '<option value="'.$row['ID_Materia'].'">'.$row['tipo'].' - '.$row['Nombre_Materia'].'- Grupo - '.$row['Grupo'].'</option>';
       }

        echo '</select>
        </td>
        <td><input type="submit" value="Mostrar" name="Btn_Buscar_Materias"></td>
        </form><form method="post">
        <td><input type="submit" value="Atras" name="Btn_Buscar_Nivel"></td></tr>
        </table></center>';

        echo " <input type='text' name='Select_C' style='visibility:hidden' value='".$S_Carrera."'></form>";

            
      }

      if(isset($_POST['Btn_Buscar_Materias'])){
        
       $Seleccion_M=$_POST['Select_M'];
  
       for ($i=0;$i<count($Seleccion_M);$i++) 
       {  $ID_Materia=$Seleccion_M[$i];} 

       //echo "es =".$ID_Materia."</br>";

       //$Select_Carrera=$_POST['txtCarrera'];

       $query="SELECT * FROM materia WHERE ID_Materia=$ID_Materia";

       $resultado=mysql_query($query,$link);
     
       echo '<form method="post" action="">

     
       <table id="tabla_materias_pg">
       <tr><td id="td_titulo"> Codigo </td>
       <td id="td_titulo"> Materia </td>
       <td id="td_titulo"> Grupo </td>
       <td id="td_titulo"> Seleccion </td>
       <td id="td_titulo"> Imprimir </td></tr><tr>';
       while($row=mysql_fetch_array($resultado))
       {  $Cod_Materia=$row['ID_Materia'];
          $Code_Grupo=$row['Grupo'];
          $Code_Carrera=$row['ID_Carrera'];
          $nivel=$row['Nivel_Materia'];
            
        echo '<td>'.$row['Codigo'].'</td>
              <td>'.$row['Nombre_Materia'].'</td>
  
              <td><center>'.$row['Grupo'].'</center></td>';
        }
        echo '<input type="text" style="visibility:hidden" value="'
        .$Cod_Materia.'" name="txt_ID_Materia" class="input_Carrera" size="5">
         <input type="text" value="'.$Code_Grupo.'" name="txtGrupo" class="input_Grupo" style="visibility:hidden">
         <input type="text" value="'.implode($Seleccion_M).'" name="Seleccion_M" class="input_Grupo" style="visibility:hidden">';
          
        echo '<td><input type="submit" value="Plan Global" name="Btn_Plan_Global"></td>
              
              </form> 
              <form method="post" action="Imprimir_Plan_Global_Docente.php">
              ';
        $consulta="SELECT * FROM materia m ,planglobal pg 
                     WHERE m.ID_Materia=$Cod_Materia AND pg.ID_Materia=m.ID_Materia";
        $resultado=mysql_query($consulta);
        
        while($row=mysql_fetch_array($resultado)){
                $Cod_PG=$row['ID_PG'];}
        
         echo '<input type="text" style="visibility:hidden" value="'
        .$Cod_Materia.'" name="Cod_M" class="input_Carrera" size="5">
         <input type="text" style="visibility:hidden" value="'
        .$Cod_PG.'" name="Cod_PG" class="input_Carrera" size="5">';

              echo '<td><input type="submit" value="Imprimir PG" name="BtnImprimir">
                
              </td> </form>';
       
       echo '</tr></table>';

       echo "<form method='post'><input type='text' style='visibility:hidden' value='"
        .$Code_Carrera."' name='txtCarrera' size='5'>";

        echo "<select name='Select_N[]' style='visibility:hidden'><option value='".$nivel."'></option></select>";


       echo "<center><input type='submit' value='atras' name='Btn_Buscar_Materia'></center></form>";
           

      }
      
      if(isset($_POST['Btn_Plan_Global']))
      {
        // echo "Aca el plan global </br>";
         $Cod_M=$_POST['txt_ID_Materia'];
         $Select_M=$_POST['Seleccion_M'];

        echo '<center><form method="post">
        <input type="submit" value="atras" name="Btn_Buscar_Materias">
        <select class="Select_Facultad" name="Select_M[]" style="visibility:hidden">
        <option value="'.$Select_M.'"></option></select>       
        </form></center>';

          $consulta="SELECT * FROM materia m ,planglobal pg 
                     WHERE m.ID_Materia=$Cod_M AND pg.ID_Materia=m.ID_Materia";
          $resultado=mysql_query($consulta);
          while($row=mysql_fetch_array($resultado)){
                $Cod_PG=$row['ID_PG'];
            }
      
         $Cod_PG;

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
                  WHERE m.ID_PG='$Cod_PG' AND pg.tipo='Titular' AND m.ID_PG=pg.ID_PG";

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
                 $ID_PG=$row2['ID_Materia'];
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
<?php  } 
else {
   header("location: Planes_Globales/index.php");
 } ?>
 