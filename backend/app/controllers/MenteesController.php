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

        if(!$credentials['email'] || !$credentials['password']) {
            response()->exit([
                'error' => 400,
                'message' => "One of required fields isn't filled.",
            ]);
        }
        $user = User::where('email', $credentials['email'])->first();

        $user = auth()->login($credentials);

        if (!$user) {
            response()->exit(auth()->errors());
        }

        response()->json($user);
    }

    public function menteeInfo()
    {
        if (auth()->user()) {
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
                "error" => 401,
                "message" => "User isn't logged in.",
            ]);
          }
    }

    public function weightUpdate()
    {
        if (auth()->user()) {
            $id = auth()->id();

            $new_weight = request()->get('new_weight');

            if(!$new_weight) {
                response()->exit([
                    "error" => 404,
                    "message" => "Empty fields",
                ]);
            }

            $weight_update = db()
            ->update("users_info")
            ->params(["current_weight" => $new_weight])
            ->where("users_id", $id)
            ->execute();

            $weight_update_log = db()
            ->insert("users_weights")
            ->params([
              "users_id" => $id,
              "new_weight" => $new_weight
            ])
            ->execute();

            if($weight_update && $weight_update_log) {
                response()->json([
                    "error" => 200,
                    "message" => "Weight update successfully.",
                ]);
            } else {
                response()->json([
                    "error" => 500,
                    "message" => "Weight can't be updated.",
                ]);
            }
          } else {
            response()->json([
                "error" => 401,
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
        $activation_hash_generated = Password::hash($email, Password::DEFAULT);

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
                "password" => $hash,
                "activation_hash" => $activation_hash_generated
            ])
            ->execute();

        if ($addmentee === false) {
            response()->json([
                "error" => 401,
                "message" => "Cannot add new mentee.",
            ]);
        } else {
            response()->json([
                "error" => 200,
                "message" => "New mentee added sucessfull.",
            ]);
        }
    }

    public function firstLogin()
    {

        $users_id = auth()->id();
        $initial_weight = request()->get('initial_weight');
        $current_weight = request()->get('current_weight');
        $target_weight = request()->get('target_weight');
        $growth = request()->get('growth');
        $age = request()->get('age');
        $activity_factor = request()->get('activity_factor');
        $sex = request()->get('sex');

        if(!$initial_weight || !$current_weight || !$target_weight || !$growth || !$age || !$activity_factor || !$sex) {
            response()->exit([
                'error' => '404',
                'message' => "One of required fields isn't filled.",
            ]);
        }


        $firstLogin = db()
            ->insert("users_info")
            ->params([
                "users_id" => $id,
                "initial_weight" => $initial_weight,
                "current_weight" => $current_weight,
                "target_weight" => $target_weight,
                "growth" => $growth,
                "age" => $age,
                "activity_factor" => $activity_factor,
                "sex" => $sex
            ])
            ->execute();

        if ($firstLogin === false) {
            response()->json([
                "error" => 404,
                "message" => "Cannot insert yours first login data.",
            ]);
        } else {
            response()->json([
                "error" => 200,
                "message" => "Your's first login data successfully inserted into database.",
            ]);
        }
    }
}
