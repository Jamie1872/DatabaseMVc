<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/LocationController.php';
require_once __DIR__ . '/../controllers/PersonnelController.php';
require_once __DIR__ . '/../controllers/ClubMemberController.php';
require_once __DIR__ . '/../controllers/FamilyMemberController.php';
require_once __DIR__ . '/../controllers/SecondaryFamilyController.php';
require_once __DIR__ . '/../controllers/TeamController.php';
require_once __DIR__ . '/../controllers/SessionController.php';
require_once __DIR__ . '/../controllers/EmailController.php';//added


require_once __DIR__ . '/../controllers/PaymentController.php';
// Add other controllers here...
$controller = new LocationController();
$personnelController = new PersonnelController();
$clubMemberController = new ClubMemberController();
$familyMemberController = new FamilyMemberController();
$secondaryFamilyController = new SecondaryFamilyController();
$TeamController = new TeamController();
$sessionController = new SessionController();
$emailController = new EmailController(); // added
$PaymentController = new PaymentController();

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
    #case 'headcoach_familymembers_report': $familyMemberController->showHeadCoachFamilyMembers(); break;
    case 'undefeated_report':$clubMemberController->showUndefeatedMembers();break;
    case 'volunteer_family_minors_report': $personnelController->showVolunteerFamilyOfMinors(); break;
    case 'secondaryfamily_index':     $secondaryFamilyController->index();    break;
    case 'secondaryfamily_create':     $secondaryFamilyController->create();     break;
    case 'secondaryfamily_edit':     $secondaryFamilyController->edit();    break;
    case 'secondaryfamily_delete':    $secondaryFamilyController->delete();    break;

    case 'never_assigned_members_report': $clubMemberController->showNeverAssignedMembers(); break;
    case 'active_members_joined_as_minors': $clubMemberController->showActiveMembersJoinedAsMinors(); break;
    case 'setter_only_players_report': $clubMemberController->showSetterOnlyPlayers(); break;
    case 'team_session_report': $sessionController->showTeamSessionReport(); break;
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
    case 'team_assign': $TeamController->assignMembers(); break;
    case 'team_assign_store': $TeamController->assignMembersStore(); break;
    case 'team_assignment_edit': $TeamController->editAssignment(); break;
    case 'team_assignment_update': $TeamController->updateAssignment(); break;
    case 'team_assignment_delete': $TeamController->deleteAssignment(); break;


    case 'session_index': $sessionController->index(); break;
    case 'session_create': $sessionController->create(); break;
    case 'session_store': $sessionController->store(); break;
    case 'session_edit': $sessionController->edit(); break;
    case 'session_update': $sessionController->update(); break;
    case 'session_delete': $sessionController->delete(); break;

    case 'headcoach_dropdown':$familyMemberController->showHeadCoachLocationForm(); break;//added
    case 'headcoach_familymembers_report':$familyMemberController->showHeadCoachFamilyMembers(); break;//added
    case 'generate_emails':$emailController->generateEmails();break; //added
    case 'view_email_log':$emailController->viewEmailLog();break; //added
    case 'add_payment_form': $PaymentController->addPaymentForm(); break;
    case 'submit_payment': $PaymentController->submitPayment(); break;
    case 'view_member_payments': $PaymentController->viewMemberPayments(); break;
    case 'view_all_payments': $PaymentController-> viewAllPayments(); break;

    default: echo "Unknown action.";
}




