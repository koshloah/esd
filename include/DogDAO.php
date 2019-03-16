<?php

//require_once 'Dog.php';

class DogDAO {
    
    public  function getBreeds() {
        try {
            
            $sql = 'select DISTINCT Breed from doginfo ORDER BY Breed';
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            //$stmt->bindParam(':breed', $breed, PDO::PARAM_STR);
            $stmt->execute();

            $dogBreed = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // $name $age $breed $size $sex $status $altered m$hasShots $houseTrained $description $pic1 $pic2
                $dogBreed[] = $row["Breed"];   
            }
            $stmt->closeCursor();
            $conn = null;  
            return $dogBreed;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public  function retrieve($breed) {
        try {
            if($breed == "All"){
                $sql = 'select * from doginfo';

                $connMgr = new ConnectionManager();
                $conn = $connMgr->getConnection();
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();
            }
            else{
                $sql = 'select * from doginfo where Breed=:breed';

                $connMgr = new ConnectionManager();
                $conn = $connMgr->getConnection();
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindParam(':breed', $breed, PDO::PARAM_STR);
                $stmt->execute();
            }
            

            $dogList = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // $name $age $breed $size $sex $status $altered m$hasShots $houseTrained $description $pic1 $pic2
                $dogList[] = new Dog($row['Name'], $row['Age'], $row['Breed'], $row['Size'], $row['Sex'], $row['Status']
                , $row['Altered'], $row['HasShots'], $row['HouseTrained'], $row['Description'], $row['Pic1'], $row['Pic2']);    
            }
            $stmt->closeCursor();
            $conn = null;  
            return $dogList;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /*public function add($dog) {
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
    }*/
  

}

?>
