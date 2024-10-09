<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Driver\PathExistsButIsNotDirectoryException;
use Illuminate\Http\Request;

class Patient extends Model
{
    protected $table = 'PATIENT';
    public $timestamps = false;
    protected $fillable = ['id', 'nom', 'prenom', 'dateNaissance'];

    public static function add(Request $request){

        $p = new Patient(); // Get an instance of patient table

        // Get the user input values
        $name = $request->input('name');
        $prenom = $request->input('prenom');
        $date_naiss = $request->input('date_naiss');

        // Pass recovered values
        $p->nom = $name;
        $p->prenom = $prenom;
        $p->dateNaissance = $date_naiss;

        if($p->save()){ // If value has been saved, redirect
            return true;
        }
    }

    public function get_incidents() {
        // Create a relation between the patient table and the incident table to obtain all incidents of the specific patient
        return $this->hasMany(Incident::class, 'id_patient');
    }

    // General edit patient method
    public static function edit($id, $name, $lastname, $date){

        // Get specific patient with its id
        $i = Patient::find($id);

        // Pass recovered value
        $i->nom = $name;
        $i->prenom = $lastname;
        $i->dateNaissance = $date;

        if($i->save()){ // If value has been saved, redirect
            return true;
        }
    }
}
