<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatementRequest;
use App\Models\Statement;
use App\Traits\Helper;
use Illuminate\Http\Request;

class StatementController extends Controller
{
    use Helper;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response([
            'statements' => Statement::filter($request)->isActive()->select('id', 'title', 'price', 'currency')->paginate(20),
            'success' => true,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatementRequest $request)
    {
        return static::safeResponse(function () use ($request) {
            $data = $request->validated();
            $data['user_id'] = auth()->id();

            return [
                'statment' => Statement::create($data),
                'success' => true,
                'message' => 'Statement Created',
            ];
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Statement $statement)
    {
        return response([
            'statement' => $statement->load(['propertyType:id,name', 'user:id,name,email']),
            'success' => true,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatementRequest $request, Statement $statement)
    {
        $this->authorize('update', $statement);

        return static::safeResponse(function () use ($request, $statement) {
            $statement->update($request->validated());

            return [
                'success' => true,
                'statement' => $statement->refresh(),
                'message' => 'Statement Updated',
            ];
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statement $statement)
    {
        $this->authorize('delete', $statement);

        return static::safeResponse(function () use ($statement) {
            $statement->delete();

            return [
                'success' => true,
                'message' => 'Statement Deleted',
            ];
        });
    }
}
