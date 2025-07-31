<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/LocationController.php';
require_once __DIR__ . '/../controllers/PersonnelController.php';
require_once __DIR__ . '/../controllers/ClubMemberController.php';
require_once __DIR__ . '/../controllers/FamilyMemberController.php';
require_once __DIR__ . '/../controllers/SecondaryFamilyController.php';
require_once __DIR__ . '/../controllers/TeamController.php';
require_once __DIR__ . '/../controllers/SessionController.php';
// Add other controllers here...
$controller = new LocationController();
$personnelController = new PersonnelController();
$clubMemberController = new ClubMemberController();
$familyMemberController = new FamilyMemberController();
$secondaryFamilyController = new SecondaryFamilyController();
$TeamController = new TeamController();
$sessionController = new SessionController();

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
    include __DIR__ . '/../views/home.php';
    break;
    case 'location_display': $controller->display(); break;
    case 'location_create':  $controller->create(); break;
    case 'location_edit':    $controller->edit(); break;
    case 'location_delete':  $controller->delete(); break;
    case 'location_full_details': $controller->fullDetails(); break;
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
    case 'role_complete_report': $clubMemberController->showRoleCompleteMembers(); break;
    case 'headcoach_familymembers_report': $familyMemberController->showHeadCoachFamilyMembers(); break;
    case 'undefeated_report':$clubMemberController->showUndefeatedMembers();break;
    case 'volunteer_family_minors_report': $personnelController->showVolunteerFamilyOfMinors(); break;
    case 'secondaryfamily_index':     $secondaryFamilyController->index();    break;
    case 'secondaryfamily_create':     $secondaryFamilyController->create();     break;
    case 'secondaryfamily_edit':     $secondaryFamilyController->edit();    break;
    case 'secondaryfamily_delete':    $secondaryFamilyController->delete();    break;
    case 'familymember_getAssociatedMembers':     $familyMemberController->getAssociatedMembers();     break;
    case 'inactive_members_display': $clubMemberController->inactiveMembersDisplay(); break;
    case 'display_formation_form': $TeamController->displayFilterForm(); break;
    case 'formation_filter_results': $TeamController->filterResults(); break;


    case 'team_index': $TeamController->index(); break;
    case 'team_create': $TeamController->create(); break;
    case 'team_store': $TeamController->store(); break;
    case 'team_edit': $TeamController->edit(); break;
    case 'team_update': $TeamController->update(); break;
    case 'team_delete': $TeamController->delete(); break;
        case 'session_index': $sessionController->index(); break;
    case 'session_create': $sessionController->create(); break;
    case 'session_store': $sessionController->store(); break;
    case 'session_edit': $sessionController->edit(); break;
    case 'session_update': $sessionController->update(); break;
    case 'session_delete': $sessionController->delete(); break;




    default: echo "Unknown action.";
}



