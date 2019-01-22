<?php

namespace App\Http\Controllers\Admin\Statistics;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    public function statistics(Request $request){
    	$school_year = $request->input('school_year');
    	$grade = $request->input('total_point_grade');
    	$data = null;
    	if($school_year && $grade){
    		$data["total_count"] = User::where('school_year', $school_year)->count();
	    	$data["grade_count"] = User::where(['school_year' => $school_year, 'total_point_grade' => $grade])->count();
	    	$data["percentage"] = sprintf("%.2f", $data["grade_count"] / $data["total_count"] * 100)."%";
	    	$data["man_count"] = User::where(['school_year' => $school_year, 'total_point_grade' => $grade, 'sex' => 1])->count();
	    	$data["woman_count"] = $data["grade_count"] - $data["man_count"];	
    	}else{
    		$data["total_count"] = null;
	    	$data["grade_count"] = null;
	    	$data["percentage"] = null;
	    	$data["man_count"] = null;
	    	$data["woman_count"] = null;
    	}
    	$data["total_point_grade"] = $grade;
    	$data["school_year"] = $school_year;
	  return view('admin.statistics', $data);
    	
    }
}
