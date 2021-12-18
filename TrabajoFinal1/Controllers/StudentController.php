<?php namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use DAO\CareerDAO as CareerDAO;
use DAO\CompanyDAO;
use DAO\UserDAO as UserDAO;
    use DAO\JobDAO as JobDAO;
    use Models\Student as Student;
    use Models\Career as Career;
    use Models\Job as Job;
    use Models\User as User;
    use Models\Company as Company;


    class StudentController {
        private $studentDAO;
        private $userDAO;
        private $jobDAO;
        private $careerDAO;

        public function __construct() {
            $this->studentDAO = new StudentDAO();
            $this->userDAO = new UserDAO();
            $this->jobDAO = new JobDAO();
            $this->careerDAO = new CareerDAO();
            $this->companyDAO = new CompanyDAO();

        }

        public function ShowAddView() {
            require_once(VIEWS_PATH."add-student.php");
        }

        public function ShowProfileStudentListView() {
            $studentListapi = $this->studentDAO->GetAllApi();
            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowProfileCvView() {
            $studentListapi = $this->studentDAO->GetAllApi();
            require_once(VIEWS_PATH."cv.php");
        }

        public function ShowProfileStudentView() {
            require_once(VIEWS_PATH."vistaStudentAdmin.php");
        }

        public function ShowProfileUserView() {
            require_once(VIEWS_PATH."vistaUserAdmin.php");
        }
        
        public function ShowProfileView() {
            require_once(VIEWS_PATH."vistaStudent.php");
        }

        public function ShowProfileView2() {
            require_once(VIEWS_PATH."students-list.php");
        }

        public function ShowProfileView3($Email) {
            $user1= null;
            $_SESSION['loggedUser'] = $user1;
            var_dump($user1);
            $this->companyDAO->ShowListView2($Email); 
        }

        public function ShowJobPostulate($jobPositionId) {
            //$arrayJob = $this->jobDAO->GetAll();
            $arrayJobpdo = $this->jobDAO->GetAllPDO();
            $arrayStudentApi = $this->studentDAO->GetAllApi();
            $loggedStudent = NULL;
            //$loggedJob = NULL;
            foreach ($arrayJobpdo as $key => $value) {
                if($jobPositionId == $value->getJobPositionId()) {
                    $loggedStudent = $value;
                }
            }
            foreach ($arrayStudentPdo as $key => $value) {
                $loggedStudent = $value;
            }
            foreach ($arrayStudentApi as $key => $value) {
                $loggedStudent = $value;
            }
            
            foreach ($arrayJobpdo as $key => $value) {
                if($jobPositionId == $value->getJobPositionId()) {
                    $loggedJob = $value;
                }
            }
            
            if($loggedJob != NULL && $loggedStudent != NULL) {
                $_SESSION['loggedStudent'] = $loggedStudent;
                $_SESSION['loggedJob'] = $loggedJob;
                require_once(VIEWS_PATH."studentProfile.php");
            }
        }

        

        /***
         *  MUESTRA LA INFORMACION PERSONAL DEL ESTUDIANTE
         */

        public function ShowPersonalInformation() {
            $arrayStudent = $this->studentDAO->GetAll();
            $loggedStudent = NULL;
            foreach ($arrayStudent as $key => $value) {
                if($value->getEmail()){
                    $loggedStudent = $value;
                }
            }
            if($loggedStudent != NULL) {
                $_SESSION['loggedStudent'] = $loggedStudent;
                require_once(VIEWS_PATH."studentProfile.php");
            }
        }

        public function SearchFilter($lastname) {
            $studentListapi = $this->studentDAO->GetAllApi();
            $studentFilter = array();
            foreach ($studentListapi as $student) {
                if($lastname !== ""){
                    if (strpos($student->getLastName(), $lastname) !== false) {
                        array_push($studentFilter, $student);
                    }
                    $studentListapi = $studentFilter;
                }
            }
            if(empty($studentListapi)) {
                echo("
                    <script>
                        alert('No hay empresas con el nombre ingresado');
                    </script>
                ");
            }
            require_once(VIEWS_PATH."student-list.php");
        }
        

        /***
         *  LOGUEO
         */


        private function validateSession($array, $email, $password) {
            $student = NULL;
            foreach($array as $key=>$value) {
                if($email == $value->getEmail() && $password == $value->getPassword()) {
                    $student = $value;
                } 
            }
            return $student;
        }

        public function Login($email, $password, $btnLogin) {
            $arrayUser =  $this->userDAO->GetAllPDO();
            $studentApi = $this->studentDAO->GetApiByEmail($email);
            $arrayCompany = $this->companyDAO->GetByEmail($email);
            $loggedUser = NULL;

            $loggedUser = $this->validateSession($arrayUser, $email, $password);
            
            if($loggedUser != NULL) { 
                if($loggedUser->getProfile() == 'Student') {
                    if ($studentApi->getActive() == true){
                        $_SESSION['loggedUser'] = $loggedUser;
                        $this->ShowProfileView($studentApi);
                    } else {
                        echo "<script> if(alert('No esta activo')); </script>";
                        require_once(VIEWS_PATH."index.php");
                    }
                } else if($loggedUser->getProfile() == 'Admin') {
                     $_SESSION['loggedUser'] = $loggedUser;
                    require_once(VIEWS_PATH."vistaAdmin.php");

                } else if($loggedUser->getProfile() == 'Company') {
                    $_SESSION['loggedUser'] = $loggedUser;
                   /// $this->ShowProfileView3($_SESSION['loggedUser']);
                  require_once(VIEWS_PATH."company-list-dueño.php");
                }else {
                    require_once(VIEWS_PATH."index.php");
                }
            } else {
                require_once(VIEWS_PATH."index.php");
            }
        }

        public function Logout () {
			session_destroy();
			require_once(VIEWS_PATH."index.php");
        }


        /***
         *  AGREGA EL USUARIO
         */

        public function Add($careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $button) {
            $student = new Student();
            $student->setCareerId($careerId);
            $student->setFirstName($firstName);
            $student->setLastName($lastName);
            $student->setDni($dni);
            $student->setFileNumber($fileNumber);
            $student->setGender($gender);
            $student->setBirthDate($birthDate);
            $student->setEmail($email);
            $student->setPhoneNumber($phoneNumber);
            $student->setActive('active');

            $this->studentDAO->AddPDO($student);
            $this->ShowAddView();
        }


    }
?>