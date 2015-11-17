<?php
class Service {
      public static function listTasks() {
        $db = ConectionFactory::getDB();
        $tasks = array();
        
        foreach($db->tasks() as $task) {
           $tasks[] = array (
               'id' => $task['id'],
               'nome' => $task['nome'],
               'email' => $task['email']
           ); 
        }
        
        return $tasks;
    }


       public static function add($newTask) {
         $db = ConnectionFactory::getDB();
         $task = $db->tasks->insert($newTask);
        
         return $task;
    }
    
    public static function update($updatedTask) {
        $db = ConnectionFactory::getDB();
        $task = $db->tasks[$updatedTask['id']];
        
        if($task) {
            $task['description'] = $updatedTask['description'];
            $task['done'] = $updatedTask['done'];
            return true;
        }
        
        return false;
    }

}
?>