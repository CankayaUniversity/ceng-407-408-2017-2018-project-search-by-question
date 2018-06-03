<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 02.06.2018
 * Time: 17:24
 */

class Authorize
{


    private $classes = array(
        'Location' => 1,
        'Date' => 2,
        'JobTitle' => 1,
        'ProductionArea' => 3,
        'Person' => 1,
        'Company' => 3,
        'Nationality' => 1,
        'Language' => 4,
        'Currency' => 4,
        'Temprature' => 5,
        'Action' => 6,
        'Quantity' => 4,
        'Award' => 6,
        'Color' => 5,
        'Animal' => 1,
        'Fruit' => 5
    );

    public function returnAuth($entityType){

        $credentials = [];

        if($this->classes[$entityType] == 1){
            $credentials["username"] = "102ba2fa-c742-4fa2-bbd7-19e54739053e";
            $credentials["password"] = "FeCp2MW0p4Gs";
            $credentials["modelID"] = "10:abf4b1cf-49b3-4460-96bd-da98395effd2";
            $credentials["NLUID"] = 1;
        }elseif($this->classes[$entityType] == 2){
            $credentials["username"] = "3a1c3a48-b03a-49cf-a2e7-825d91602a1f";
            $credentials["password"] = "X6kRvI4F616c";
            $credentials["modelID"] = "10:4ce55c64-2c4d-49b5-b930-517464b126f4";
            $credentials["NLUID"] = 2;
        }elseif($this->classes[$entityType] == 3){
            $credentials["username"] = "e9afd6cc-069d-4b44-9b1e-54ed6000b3bc";
            $credentials["password"] = "PXWf6iDTy5eV";
            $credentials["modelID"] = "10:128a86dd-f10f-4bcc-ac80-4bc12e456e17";
            $credentials["NLUID"] = 3;
        }elseif($this->classes[$entityType] == 4){
            $credentials["username"] = "3af80417-c54f-4f86-9d7c-1b8c4123c96c";
            $credentials["password"] = "ueYwaZUJCrlS";
            $credentials["modelID"] = "10:7786a063-9e93-449a-ac80-ac7778db3640";
            $credentials["NLUID"] = 4;
        }elseif($this->classes[$entityType] == 5){
            $credentials["username"] = "22162b82-ba8a-4cd5-8395-f974f2adefdc";
            $credentials["password"] = "PA0STJYoYbSv";
            $credentials["modelID"] = "10:ed6af962-5c35-462c-bf38-3e1203ee7652";
            $credentials["NLUID"] = 5;
        }elseif($this->classes[$entityType] == 6){
            $credentials["username"] = "dc0fb136-c454-4f32-b4ef-766dccf33caa";
            $credentials["password"] = "UFb5oscM6ehp";
            $credentials["modelID"] = "";
            $credentials["NLUID"] = 6;
        }



        return $credentials;
    }

}