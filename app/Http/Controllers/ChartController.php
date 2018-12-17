<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use Response;

use App\Chart;
use DB;

class ChartController extends Controller
{
     public function index(){
     	
     // 

      $user_info = DB::table('charts')
                 ->select('StockStatus','StockPrice','StockYear',DB::raw('count(*) as total'))
                 ->groupBy('StockYear')
                 ->get()->toJson();
      

     	return $user_info;



     }

     private static function chart($lava){

     	
     	$stock=$lava->DataTable();
     	$data=Chart::select('StockYear','StockPrice')->get();
     	$stock->addStringColumn("StockPrice")
     	->addNumberColumn("StockYear");

     	foreach($data as $key=>$value){
     		$stock->addRow([
     			$value['StockYear'],$value['StockPrice'],
     		]);
     	}

     	$lava->ColumnChart('Stock',$stock,[
     		'title'=> 'Price per years',
     		'is3D'   => true,
     		
    

     	]);


  

     }
     public function getdata(){
     	  $names = DB::table('charts')->pluck('StockName');;
     	  $price = DB::table('charts')->pluck('StockPrice');
     	  $year = DB::table('charts')->pluck('StockYear');

     	  

     	  $data =array(
     	  	'names'=>$names,
     	  	'price'=>$price,
     	  	'year'=>$year,
);
     	  
      
      return $data;     

   // return view('stock',compact('data'));

     }


     public function renderChart(){


     	$f = $this->getdata();

     	return view('stock')->withF($f);

     }


      public function projectsChartData()
    {
        $devlist = DB::table('projects')
            ->select(DB::raw('MONTHNAME(updated_at) as month'), DB::raw("DATE_FORMAT(updated_at,'%Y-%m') as monthNum"), DB::raw('count(*) as projects'))
            ->groupBy('monthNum')
            ->get();

        return  view('stock', compact('devlist'));
    }
     

     
}
