<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Transport\ResendTransport;
use SebastianBergmann\CodeCoverage\Driver\PathExistsButIsNotDirectoryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Patient extends Model
{
    protected $table = 'PATIENT';
    public $timestamps = false;
    protected $fillable = ['id', 'nom', 'prenom', 'dateNaissance', 'email', 'ageDespistageSurdite'];

    public static function add(Request $request){

        $p = new Patient(); // Get an instance of patient table

        // Get the user input values
        $name = filter_var($request->input('name'), FILTER_SANITIZE_STRING);
        $prenom = filter_var($request->input('prenom'), FILTER_SANITIZE_STRING);
        $date_naiss = $request->input('date_naiss');
        $email = $request->input('email');
        $age_depisatage = $request->input('age_depistage_surdite');

        // Pass recovered values
        $p->nom = $name;
        $p->prenom = $prenom;
        $p->dateNaissance = $date_naiss;
        $p->email = $email;
        $p->ageDespistageSurdite = $age_depisatage;

        $request->validate([
            'email' => 'required|email'
        ]);

        $request->validate([
            'age_depistage_surdite' => 'required|integer|min:0|max:120'
        ]);

        if($p->save()){ // If value has been saved, redirect
            return true;
        }
    }

    public function get_incidents() {
        // Create a relation between the patient table and the incident table to obtain all incidents of the specific patient
        return $this->hasMany(Incident::class, 'id_patient');
    }

    // General edit patient method
    public static function edit($id, $name, $lastname, $date, $email, $age_surdite){

        // Get specific patient with its id
        $i = Patient::find($id);

        // Pass recovered value
        $i->nom = filter_var($name, FILTER_SANITIZE_STRING);
        $i->prenom = filter_var($lastname, FILTER_SANITIZE_STRING);
        $i->dateNaissance = $date;
        $i->email = $email;
        $i->ageDespistageSurdite = $age_surdite;

        Validator::make(
            ['age_surdite' => $age_surdite],
            ['age_surdite' => 'required|integer|min:0|max:120']
        );

        Validator::make(
            ['email' => $email],
            ['email' => 'required|email']
        );

        if($i->save()){ // If value has been saved, redirect
            return true;
        }
    }
}
