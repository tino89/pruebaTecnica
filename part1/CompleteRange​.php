<?php

class CompleteRange
{

    /*
     * @param array array
     * @return  array orden
     *
     * Se completa los numeros que faltan en la coleccion en el rango dado
     * entrada : [1, 2, 4, 5] salida : [1, 2, 3​, 4, 5]
     * entrada : [2, 4, 9] salida : [2, 3​,​ 4, 5, 6, 7, 8​, 9]
     * entrada : [55, 58, 60] salida : [55, 56, 57, ​58, 59,​ 60]
     *
     * */
    public function build($array)
    {
        asort($array);
        $orden = [];
        for ($i = $array[0]; $i <= $array[count($array) - 1]; $i++) {
            $orden[] = $i;
        }
        return $orden;
    }
}


$a = new CompleteRange();
$ans = $a->build([2, 4, 9]);
echo "[ ".implode(", ", $ans)." ]";
echo "\n";