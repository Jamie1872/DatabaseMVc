<?php
require_once __DIR__ . '/../models/SecondaryFamilyMember.php';

class SecondaryFamilyController
{
    public function index()
    {
        $model = new SecondaryFamilyMember();
        $members = $model->getAll();
        include __DIR__ . '/../views/secondaryfamily/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone_number' => $_POST['phone_number'],
            ];

            $model = new SecondaryFamilyMember();
            $model->create($data);
            header('Location: ?action=secondaryfamily_index');
            exit;
        }

        include __DIR__ . '/../views/secondaryfamily/create.php';
    }


    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?action=secondaryfamily_index');
            exit;
        }

        $model = new SecondaryFamilyMember();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone_number' => $_POST['phone_number'],
            ];

            $model->update($id, $data);
            header('Location: ?action=secondaryfamily_index');
            exit;
        }

        $member = $model->getById($id);
        if (!$member) {
            header('Location: ?action=secondaryfamily_index');
            exit;
        }

        include __DIR__ . '/../views/secondaryfamily/edit.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $model = new SecondaryFamilyMember();
            $model->delete($id);
        }
        header('Location: ?action=secondaryfamily_index');
        exit;
    }
}
