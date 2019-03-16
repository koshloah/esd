<?php

//require_once 'ConnectionManager.php';

class UserDAO {
    
    public  function retrieve($email) {
        try {
            $sql = 'select * from dog_users where Email=:email';
            
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return new User($row['FirstName'], $row['LastName'], $row['Email'], $row['Phone'], $row['Password'], $row['Role']);
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function add($user) {
        $preference="";
        $sql = 'insert into dog_users (FirstName, LastName, Email, Phone, Password, Preference, Role) values (:firstName, :lastName, :email, :phone, :password, :preference, :role)';
        
        $connMgr = new ConnectionManager();       
        $conn = $connMgr->getConnection();
         
        $stmt = $conn->prepare($sql); 

        $stmt->bindParam(':firstName', $user->firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $user->lastName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $user->email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user->phone, PDO::PARAM_STR);
        $stmt->bindParam(':password', $user->password, PDO::PARAM_STR);
        $stmt->bindParam(':preference', $preference, PDO::PARAM_STR);
        $stmt->bindParam(':role', $user->role, PDO::PARAM_STR);

        $isAddOK = False;
        if ($stmt->execute()) {
            $isAddOK = True;
        }
        //$connMgr->close($conn,$stmt);

        return $isAddOK;
    }
  

}

?>
