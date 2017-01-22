<?php

class ChangeString
{


    private $starta = 65;
    private $finalz = 90;
    private $startA = 97;
    private $finalZ = 122;

    /*
     * @param str-String
     * @return  str-String
     * se incrementa en uno cada caracter del alfabeto [a-zA-Z]
     * ejemplos
     * entrada : "123 abcd*3" salida : "123 bcde*​ 3"
     * entrada : "**Casa 52" salida : "**Dbtb​ 52"
     * entrada : "**Casa 52Z" salida : "**Dbtb​ 52A​"
     *
     * */

    public function build($str)
    {
        $ans = "";
        for ($i = 0; $i < strlen($str); $i++) {
            $char = ord($str[$i]);
            if (($char >= $this->starta && $char <= $this->finalz) || ($char >= $this->startA && $char <= $this->finalZ)) {
                $char++;
                if ($char == $this->finalz + 1)
                    $char = $this->starta;
                elseif ($char == $this->finalZ + 1)
                    $char = $this->startA;
            }
            $ans = $ans . chr($char);
        }
        return $ans;
    }
}

$a = new ChangeString();
$ans = $a->build("ABYZ");
echo $ans;
echo "\n";