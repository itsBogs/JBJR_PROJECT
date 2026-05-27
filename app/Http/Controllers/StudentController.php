<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Degree;
use App\Models\Student;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $degrees = Degree::orderBy('degree_title')->get();
        $students = Student::with(['degree', 'userAccount'])
            ->latest()
            ->get();

        return $this->renderAjaxOrView('studentHome', compact('degrees', 'students'));
    }

    public function home()
    {
        return redirect()->route('dashboard');
    }

    public function page()
    {
        return redirect()->route('dashboard');
    }

    public function aboutUs()
    {
        return $this->renderAjaxOrView('studentAboutUs');
    }

    public function create()
    {
        $degrees = Degree::orderBy('degree_title')->get();

        return $this->renderAjaxOrView('addStudent', compact('degrees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
            'contact_number' => ['required', 'digits:11'],
            'email_address' => ['required', 'email', 'max:255', 'unique:user_accounts,email'],
            'username' => ['required', 'string', 'min:4', 'max:255', 'unique:user_accounts,username'],
            'password' => ['required', 'string', 'min:8'],
            'degree_id' => ['required', 'integer', 'exists:degrees,id'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 2 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 2 characters.',
            'middle_name.max' => 'Middle name must not exceed 255 characters.',
            'address.required' => 'Address is required.',
            'contact_number.required' => 'Contact number is required.',
            'contact_number.digits' => 'Contact number must be exactly 11 digits.',
            'email_address.required' => 'Email address is required.',
            'email_address.email' => 'Email address must be valid.',
            'email_address.unique' => 'This email address is already taken.',
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'degree_id.required' => 'Degree is required.',
            'degree_id.exists' => 'Selected degree does not exist.',
            'avatar.image' => 'The file uploaded must be an image.',
            'avatar.mimes' => 'Only jpeg, png, jpg, and gif formats are allowed.',
            'avatar.max' => 'The image size must practically not exceed 2MB.',
        ]);

        DB::transaction(function () use ($data, $request) {
            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            }

            $userAccount = UserAccount::create([
                'username' => $data['username'],
                'email' => $data['email_address'],
                'password' => $data['password'],
                'role' => 'student',
                'is_active' => true,
                'must_change_password' => true,
                'avatar' => $avatarPath,
            ]);

            Student::create([
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'address' => $data['address'],
                'contact_number' => $data['contact_number'],
                'user_account_id' => $userAccount->id,
                'degree_id' => $data['degree_id'],
            ]);
        });

        $msg = "New student added: {$data['first_name']} {$data['middle_name']} {$data['last_name']} ({$data['email_address']})";
        Log::info($msg);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Student and User Account created successfully.',
                'redirect' => route('students.index')
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Student and User Account created successfully.')->with('source', 'students');
    }

    public function show(Student $student)
    {
        $currentUser = Auth::user();

        if ($currentUser?->role === 'student' && $currentUser?->student?->id !== $student->id) {
            abort(403, 'Unauthorized Access');
        }

        $student->load(['degree', 'userAccount']);

        return $this->renderAjaxOrView('studentPage', compact('student'));
    }

    public function edit(Student $student)
    {
        $student->load('userAccount');
        $degrees = Degree::orderBy('degree_title')->get();

        return $this->renderAjaxOrView('editStudent', compact('student', 'degrees'));
    }

    public function update(Request $request, Student $student)
    {
        $original = $student->load('userAccount')->toArray();

        $data = $request->validate([
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
            'contact_number' => ['required', 'digits:11'],
            'email_address' => ['required', 'email', 'max:255', 'unique:user_accounts,email,' . ($student->userAccount->id ?? 0)],
            'degree_id' => ['required', 'integer', 'exists:degrees,id'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        DB::transaction(function () use ($data, $student, $request) {
            if ($student->userAccount) {
                $userAccountData = [
                    'email' => $data['email_address'],
                ];

                if ($request->hasFile('avatar')) {
                    if ($student->userAccount->avatar && Storage::disk('public')->exists($student->userAccount->avatar)) {
                        Storage::disk('public')->delete($student->userAccount->avatar);
                    }

                    $userAccountData['avatar'] = $request->file('avatar')->store('avatars', 'public');
                }

                $student->userAccount->update($userAccountData);
            }

            $student->update([
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'address' => $data['address'],
                'contact_number' => $data['contact_number'],
                'degree_id' => $data['degree_id'],
            ]);
        });

        ActivityLog::create([
            'action' => 'edit',
            'entity_type' => 'student',
            'entity_id' => $student->id,
            'description' => 'Edited student: ' . $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name,
            'old_values' => $original,
            'new_values' => $student->fresh(['userAccount'])->toArray(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully.',
                'redirect' => route('students.index')
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Student updated successfully.')->with('source', 'students');
    }

    public function destroy(Student $student)
    {
        $student->load('userAccount');
        $studentName = $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name;
        $userAccount = $student->userAccount;

        ActivityLog::create([
            'action' => 'delete',
            'entity_type' => 'student',
            'entity_id' => $student->id,
            'description' => 'Deleted student: ' . $studentName,
            'old_values' => $student->toArray(),
        ]);

        DB::transaction(function () use ($student, $userAccount) {
            $student->delete();

            if ($userAccount) {
                if ($userAccount->avatar && Storage::disk('public')->exists($userAccount->avatar)) {
                    Storage::disk('public')->delete($userAccount->avatar);
                }

                $userAccount->delete();
            }
        });

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully.',
                'redirect' => route('students.index')
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.')->with('source', 'students');
    }
}
