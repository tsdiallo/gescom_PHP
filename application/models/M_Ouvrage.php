

<?php
require_once('application/core/DaoInterface.php');

class M_Ouvrage extends CI_Model   implements DaoInterface{

    public $id;
    public $titre;
    public $auteur;
    public $resume;
    public $mots;

    public function __construct(){
         parent::__construct();
     }

    //Redéfinition des Méthodes
    public function insert(){
      $this->db->insert($this->getTableName(), $this);
       $d=array(
        "statut"=>"succes",
        "id"=> $this->db->insert_id(),
        "message"=>ucfirst($this->getTableName())." a été Enregistré avec Success"
       );
     return $d;
    }
    
    public function update(){
       $this->db->where("id",$this->id);
       $this->db->update($this->getTableName(), $this);
       $d=array(
        "statut"=>"succes",
        "id"=> $this->id,
        "message"=>ucfirst($this->getTableName())." a été Modifié avec Success"
       );
     return $d;
    }
    public function delete(){
      $this->db->where("id",$this->id);
      $this->db->delete($this->getTableName());
      $d=array(
       "statut"=>"succes",
       "id"=> $this->id,
       "message"=>ucfirst($this->getTableName())." a été Supprimé avec Success"
      );
    return $d;
    }
    public function findById(){
      return   $this->db
                 ->get_where($this->getTableName(),array("id"=>$this->id))
                 ->row();
    }
    public function findAll(){
       return   $this->db->get($this->getTableName())
                 ->result();
    }
    public function getTableName(){

          return "ouvrage";
    }



}