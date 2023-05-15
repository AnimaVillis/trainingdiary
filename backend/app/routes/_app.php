<?php
app()->get('/', function () {
    response()->json(['message' => 'Leaf is amazing!']);
  });

app()->get("/app", function () {
    // app() returns $app
    response()->json(app()->routes());
});

app()->get("/mentees", "MenteesController@index");
app()->get('/mentees/(\d+)', 'MenteesController@singleMentee');
