<?php
    namespace Controllers;

    use DAO\CareerDAO as CareerDAO;
    use DAO\StudentDAO as StudentDAO;
    use Models\Career as Career;
    use Models\Student as Student;

    class CareerController {
        private $careerDAO;
        private $studentDAO;

        public function __construct() {
            $this->careerDAO = new CareerDAO();
            $this->studentDAO = new StudentDAO();
        }
        
        public function ShowAddView() {
            require_once(VIEWS_PATH."add-career.php");
        }
        
        public function ShowProfileView() {
            $careerListApi = $this->careerDAO->GetAll();
            $careerListpdo = $this->careerDAO->GetAllPDO();
            require_once(VIEWS_PATH."career-list.php");
        }

        public function ShowProfileCareerView() {
            require_once(VIEWS_PATH."vistaCareer.php");
        }


        public function ShowPersonalCareer($careerId) {
            $career = $this->careerDAO->getCareerById($careerId);
            $loggedCareer = NULL;
            if($career) {
                $loggedCareer = $career;
            }
            if($loggedCareer != NULL) {
                $_SESSION['loggedCareer'] = $loggedCareer;
                require_once(VIEWS_PATH . "student-career.php");
            }
        }

        public function Add($description, $active, $button) {
            $career = new Career();
            $career->setDescription($description);
            $career->setActive($active);
            $this->careerDAO->AddPDO($career);
            $this->ShowAddView();
        }

        public function DeleteCareer($careerId) {
            $this->careerDAO->DeleteById($careerId);
    		$this->ShowProfileView();
        }

        public function ShowModifyView($careerId) {
            $arrayCareer = $this->careerDAO->GetAllPDO();
            $loggedCareer = NULL;
            foreach ($arrayCareer as $key => $value) {
                if($careerId == $value->getCareerId()) {
                    $loggedCareer = $value;
                }
            }
            if($loggedCareer != NULL) {
                $_SESSION['loggedCareer'] = $loggedCareer;
                require_once(VIEWS_PATH."modify-career.php");
            }
        }

        public function ModifyCareer($careerId, $description, $active, $button) {
            $this->careerDAO->UpdateById($careerId, $description, $active);
            $this->ShowProfileView();
        }


    }
?>