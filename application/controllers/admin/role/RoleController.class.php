<?php

class RoleController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	//$_POST['id'] et $_POST['value']

    	$userModel = new UserModel();
    	$userModel->changeUserRole($_POST['id'], $_POST['value']);

    	$result = [
    	            "msg"=>"value has been modified",
    	            "datas"=>$_POST
    	          ];


        echo json_encode($result);
        exit();

    }
}
