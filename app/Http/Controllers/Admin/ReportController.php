<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ReportController extends Controller
{
    public function index(){
        $user_by_month = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
        ];

        $product_by_month = [
            'chart_title' => 'Product by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Product',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];

        $order_by_month = [
            'chart_title' => 'Order by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
        ];


        $order_item_by_month = [
            'chart_title' => 'Order Item by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
        ];

        $user_by_day = [
            'chart_title' => 'Users by Day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
        ];

        $product_by_day = [
            'chart_title' => 'Product by Day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Product',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];

        $order_by_day = [
            'chart_title' => 'Order by Day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'pie',
        ];


        $order_item_by_day = [
            'chart_title' => 'Order Item by Day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'pie',
        ];

        $user_m = new LaravelChart($user_by_month);
        $product_m = new LaravelChart($product_by_month);
        $order_m = new LaravelChart($order_by_month);
        $order_item_m = new LaravelChart($order_item_by_month);

        $user_d = new LaravelChart($user_by_day);
        $product_d = new LaravelChart($product_by_day);
        $order_d = new LaravelChart($order_by_day);
        $order_item_d = new LaravelChart($order_item_by_day);

        return view('backend.admin.report.index', compact('user_m', 'product_m', 'order_m', 'order_item_m', 'user_d', 'product_d', 'order_d', 'order_item_d'));
    }
}
