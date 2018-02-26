<?php
namespace Sfp;

class Fibonacci {
    var $filePath;

    //Open csv and get the fibonacci data
    public function execute($filePath) {
      $rawData = fopen($filePath, "r");

      $data = []; //An empty array to hold the dataset

      while(!feof($rawData)) {
        //Since fgetcsv returns an array, temporarily hold the one element array and parse the single element into the permanent $data array
        $tempData = fgetcsv($rawData); //temporarily hold the csv row data
        array_push($data, $tempData[0]); //insert into the data array
      }

      fclose($rawData); //Close out the data file
      $fibonacciArray = $this->fibonacciSequence($data);
      return $fibonacciArray;
    }

    //Accepts the fibonacci data from the csv and begins the fibonacci algorithm, the function will check at each step whether or not all fibonacci values from the csv have been included in the sequence, if not it keeps going.
    //{\displaystyle F_{n}=F_{n-1}+F_{n-2},}
    function fibonacciSequence($data) {
      $dataSatisfied = false; //A variable to tell whether or not the fibonacci Array includes the data from the csv
      //initialize a counter to check if all csv values have been included
      $csvCounter = 0;
      $fibonacciArray = [0, 1]; //initialize the fibonacci array
      //initialize counters to track two positions in the fibonacci array
      $i = 0;
      $j = 1;
      while (count($fibonacciArray) < 10 && $dataSatisfied === false) {
        $fibonacciArray[] = $fibonacciArray[$j] + $fibonacciArray[$i];
        //check if all data from the csv is included yet
        for ($k=0; $k < count($data); $k++) {
          //compare the csv data with the fibonacci array
          if ($data[$k] === $fibonacciArray[$i]) {
            $csvCounter++;
            if ($csvCounter === count($data)) {
              $dataSatisfied = true;
            }
          }
        }
        $i++;
        $j++;
      }
      return $fibonacciArray;
    }
  }

  //instantiate the class
  $filePath = "..\\assets\\fibonacci.csv";
  $test = new Fibonacci();
  $test->execute($filePath);







 ?>
