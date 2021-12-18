<?php namespace Controllers;

    use DAO\JobDAO as JobDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\Job as Job;
    use Models\Career as Career;

    class JobController {
        private $jobDAO;
        private $careerDAO;

        public function __construct() {
            $this->jobDAO = new JobDAO();
            $this->careerDAO = new CareerDAO();
        }
        
        public function ShowAddView() {
            $careerList = $this->careerDAO->GetAll();
            require_once(VIEWS_PATH."add-job.php");
        }


        public function ShowProfileViewAdmin() {
            $jobListPdo = $this->jobDAO->GetAllPDO();
            require_once(VIEWS_PATH."job-list-admin.php");
        }

        public function ShowProfileView() {
            $jobListApi = $this->jobDAO->GetAll();
            $jobListPdo = $this->jobDAO->GetAllPDO();
            require_once(VIEWS_PATH."job-list.php");
        }

        public function ShowProfileView2() {
            require_once(VIEWS_PATH."students-list.php");
        }

        
        public function SearchFilter($description) {
            $jobListPdo = $this->jobDAO->GetAllPDO();
            $jobFilter = array();
            foreach ($jobListPdo as $job) {
                if($description !== ""){
                    if (strpos($job->getDescription(), $description) !== false) {
                        array_push($jobFilter, $job);
                    }
                    $jobListPdo = $jobFilter;
                }
            }
            if(empty($jobListPdo)) {
                echo("
                    <script>
                        alert('No hay empresas con el nombre ingresado');
                    </script>
                ");
            }
            require_once(VIEWS_PATH."job-list-admin.php");
        }

        public function LogoutMenuJob () {
			session_destroy();
			require_once(VIEWS_PATH."vistaJobAdmin.php");
        }

        public function Add($description, $careerId, $button) {
            $job = new Job();
            $career = new Career();
            $career = $this->careerDAO->GetById($careerId);
            $job->setDescription($description);
            $job->getCareer()->setCareerId($careerId);
            $this->jobDAO->AddPDO($job);
            $this->ShowAddView();
        }

        public function ShowModifyView($jobPositionId) {
            $arrayJob = $this->jobDAO->GetAllPDO();
            $loggedJob = NULL;
            foreach ($arrayJob as $key => $value) {
                if($jobPositionId == $value->getJobPositionId()) {
                    $loggedJob = $value;
                }
            }
            if($loggedJob != NULL) {
                $_SESSION['loggedJob'] = $loggedJob;
                require_once(VIEWS_PATH."modify-job.php");
            }
        }


        public function ModifyJob($jobPositionId, $description, $careerId, $button) {
            $this->jobDAO->UpdateById($jobPositionId, $description, $careerId);
            $this->ShowProfileViewAdmin();
        }

        public function DeleteJob($jobPositionId) {
            $this->jobDAO->DeleteById($jobPositionId);
    		$this->ShowProfileViewAdmin();
        }

    }
?>