<?php
/**
 * 改变属性
 * @param $model
 * @param $attr
 * @return string
 */
function is_something($model, $attr)
{
    if ($model->$attr) {
        return '<span class="am-icon-check change_attr" data-attr="' . $attr . '"></span>';
    }
    return '<span class="am-icon-remove change_attr" data-attr="' . $attr . '"></span>';
}

function show_brand_products($brand)
{
    if (!$brand->products) {
        return '<a class="am-btn am-btn-success am-btn-xs" href="' . route('shop.product.index',
                ['brand_id' => $brand->id]) . '">查看商品</a>';
    }
}

function show_category_products($category)
{
    if (!$category->products->isEmpty()) {
        return '<a class="am-btn am-btn-success am-btn-xs" href="' . route('shop.product.index',
                ['category_id' => $category->id]) . '">查看商品</a>';
    }
}

function category_indent($count)
{
    $str = '';
    for ($i = 0; $i < $count; $i++) {
        $str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    return $str;
}


/**
 * 截取, 并加上...
 * @param $string
 * @param $size
 * @param bool $dot 是否加上..., 默认true
 * @return string
 */
function sub($string, $size = 24, $dot = true)
{
    $string = strip_tags(trim($string));
    if (strlen($string) > $size) {
        $string = mb_substr($string, 0, $size);
        $string .= $dot ? '...' : '';
        return $string;
    }

    return $string;
}

/**
 * 递归生成无限极分类数组
 * @param $data
 * @param int $parent_id
 * @param int $count
 * @return array
 */
function tree(&$data, $parent_id = 0, $count = 1)
{
    static $treeList = [];

    foreach ($data as $key => $value) {
        if ($value['parent_id'] == $parent_id) {
            $value['count'] = $count;
            $treeList [] = $value;
            unset($data[$key]);
            tree($data, $value['id'], $count + 1);
        }
    }
    return $treeList;
}


/**
 * 栏目名前面加上缩进
 * @param $count
 * @return string
 */
function indent_category($count)
{
    $str = '';
    for ($i = 1; $i < $count; $i++) {
        $str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    return $str;
}


function time_format($attr, $datetime)
{
    if ($datetime == "") {
        return "";
    }
    return date($attr, strtotime($datetime));
}

/**
 * 微信菜单, 删除空数组
 * @param $buttons
 */
function wechat_menus($request_buttons)
{
    $buttons = [];

    foreach ($request_buttons as $key => $value) {
        if ($value['name'] == "") {
            continue;
        }

        $buttons["$key"] = wechat_key_url($value);

        foreach ($value["sub_button"] as $k => $v) {
            if ($v['name'] == "") {
                continue;
            }
            $buttons["$key"]["sub_button"][] = wechat_key_url($v);
        }
    }
    return $buttons;
}

/**
 * 根据类型,返回url或者key
 * @param $value
 * @return array
 */
function wechat_key_url($value)
{
    $result = [];

    $result['type'] = $value['type'];
    $result['name'] = $value['name'];
    if ($value['type'] == "click") {
        $result['key'] = $value['value'];
    } else {
        $result['url'] = $value['value'];
    }
    return $result;
}

/**
 * 订单状态
 * @param $status
 * @return mixed
 */
function order_status($status)
{
    $info = config('admin.order_status');
    return $info["$status"];
}

/**
 * 1=> '下单',       //待支付
 * 2=> '付款',       //待发货
 * 3=> '配货',
 * 4=> '出库',       //待收货
 * 5=> '交易成功',    //已完成
 * @param $status
 * @return string
 */
function order_color($status)
{
    switch ($status) {
        case '1':
            return 'uc-order-item-pay';        //橙
            break;
        case '2':
            return 'uc-order-item-shipping';    //红
            break;
        case '3':
            return 'uc-order-item-shipping';    //红
            break;
        case '4':
            return 'uc-order-item-receiving';   //绿
            break;
        case '5':
            return 'uc-order-item-finish';      //灰
            break;
        default:
            return 'uc-order-item-finish';
    }
}
 function authorize()
{
    return true;
}

/**
 * Get the validation rules that apply to the request.
 *
 * @return array
 */

//手机号中间四位隐藏
//function telmd($tel)
//{
//    if (is_numeric($tel)) {
//        $pattern = '/(?<=\d{3}).*(?=\d{4})/';
//        $result = preg_replace($pattern, '****', $tel);
//        return $result;
//    } else {
//        return $tel;
//    }
//    echo(telmd('18872374243'));
//}

