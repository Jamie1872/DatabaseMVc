<?php
require_once __DIR__ . '/../models/Session.php';
require_once __DIR__ . '/../models/Team.php';

class SessionController
{
    public function index()
    {
        $sessions = Session::all();
        include __DIR__ . '/../views/session/index.php';
    }

    public function create()
    {
        $teams = Team::all();
        include __DIR__ . '/../views/session/create.php';
    }

    public function store()
    {
        Session::create($_POST);
        header("Location: index.php?action=session_index");
    }

    public function edit()
    {
        $id = $_GET['id'];
        $session = Session::find($id);
        $teams = Team::all();
        include __DIR__ . '/../views/session/edit.php';
    }

    public function update()
    {
        Session::update($_POST['session_id'], $_POST);
        header("Location: index.php?action=session_index");
    }

    public function delete()
    {
        $id = $_GET['id'];
        Session::delete($id);
        header("Location: index.php?action=session_index");
    }

    # Query 12
    public function showTeamSessionReport() {
        $startDate = $_GET['start_date'] ?? null;
        $endDate = $_GET['end_date'] ?? null;
        $report = [];
    
        if ($startDate && $endDate) {
            $report = Session::getTeamSessionReport($startDate, $endDate);
        }
    
        include __DIR__ . '/../views/session/team_session_report.php';
    }
}
