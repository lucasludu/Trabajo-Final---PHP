<?php namespace Controllers;

    class HomeController {
        public function Index($message = "") {
            require_once(VIEWS_PATH."index.php");
        }

        public function IndexAdmin($message = "") {
            require_once(VIEWS_PATH."vistaAdmin.php");
        }

        public function IndexCompany($message = "") {
            require_once(VIEWS_PATH."vistaCompany.php");
        }

        public function IndexStudent($message = "") {
            require_once(VIEWS_PATH."vistaStudent.php");
        }
        
        public function IndexStudentAdmin($message = "") {
            require_once(VIEWS_PATH."vistaStudentAdmin.php");
        }

        public function IndexUserAdmin($message = "") {
            require_once(VIEWS_PATH."vistaUserAdmin.php");
        }

        public function IndexCompanyAdmin($message = "") {
            require_once(VIEWS_PATH."company-list-dueño.php");
        }

        public function Logout() {
            session_destroy();
            $this->Index();
        }

        public function Logout2() {
            session_destroy();
            $this->IndexAdmin();
        }

        public function Logout3() {
            session_destroy();
            $this->IndexCompany();
        }

        public function Logout4() {
            session_destroy();
            $this->IndexStudent();
        }

        public function Logout5() {
            session_destroy();
            $this->IndexStudentAdmin();
        }

        public function Logout6() {
            session_destroy();
            $this->IndexUserAdmin();
        }

        public function Logout7() {
            session_destroy();
            $this->IndexCompanyAdmin();
        }
    }
?>