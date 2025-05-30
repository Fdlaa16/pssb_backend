<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Club;
use App\Models\Standing;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StandingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function indexScheduleMatch(Request $request)
    {
        $orderByColumn = 'created_at';
        $orderByDirection = 'desc';

        if ($request->has('sort')) {
            $orderByDirection = $request->input('sort') === 'asc' ? 'asc' : 'desc';
        }

        $stadiums = Club::query()
            ->with([
                'scheduleMatch'
            ])
            ->when(!empty($request->search), function ($q) use ($request) {
                $q->where('created_at', 'like', '%' . $request->search . '%')
                    ->orWhere('code', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhereHas('scheduleMatch', function ($user) use ($request) {
                        $user->where('schedule_date', 'like', '%' . $request->search . '%')
                            ->orWhere('score', 'like', '%' . $request->search . '%');
                    });
            })
            ->orderBy($orderByColumn, $orderByDirection)
            ->latest();

        if ($request->has('from_date') && !empty($request->from_date)) {
            $stadiums->where('created_at', '>=', Helper::formatDate($request->from_date, 'Y-m-d') . ' 00:00:00');
        }
        
        if ($request->has('to_date') && !empty($request->to_date)) {
            $stadiums->where('created_at', '<=', Helper::formatDate($request->to_date, 'Y-m-d') . ' 23:59:59');
        }

        $stadiums = $stadiums->paginate(10);

        return $stadiums;
    }

    public function indexScheduleTraining(Request $request)
    {
        $orderByColumn = 'created_at';
        $orderByDirection = 'desc';

        if ($request->has('sort')) {
            $orderByDirection = $request->input('sort') === 'asc' ? 'asc' : 'desc';
        }

        $stadiums = Club::query()
            ->with([
                'scheduleTraining'
            ])
            ->when(!empty($request->search), function ($q) use ($request) {
                $q->where('created_at', 'like', '%' . $request->search . '%')
                    ->orWhere('code', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhereHas('scheduleMatch', function ($user) use ($request) {
                        $user->where('schedule_date', 'like', '%' . $request->search . '%')
                            ->orWhere('score', 'like', '%' . $request->search . '%');
                    });
            })
            ->orderBy($orderByColumn, $orderByDirection)
            ->latest();

        if ($request->has('from_date') && !empty($request->from_date)) {
            $stadiums->where('created_at', '>=', Helper::formatDate($request->from_date, 'Y-m-d') . ' 00:00:00');
        }
        
        if ($request->has('to_date') && !empty($request->to_date)) {
            $stadiums->where('created_at', '<=', Helper::formatDate($request->to_date, 'Y-m-d') . ' 23:59:59');
        }

        $stadiums = $stadiums->paginate(10);

        return $stadiums;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
