<?php
  namespace Sfp;


  class Rotate {

    var $shiftAmount;

    public function __construct($shiftAmount) {
      $this->shiftAmount = $shiftAmount;
    }

    public function execute() {
      $filePath = "..\\assets\\rotate.json";
      return $this->rotateData($filePath);
    }

    function rotateData($filePath) {
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




  //$shiftAmount = 1;
  $test = new Rotate($shiftAmount);
  $test->execute();

 ?>
