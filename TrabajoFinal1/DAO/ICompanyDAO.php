<?php namespace DAO;
    use Models\Company as Company;

    interface ICompanyDAO {
        
        public function GetAll();
        function remove($cuit);

    }
    
?>