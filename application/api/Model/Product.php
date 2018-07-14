<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/14
 * Time: 12:03
 */

namespace app\api\Model;


class Product extends BaseModel
{
    protected $hidden = [
        'pivot',
        'delete_time',
        'main_img_id',
        'from',
        'category_id',
        'create_time',
        'update_time'
    ];

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public static function getMostRecent($count)
    {
        $products = self::limit($count)->order('create_time desc')->select();
        return $products;
    }

    public static function getProductsByCategotyID($categoryID)
    {
        $products = self::where('category_id', '=', $categoryID)->select();
        return $products;
    }
}