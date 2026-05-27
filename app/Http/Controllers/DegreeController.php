<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DegreeController extends Controller
{
    public function index()
    {
        return redirect()->route('students.index');
    }

    public function create()
    {
        return $this->renderAjaxOrView('addDegree');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'degree_title' => ['required', 'string', 'max:255'],
        ]);

        Degree::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Degree added successfully.',
                'redirect' => route('students.index'),
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Degree added successfully.')->with('source', 'degrees');
    }

    public function show(Degree $degree)
    {
        $degree->loadCount('students');

        return $this->renderAjaxOrView('degreePage', compact('degree'));
    }

    public function edit(Degree $degree)
    {
        return $this->renderAjaxOrView('editDegree', compact('degree'));
    }

    public function update(Request $request, Degree $degree)
    {
        $original = $degree->only(['degree_title']);

        $data = $request->validate([
            'degree_title' => ['required', 'string', 'max:255'],
        ]);

        $degree->update($data);

        ActivityLog::create([
            'action' => 'edit',
            'entity_type' => 'degree',
            'entity_id' => $degree->id,
            'description' => 'Edited degree: ' . $degree->degree_title,
            'old_values' => $original,
            'new_values' => $degree->fresh()->only(['degree_title']),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Degree updated successfully.',
                'redirect' => route('students.index'),
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Degree updated successfully.')->with('source', 'degrees');
    }

    public function destroy(Degree $degree)
    {
        $degreeSnapshot = $degree->only(['degree_title']);

        if ($degree->students()->exists()) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete this degree because students are currently assigned to it.',
                ], 422);
            }

            return redirect()
                ->route('students.index')
                ->with('error', 'Cannot delete this degree because students are currently assigned to it.');
        }

        try {
            $degree->delete();
        } catch (QueryException $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to delete degree due to related records. Remove dependencies first.',
                ], 422);
            }

            return redirect()
                ->route('students.index')
                ->with('error', 'Unable to delete degree due to related records. Remove dependencies first.');
        }

        ActivityLog::create([
            'action' => 'delete',
            'entity_type' => 'degree',
            'entity_id' => $degree->id,
            'description' => 'Deleted degree: ' . ($degreeSnapshot['degree_title'] ?? 'Unknown'),
            'old_values' => $degreeSnapshot,
        ]);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Degree deleted successfully.',
                'redirect' => route('students.index'),
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Degree deleted successfully.')->with('source', 'degrees');
    }
}
