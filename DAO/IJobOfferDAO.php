<?php namespace DAO;

    use Models\JobOffer as JobOffer;

    interface IJobOfferDAO {

        function GetAll();
        function GetAllPDO();
        function GetJobOfferStudent($careerId);
        
    }

?>