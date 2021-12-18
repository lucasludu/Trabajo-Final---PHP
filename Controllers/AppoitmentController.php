<?php
    namespace Controllers;
    use \Exception as Exception;
    use DAO\AppoitmentDAO as AppoitmentDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\Appoitment as Appoitment;
    use DAO\UserDAO as UserDAO;
    use DAO\StudentDAO as StudentDAO;
    use Models\User as User;
    use Models\Company as Company;
    use Models\Student as Student;
    use Models\JobOffer as JobOffer;
    use DAO\JobOfferDAO as JobOfferDAO;



    class AppoitmentController {
        private $appoitmentDAO;
        private $companyDAO;
        private $userDAO;
        private $studentDAO;
        private $jobOfferDAO;


        public function __construct() {
            $this->appoitmentDAO = new AppoitmentDAO();
            $this->companyDAO = new CompanyDAO();
            $this->userDAO = new UserDAO;
            $this->studentDAO = new studentDAO;
            $this->jobOfferDAO = new JobOfferDAO();


        }

        public function ShowProfileAppoitmentView() {
            require_once(VIEWS_PATH."vistaAppoitment.php");
        }

        public function showAddView($jobOfferId, $companyName, $job)
        {
                require_once(VIEWS_PATH."add-appoitment.php");
        ///    $appoitmentList = $this->appoitmentDAO->GetByIdStudent($_SESSION['loggedUser'][0]->getUserId());
           /// var_dump($appoitmentList);

           /// if($appoitmentList){
         ///       echo "<script> if(alert('Se encuentra postulado en una oferta activa')); </script>";
       ///         require_once(VIEWS_PATH."appoitment.php");
          ///  } else {
            }
       
        public function showListView() {
            $appoitmentList = $this->appoitmentDAO->GetAll();
            require_once(VIEWS_PATH."appoitment-list.php");
        }

        public function showListViewAdmin() {
            $appoitmentList = $this->appoitmentDAO->GetAll();
            require_once(VIEWS_PATH."appoitment-list-admin.php");
        }

        public function ShowFile($name)
        {
            require_once(VIEWS_PATH."file-show.php");
        }

        public function ShowDownload($name)
        {
            require_once(VIEWS_PATH."file-download.php");
        }

        public function ShowAppoitmentView()
        {
           
                require_once(VIEWS_PATH."vistaStudent.php");
        }

        public function Add($id,$message, $cv)
        { 
   
       $file = $this->Upload($cv);

       $appoitment = new Appoitment();
       $student = new Student();
       $jobOffer = new JobOffer();
       $student = $this->studentDAO->GetApiByEmail($_SESSION['loggedUser']->getEmail());
       
       $jobOffer = $this->jobOfferDAO->searchJobOfferById($id) ;


       $appoitment->setJobOffer($jobOffer);
       $appoitment->setStudent($student);         
       $appoitment->setMessage($message);
  
         $appoitment->setCv($file);


     $this->appoitmentDAO->AddPDO($appoitment);
           $this->ShowAppoitmentView();
        }
        
        private function Upload($file)
        {
            try
            {
                $fileName = $file["name"];
                $tempFileName = $file["tmp_name"];
                $type = $file["type"];
                
                $filePath = UPLOADS_PATH.basename($fileName);            

                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                $extension_correcta = ($fileType == 'doc' or $fileType == 'docx' or $fileType == 'pdf');

                if($extension_correcta !== false)
                {
                    if (move_uploaded_file($tempFileName, $filePath))
                    {
                        $message = "Archivo subido correctamente";
                        return $fileName;
                    }
                    else
                        $message = "Ocurrió un error al intentar subir el archivo";
                }
                else   
                    $message = "El archivo no corresponde a una extension valida";
            }
            catch(Exception $ex)
            {
                echo "<script> if(alert('Ocurrió un error al intentar subir el archivo')); </script>";
            }
        }    

        public function DeleteAppoitments($careerId) {
            $this->appoitmentDAO->DeleteById($careerId);
    		$this->showListViewAdmin();
        }

        public function ShowModifyView($careerId) {
            $arrayAppoitment = $this->appoitmentDAO->GetAll();
            $loggedAppoitment = NULL;
            foreach ($arrayAppoitment as $key => $value) {
                if($careerId == $value->getCareerId()) {
                    $loggedAppoitment = $value;
                }
            }
            if($loggedAppoitment != NULL) {
                $_SESSION['loggedAppoitment'] = $loggedAppoitment;
                require_once(VIEWS_PATH."modify-appoitment.php");
            }
        }

        public function ModifyAppoitments($jobOfferId, $studentId, $message, $cv, $button) {
            $this->appoitmentDAO->UpdateById($jobOfferId, $studentId, $message, $cv);
            $this->showListViewAdmin();
        }
        
    }
    
?>