<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/LocationController.php';
require_once __DIR__ . '/../controllers/PersonnelController.php';
require_once __DIR__ . '/../controllers/ClubMemberController.php';
require_once __DIR__ . '/../controllers/FamilyMemberController.php';
// Add other controllers here...
$controller = new LocationController();
$personnelController = new PersonnelController();
$clubMemberController = new ClubMemberController();
$familyMemberController = new FamilyMemberController();

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
    include __DIR__ . '/../views/home.php';
    break;
    case 'location_display': $controller->display(); break;
    case 'location_create':  $controller->create(); break;
    case 'location_edit':    $controller->edit(); break;
    case 'location_delete':  $controller->delete(); break;
    case 'personnel_display': $personnelController->display(); break;
    case 'personnel_create':  $personnelController->create(); break;
    case 'personnel_edit':    $personnelController->edit(); break;
    case 'personnel_delete':  $personnelController->delete(); break;
    case 'clubmember_index': $clubMemberController ->index(); break;
    case 'clubmember_create': $clubMemberController->create();        break;
    case 'clubmember_edit': $clubMemberController->edit();        break;
    case 'clubmember_delete': $clubMemberController->delete();        break;
    case 'familymember_index': $familyMemberController->index(); break;
    case 'familymember_create':     $familyMemberController->create();     break;
    case 'familymember_edit':     $familyMemberController->edit();     break;
    case 'familymember_delete':     $familyMemberController->delete();     break;


    default: echo "Unknown action.";
}
