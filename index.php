<style>
    table{
        background : url(http://d25379/sudoku/grille.jpg);
        margin : 10px;
    }
    td{
        height : 57px ;
        width : 55px ;
        text-align: center;
        font-size: 20px;
    }
</style>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*return un array*/
function initSudoku($data){
    
     $array = str_split($data);
    
    return $array;
}

/*rien return, mais affiche a lecran*/
function printSudoku($array){
    echo '<table><tr>';
    foreach($array as $k => $v){
        echo '<td>'.$v.'</td>';
        if(($k + 1) % 9 == 0){
            echo '</tr><tr>';
        }
    }
    echo '</tr></table>';
}

/* checkcolumn, checkLine, checkSquare*/

function checkLine($array, $pos){    
    $firstPos = $pos - ($pos % 9);
    for($i = $firstPos ; $i < ($firstPos + 9) ; $i++){
        if($array[$pos] == $array[$i] && $i != $pos)
            return false;
    }
    return true;
}

function checkColumn($array, $pos){
    $firstPos = $pos - (floor($pos / 9)*9);
    for($i = $firstPos ; $i < 81 ; $i += 9){
        if($array[$pos] == $array[$i] && $i != $pos)
            return false;
    }
    return true;
}

function checkSquare($array, $pos){
    $columnSquare = ($pos % 9) % 3;
    $lineSquare = (floor($pos / 9)) % 3;
    $firstPos = $pos - ($columnSquare + ($lineSquare * 9));
    for($i = $firstPos ; $i <= ($firstPos + 20) ; $i++){
        if($array[$pos] == $array[$i] && $i != $pos)
            return false;
        if(($i + 1) % 3 == 0)
            $i += 6;
    }     
    return true;
}

function check($array, $pos){
    return checkLine($array, $pos) && checkColumn($array, $pos) && checkSquare($array, $pos);
}

$nbr = 0;
//$array = initSudoku('8          36      7  9 2   5   7       457     1   3   1    68  85   1  9    4  ');
  $array = initSudoku('53  7    6  195    98    6 8   6   34  8 3  17   2   6 6    28    419  5    8  79');
printSudoku($array);


function recursion(&$array, $pos, &$nbr){
    if($pos > 80){
        printSudoku ($array); echo $nbr;
        return 1;
    }
    if($array[$pos] != ' '){
        return recursion($array, $pos+1, $nbr);
    }
    for($i = 1 ; $i <= 9 ; $i++){
        $nbr++;
        $array[$pos] = $i;
        if(check($array, $pos)){
            if(recursion($array, $pos+1, $nbr) == 1){
                return 1;
            }
        }
    }
    $array[$pos] = ' ';
    return 0;
}

recursion($array, 0, $nbr);