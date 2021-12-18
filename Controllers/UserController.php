<?php
    namespace Controllers;
    use \Exception as Exception;
    use DAO\UserDAO as UserDAO;
    use DAO\StudentDAO as StudentDAO;
    use Models\User as User;
    use Models\Student as Student;

    class UserController {
        
        private $UserDAO;
        private $studentDAO;

        public function __construct() {
            $this->UserDAO = new UserDAO();
            $this->studentDAO = new StudentDAO();
        }
        
        public function ShowAddView() {
            require_once(VIEWS_PATH."add-user.php");
        }
        
        public function ShowProfileView() {
            $userList = $this->UserDAO->GetAllPDO();
            require_once(VIEWS_PATH."user-list.php");
        }

        public function ShowProfileUserView() {
            require_once(VIEWS_PATH."vistaUserAdmin.php");
        }

        public function ShowProfileUserModify() {
            require_once(VIEWS_PATH."modify-user.php");
        }

        public function ShowProfileUserRecovery() {
            require_once(VIEWS_PATH."recover.php");
        }

        public function ShowModifyView($email) {
            $arrayUser = $this->UserDAO->GetAllPDO();
            $loggedUser = NULL;
            foreach ($arrayUser as $key => $value) {
                if($email == $value->getEmail()) {
                    $loggedUser = $value;
                }
            }
            if($loggedUser != NULL) {
                $_SESSION['loggedUser'] = $loggedUser;
                require_once(VIEWS_PATH."modify-user.php");
            }
        }


        public function AddStudent ($email, $password,$question, $btnLogin) { // primero verifico que este en la API y luego lo registro en la base 
            $arrayStudents = $this->studentDAO->GetAllApi();
            $student = null; 

            foreach ($arrayStudents as $key => $value) {
                if($email == $value->getEmail() && $value->getActive() == true){
                    $student = $value;
                }
            }
            if($student) {
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setProfile('Student');
                $user->setProfile('Student');
                $user->setQuestion($question);
                $this->UserDAO->AddPDO($user); 
                echo "<script> if(alert('ESTUDIANTE AGREGADO')); </script>";
                require_once(VIEWS_PATH."index.php");
            } else {
                echo "<script> if(alert('No se pudo registar')); </script>";
                require_once(VIEWS_PATH."index.php");
            }
        }

        public function Add($email, $password, $button) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setProfile('Admin');
            $this->UserDAO->AddPDO($user);
            $this->ShowAddView();
        }

        public function ModifyUser($email, $password, $button) {
            $this->UserDAO->UpdateByEmail($email, $password);
            $this->ShowProfileView();
        }

        public function DeleteUser($email) {
            $this->UserDAO->DeleteByEmail($email);
    		$this->ShowProfileView();
        }

        public function PasswordChange($email,$password,$question, $button) {

            $userList = $this->UserDAO->GetAllPDO();
            $user = null;
            foreach ($userList as $key => $value) {
                    if($email == $value->getEmail() && $value->getQuestion() == $question){
                        $user = $this->UserDAO->Change($email, $password,$question);
                        require_once(VIEWS_PATH."index.php");
                    } else {
                        require_once(VIEWS_PATH."index.php");
                    }                
            }
        }

    }
?>