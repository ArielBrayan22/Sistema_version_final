

<?php

 if(isset($_POST['BtnImprimir'])){
 
  require_once("/dompdf/dompdf_config.inc.php");
         require("coneccion.php");

         $code_Mat=$_POST['txt_ID_Materia'];

		  $html='<html>
      <head>
        <title>Sistema de Planes Globales</title>
        <link rel="stylesheet" type="text/css" href="estilos2.css">
        
      </head>
      <body>';

         $query="SELECT * FROM planglobal WHERE ID_Materia='$code_Mat'";
         $resultado=mysql_query($query,$link);
         
         while($row=mysql_fetch_array($resultado))
         {
            $Cod_PG=$row['ID_PG'];
         }

         $html.='<table id="tabla_PA">
         <tr><td id="logoUMSS"><img src="img pa.PNG"></td>
         <td><H2 id="titulo_PA">UNIVERSIDAD MAYOR DE SAN SIMÓN</H2></BR>
             <H2 id="titulo_PA2">FACULTAD DE CIENCIAS Y TECNOLOGÍA</H2></td></tr>
        </table>';
         
         $html.='<hr id="linea_PA"></hr>';

         $html.='<center><h2 id="titulo_Principal_PA">PROGRAMA ANALÍTICO</h2></center>';

         $html.='<h3 id="titulos_PA"> IDENTIFICACION</h3>';

         $html.='<table id="tabla_Ident">';
        
         $query="SELECT * FROM materia WHERE ID_Materia='$code_Mat'";
         $resultado=mysql_query($query,$link);
         
         while($row=mysql_fetch_array($resultado))
         {
              $html.='<tr><td id="td_datos">Asignatura:</td><td>'.$row['Nombre_Materia'].'</td>';

              $html.='<td id="td_datos">Departamento: </td><td>'.$row['Departamento'].'</td></tr>';
                  
              $html.='<tr><td id="td_datos">Codigo:</td><td>'.$row['Codigo'].'</td>';
              
               $query="SELECT * FROM planglobal pg,docente d 
                         WHERE pg.ID_Materia='$code_Mat' AND pg.ID_Docente=d.ID_Docente";
                 $resultado=mysql_query($query,$link);
                 $html.='<td> Docente :</td><td>';
                 
                 while($row1=mysql_fetch_array($resultado))
                 {
                    $html.=''.$row1['Nombre_Completo']
                            .' '.$row1['Apellido_Paterno'].' '.
                            $row1['Apellido_Materno'].'';
                 }  

                 $html.='</td></tr>';

         }
         
       
         
         $query="SELECT * FROM materia m,carrera c WHERE ID_Materia='$code_Mat' AND c.ID_Carrera=m.ID_Carrera";
         $resultado=mysql_query($query,$link);
         
         while($row=mysql_fetch_array($resultado))
         {
               $html.='<tr><td id="td_datos"> Carreras :</td><td> '.$row['nombre_carrera'].'</td></tr>';
         }
         
          $html.='<tr><td id="td_datos"> Gestion :</td><td> 1-2016 </td></tr>';
          $html.='<tr><td id="td_datos"> Semestre :</td><td> PRIMER </td></tr>';
         
         $query="SELECT * FROM materia 
                 WHERE ID_Materia='$code_Mat' ";
         $resultado=mysql_query($query,$link);
         
         while($row=mysql_fetch_array($resultado))
         {
               $html.='<tr><td id="td_datos">Carga Horaria :</td><td>'.$row['Carga_Horaria'].' hrs/mes</td>';

         }


          $html.='</table>';

      
       $html.='<p id="espacio">a</p>';
       

       $html.='<h3 id="titulos_PA"> CONTENIDO ANALITICO</h3>';


        
          $query="SELECT COUNT(*) FROM unidad u,planglobal pg 
                  WHERE u.ID_PG='$Cod_PG' AND u.ID_PG=pg.ID_PG AND pg.ID_Materia='$code_Mat'";

          $resultado=mysql_query($query,$link);
          $u=mysql_result($resultado, 0, "COUNT(*)");
          
          $query1=" SELECT * FROM unidad u,planglobal pg 
                    WHERE u.ID_PG='$Cod_PG' AND u.ID_PG=pg.ID_PG";
          $resultado1=mysql_query($query1,$link);
          
          $html.='<table id="tabla_Ident">';
        
       
         for ($i=0; $i <$u; $i++) { 
             
              
             mysql_result($resultado1, $i, "Unidad");
             $id_unidad=mysql_result($resultado1, $i, "ID_Unidad");
        
              $html.='<tr><td><h4> Unidad '.mysql_result($resultado1, $i, "Numero_Unidad").' .-
             '.mysql_result($resultado1, $i, "Unidad").'</h4></td></tr>';



             // CONTENIDO

                $query4="SELECT COUNT(*) FROM seccion_contenido WHERE ID_Unidad=$id_unidad";
                $resultado4=mysql_query($query4,$link);

                $m=mysql_result($resultado4, 0, "COUNT(*)");
              
                for ($k=0; $k <$m ; $k++) { 
                    $query5="SELECT * FROM seccion_contenido WHERE ID_Unidad=$id_unidad";
                    $resultado5=mysql_query($query5,$link);
                 
                  $html.='<tr><td>&nbsp;&nbsp; * &nbsp;'.mysql_result($resultado5, $k, "Contenido").'</td></tr>';

                }
                
             }


         $html.='</table>';

         $html.='<p id="espacio">a</p>';

         $html.='<h3 id="titulos_PA"> BIBLIOGRAFIA</h3>';

         $html.='<table id="tabla_Ident_B">';

         $query="SELECT * FROM bibliografia b,planglobal pg 
                  WHERE b.ID_PG='$Cod_PG' AND b.ID_PG=pg.ID_PG";

          $resultado=mysql_query($query);

          while($row=mysql_fetch_array($resultado)){

           $html.='<tr><td>&nbsp; &bull; '.$row['texto'].'</td></tr>'; } 
          
           $html.='</table>'; 
          

            # Instanciamos un objeto de la clase DOMPDF.
            $mipdf = new DOMPDF();
             
            # Definimos el tamaño y orientación del papel que queremos.
            # O por defecto cogerá el que está en el fichero de configuración.
            $mipdf ->set_paper("letter", "portrait");
             
            # Cargamos el contenido HTML.
            $mipdf ->load_html(utf8_decode($html));
             
            # Renderizamos el documento PDF.
            $mipdf ->render();
             
            # Enviamos el fichero PDF al navegador.
            $mipdf ->stream('Programa_Analitico.pdf');
            //*/    
            }      

?>
</body>
</html>