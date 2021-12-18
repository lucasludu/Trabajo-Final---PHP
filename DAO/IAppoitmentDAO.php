<?php namespace DAO;

    use Models\Appoitment as Appoitment;

    interface IAppoitmentDAO {

        function AddPDO(Appoitment $appoitment);
        function GetAll();    
        
    }
    
?>