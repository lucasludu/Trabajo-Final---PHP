<?php namespace DAO;

    use Models\User as User;

    interface IUserDAO {

        function Add(User $user);
        function GetAllPDO();
        function DeleteByEmail($email);
        function UpdateByEmail($email, $password);
        function GetAllStudents();
        function GetAllAdmin();
    }

?>