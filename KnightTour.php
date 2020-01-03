<?php

class KnightTour {

    CONST X_STEPS = [2, 1, -1, -2, -2, -1, 1, 2];
    CONST Y_STEPS = [1, 2, 2, 1, -1, -2, -2, -1];

    private $chess_table_length = 8;
    private $final_solution = [];

    public function generateTable() {

        $table = array();

        for ($x = 0; $x < $this->chess_table_length; $x++) {

            for ($y = 0; $y < $this->chess_table_length; $y++) {
                $table[$x][$y] = -1;
            }

        }

        return $table;

    }

    private function printTable($table) {

        for ($x = 0; $x < $this->chess_table_length; $x++) {

            for ($y = 0; $y < $this->chess_table_length; $y++) {
                echo $table[$x][$y] . " ";
            }

            echo PHP_EOL;

        }

    }

    private function isValidMove($x, $y, $table) {

        if ($x >= 0 && $x < $this->chess_table_length && $y >= 0 && $y < $this->chess_table_length && $table[$x][$y] == -1) {
            return true;
        }

        return false;

    }

    private function findSolution($current_coordinates = [], $step = 1, $solution = []) {

        if ($step == pow($this->chess_table_length, 2)) {
            $this->final_solution = $solution;
            return true;
        }

        for ($k = 0; $k < 8; $k++) {

            $next_x = $current_coordinates[0] + self::X_STEPS[$k];
            $next_y = $current_coordinates[1] + self::Y_STEPS[$k];

            if ($this->isValidMove($next_x, $next_y, $solution)) {

                $solution[$next_x][$next_y] = $step;

                if ($this->findSolution([$next_x, $next_y], $step + 1, $solution)) {
                    return true;
                } else {
                    $solution[$next_x][$next_y] = -1;
                }

            }

        }

        return false;

    }

    public function findTours() {

        $table = $this->generateTable();
        $table[0][0] = 0;

        if ($this->findSolution([0, 0], 1, $table)) {
            $this->printTable($this->final_solution);
        } else {
            exit("Unable to find a solution.");
        }

    }

}

$knight_tour = new KnightTour();
$knight_tour->findTours();
