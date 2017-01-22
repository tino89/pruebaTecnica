<?php

class Position
{

    private $index;
    public  $character;


    function position($index, $character)
    {
        $this->character = $character;
        $this->index = $index;
    }

    public function getIndex(){
        return $this->index;
    }

    public function setIndex($index)
    {
        $this->index = $index;
    }

    public function getCharacter(){
        return $this->character;
    }

    public function setCharacter($character)
    {
        $this->character = $character;
    }
}


class ClearPar
{

    /*
     * @param String str
     * @return String str
     * elimina todos los paréntesis que no tienen pareja
     * entrada : "()())()" salida : "()()()"
     * entrada : "()(()" salida : "()()"
     * entrada : ")(" salida : ""
     * entrada : "((()" salida : "()"
     *
     * */

    public function build($str)
    {
        $cont = 0;
        $queue = [];
        $position =  new Position(0, $str[$cont]);
        $queue[] = $position;
        for ($i = 1; $i < strlen($str); $i++) {
            $cont++;
            $position =  new Position($i, $str[$i]);
            $queue[$cont] = $position;
            $elementsQueue = count($queue);
            if ($elementsQueue > 1 && $queue[$elementsQueue - 1]->getCharacter() == ")" && $queue[$elementsQueue - 2]->getCharacter() == "(") {
                unset($queue[$elementsQueue - 1]);
                unset($queue[$elementsQueue - 2]);
                $cont = $cont - 2;
            }
        }
        foreach ($queue as $row){
            $str[$row->getIndex()] = "?";
        }
        return str_replace("?","",$str);
    }

}

$a = new ClearPar();
$ans = $a->build(")(");
echo $ans;
echo "\n";