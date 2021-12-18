<?php namespace DAO;

    use Models\Student as Student;

    interface IStudentDAO {

        function GetAll();
        function GetAllApi ();
        function GetApiByEmail ($email);
    }
?>