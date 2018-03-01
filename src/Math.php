<?php
  namespace Sfp;

  class Math {

    var $filePath;

    //Open csv and get the data
    public function execute($filePath) {
      $rawData = fopen($filePath, "r");

      $data = []; //An empty array to hold the dataset

      while(!feof($rawData)) {
        array_push($data, fgetcsv($rawData)); //insert into the data array
      }
      fclose($rawData); //Close out the data file
      /*
      echo '<pre>';
      var_dump($data);
      echo '</pre>';
      */
      return $this->average($data);
    }
    //checks for accept field being true, if it is, then the value will be slated to be average with all other values with accept field of true
    function average($data) {
      $trueCount = 0; //track number of true values
      $trueValues = 0; //track the sum of the true values
      //start at one to void the header
      for ($i=1; $i < count($data); $i++) {
        if ($data[$i][2] === "true") {
          //Add the true values and switch each value to a double
          $trueValues += doubleval($data[$i][1]);
          $trueCount++; //add to the number of true values
        }
      }
      $myAverage = $trueValues/$trueCount;
      return $myAverage;
    }
  }

  //instantiate the class
  $filePath = "..\\assets\\tabular.csv";
  $test = new Math();
  $test->execute($filePath);


 ?>
