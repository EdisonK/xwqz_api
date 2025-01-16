<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class StatisticController extends BaseController
{
    public function tieying(Request $request)
    {
//        return $this->successWithData([1]);
        $validated = $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date',
            'keyword' => 'string|nullable',
            'page' => 'integer|nullable',
        ]);
        $start_str = $request->input('start','2025-01-08');
        $end_str = $request->input('end','2025-01-09');
        $keyword = $request->input('keyword');
        $page = $request->input('page',1);
        $per_page = 2;
        $start_num = ($page-1)*$per_page;

        $data = [];
        if($start_str == $end_str){
            $date_str = $start_str;
            $data = $this->getTieYingData($date_str,$keyword);

        }else{
            // 使用Carbon创建两个日期实例
            $start = Carbon::createFromFormat('Y-m-d', $start_str);
            $end = Carbon::createFromFormat('Y-m-d', $end_str);
            if($start->gt($end)){

                return $this->successWithData([]);

            }

            while($start->lte($end)){
                $date_str = $start->format('Y-m-d');
//                调用sql查询数据
                $data1 = $this->getTieYingData($date_str,$keyword);

                $data = array_merge($data,$data1);
                $start = $start->addDay();
            }

        }

        return response()->json([
            'message' => '成功',
            'code' => 0,
            'data' => [
                'data' => $data,
                'meta' => [
                    'page' => $page,
                    'per_page' => $per_page
                ]
            ]

        ]);

    }

    private function getTieYingData($date_str,$keyword)
    {
        $sql = "SELECT C.RQ date_,B.JCBH car_band,ROUND(C.person_time,1) person_time,B.JYXM driver,B.SSDWMC driver_unit,ROUND(C.person_dis,1) person_dis,ROUND(C.per_count_dis,1) per_count_dis,ROUND(C.per_count_time,1) per_count_time,car_total_count,car_total_time,car_total_dis FROM (
            SELECT RQ,JCBH,DUR/x person_time,Z.DISTANCE/x person_dis,Z.DISTANCE/Z.COUNT per_count_dis,Z.DUR/Z.COUNT per_count_time,Z.COUNT car_total_count,Z.DUR car_total_time,Z.DISTANCE car_total_dis FROM (
                SELECT JCBH,COUNT(*) x from baobeis WHERE PBRQ = '$date_str' and ssdwmc like '%$keyword%' GROUP BY JCBH
            ) A
            INNER JOIN  tie_ying_xing_shis Z ON Z.VEHICLE_NAME = A.JCBH WHERE Z.RQ = '$date_str' and Z.client_name like '%$keyword%'
        ) C
        INNER JOIN baobeis B ON B.JCBH = C.JCBH WHERE B.PBRQ = '$date_str' and B.ssdwmc like '%$keyword%' ";

//        dd($sql);:q

        $results = DB::select($sql);

        return $results;

    }


}
