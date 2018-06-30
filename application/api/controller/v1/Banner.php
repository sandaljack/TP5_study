<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/6/27
 * Time: 0:25
 */

namespace app\api\controller\v1;

use app\api\validate\TestValidate;
use think\Validate;

class Banner
{
    /*
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     */
    public function getBanner($id)
    {
        $data = [
            'id' => $id,
        ];

//        $validate = new Validate([
//            'name' => 'require|max:10',
//            'eamil' => 'email'
//        ]);
        $validate = new IDMustBePostiveInt();
        //batch批量验证
        $result = $validate->batch()->check($data);
        if ($result) {

        } else {
            
        }
    }
}