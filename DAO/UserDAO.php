<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IUserDAO as IUserDAO;
    use DAO\IStudentDAO as IStudentDAO;
    use Models\User as User;
    use Models\Student as Student;
    use DAO\Connection as Connection;

    class UserDAO implements IUserDAO {
        private $connection;
        private $userList = array();
        private $studentList = array();
        private $tableName = "users";

        public function AddPDO(User $user) {
            try {

                $query = "INSERT INTO ". $this->tableName ." (email, password, profile, question) VALUES (:email, :password, :profile, :question);";
                $parameters['email'] = $user->getEmail();
                $parameters['password'] = $user->getPassword();
                $parameters['profile'] = $user->getProfile();
                $parameters['question'] = $user->getQuestion();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }
        
        public function GetAllPDO() {
            try {
                $userList = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->Execute($query);
                foreach($resultSet as $row) {
                    $user = new User();
                    $user->setUserId($row['userId']);
                    $user->setEmail($row['email']);
                    $user->setPassword($row['password']);
                    $user->setProfile($row['profile']);
                    $user->setQuestion($row['question']);

                    array_push($userList, $user);
                }
                return $userList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function UpdateByEmail($email, $password) {
            try {
                $query = "UPDATE ".$this->tableName." SET email=:email, password=:password WHERE email=:email;";

                $parameters['email'] = $email;
                $parameters['password'] = $password;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function DeleteByEmail($email) {

            $sql = "DELETE FROM users WHERE email=:email";
            $parameters['email'] = $email;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        public function Add(User $user) {
            $this->RetrieveData();
            array_push($this->userList, $user);
            $this->SaveData();
        }

        public function GetAllStudents() {
            try {
                $userList = array();
                $query = "SELECT * FROM ".$this->tableName." WHERE (profile = 'Student')";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {                
                    $user = new User();
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);
                    $user->setProfile($row["profile"]);
                    array_push($userList, $user);
                }
                return $userList;
            } catch(\PDOException $ex) {
                throw $ex;
            }
        }

        public function GetAllAdmin() {
            try {
                $userList = array();
                $query = "SELECT * FROM ".$this->tableName." WHERE (profile = 'Admin')";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {                
                    $user = new User();
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);
                    $user->setProfile($row["profile"]);
                    array_push($userList, $user);
                }
                return $userList;
            } catch(\PDOException $ex) {
                throw $ex;
            }
        }

        public function getStudentByMail($email) {
            $userList = $this->GetAllPDO();

            foreach ($this->userList as $user) {
                if ($user->getEmail() == $email){
                    return $user;
                }
            }
            return null;
        }

        public function Change($email, $password,$question) {
            try {
                $query = "UPDATE ".$this->tableName." SET email=:email, password=:password, question=:question WHERE email=:email;";
        
                $parameters['email'] = $email;
                $parameters['password'] = $password;
                $parameters['question'] = $question;
        
        
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return "Password modificado correctamente";
            } catch(Exception $ex) {
                return "Ha ocurrido un error, usuario o palabra clave incorrectos:( " . $ex->getMessage();     
            }
        

    }
    public function GetStudentsByEmail($email) 
    {
       //// $studentUnico = $this->studentDAO->getStudentByMail($email);
       
       try
       {
           $student1 = $this->studentDAO->traerdatos($email); 

            $userList = array();

            $query = "SELECT * FROM ".$this->tableName." WHERE (profile = 'Student' and email = :email);";

            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
           /// $studentUnico = new Student();
            
            foreach ($resultSet as $row)
            {                
                $user = new User();

                $student1->setStudentId($row["userId"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                $user->setProfile($row["profile"]);
                $user->setQuestion($row["question"]);


                array_push($userList, $user);
            }

            return $userList;
        }
        catch(\PDOException $ex)
        {
            echo "<script> if(alert('No se encontro el estudiante por email')); </script>";
        }
    }
}
?>