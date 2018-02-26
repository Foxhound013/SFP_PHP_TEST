<?php
  namespace Sfp;

  class Even {

    var $filePath;

    //Create a function to open the file, read it into an array, then hand that array off to a function to count evens.
    public function execute($filePath) {
      $rawData = fopen($filePath, "r");

      $data = []; //An empty array to hold the dataset

      while(!feof($rawData)) {
        //Since fgetcsv returns an array, temporarily hold the one element array and parse the single element into the permanent $data array
        $tempData = fgetcsv($rawData); //temporarily hold the csv row data
        array_push($data, $tempData[0]); //insert into the data array
      }

      fclose($rawData); //Close out the data file
      $numberOfEvens = $this->countEvens($data);
      return $numberOfEvens;
    }

    //Accepts an array of data and counts the number of evens in that array
    function countEvens($data) {
      $numberOfEvens = 0; //Initialize a counter to count the number of evens in the dataset
      for ($i=0; $i < count($data); $i++) {
        if ($data[$i] % 2 == 0) {
          $numberOfEvens++;
        }
      }
      return $numberOfEvens;
    }

  }

  //instantiate the class
  $filePath = "..\\assets\\numbers.csv";
  $test = new Even();
  $test->execute($filePath);

 ?>
 <!--
 sfp:even
 Scope: Create a class containing a method that will return the number of even values provided in the defined dataset.
 Filename src/Even.php
 namespace Sfp
 classname Even
 testable method execute
 Use assets/numbers.csv
 return type Integer the number of even values

 MUST CONTAIN A PUBLIC METHOD
 -->
