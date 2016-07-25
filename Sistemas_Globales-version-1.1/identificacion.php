<html>
<head>
	<title>Sistema de Planes Globales</title>
	<link rel="stylesheet" type="text/css" href="Style.css">
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
    <center><img src="imagenes/logo_01.png" width="30%" height="30%" ></center>
    <center><h3>Contactos</h3>
    		<h4>Correo:umss.molecular.bolivia@.gmail.com</h4>
    		<h4>Direccion:Barrio el Profesional Nro 192</h4>
    		<h4>Telefonos:7772767 - 65502158 </h4>

    </center>

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
</html>