<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;


class BaseController extends Controller
{
    use Helpers;

    protected function success($message = '成功')
    {

        return $this->backWithData($data = null,$message,$code = 0);

    }

    protected function fail()
    {
        return $this->backWithData($data = null,$message ='失败',$code = 1);
    }

    protected function failWithData($message ='失败')
    {
        return $this->backWithData($data = null,$message,$code = 1);
    }

    protected function successWithData($data,$message ='成功', $code = 0)
    {

        return $this->backWithData($data,$message,$code);
    }

    protected function backWithData($data,$message, $code)
    {

        $base_data = [
            'message' => '',
            'code' => '',
            'data' => null
        ];
        $merge_data = [
            'message' => $message,
            'code' => $code,
            'data' => $data
        ];
        return response()->json(array_merge($base_data,$merge_data));
    }


}
