<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Driver\PathExistsButIsNotDirectoryException;
use Illuminate\Http\Request;

class Incident extends Model
{
    protected $table = 'INCIDENT';
    public $timestamps = false;
    protected $fillable = ['id', 'description', 'level', 'date', 'id_patient'];

    public static function add(Request $request)
    {
        $i = new Incident(); // Get an instance of incident table

        // Get the user input values
        $description = filter_var($request->input('desc'), FILTER_SANITIZE_STRING);
        $level = $request->input('level_select');
        $date = $request->input('date_incident');
        $id_patient = $request->input('patient_select');

        // Pass recovered values
        $i->description = $description;
        $i->level = $level;
        $i->date = $date;
        $i->id_patient = $id_patient;

        if($i->save()){ // If value has been saved, redirect
            return true;
        }
    }

    // General edit incident method
    public static function edit($id, $desc, $level, $date){

        // Get specific incident with its id
        $i = Incident::find($id);

        // Pass recovered value
        $i->description = filter_var($desc, FILTER_SANITIZE_STRING);
        $i->level = $level;
        $i->date = $date;

        if($i->save()){ // If value has been saved, redirect
            return true;
        }
    }
}
