<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Message\Text;
use EasyWeChat;
use EasyWeChat\Message\News;
use EasyWeChat\Foundation\Application;

class WechatController extends Controller
{
    public function serve()
    {

        $server = EasyWeChat::server();
        $server->setMessageHandler(function ($message) {
//            switch ($message->MsgType) {
//                case 'event':
//                    return '收到事件消息';
//                    break;
//                case 'text':
//                    return '收到文字消息';
//                    break;
//                case 'image':
//                    return '收到图片消息';
//                    break;
//                case 'voice':
//                    return '收到语音消息';
//                    break;
//                case 'video':
//                    return '收到视频消息';
//                    break;
//                case 'location':
//                    return '收到坐标消息';
//                    break;
//                case 'link':
//                    return '收到链接消息';
//                    break;
//                default:
//                    return '收到其它消息';
//                    break;
//            }
            //事件处理
            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case 'subscribe':
                        return new Text(['content' => '欢迎关注 xqking小卖铺!亲，还等什么，赶紧去小卖铺买东西把']);
                        break;

                    case 'CLICK':
                        switch ($message->EventKey) {
                            case 'recommend':
                                return $this->is_recommend();
                                break;

                            case 'new':
                                return $this->is_new();
                                break;

                            case 'selling':
                                return $this->is_selling();
                                break;

                            case 'order':
                                return $this->order($message->FromUserName);
                                break;

                        }
                        break;
                }
            }
            //文本消息
            if ($message->MsgType == 'text') {
                switch ($message->Content) {

                    case '精选':
                    case '推荐':
                    case '精选推荐':
                    case 'recommend':
                        return $this->is_recommend();
                        break;

                    case '新品':
                    case '新品到货':
                    case 'new':
                        return $this->is_new();
                        break;

                    case '人气':
                    case '热卖':
                    case '人气热卖':
                    case 'selling':
                        return $this->is_selling();
                        break;

                    case '我的':
                    case '订单':
                    case '我的订单':
                    case 'order':
                        return $this->order($message->FromUserName);
                        break;

                    default:
                        return $this->default_msg();
                }
            }

            //语音消息
            if ($message->MsgType == 'voice') {
                switch ($message->Recognition) {
                    case '精选。':
                    case '推荐。':
                    case '精选推荐。':
                    case 'recommend':
                        return $this->is_recommend();
                        break;

                    case '新品。':
                    case '到货。':
                    case '新品到货。':
                    case 'new':
                        return $this->is_new();
                        break;

                    case '人气':
                    case '热卖':
                    case '人气热卖':
                    case 'selling':
                        return $this->is_selling();
                        break;

                    case '我的':
                    case '订单':
                    case '我的订单':
                    case 'order':
                        return $this->order($message->FromUserName);
                        break;

                    default:
                        return '您说的是:' . $message->Recognition . '?';
                }
            }

        });
        return $server->serve();
    }

    /**
     * 推荐
     * @return array
     */
    private function is_recommend()
    {
        $products = Product::where('is_recommend', true)->orderBY('is_top', 'desc')->orderBY('created_at')->take(6)->get();
        $news = [];
        foreach ($products as $value) {
            $news[] = new News([
                'title' => $value->name,
                'description' => $value->description,
                'url' => 'http://' . env('WECHAT_DOMAIN') . '/product/' . $value->id,
                'image' => $value->image,
            ]);
        }
        return $news;
    }

    /**
     * 新品
     * @return array
     */
    private function is_new()
    {
        $products = Product::where('is_new', true)->orderBY('is_top', 'desc')->orderBY('created_at')->take(6)->get();
        $news = [];
        foreach ($products as $value) {
            $news[] = new News([
                'title' => $value->name,
                'description' => $value->description,
                'url' => 'http://' . env('WECHAT_DOMAIN') . '/product/' . $value->id,
                'image' => $value->image,
            ]);
        }
        return $news;
    }

    /**
     * 人气热卖
     * @return array
     */
    public function is_selling()
    {
        $products = Product::where('is_selling', true)->orderBY('is_top', 'desc')->orderBY('created_at')->take(6)->get();
        $news = [];
        foreach ($products as $value) {
            $news[] = new News([
                'title' => $value->name,
                'description' => $value->description,
                'url' => 'http://' . env('WECHAT_DOMAIN') . '/product/' . $value->id,
                'image' => $value->image,
            ]);
        }
        return $news;
    }


    function order($openid)
    {
        $user = User::where('openid', $openid)->first();
        if (!$user) {
            return '您没有未完成订单，请先购买一件吧！';
        }
        $order_status = config('admin.order_status');
        $orders = Order::where('status', '<', 5)->with('order_products.product')->orderBY('status')
            ->orderBY('id', 'desc')->take(6)->get();
        if ($orders->isEmpty()) {
            return '您没有未完成订单，请先购买一件吧！';
        }
        $news = [];
        foreach ($orders as $order) {
            $news[] = new News([
                'title' => '订单号' . $order->id . "(" . $order_status[$order->status] . ")",
                'url' => 'http://' . env('WECHAT_DOMAIN') . '/product/' . $order->id,
                'image' => $order->order_products->first()->product->image,
            ]);
        }
        return $news;
    }

    /**
     * 其他消息
     * @return string
     */
    function default_msg()
    {
        return '您在跟我搞笑';
    }

//    /**
//     * 微信接口消息
//     * @return mixed
//     */
//    public function serve()
//    {
//        $server = EasyWeChat::server();
//        $server->setMessageHandler(function ($message) {
//            //事件处理
//            if ($message->Msgtype == 'event') {
//                switch ($message->Event) {
//                    case 'subscribe':
//                        return new Text(['content' => '欢迎关注 xqking小卖铺!亲，还等什么，赶紧去小卖铺买东西把']);
//                        break;
//
//                    //点击事件
//                    case 'CLICK':
//                        switch ($message->EventKey) {
//                            case 'recommend':
//                                return $this->is_recommend();
//                                break;
//                            case 'new':
//                                return $this->is_new();
//                                break;
//                            case 'hot':
//                                return $this->is_hot();
//                                break;
//                            case 'order':
//                                return $this->order($message->FromUserName);
//                                break;
//                        }
//                        break;
//                }
//            }
//            //文本消息
//            if ($message->Msgtype == 'text') {
//                switch ($message->Content) {
//                    case '精选':
//                    case '推荐':
//                    case '精选推荐':
//                    case 'recommend':
//                        return $this->is_recommend();
//                        break;
//
//                    case '新品':
//                    case '新品到货':
//                    case 'new':
//                        return $this->is_new();
//                        break;
//
//                    case '人气':
//                    case '热卖':
//                    case '人气热卖':
//                    case 'hot':
//                        return $this->is_hot();
//                        break;
//
//                    case '我的订单':
//                    case '订单':
//                        return $this->order($message->FromUserName);
//                        break;
//
//                    default:
//                        return $this->default_msg();
//                }
//            }
//
//            //语言消息
//            if ($message->MsgType == 'voice') {
//                switch ($message->Recognition) {
//                    case '精选。':
//                    case '推荐。':
//                    case '精选推荐。':
//                        return $this->is_recommend();
//                        break;
//
//                    case '新品。':
//                    case '新品到货。':
//                        return $this->is_new();
//                        break;
//
//                    case '人气。':
//                    case '热卖。':
//                    case '人气热卖。':
//                        return $this->is_hot();
//                        break;
//
//                    case '订单。':
//                    case '我的订单。':
//                        return $this->order($message->FromUserName);
//                        break;
//
//                    default:
//                        return '您说的是:' . $message->Recognition . '?';
//
//                }
//            }
//        });
//        return $server->serve();
//    }
//
//    /**
//     * 精选推荐
//     * @return array
//     */
//    private function is_recommend()
//    {
//        $products = Product::where('is_recommend', true)->orderBY('is_top', 'desc')->orderBY('created_at')->take(6)->get();
//        $news = [];
//        foreach ($products as $value) {
//            $news[] = new News([
//                'title' => $value->name,
//                'description' => $value->desc,
//                'url' => 'http://' . env('WECHAT_DOMAIN') . '/product/' . $value->id,
//                'image' => $value->image ? env('QINIU_IMAGES_LINK') . $value->image : '',
//            ]);
//        }
//        return $news;
//    }
//
//    /**
//     * 新品
//     * @return array
//     */
//    private function is_new()
//    {
//        $products = Product::where('is_new', true)->orderBY('is_top', 'desc')->orderBY('created_at')->take(6)->get();
//        $news = [];
//        foreach ($products as $value) {
//            $news[] = new News([
//                'title' => $value->name,
//                'description' => $value->desc,
//                'url' => 'http://' . env('WECHAT_DOMAIN') . '/product/' . $value->id,
//                'image' => $value->image ? env('QINIU_IMAGES_LINK') . $value->image : '',
//            ]);
//        }
//        return $news;
//    }
//
//    /**
//     * 人气热卖
//     * @return array
//     */
//    private function is_hot()
//    {
//        $products = Product::where('is_hot', true)->orderBY('is_top', 'desc')->orderBY('created_at')->take(6)->get();
//        $news = [];
//        foreach ($products as $value) {
//            $news[] = new News([
//                'title' => $value->name,
//                'description' => $value->desc,
//                'url' => 'http://' . env('WECHAT_DOMAIN') . '/product/' . $value->id,
//                'image' => $value->image ? env('QINIU_IMAGES_LINK') . $value->image : '',
//            ]);
//        }
//        return $news;
//    }
//
//    /**
//     * 我的订单
//     * @param $openid
//     * @return array|string
//     */
//    private function order($openid)
//    {
//        $user = User::where('openid', $openid)->first();
//        if (!$user) {
//            return '您还没有未完成订单，去购买一件商品吧！';
//        }
//        $order_status = config('admin.order_status');
//        $orders = Order::where('status', '<', 5)->where('user_id', $user->id)->with('order_products.product')
//            ->orderBY('status')->orderBY('id', 'desc')->take(6)->get();
//        if ($orders->isEmpty()) {
//            return '您还没有未完成订单，去购买一件商品吧！';
//        }
//        $news = [];
//        foreach ($orders as $order) {
//            $news[] = new News([
//                'title' => '订单号' . $order->id . "(" . $order_status[$order->status] . ")",
//                'url' => 'http://' . env('WECHAT_DOMAIN') . '/product/' . $order->id,
//                'image' => $order->order_products->first()->product->image ? env('QINIU_IMAGES_LINK')
//                    . $order->order_products->first()->product->image : '',
//            ]);
//        }
//        return $news;
//    }
//
//    /**
//     * 默认消息
//     * @return string
//     */
//    function default_msg()
//    {
//        return '您在跟我搞笑';
//    }
}
