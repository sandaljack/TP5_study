<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/22
 * Time: 15:50
 */

namespace app\api\service;


use app\api\Model\Product;
use app\lib\exception\OrderException;

class Order
{
    //订单的商品列表，也就是客户端传递过来的products参数
    protected  $oProducts;

    //真实的商品信息(包括库存量)
    protected $products;

    protected $uid;

    public function place($uid, $oProducts)
    {
        //oProducts和products 作对比
        //products从数据库中查询处理
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);
        $this->uid = $uid;
    }

    //获取订单状态
    private function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'pStatusArray' => []
        ];

        foreach ($this->oProducts as $oProduct)
        {
            $pStatus = $this->getProductStatus($oProduct['product_id'], $oProduct['count'], $this->products);
            if (!$pStatus['haveStock']) {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            array_push($status['pStatusArray'], $pStatus);
        }
        return $status;
    }

    private function getProductStatus($oPID, $oCount, $products)
    {
        $pIndex = -1;
        $pStatus = [
            'id' => null,
            'haveStock' => false,
            'count' => 0,
            'name' => null,
            'totalPrice' => 0
        ];
        for($i=0; $i<count($products); $i++)
        {
            if ($oPID == $products[$i]['id']) {
                $pIndex = $i;
            }
        }

        if ($pIndex  == -1) {
            //客户端传递的product_id有可能根本不存在
            throw new OrderException([
                'msg' => 'id为'.$oPID.'商品不存在，创建订单失败'
            ]);
        } else {
            $product = $products[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['count'] = $oCount;
            $pStatus['totalPrice'] = $product['price'] * $oCount;
            if ($product['stock'] - $oCount >= 0) {
                $pStatus['haveStock'] = true;
            }
        }
        return $pStatus;
    }

    //根据订单信息查找真实的商品信息
    private function getProductsByOrder($oProducts)
    {
        //循环不好
//        foreach ($oProducts as $oProduct)
//        {
//            //循环查询数据库
//        }
        //根据id数组去查
        $oPIDs = [];
        foreach ($oProducts as $item) {
            array_push($oPIDs, $item['product_id']);
        }
        $products = Product::field(['id','price','stock','name','main_img_url'])->all($oPIDs);
        return $products;
    }
}