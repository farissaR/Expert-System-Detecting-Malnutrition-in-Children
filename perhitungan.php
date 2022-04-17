<?php
include_once 'setbhs.php';

function cekrule($cf1,$cf2){
    if ($cf1 >=0 && $cf2 >=0){
      // echo "rule 1";
      return $combine = $cf1 + $cf2*(1-$cf1);
    }
    else if ($cf1 <0 && $cf2 >0 || $cf1 >0 && $cf2 <0) {
      // echo "rule 2";
      return $combine = ($cf1+$cf2)/(1 -min(abs($cf1),abs($cf2)));
    }
    else if ($cf1<0 && $cf2 <0){
      // echo "rule 3";
    return $combine =  $cf1 + $cf2*(1+$cf1);}
  }
  function pembulatan($a){ //tinggi badan
  $round_a =0;
  $b = 0.5;
  $exp_a = array_pad(explode(".",$a),2,null);
  $hasil= $exp_a[1];
  //echo $hasil;

  if ($hasil<5){
    return $round_a = round($a,0,PHP_ROUND_HALF_UP);
  }elseif ($hasil==5) {
    return $round_a = $a;
  }
  elseif ($hasil!=5 && $hasil>5) {
    $round_aa = round($a,0,PHP_ROUND_HALF_UP);
    //echo "$round_aa";
    return $round_a = $round_aa - $b;
    }
  }
  function index_pb($sex, $weight, $height, $age){
    include "db.php";
    $Z_score = 0;
    if ($sex=="female"){
      $query= "SELECT * FROM antro_female_pbu WHERE age = '$age'";
    }else{
      $query= "SELECT * FROM antro_male_pbu WHERE age = $age";
    }
    $tabel_antro = mysqli_query($con, $query);

    if ($tabel_antro){
      while($row = mysqli_fetch_array($tabel_antro)) {
            $median = $row['median'];
            $plus_1 = $row['plus_1'];
            $min_1  = $row['min_1'];
            // echo "TABEL BENAR"."</br>";
            // echo "median = ".$median."</br>";
            // echo "+1 = ".$plus_1."</br>";
            // echo "-1 = ".$min_1."</br>";
          }
      }else {
      // echo "TABEL SALAH";
      }
      if ($height > $median){
        return $Z_score = ($height - $median) / ($plus_1 - $median);
        // echo "Z Score PB/U = ".$Z_score."</br>";
      }else {
        return $Z_score = ($height - $median) / ($median - $min_1);
        // echo "Z Score PB/U = ".$Z_score."</br>";
      }
    }

    $sex = "male";
    $height = 76.7;
    $weight = 8.5;
    $age = 18;
    // Test fungsi Z Score PB/U
    // $result_PB = index_pb($sex, $weight, $height, $age);


    function index_bb($sex, $weight, $height, $age){
      $Z_score = 0;
      $tb = pembulatan($height);
      include "db.php";

      if ($sex=="male") {
        if($age<24){
          $query = "SELECT * FROM antro_male_bbpbun24bln WHERE length = '$tb'";
        }
        else{
          $query = "SELECT * from antro_male_bbpbup24bln WHERE length = '$tb'";        }
      }
      elseif ($sex == "female"){
      if ($age<24) {
        $query = "SELECT * from antro_female_bbpbun24bln WHERE length = '$tb'";
        // echo "tabel cewek under 24 bulan </br>";
      }else{
        $query = "SELECT * from antro_female_bbpbup24bln WHERE length = '$tb'";
        // echo "tabel cewek upper 24 bulan </br>";
      }
    }
    $tabel_antro = mysqli_query($con, $query);
      if ($tabel_antro){
        // echo "i'm hereee </br>";
        while($row = mysqli_fetch_array($tabel_antro)) {
              $median = $row['median'];
              $plus_1 = $row['plus_1'];
              $min_1  = $row['min_1'];
              $tinggi = $row['length'];
              // echo "i'm in while"."</br>";
              // echo "median = ".$median."</br>";
              // echo "+1 = ".$plus_1."</br>";
              // echo "-1 = ".$min_1."</br>";
            }
            // echo "blabalbal";
        }else {
        // echo "TABEL SALAH";
        }
        // echo "berat badan : ".$weight."</br>";
        // echo "tinggi badan : ".$tb  ."</br>";
        // echo "median = ".$median."</br>";
        if ($weight > $median){
          return $Z_score = ($weight - $median) / ($plus_1 - $median);
          // echo "Z Score BB/PB = ".$Z_score."</br>";
        }else {
          return $Z_score = ($weight - $median) / ($median - $min_1);
          // echo "Z Score BB/PB = ".$Z_score."</br>";
        }
      }
      // $sex = "male";
      // $height = 70.50;
      // $weight = 7;
      // $age = 18;
      // $result = index_bb($sex, $weight, $height, $age);
      // echo "RESULT : ".$result;

      function hasil_akhir($sex, $weight, $height, $age){ // parameter isinya $id
        $sex; $weight; $height; $age;
        $q1; $q2; $q3; $q4; $q5; $q6; $q7;
        $Z_score_bb; $Z_score_pb;
        $w2; $w3; $w4; $w5; $w6;
        $s2; $s3; $s4; $s5; $s6; $s7;

        $bobotbb = 0;
        include 'db.php';
        // BOBOT KONDISI OBESITAS
        $bobotq1 = 0.8;
        $bobotq2 = 0.8;
        $bobotq3 = 0.8;
        $bobotq4 = 0.8;
        $bobotq5 = 0.8;
        $bobotq6 = 0.8;

        //BOBOT KONDISI WASTING
        $bobotw2 = 0.6;
        $bobotw3 = 0.4;
        $bobotw4 = 0.4;
        $bobotw5 = 0.4;
        $bobotw6 = 0.6;

        //BOBOT KONDISI Stunting
        $bobots2 = 0.4;
        $bobots3 = 0.6;
        $bobots4 = 0.6;
        $bobots5 = 0.4;
        $bobots6 = 0.4;
        $bobots7 = 0.4;

        // CHECK PERHITUNGAN ANTROPOMETRI Z-Score
        $Z_score_bb_pb = index_bb($sex, $weight, $height, $age);
        $Z_score_pb_u = index_pb($sex, $weight, $height, $age);
        // echo "Z Score BB/PB".$Z_score_bb_pb;
        // echo "Z Score PB/U".$Z_score_pb_u;
        if ($Z_score_bb_pb >= 3){ //anak obesitas
          // echo " direct ke pertanyaan gejala Obesitas ";
          return $bobotbb = 1;
        }elseif ($Z_score_bb_pb>-2) { // normal di index BB/PB

          if ($Z_score_pb_u <= -2){
            // echo " direct ke pertanyaan gejala Stunting ";
          }return $bobotbb = -1;
        }elseif ($Z_score_bb_pb < -2) {
          // echo " direct ke pertanyaan gejala wasting ";
          return $bobotbb = 1;
        }
    }
    function output_syntax($x){
    if ($x<=50.0){
      $output = $lang['no'];
    }elseif ($x<79.0) {
      $output = $lang['hampir'];
    }elseif ($x<99.0) {
      $output = $lang['kemungkinan'];
    }else{
      $output = $lang['iya'];
    }return $output;
    }
    $output = "";
											
      // $hasil = hasil_akhir($sex, $weight, $height, $age);
      // echo "bobot :".$hasil;
 ?>
