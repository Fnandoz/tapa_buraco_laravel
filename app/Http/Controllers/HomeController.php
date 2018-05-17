<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase;
use Phpml\Clustering\KMeans;


class HomeController extends Controller
{


    public function index(Request $request)
    {
      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/tapa-buraco-256ba-firebase-adminsdk-frksd-6690637b44.json');
      $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        // The following line is optional if the project id in your credentials file
        // is identical to the subdomain of your Firebase project. If you need it,
        // make sure to replace the URL with the URL of your project.
        ->withDatabaseUri('https://tapa-buraco-256ba.firebaseio.com/')
        ->create();

      $database = $firebase->getDatabase();
      $reference = $database->getReference('/buracos');
      $snapshot = $reference->getSnapshot();
      $storage = $firebase->getStorage();

      $bucket = $storage->getBucket();
      $filesystem = $storage->getFilesystem();

      //dd($bucket->object('3d054285-ca9e-4d77-8084-a567cadfdee3'));
      //return view('welcome', ['array'=>$snapshot->getValue()]);
      return view('index2', ['buracos'=>$reference->getValue()]);
    }

    public function getBairro($lat, $lon)
    {
      $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lon.'&key=AIzaSyBhsjvabUuDHzH667B7e9YRTdPEW8U_iF4';
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $output = curl_exec ($ch);
      $info = curl_getinfo($ch);
      $http_result = $info ['http_code'];
      curl_close ($ch);
      $buracoJson = json_decode($output, true);
      $bairro = $buracoJson["results"][0]["address_components"][2]["long_name"];
      return $bairro;
    }

    public function analise2(Request $request)
    {
      $kmeans = new KMeans(2);
      $kmeans = new KMeans(4, KMeans::INIT_RANDOM);
      $samples = [[1, 1], [8, 7], [1, 2], [7, 8], [2, 1], [8, 9]];

      $kmeans = new KMeans(2);
      $kmeans->cluster($samples);

      $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=-1.4093010415529401,-48.510585464537144&key=AIzaSyBhsjvabUuDHzH667B7e9YRTdPEW8U_iF4';
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $output = curl_exec ($ch);
      $info = curl_getinfo($ch);
      $http_result = $info ['http_code'];
      curl_close ($ch);
      $buracoJson = json_decode($output, true);
      $bairro = $buracoJson["results"][0]["address_components"][2]["long_name"];
      return $bairro;
    }

    public function analise(Request $request)
    {
      $bairros = array();
      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/tapa-buraco-256ba-firebase-adminsdk-frksd-6690637b44.json');
      $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        // The following line is optional if the project id in your credentials file
        // is identical to the subdomain of your Firebase project. If you need it,
        // make sure to replace the URL with the URL of your project.
        ->withDatabaseUri('https://tapa-buraco-256ba.firebaseio.com/')
        ->create();

      $database = $firebase->getDatabase();
      $reference = $database->getReference('/buracos');
      foreach ($reference->getValue() as $b) {
        array_push($bairros, $this->getBairro($b["lat"], $b["lon"]));
      }

      return $bairros ;
    }



    /**
    * Gráficos
    * Line Chart -> Registros x Periodo
    * Column Chart -> Indice de impacto x Qntd. Registros
    * Column Chart -> Qntd. Registros X Bairros (Geocoding API)
    * https://maps.googleapis.com/maps/api/geocode/json?latlng=-1.3936469895130454,-48.46544522792101&key=AIzaSyBhsjvabUuDHzH667B7e9YRTdPEW8U_iF4
    */
}
