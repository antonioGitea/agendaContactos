<?php
//Require del archivo conexión, invocamos de él la variable $pdo.
require_once dirname(__DIR__) . '/conexion.php';
/**
  * Clase principal de contacto
  * 
  * Esta clase implementa funcioness de listado además de las operaciones CRUD básicas
  * 
  * @author Antonio Sánchez Leal
  * @version 1.2.0
  * @package Proyecto agenda MVC
*/
class Contacto {
  public string $name;
  public string $email;
  public int $phone;

  //Constructor
  public function __construct(string $name, string $email, int $phone) {
    $this->name = $name;
    $this->email = $email;
    $this->phone = $phone;
  }
  
  /**
   * Recoge un usuario de la BDD por ID
   * 
   * Utiliza la conexión PDO para listar todos los contactos almacenados en la BDD
   * 
   * @param PDO $pdo Objeto de conexión a la base de datos
   * @return object Objeto recogido de la bdd con todos sus campos
   * @throws Exception En caso de  un error durante la consulta
  */
  public static function obtenerContacto($pdo, $id){
    try{
      $busqueda = $pdo->prepare("SELECT * FROM contacto WHERE id = :id");
      $busqueda->bindParam(':id', $id, PDO::PARAM_INT);
      $busqueda->execute();
      $contacto = $busqueda->fetch(PDO::FETCH_ASSOC);
      
      $nuevoContacto = new Contacto($contacto['name'], $contacto['email'], $contacto['phone']);
      return $nuevoContacto;
      
    }catch (PDOException $e){
      echo "Error: " . $e->getMessage();
    }finally {
      $busqueda = null;
      $pdo = null;
    }
  }
  
  /**
   * Lista los contactos de la base  de datos
   * 
   * Utiliza la conexión PDO para listar todos los contactos almacenados en la BDD
   * 
   * @param PDO $pdo Objeto de conexión a la base de datos
   * @return array Con todos los contactos almacenados en la BDD
   * @throws Exception En caso de  un error durante la consulta
  */
  public static function listar($pdo) {
    try {
      //recogemos el PDO de conexión y preparamos el statement SQL que seleccionara todos los campos de nuestra BDD, con la funcion fetchAll
      //lo recogeremos como un array asociativo.
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM contacto";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();

      $listaContactos = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $listaContactos;

    }catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }finally {
      $stmt = null;
      $pdo = null;
    }
  }


  /**
     * Inserta contacto en la base de datos
     * 
     * Utiliza la conexión PDO para insertar el contacto creado
     * 
     * @param PDO $pdo Objeto de conexión a la base de datos
     * @throws Exception En caso de  un error durante la consulta
  */
  public function insertar ($pdo) { 
    try{
      //Recogemos la variable $pdo y preparamos una cosulta de INSERT parametritazada, los valores los asignara recogiendo
      //los valores de atributo del objeto que llame a la funcion.
      $insercion = $pdo->prepare("INSERT INTO contacto(name,email,phone)" . " VALUES(:name,:email,:phone)");
      $insercion->bindParam(':name', $this->name);
      $insercion->bindParam(':email', $this->email);
      $insercion->bindParam(':phone', $this->phone);
      $insercion->execute();

    }catch(PDOException $e){
      echo "Error: " . $e->getMessage();
      
    }finally{
      $pdo = null;
      $insercion = null;
    }
  }

  
  /**
     * Modifica contacto en la base de datos
     * 
     * Utiliza la conexión PDO para modificar el contacto buscado con la id
     * 
     * @param PDO $pdo Objeto de conexión a la base de datos
     * @param id $id Es el atributo por el que buscaremos en la base de datos el contacto que queremos modificar
     * @throws Exception En caso de  un error durante la consulta
 */
  public function modificar ($pdo, $id) {
    try{
      //Recogemos la variable $pdo y preparamos una cosulta de UPDATE parametritazada, los nuevos valores los asignara recogiendo
      //los valores de atributo del objeto que llame a la funcion.
      $modificar = $pdo->prepare("UPDATE contacto SET name = :name, email = :email, phone = :phone WHERE id = :id");
      $modificar->bindParam(':id', $id);
      $modificar->bindParam(':name', $this->name);
      $modificar->bindParam(':email', $this->email);
      $modificar->bindParam(':phone', $this->phone);
      $modificar->execute();

    }catch(PDOException $e){
      echo "Error: " . $e->getMessage();

    }finally{
      $pdo = null;
      $modificar = null;
    }
  }


  /**
     * Elimina contacto de la base de datos
     * 
     * Utiliza la conexión PDO para eliminar el contacto buscado con la id
     * 
     * @param PDO $pdo Objeto de conexión a la base de datos
     * @param id $id Es el atributo por el que buscaremos en la base de datos el contacto que queremos eliminar
     * @throws Exception En caso de  un error durante la consulta
 */
  public static function eliminar($pdo, $id) {
    try{
      //Recogemos la variable $pdo y preparamos una cosulta de DELETE parametritazada, como la funcion es estatica, borraremos el
      //usuario con el mismo id que entre por el formulario.
      $eliminacion = $pdo->prepare("DELETE FROM contacto WHERE id = :id");
      $eliminacion->bindParam(':id', $id);
      $eliminacion->execute();

    }catch(PDOException $e){
      echo "Error: " . $e->getMessage();

    }finally{
      $pdo = null;
      $eliminacion = null;
    }
  }


  public function __get($atributo){
    if (property_exists($this, $atributo))
        return $this->$atributo;
    else
        return "El atributo '$atributo' no esta implementado en la clase";
  }
}