<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23/09/2018
 * Time: 12:44
 */
require_once('application/core/DaoInterface.php');
class M_Commande  extends CI_Model implements DaoInterface
{
    public $id;
    public $numero;
    public $date;
    public $montant;
    public $etat;
    public $client_id;
    public function __construct(){
        parent::__construct();
    }
   //Redéfinition des Méthodes
   public function insert(){
     $this->db->insert($this->getTableName(), $this);
      $d=array(
       "statut"=>"succes",
       "id"=> $this->db->insert_id(),
       "message"=>ucfirst($this->getTableName())." a été Enregistrée avec Success"
      );
    return $d;
   }
   public function update(){
      $this->db->where("id",$this->id);
      $this->db->update($this->getTableName(), $this);
      $d=array(
       "statut"=>"succes",
       "id"=> $this->id,
       "message"=>ucfirst($this->getTableName())." a été Modifiée avec Success"
      );
    return $d;
   }
   public function delete(){
     $this->db->where("id",$this->id);
     $this->db->delete($this->getTableName());
     $d=array(
      "statut"=>"succes",
      "id"=> $this->id,
      "message"=>ucfirst($this->getTableName())." a été Supprimée avec Success"
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

         return "commande";
   }

   public function findCommandeLivre(){
       return $this->db->select("c.*,cl.nom,cl.prenom")
                    ->from($this->getTableName().' c')
                    ->join('client cl', 'cl.id=c.client_id','left')
                    ->get()
                    ->result();
   }

   public function findCommandeByEtat($etat){
     return  $this->db->select("c.*,cl.*")
             ->from($this->getTableName() .' c')
             ->join("client cl","cl.id=c.client_id","left")
             ->where("etat=".$etat)
             ->get()
             ->result();
   }
   public function select()
   {
       // TODO: Implement select() method.
   }

}