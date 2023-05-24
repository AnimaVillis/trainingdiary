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
                'error' => '404',
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
                "error" => 404,
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
                    "newWeight" => $new_weight,
                    "message" => "Weight update successfully.",
                ]);
            } else {
                response()->json([
                    "error" => 404,
                    "message" => "Weight can't be updated.",
                ]);
            }
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

    public function activateMentee()
    {
        if (auth()->user()) {
            $id = auth()->id();

            $menteeActivation = db()
            ->select("users WHERE id = ?")
            ->hidden(["password"], ["user_level"], ["first_login"])
            ->bind($id)
            ->fetchAssoc();

            $name = $menteeActivation['name'];
            $email = $menteeActivation['email'];
            $activation_hash = $menteeActivation['activation_hash'];
            $link = "http://localhost:3001/mentees/activate/$activation_hash";

            if($menteeActivation['account_activation'] == 0){
                $mail = new \Leaf\Mail;
                $mail->smtp_connect('smtp.gmail.com', 587, true, 'tailwindcssforum@gmail.com', 'yeuashogkaycesoo', 'STARTTLS');
                $mail->isHTML(true);

                $email = $mail->write([
                    "subject" => "Hi $name! Here's you'r activation code!",
                    "sender_name" => "Training Diary - Activation Url",
                    "body" => "Hello <b>$name</b>!<br>
                    I would like to send You an activation link!<br>
                    <br>
                    $link<br>
                    <br>
                    Hope this simple app will be usefull for You!<br>
                    Best regards,
                    <b>Training Diary</b> Development Team!",
                    "sender_email" => "trainingdiary@test.com",
                    "recepient_email" => $email
                ]);

                if (!$email) {
                    app()->response()->exit($mail->errors());
                }

                $email->send();

                response()->json([
                    "error" => 200,
                    "message" => "Activation link, was sended.",
                ]);
            }
          } else {
            response()->json([
                "error" => 404,
                "message" => "User isn't logged in.",
            ]);
          }
    }
}
