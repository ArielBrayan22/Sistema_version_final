<?php
/*class 
{
  public function connectToServer($serverName=null)
  {
    if($serverName==null){
      throw new Exception("¡Este no es un nombre de servidor!");
    }
    $fp = fsockopen($serverName,80);
    return ($fp) ? true : false;
  }
  public function returnSampleObject()
  {
    return $this;
  }
}*/
class Nuevo extends PHPUnit_Framework_TestCase
{
	public $Docente;
	public $Carrera;
	public $Plan_Global;

    public function __construct($Docente,$Carrera,$Plan_Global)
    {
        $this->Docente=$Docente;
        $this->Carrera=$Carrera;
        $this->Plan_Global=$Plan_Global;
    }

    public function testgetDocente()
    {
    	return $this->Docente;
    }
    public function testgetCarrera()
    {
    	return $this->Carrera;
    }
    public function testgetPlan_Global()
    {
    	return $this->Plan_Global;
    }
    public function testgetLogin()
    {
    	return $this->Plan_Global;
    }

    public function testgetRedireccion()
    {
      return $this->Plan_Global;
    }

    public function testgetMenu_Docente()
    {
      return $this->Plan_Global;
    }
   
    public function testgetMenu_Admin()
    {
      return $this->Plan_Global;
    }
    /*$miper= new Nuevo("Paco",20,1996);
    echo "Empleado 1 <br>";
    $res=$miper->testgetNombre();
    echo "$res<br>";*/


   
   }

  ?>