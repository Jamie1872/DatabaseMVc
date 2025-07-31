<?php
require_once __DIR__ . '/../models/Team.php';
require_once __DIR__ . '/../models/Personnel.php';
require_once __DIR__ . '/../models/Location.php';

class TeamController
{
    public function index()
    {
        $teams = Team::getAll();
        include __DIR__ . '/../views/team/index.php';
    }

    public function create()
    {
        $coaches = Personnel::all();
        $locations = Location::all();
        include __DIR__ . '/../views/team/create.php';
    }

    public function store()
    {
        Team::create($_POST);
        header('Location: index.php?action=team_index');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $team = Team::getById($id);
        $coaches = Personnel::all();
        $locations = Location::all();
        include __DIR__ . '/../views/team/edit.php';
    }

    public function update()
    {
        $id = $_POST['team_id'];
        Team::update($id, $_POST);
        header('Location: index.php?action=team_index');
    }

    public function delete()
    {
        $id = $_GET['id'];
        Team::delete($id);
        header('Location: index.php?action=team_index');
    }
}
