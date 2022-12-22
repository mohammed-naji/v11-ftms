<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Notifications\AppliedNotification;
use App\Models\Company;
use App\Models\User;
use App\Models\Course;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        // $companies = Company::has('courses')->latest('id')->get();
        $companies = Company::whereHas('courses', function(Builder $query) {
            $query->whereDate('start_date', '>=', date('Y-m-d') );
        })->latest('id')->get();
        // dd($companies);
        return view('site.index', compact('companies'));
    }

    public function company($id)
    {
        $company = Company::with('courses')->findOrFail($id);
        return view('site.company', compact('company'));
    }

    public function course($id)
    {
        $course = Course::findOrFail($id);
        return view('site.course', compact('course'));
    }

    public function course_apply(Request $request, $id)
    {
        $course = Course::find($id);
        // dd($request->all());
        Application::create([
            'company_id' => $request->company_id,
            'user_id' => $request->user()->id,
            'course_id' => $id,
            'reason' => $request->reason
        ]);

        $user = User::where('company_id', $request->company_id)->first();

        // dd($request->company_id);

        $user->notify( new AppliedNotification($request->user()->name, $course->name) );

        return redirect()->back()->with('msg', 'Your application has been submitted successfully');
    }

}
