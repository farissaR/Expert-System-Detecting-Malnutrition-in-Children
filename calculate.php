<?php
require('db.php');
$id = mysqli_escape_string($con,$_GET['id']);
if (!isset($_SESSION)) {
	session_start();
}
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
include_once 'setbhs.php';

function obesitas(){
	include 'db.php';
	if (isset($_GET['id']))
	$id = $_GET['id'];

	$sql = "select * from data_anak where id='$id'";
	$query1 = mysqli_query($con, $sql);
	while ($row1 = mysqli_fetch_array($query1)) {

		$name = $row1['nama'];
		$sex = $row1['sex'];
		$weight = $row1['weight'];
		$height = $row1['height'];
		$age = $row1['age'];

		$g1User = $row1['g1'];
		$g1aUser = $row1['g1a'];
		$g1bUser = $row1['g1b'];
		$g2User = $row1['g2'];
		$g3User = $row1['g3'];
		$g4User = $row1['g4'];
		$g5User = $row1['g5'];
		$g6User = $row1['g6'];
		$g7User = $row1['z_score_bbpb'];

	include_once ('perhitungan.php');
		//bobot gejala Obesitas
			$bobotg1 = 0.8;
			$bobotg2 = 0.8;
			$bobotg3 = 0.8;
			$bobotg4 = 0.8;
			$bobotg5 = 0.8;
			$bobotg6 = 0.8;
			$bobotg7 = 0;
			//antropometri
			if ($g7User >= 3){
				$bobotg7 = 1;
			}else {
				$bobotg7 = 0;
			}
			//hasil percabangan pertanyaan G1
			$g1UserFin = ($g1User + $g1aUser + $g1bUser)/3;

			// mengalikan cf user dengan pakar
			$q1Fin = $g1UserFin*$bobotg1; // pertanyaan yang dipecah tiga
			$q2Fin = $g2User*$bobotg2;
			$q3Fin = $g3User*$bobotg3;
			$q4Fin = $g4User*$bobotg4;
			$q5Fin = $g5User*$bobotg5;
			$q6Fin = $g6User*$bobotg6;
			$q7Fin = $bobotg7; // antropometri

			//inisialisasi cf combinasi
			$com1=0;
			$com2=0;
			$com3=0;
			$com4=0;
			$com5=0;
			$com6=0;

			// Menghitung Cf kombinasi
			$Z_score_pb_u = index_pb($sex, $weight, $height, $age);
			$Z_score_bb_pb = index_bb($sex, $weight, $height, $age);


			$com1 = cekrule($q1Fin,$q2Fin);
			$com2 = cekrule($com1,$q3Fin);
			$com3 = cekrule($com2,$q4Fin);
			$com4 = cekrule($com3,$q5Fin);
			$com5 = cekrule($com4,$q6Fin);
			$com6 = cekrule($com5,$q7Fin);

			// echo "hasil kombinasi kombinasi 1 : ".$com1."
			// kombinasi 2 : ".$com2." kombinasi 3: ".$com3." kombinasi 4: ".$com4." kombinasi 5: ".$com5." kombinasi 6: ".$com6;

			$persen = $com6 * 100;
			$hasil_obese = round($persen,2);

			require ('db.php');
			$query="UPDATE `data_anak` SET `hasil_obese`='".$hasil_obese."' WHERE `id`='".$id."'";
			$result= mysqli_query($con, $query);
			if ($result){
				//echo "Update hasil Obese berhasil";
			}
		}
	}
	function wasting(){
		include 'db.php';
		if (isset($_GET['id']))
		$id = $_GET['id'];

		$sql ="select * from data_anak where id='$id'";
		$query1 = mysqli_query($con, $sql);
		while ($row1 = mysqli_fetch_array($query1)) {

			$name = $row1['nama'];
			$sex = $row1['sex'];
			$weight = $row1['weight'];
			$height = $row1['height'];
			$age = $row1['age'];

			$w2User = $row1['w2'];
			$w2aUser = $row1['w2a'];
			$w3User = $row1['w3'];
			$w4User = $row1['w4'];
			$w5User = $row1['w5'];
			$w6User = $row1['w6'];
			$w1User = $row1['z_score_bbpb'];
// 			echo "BB/PB : ".$w1User;
			
			$bobotw1 = 0;
			if ($w1User <= -2){
			    $bobotw1 = 1;
		    }else {
			    $bobotw1 = 0;
			}
            // echo "bobot w1: ".$bobotw1;
            
		include_once ('perhitungan.php');
			//bobot pakar
			$bobotw2 = 0.6;
			$bobotw3 = 0.4;
			$bobotw4 = 0.4;
			$bobotw5 = 0.4;
			$bobotw6 = 0.6;

		
			//hasil percabangan pertanyaan W2
			$w2UserFin = ($w2User + $w2aUser)/2;
			// mengalikan cf user dengan pakar
			$q1Fin = $bobotw1; // antropometri
			$q2Fin = $w2UserFin*$bobotw2; // pertanyaan yang dipecah 2
			$q3Fin = $w3User*$bobotw3;
			$q4Fin = $w4User*$bobotw4;
			$q5Fin = $w5User*$bobotw5;
			$q6Fin = $w6User*$bobotw6;

			//inisialisasi cf combinasi
				$com1=0;
				$com2=0;
				$com3=0;
				$com4=0;
				$com5=0;

			// Menghitung Cf kombinasi
				$Z_score_pb_u = index_pb($sex, $weight, $height, $age);
				$Z_score_bb_pb = index_bb($sex, $weight, $height, $age);

				$com1 = cekrule($q1Fin,$q2Fin);
				$com2 = cekrule($com1,$q3Fin);
				$com3 = cekrule($com2,$q4Fin);
				$com4 = cekrule($com3,$q5Fin);
				$com5 = cekrule($com4,$q6Fin);


				// echo "hasil kombinasi kombinasi 1 : ".$com1."
				// kombinasi 2 : ".$com2." kombinasi 3: ".$com3." kombinasi 4: ".$com4." kombinasi 5: ".$com5." kombinasi 6: ".$com6;

				$persen = $com5 * 100;
				$hasil_waste = round($persen,2);
				// echo "HASIL WASTE : ".$hasil_waste;

				require ('db.php');
				$query="UPDATE `data_anak` SET `hasil_waste`='".$hasil_waste."' WHERE `id`='".$id."'";
				$result= mysqli_query($con, $query);
				if ($result){
					// echo "Update hasil Wasting berhasil";
				}
				echo " GAGAL UPDATE DATA WASTING";
			}
		}
		function stunting(){
			include 'db.php';
			include_once 'perhitungan.php';
			if (isset($_GET['id']))
			$id = $_GET['id'];

			$sql ="select * from data_anak where id='$id'";
			$query1 = mysqli_query($con, $sql);
			while ($row1 = mysqli_fetch_array($query1)) {
				$name = $row1['nama'];
				$sex = $row1['sex'];
				$weight = $row1['weight'];
				$height = $row1['height'];
				$age = $row1['age'];

				$q2User = $row1['q2'];
				$q3User = $row1['q3'];
				$q4User = $row1['q4'];
				$q5User = $row1['q5'];
				$q6User = $row1['q6'];
				$q7User = $row1['q7'];
				$q1User = $row1['z_score_pbu'];
				// echo "q1 user: ".$q1User;
				//antropometri
				    $bobotq1 = 0;
					if ($q1User <= -2){
						$bobotq1 = 1;
					}else {
						$bobotq1 = 0;
					}
                    // echo "bobot q1 : ".$bobotq1;

				//bobot pakar Stunting
					$bobotq2 = 0.4;
					$bobotq3 = 0.6;
					$bobotq4 = 0.6;
					$bobotq5 = 0.4;
					$bobotq6 = 0.4;
					$bobotq7 = 0.4;
				
					// mengalikan cf user stunting dengan pakar
					$q1FinS = $bobotq1;
					$q2FinS = $q2User*$bobotq2;
					$q3FinS = $q3User*$bobotq3;
					$q4FinS = $q4User*$bobotq4;
					$q5FinS = $q5User*$bobotq5;
					$q6FinS = $q6User*$bobotq6;
					$q7FinS = $q7User*$bobotq7;

					//inisialisasi cf combinasi Stunting
					$com1S=0;
					$com2S=0;
					$com3S=0;
					$com4S=0;
					$com5S=0;
					$com6S=0;

				// Menghitung Cf kombinasi Stunting
					$com1S = cekrule($q1FinS,$q2FinS);
					$com2S = cekrule($com1S,$q3FinS);
					$com3S = cekrule($com2S,$q4FinS);
					$com4S = cekrule($com3S,$q5FinS);
					$com5S = cekrule($com4S,$q6FinS);
					$com6S = cekrule($com5S,$q7FinS);

				// echo "hasil kombinasi kombinasi 1 : ".$com1."
				// kombinasi 2 : ".$com2." kombinasi 3: ".$com3." kombinasi 4: ".$com4." kombinasi 5: ".$com5." kombinasi 6: ".$com6;
				// Persen stunting
					$persen_stunt = $com6S * 100;
					$hasil_stunt = round($persen_stunt,2);

					//UPDATE NILAI KOMBINASI CF DI DATABASE
					require ('db.php');
					$query="UPDATE `data_anak` SET `hasil_stunt`='".$hasil_stunt."' WHERE `id`='".$id."'";
					$result= mysqli_query($con, $query);
					if ($result){
						// echo "Update hasil Stunting berhasil";
					}
		}}
 ?>
