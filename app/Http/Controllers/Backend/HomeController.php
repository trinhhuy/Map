<?php

namespace App\Http\Controllers\Backend;

use App\Models\Agent;
use App\Models\Area;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class HomeController extends AdminController
{

    public function index()
    {
       return view('admin.index');
    }
    public function dashboard(Request $request){
        $user = auth()->user();
        $year = Carbon::now()->year;
        if($user->email == 'admin@gmail.com'){
            $area = Area::select('*')->get()->pluck('id')->toArray();
            $agentId = Agent::whereIn('area_id',$area)->get()->pluck('id')->toArray();
        }else{
            $area = $user->area()->get()->pluck('id')->toArray();
            $subArea = Area::whereIn('parent_id',$area)->get()->pluck('id')->toArray();
            $areaIds = array_unique(array_merge($area,$subArea));
            $agents = Agent::whereIn('area_id',$areaIds)->get()->pluck('id')->toArray();
            //agent Id of user
            $agentId = $user->agent()->get()->pluck('id')->toArray();
            $agentId= array_unique(array_merge($agentId,$agents));
        }

        //chart cot

        $products = DB::table('sale_agents')
            ->select(\DB::raw('SUM(sales_plan) as sales_plan,SUM(sales_real) as sales_real,month'))
            ->whereIn('agent_id',$agentId)->groupBy('month')->where('month','like','%'.$year.'%')->orderBy('month')
            ->get()->toArray();
        $sales_plan = [];
        $sales_real = [];


        for($i = 0;$i < 12;$i++){
            $sales_plan[$i] = 0;
            $sales_real[$i] = 0;
        }

        foreach ($products as $key => $product){
            $sales_plan[$key] = intval($product->sales_plan);
            $sales_real[$key] = intval($product->sales_real);

        }

        //end chart cot


//        $productsTt = DB::table('sale_agents')
//            ->select(\DB::raw('SUM(sales_plan) as sales_plan,SUM(sales_real) as sales_real,month,product_id,products.name'))
//            ->whereIn('agent_id',$agentId)->groupBy('month')->groupBy('product_id')
//            ->where('month','like','%'.$year.'%')->orderBy('month')
//            ->join('products','sale_agents.product_id','=','products.id')
//            ->get()->toArray();





        return view('admin.dashboard', compact('month','sales_plan','sales_plan','sales_real'));
    }
}
