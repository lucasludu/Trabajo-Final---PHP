<?php namespace Controllers;

    use \DAO\Connection as Connection;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class CompanyController {
        private $companyDAO;

        public function __construct() {
            $this->companyDAO = new CompanyDAO();
        }


        public function ShowAddView() {
            require_once(VIEWS_PATH."add-company.php");
        }


        public function ShowListView() {
            $companyList = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH."company-list.php");
        }

        
        public function ShowListView3($email) {
            $arrayCompany = $this->companyDAO->GetAll();
            $loggedUser = NULL;
            foreach ($arrayCompany as $key => $value) {
                if($email == $value->getCompanyEmail()){
                    $loggedUser = $value;
                }
            }
            if($loggedUser != NULL) {
                $_SESSION['loggedUser'] = $loggedUser;
                require_once(VIEWS_PATH."company-list-dueño.php");
            } 
        }

        public function ShowListView2($companyId) {
            $arrayCompany = $this->companyDAO->GetAll();
            $loggedUser = NULL;
            foreach ($arrayCompany as $key => $value) {
                if($companyId == $value->getCompanyId()){
                    $loggedUser = $value;
                }
            }
            if($loggedUser != NULL) {
                $_SESSION['loggedUser'] = $loggedUser;
                require_once(VIEWS_PATH."company-list2.php");
            } 
        }

        public function ShowListView22($companyId) {
            $arrayCompany = $this->companyDAO->GetAll();
            $loggedUser = NULL;
            foreach ($arrayCompany as $key => $value) {
                if($companyId == $value->getCompanyId()){
                    $loggedUser = $value;
                }
            }
            if($loggedUser != NULL) {
                $_SESSION['loggedUser'] = $loggedUser;
                require_once(VIEWS_PATH."company-list2.php");
            } 
        }

        public function ShowListViewAdmin() {
            $companyListPdo = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH."company-list-admin.php");
        }

        public function ShowListViewAdmin123() {
            require_once(VIEWS_PATH."index.php");
        }


        
        public function ShowListViewMenuCompany() {
            $companyListPdo = $this->companyDAO->GetAll();
        }

        public function ShowListViewStudent() {
            $companyList = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH."student-company.php");
        }


        public function ShowModifyView($companyId) {
            $arrayCompany = $this->companyDAO->getAll();
            $loggedCompany = NULL;
            foreach ($arrayCompany as $key => $value) {
                if($companyId == $value->getCompanyId()) {
                    $loggedCompany = $value;
                }
            }
            if($loggedCompany != NULL) {
                $_SESSION['loggedCompany'] = $loggedCompany;
                require_once(VIEWS_PATH."modify-company.php");
            }
        }

        public function ShowModifyView2($email) {
            $arrayCompany = $this->companyDAO->getAll();
            $loggedCompany = NULL;
            foreach ($arrayCompany as $key => $value) {
                if($email == $value->getCompanyEmail()) {
                    $loggedCompany = $value;
                }
            }
            if($loggedCompany != NULL) {
                $_SESSION['loggedCompany'] = $loggedCompany;
                require_once(VIEWS_PATH."modify-company2.php");
            }
        }

        public function SearchFilter($name) {
            $companyListPdo = $this->companyDAO->GetAll();
            $companyFilter = array();
            foreach ($companyListPdo as $company) {
                if($name !== ""){
                    if (strpos($company->getCompanyName(), $name) !== false) {
                        array_push($companyFilter, $company);
                    }
                    $companyListPdo = $companyFilter;
                }
            }
            if(empty($companyListPdo)) {
                echo("
                    <script>
                        alert('No hay empresas con el nombre ingresado');
                    </script>
                ");
            }
            require_once(VIEWS_PATH."company-list-admin.php");
        }


        public function redirectionCompany() {
            $companyList = $this->companyDAO->GetAllPDO();
            require_once(VIEWS_PATH."vistaCompany.php");
        }

        public function Add($companyName,$cuit, $companyCity, $companyDescription, $companyEmail, $companyPhoneNumber, $button) {
            $company = new Company();
            $company->setCompanyName($companyName);
            $company->setCompanyCuit($cuit);
            $company->setCompanyCity($companyCity);
            $company->setCompanyDescription($companyDescription);
            $company->setCompanyEmail($companyEmail);
            $company->setCompanyPhoneNumber($companyPhoneNumber);

            $this->companyDAO->AddPDO($company);
            $this->ShowAddView();
        }


        public function ModifyCompany($companyId, $companyName, $cuit, $companyCity, $companyDescription, $companyEmail, $companyPhoneNumber, $button) {
            $this->companyDAO->UpdateById($companyId, $companyName, $cuit, $companyCity, $companyDescription, $companyEmail, $companyPhoneNumber);
           /// $this->ShowListViewAdmin();
           echo "<script> if(alert('Se modifico correctamente')); </script>";
            $this->ShowListViewAdmin123();

        }

        public function ModifyCompany2($companyId, $companyName, $cuit, $companyCity, $companyDescription, $companyEmail, $companyPhoneNumber, $button) {
            $this->companyDAO->UpdateById($companyId, $companyName, $cuit, $companyCity, $companyDescription, $companyEmail, $companyPhoneNumber);
            $this->ShowListViewAdmin123();
        }
        public function DeleteCompany($cuit) {
            $companyRemove = $this->companyDAO->remove($cuit);
            if($companyRemove == null ){
                echo "<script> if(alert('No se puede eliminar la empresa, primero debe eliminar la oferta de trabajo')); </script>";
            }
            $this->ShowListViewAdmin();
        }

        public function DeleteCompany1($cuit) {
            $companyRemove = $this->companyDAO->remove($cuit);
            if($companyRemove == null ){
                echo "<script> if(alert('No se puede eliminar la empresa, primero debe eliminar la oferta de trabajo')); </script>";
            }
            $this->ShowListViewMenuCompany();
        }

        public function showSendEmail(){

            require_once(VIEWS_PATH."sendEmail.php");

        }
    }
    
?>