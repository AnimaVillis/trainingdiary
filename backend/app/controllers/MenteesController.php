<?php

namespace App\Controllers;
use Leaf\Helpers\Password;



class MenteesController extends Controller
{

    public function index()
    {
        $mentees = db()
            ->select("users
            LEFT JOIN users_info
            ON users.id = users_info.users_id")
            ->fetchAll();
        response()->json([
            "mentees" => $mentees,
        ]);
    }

    public function singleMentee($id) {
            $singlementee = db()
            ->select("users
            LEFT JOIN users_info
            ON users.id = users_info.users_id
            WHERE id = ?")
            ->bind($id)
            ->fetchAssoc();

            if ($singlementee === false) {
                response()->json([
                    "error" => 404,
                    "message" => "There isn't any mentee with this id.",
                ]);
              }
        response()->json([
            "singlementee" => $singlementee,
        ]);
    }

    public function addMentee()
    {

        $name = request()->get('name');
        $email = request()->get('email');
        $password = request()->get('password');

        $hash = Password::hash($password, Password::DEFAULT);

        if($name || $email || $password == NULL) {
            response()->json([
                "error" => 404,
                "message" => "Cannot add new mentee, some fields isn't filled.",
            ]);
        }

        $addmentee = db()
            ->insert("users")
            ->params([
                "name" => $name,
                "email" => $email,
                "password" => $hash
            ])
            ->execute();

        if ($addmentee === false) {
            response()->json([
                "error" => 404,
                "message" => "Cannot add new mentee.",
            ]);
        } else {
            response()->json([
                "error" => 200,
                "message" => "New mentee added sucessfull.",
            ]);
        }
    }
}
