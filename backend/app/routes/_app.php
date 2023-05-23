<?php
app()->cors();

app()->get('/', function () {
    response()->json(['message' => 'Leaf API is working!']);
  });

app()->get("/app", function () {
    // app() returns $app
    response()->json(app()->routes());
});

app()->get("/mentees", "MenteesController@index");
app()->get('/mentees/(\d+)', 'MenteesController@singleMentee');
app()->post('/mentees/add', 'MenteesController@addMentee');
app()->post('/mentees/login', 'MenteesController@login');
app()->post('/mentees/weightupdate', 'MenteesController@weightUpdate');
app()->post('/mentees/firstLogin', 'MenteesController@firstlogin');
app()->get('/mentees/info', 'MenteesController@menteeInfo');
