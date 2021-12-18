<?php namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobDAO as JobDAO;
    use DAO\StudentDAO as StudentDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\UserDAO as UserDAO;
    use DAO\CareerDAO as CareerDAO;

    use Models\Job as Job;
    use Models\JobOffer as JobOffer;
    use Models\Company as Company;
    use Models\Career as Career;
    use Models\User as User;

    class JobOfferController {
        private $JobOfferDAO;
        private $JobDAO;
        private $CompanyDAO;
        private $StudentDAO;
        private $careerDAO;
        private $UserDAO;

        public function __construct() {
            $this->JobOfferDAO = new JobOfferDAO();
            $this->JobDAO = new JobDAO();
            $this->CompanyDAO = new CompanyDAO();
            $this->StudentDAO = new StudentDAO ();
            $this->careerDAO = new CareerDAO ();
        }

        public function ShowAddView() {
            $jobList = $this->JobDAO->GetAll();
            if($jobList == null){
                $jobList = $this->JobDAO->getAllApi();
            }
            $careerList = $this->careerDAO->GetAllPDO();
            $companyList = $this->CompanyDAO->GetAll(); // como iria el company?

            require_once(VIEWS_PATH."add-jobOffer.php");
        }

        
        public function ShowAddView2() {
            $jobList = $this->JobDAO->GetAll();
            if($jobList == null){
                $jobList = $this->JobDAO->getAllApi();
            }
            $careerList = $this->careerDAO->GetAllPDO();
            $companyList = $this->CompanyDAO->GetAll(); // como iria el company?

            require_once(VIEWS_PATH."add-jobOffer2.php");
        }
        
        public function ShowProfileView() {
            $jobOfferList = $this->JobOfferDAO->GetAll();
            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function ShowProfileView2() {
            $jobOfferList = $this->JobOfferDAO->GetAll();
            require_once(VIEWS_PATH."jobOffer-list-Dueño.php");
        }

        
/*
       public function ShowListView() {
            $student = $this->StudentDAO->GetApiByEmail($_SESSION['loggedUser']->getEmail());
            $jobOfferList = $this->JobOfferDAO->GetJobOfferStudent($student->getCareerId());
            require_once(VIEWS_PATH."jobOffer-student-list.php");
        }*/


       public function ShowListView() {
            $jobOfferList = $this->JobOfferDAO->GetAllStudent();
            require_once(VIEWS_PATH."jobOffer-student-list.php");
        }

        public function ShowListViewAdmin() {
            $jobOfferList = $this->JobOfferDAO->GetAll();
            require_once(VIEWS_PATH."jobOffer-list.php");
        }


        public function ShowListStudent() {
            //$student = $this->UserDAO->GetApiByEmail($_SESSION['loggedStudent']->getEmail());
            $student = $this->UserDAO->GetApiByEmail($_SESSION['loggedUser']->getEmail());
            $jobOfferList = $this->JobOfferDAO->GetJobOfferStudent($student->getCareerId());
            require_once(VIEWS_PATH."jobOffer-listStudent.php");
        }

        
        public function ShowListOffersByJobPosition($job)
        {
            $jobOfferList = $this->jobOfferDAO->GetOffersByJobPosition($job);
            if($jobOfferList){
                require_once(VIEWS_PATH."jobOffer-listFilter.php");
            } else {
                echo "<script> if(alert('No se encontraron ofertas laborales del puesto ingresado')); </script>";
                $this->ShowListView();
            }
        }

        public function ShowListOffersByCareer($career)
        {
            $jobOfferList = $this->jobOfferDAO->GetOffersByCareer($career);
            if($jobOfferList){
                require_once(VIEWS_PATH."jobOffer-listFilter.php");
            } else {
                echo "<script> if(alert('No se encontraron ofertas laborales de la carrera ingresada')); </script>";
                $this->ShowListView();
            }
        }


        public function ShowFileExcel($name) {
            require_once(VIEWS_PATH."file-showExcel.php");
        }
 
        public function Add($companyName, $publishedDate, $finishDate, $task, $skills, $salary, $jobPositionId,$careerId, $button) {
           
            
            $jobOffer = new JobOffer();
            $company = new Company();
            $job = new Job();
            $career = new Career();
                        
            $company = $this->CompanyDAO->GetByName($companyName);
            
            $job =  $this->JobDAO->GetById12($jobPositionId) ;
            $career = $this->careerDAO->GetById($careerId) ;
            
            $jobOffer->setPublishedDate($publishedDate);
            $jobOffer->setFinishDate($finishDate);
            $jobOffer->setTask($task);
            $jobOffer->setSkills($skills);
            $jobOffer->setSalary($salary);
            $jobOffer->setJobs($job[0]);
            $jobOffer->setCompany($company[0]);
         ///   $jobOffer->setCareer($career[0]);

            $this->JobOfferDAO->AddPDO($jobOffer);
            $this->ShowAddView();
        }

        public function ShowModifyView($jobOfferId) {
            $arrayJobOffer = $this->JobOfferDAO->GetAll();
            $loggedJobOffer = NULL;
            foreach ($arrayJobOffer as $key => $value) {
                if($jobOfferId == $value->getJobOfferId()) {
                    $loggedJobOffer = $value;
                }
            }
            if($loggedJobOffer != NULL) {
                $_SESSION['loggedJobOffer'] = $loggedJobOffer;
                require_once(VIEWS_PATH."modify-jobOffer.php");
            }
        }

        public function ModifyJobOffer($jobOfferId, $title, $publishedDate, $finishDate, $task, $skills, $salary, $jobPositionId,$companyId, $button) {
            $this->JobOfferDAO->UpdateById($jobOfferId, $title, $publishedDate, $finishDate, $task, $skills, $salary, $jobPositionId,$companyId);
            $this->ShowProfileView();
        }

        /*public function DeleteJobOffer($jobOfferId) {
            $this->JobOfferDAO->DeleteById($jobOfferId);
    		$this->ShowProfileView();
        }
*/
        public function DeleteJobOffer($jobOfferId) {
            $jobOfferRemove = $this->JobOfferDAO->DeleteById($jobOfferId);
            
            if($jobOfferRemove == null ){
                echo "<script> if(alert('No se puede eliminar la oferta de trabaj, hay un alumno postulado')); </script>";
            }
            $this->ShowProfileView();
        }

    }
?>
