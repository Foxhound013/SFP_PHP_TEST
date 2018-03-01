<?php
  namespace Sfp;


  class Rotate {

    var $shiftAmount;
    var $jsonArray;
    var $data;

    public function __construct($shiftAmount) {
      $this->shiftAmount = $shiftAmount;
      $this->jsonArray = $this->execute();
    }

    public function execute() {
      $filePath = "..\\assets\\rotate.json";
      $jsonArray = $this->rotateData($filePath);
      return $jsonArray;
    }

    public function rotateData($filePath) {
      //Load in the json file, and decode into array
      $data = file_get_contents($filePath);
      $data = json_decode($data);
      //shift the array to the left
      while ($this->shiftAmount > 0) {
        $tempLast = $data[count($data)-1]; //temporarily hold the last value in the array
        array_unshift($data, $tempLast); //Prepend the last element
        array_pop($data); //delete last element of array
        $this->shiftAmount--;
      }
      return $data;
    }
  }

  class Extend extends Rotate {

    //enable the extended class to access the Rotate values
    public function __construct($shiftAmount) {
      parent::__construct($shiftAmount);
      return $this->extend();
    }

    //Return the last value of the array in Rotate.
    public function extend() {
      $data = $this->jsonArray;
      return $data[count($data)-1];
    }
  }

  $shiftAmount = 1;
  $test = new Rotate($shiftAmount);
  $test2 = new Extend($shiftAmount);

 ?>
