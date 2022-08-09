<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

class AdminCustomerController
{
    public function customers()
    {
        $customers = User::where('role_type', 'customer')->get();

        return view('admin.customers.index', compact('customers'));
    }
}
