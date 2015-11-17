<?php
class Service {
      public static function listGuest() {
        $db = ConnectionFactory::getDB();
        $guest = array();
        
        foreach($db->guests() as $guest) {
           $guest[] = array (
               'id' => $guest['id'],
               'nome' => $guest['nome'],
               'email' => $guest['email']
           ); 
        }
        
        return $guest;
    }


       public static function add($newGuest) {
         $db = ConnectionFactory::getDB();
         $guest = $db->guests->insert($newGuest);
        
         return $guest;
    }
    
    public static function update($updatedGuest) {
        $db = ConnectionFactory::getDB();
        $guest = $db->guests[$updatedGuest['id']];
        
        if($guest) {
            $guest['nome'] = $updatedGuest['nome'];
            $guest['email'] = $updatedGuest['email'];
            return true;
        }
        
        return false;
    }

}
?>