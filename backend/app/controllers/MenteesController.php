<?php

namespace App\Controllers;
use Leaf\Helpers\Password;
use App\Models\User;
use Leaf\Helpers\Authentication;

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

    public function login()
    {
        $credentials = request()->get(['email', 'password']);
        $user = User::where('email', $credentials['email'])->first();

        $user = auth()->login($credentials);

        if (!$user) {
            response()->exit(auth()->errors());
        }

        response()->json($user);
    }

    public function menteeInfo()
    {
        auth()->useSession();

        if (auth()->status()) {
            $id = auth()->id();

            $menteeInfo = db()
            ->select("users
            LEFT JOIN users_info
            ON users.id = users_info.users_id
            WHERE id = ?")
            ->hidden("password")
            ->bind($id)
            ->fetchAssoc();

            response()->json([
                "menteeinfo" => $menteeInfo,
            ]);
          } else {
            response()->json([
                "error" => 404,
                "message" => "User isn't logged in.",
            ]);
          }
    }

    public function addMentee()
    {

        $name = request()->get('name');
        $email = request()->get('email');
        $password = request()->get('password');

        $hash = Password::hash($password, Password::DEFAULT);

        if(!$name || !$email || !$password) {
            response()->exit([
                'error' => '404',
                'message' => "One of required fields isn't filled.",
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
