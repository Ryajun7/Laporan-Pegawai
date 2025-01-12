<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    protected $helloService;

    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function showForm()
    {
        return view('hello');
    }

    public function processForm(Request $request)
    {
        $n = $request->input('n');


        $request->validate([
            'n' => 'required|integer|min:1',
        ]);

        $result = $this->helloService->helloworld($n);
        return view('hello', ['result' => $result, 'n' => $n]);
    }
}
