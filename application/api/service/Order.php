<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/22
 * Time: 15:50
 */

namespace app\api\service;


use app\api\Model\OrderProduct;
use app\api\Model\Product;
use app\api\Model\UserAddress;
use app\api\Model\Order as OrderModel;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use think\Exception;

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
        $status = $this->getOrderStatus();
        //检测订单是否通过
        if (!$status['pass']) {
            $status['order_id'] = -1;
            return $status;
        }

        //开始创建订单
        $orderSnap = $this->snapOrder($status);//生成快照
        $order = $this->createOrder($orderSnap);//创建订单
        $order['pass'] = true;
        return $order;

    }

    //创建订单
    private function createOrder($snap)
    {
        try {
            $orderNo = $this->makeOrderNo();//生成订单号
            $order = new OrderModel();
            $order->user_id = $this->uid;
            $order->order_no = $orderNo;
            $order->total_price = $snap['orderPrice'];
            $order->total_count = $snap['totalCount'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_name = $snap['snapName'];
            $order->snap_address = $snap['snapAddress'];
            $order->snap_items = json_encode($snap['pStatus']);
            $order->save();

            //插入order_product
            $orderID = $order->id;
            $create_time = $order->create_time;
            foreach ($this->oProducts as &$p) {
                $p['order_id'] = $orderID;
            }
            $orderProduct = new OrderProduct();
            $orderProduct->saveAll($this->oProducts);
            return [
                'order_no' => $orderNo,
                'order_id' => $orderID,
                'create_time' => $create_time,
            ];
        } catch (Exception $e) {
            throw $e;
        }


    }

    //生成订单号
    public static function makeOrderNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn =
            $yCode[intval(date('Y')) - 2018] . strtoupper(dechex(date('m'))) . date(
                'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
                '%02d', rand(0, 99));
        return $orderSn;
    }

    //生成订单快照
    private function snapOrder($status)
    {
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => null,
            'snapName' => '',
            'snapImg' => ''
        ];

        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status['pStatusArray'];
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_img_url'];

        if (count($this->products) > 1) {
            $snap['snapName'] .= '等';
        }
    }

    //查出用户地址
    private function getUserAddress()
    {
        $userAddress = UserAddress::where('user_id', $this->uid)->find();
        if (!$userAddress) {
            throw new UserException([
                'msg' => '用户收货地址不存在，下单失败',
                'errorCode' => 60001,
            ]);
        }
        return $userAddress;
    }

    /**
     * @param string $orderNo 订单号
     * @return array 订单商品状态
     * @throws Exception
     */
    public function checkOrderStock($orderID)
    {
        //        if (!$orderNo)
        //        {
        //            throw new Exception('没有找到订单号');
        //        }

        // 一定要从订单商品表中直接查询
        // 不能从商品表中查询订单商品
        // 这将导致被删除的商品无法查询出订单商品来
        $oProducts = OrderProduct::where('order_id', '=', $orderID)
            ->select();
        $this->products = $this->getProductsByOrder($oProducts);
        $this->oProducts = $oProducts;
        $status = $this->getOrderStatus();
        return $status;
    }

    //获取订单状态
    private function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatusArray' => []
        ];

        foreach ($this->oProducts as $oProduct)
        {
            $pStatus = $this->getProductStatus($oProduct['product_id'], $oProduct['count'], $this->products);
            if (!$pStatus['haveStock']) {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            $status['totalCount'] += $pStatus['count'];
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

    public function delivery($orderID, $jumpPage = '')
    {
        $order = OrderModel::where('id', '=', $orderID)
            ->find();
        if (!$order) {
            throw new OrderException();
        }
        if ($order->status != OrderStatusEnum::PAID) {
            throw new OrderException([
                'msg' => '还没付款呢，想干嘛？或者你已经更新过订单了，不要再刷了',
                'errorCode' => 80002,
                'code' => 403
            ]);
        }
        $order->status = OrderStatusEnum::DELIVERED;
        $order->save();
//            ->update(['status' => OrderStatusEnum::DELIVERED]);
        $message = new DeliveryMessage();
        return $message->sendDeliveryMessage($order, $jumpPage);
    }
}