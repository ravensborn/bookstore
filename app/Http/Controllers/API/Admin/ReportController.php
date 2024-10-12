<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\ListIncomeRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $topCategories = Category::select(['id', 'name'])->withCount(['books' => function ($query) {
            $query->where('stock', '>', 0);
        }])
            ->orderBy('books_count', 'desc')

            ->take(5)
            ->get();


        return [
            'books_added_in_last_2_weeks' => Book::where('created_at', '>=', Carbon::now()->subWeeks(2))->count(),
            'orders_today' => Order::whereDate('created_at', Carbon::today())->count(),
            'total_categories' => Category::count(),
            'total_books' => Book::count(),

            'categories_with_most_books_in_stock' => $topCategories,
        ];
    }

    public function income(ListIncomeRequest $request)
    {

        $startDate = Carbon::createFromFormat('Y-m-d', $request->from);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->to);

        $total = Order::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->sum('total');
        $paid = Order::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->sum('paid');

        return [
            'total' => (float)$total,
            'paid' => (float)$paid,
            'amount_due' => $total - $paid,
        ];
    }


}
