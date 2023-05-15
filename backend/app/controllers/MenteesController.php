<?php

namespace App\Controllers;


class MenteesController extends Controller
{

    public function index()
    {
        //$mentees = db()->select('users')->all();
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


}
