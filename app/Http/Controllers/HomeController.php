<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase;

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
      return view('heatmap', ['buracos'=>$reference->getValue()]);
    }
}
