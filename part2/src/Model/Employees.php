<?php

class Employees
{

    private $employess = [];

    function employees()
    {
        try {
            $string = file_get_contents(__DIR__ . "/../../public/assets/employees.json");
            $this->employees = json_decode($string, true);
        } catch (Exception $e) {
            echo "file not Found";
        }
    }

    /*
     * @Params String email
     * @Return Array  list
     *
     * Retorna lista de empleados, si email es nulo retorna todos los empleados casos contrario
     * los empleados que tiene el mismo correo que
     *
     * */

    function listEmployees($email = null)
    {

        $list = $this->employees;
        if ($email) {
            $filterEmployees = [];
            foreach ($this->employees as $row) {
                if (strtolower(trim($row["email"])) == strtolower(trim($email))) {
                    $filterEmployees[] = $row;
                }
            }
            $list = $filterEmployees;
        }
        return $list;

    }

    /*
     * @Params String id
     * @Return Array employee
     *
     * Se busca empleado por id de empleado, en caso no encuentre redirecciona al listado de empleados
     *
     * */

    function showEmployee($id)
    {
        $employee = null;
        foreach ($this->employees as $row) {
            if (strtolower(trim($row["id"])) == strtolower(trim($id))) {
                $employee = $row;
                break;
            }
        }
        return $employee;
    }


    /*
     * @params int min
     * @params int max
     * @return array employees
     *
     * se filtra usuarios por el rango de sueldo, luego se retorn los empleados que cumplan con esta
     * condicion
     *
     */

    function EmployeesRangeSalary($min, $max)
    {

        $employees = [];
        foreach ($this->employees as $row) {
            $salary = substr(strtolower(trim($row["salary"])), 1);
            $salary = str_replace(",", "", $salary) * 1;
            if ($salary >= $min && $salary <= $max) {
                $employees[] = $row;
            }
        }
        return $employees;
    }

    /*
     * @params int min
     * @params int max
     * @return SimpleXMLElement employees
     *
     * se filtra usuarios por el rango de sueldo, luego se retorn los empleados que cumplan con esta
     * condicion
     *
     */

    function EmployeesRangeSalaryXml($min, $max)
    {
        $employees = $this->EmployeesRangeSalary($min, $max);
        $xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><employees></employees>");
        //function call to convert array to xml
        $this->array_to_xml($employees, $xml_user_info);
        return $xml_user_info;
    }


    /*
     * @params array array
     * @params SimpleXMLElement $xml_user_info
     *
     * agrega los elementos del array al objeto SimpleXMLElement;
     *
     * referncia: http://www.codexworld.com/convert-array-to-xml-in-php/
     */

    function array_to_xml($array, &$xml_user_info)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $subnode = $xml_user_info->addChild("$key");
                    $this->array_to_xml($value, $subnode);
                } else {
                    $subnode = $xml_user_info->addChild("item$key");
                    $this->array_to_xml($value, $subnode);
                }
            } else {
                $xml_user_info->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }


}