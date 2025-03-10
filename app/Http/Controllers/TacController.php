<?php

namespace App\Http\Controllers;

use App\Models\Tac;
use Illuminate\Http\Request;
use App\Http\Requests\TacRequest;
use App\Services\TacService;
class TacController extends Controller
{
    public function __construct(private TacService $tacService)
    {

    }
    public function index()
    {
        $layout = "layouts.super";
        $tac = $this->tacService->index();
        return view("backend.tac.index", compact("tac", "layout"));
    }
    public function store(TacRequest $tacRequest)
    {
        try {
            $this->tacService->store($tacRequest);
            return redirect()->back()->with('success', 'TAC Number created successfully!');
        } catch (\Exception $e) {
            // Log the error and return an error message
            \Log::error('Error storing element: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the model number.');
        }
    }

    public function destroy($tacId)
    {
        $tac = Tac::find($tacId);
        if (!$tac) {
            return redirect()->back()->with('error', 'Device Tac No Not Found');
        }

        try {
            $tac->delete();
            return redirect()->back()->with('success', 'Device Tac No Deleted!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Device Tac No Not Deleted! Something Went Wrong!');
        }
    }

    public function update($tacId, Request $request)
    {
        $tac = Tac::find($tacId);
        if (!$tac) {
            return redirect()->back()->with('error', 'Device Tac No Not Found');
        }

        try {
            $tac->tacNo = $request['tacNo'];
            $tac->save();
            return redirect()->back()->with('success', 'Device Tac No Deleted!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Device Tac No Not Deleted! Something Went Wrong!');
        }
    }
}
