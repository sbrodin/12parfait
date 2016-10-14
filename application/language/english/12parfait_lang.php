<?php
/**
 * System messages translation for 12parfait application
 * @author  Stanislas BRODIN
 */
defined("BASEPATH") OR exit("No direct script access allowed");

// Champs génériques
$lang['yes'] = 'Yes';
$lang['no'] = 'No';
$lang['home'] = 'Home';
$lang['back'] = 'Back';
$lang['confirm'] = 'Confirm';
$lang['user'] = 'User';
$lang['users'] = 'Users';
$lang['log_in'] = 'Log in';
$lang['log_out'] = 'Log out';
$lang['search'] = 'Search';
$lang['admin'] = 'Admin';
$lang['12_parfait'] = '12parfait';
$lang['add'] = 'Add';
$lang['edit'] = 'Edit';

// Champs spécifiques à l'application
$lang['application_title'] = '12parfait';
$lang['copyright'] = '&copy; sbrodin, 2016<br/>Generated with <a href="http://www.codeigniter.com">CodeIgniter</a>';

// Menu admin
$lang['site_admin'] = 'Site admin';
$lang['back_to_site_admin'] = 'Back to site admin';
$lang['users_admin'] = 'Users admin';
$lang['back_to_users_admin'] = 'Back to users admin';
$lang['championships_admin'] = 'Championships admin';
$lang['back_to_championships_admin'] = 'Back to championships admin';
$lang['teams_admin'] = 'Teams admin';
$lang['back_to_teams_admin'] = 'Back to teams admin';
$lang['matches_admin'] = 'Matches admin';
$lang['back_to_matches_admin'] = 'Back to matches admin';
$lang['fixtures_admin'] = 'Fixtures admin';
$lang['back_to_fixtures_admin'] = 'Back to fixtures admin';

// Messages de succès
$lang['profile_modified'] = 'Profile successfully modified !';
$lang['account_successful_creation'] = 'Account successfully created !';
$lang['championship_successful_creation'] = 'Championship successfully created !';
$lang['championship_successful_edition'] = 'Championship successfully edited !';
$lang['team_successful_creation'] = 'Team successfully created !';
$lang['success_user_add'] = 'User successfully added !';
$lang['success_user_edit'] = 'User successfully updated !';
$lang['fixture_successful_creation'] = 'Ficture successfully created !';
$lang['fixture_successful_edition'] = 'Ficture successfully edited !';
$lang['fixture_matches_successful_edition'] = 'Fixture matches successfully edited !';

// Messages d'information
$lang['reset_password_email_sent'] = 'Email for password reset successfully sent, please check your inbox.';
$lang['complete_fixture'] = 'Fixture complete.';
$lang['no_match_for_fixture'] = 'No match defined for this fixture.';
$lang['no_fixture_for_championship'] = 'No fixture defined for this championship.';

// Messages d'erreur
$lang['incorrect_login'] = 'Wrong email / password.';
$lang['deactivated_account'] = 'Your account has been deactivated.';
$lang['upgrade_browser'] = 'Your browser is not recent enough.';
$lang['not_in_database_email'] = 'No email matches in the database.';
$lang['duplicate_teams'] = 'Some teams appear more than once.';

// Messages de contrôle des formulaires
$lang['required_field'] = 'The field "%s" is required.';
$lang['already_in_db_field'] = 'The field "%s" already exists in database.';
$lang['must_match_field'] = 'The field "%s" must match field "%s".';
$lang['must_differ_field'] = 'The field "%s" must be different from field "%s".';
$lang['valid_email'] = 'The field "%s" is not a valid email.';
$lang['min_length_field'] = 'The field "%s" must contain at least %s characters.';
$lang['must_contain_uppercase_field'] = 'The field "%s" must contain at least one capital letter.';
$lang['must_contain_lowercase_field'] = 'The field "%s" must contain at least one lower case letter.';
$lang['must_contain_number_field'] = 'The field "%s" must contain at least one number.';
$lang['must_be_year_field'] = 'The field "%s" must be a year greater than or equal to 2016.';

// Profil
$lang['profile'] = 'Profile';
$lang['create_account'] = 'Create account';
$lang['forgotten_password'] = 'Forgotten password ?';
$lang['reset_password'] = 'Reset password';
$lang['profile_edit'] = 'Edit profile';
$lang['my_profile_edit'] = 'Edit my profile';

// Championships
$lang['championship'] = 'Championship';
$lang['add_championship'] = 'Add a championship';
$lang['championship_name'] = 'Championship name';
$lang['sport'] = 'Sport';
$lang['football'] = 'Football';
$lang['country'] = 'Country';
$lang['france'] = 'France';
$lang['level'] = 'Level';
$lang['year'] = 'Year';
$lang['edit_championship'] = 'Edit';

// Equipes
$lang['team'] = 'Team';
$lang['add_team'] = 'Add a team';
$lang['team_name'] = 'Team name';
$lang['edit_team'] = 'Edit';

// Matchs
$lang['match'] = 'Match';
$lang['add_match'] = 'Add a match';
$lang['edit_matches'] = 'Edit matches';
$lang['choose_championship'] = 'Choose this championship';
$lang['team1'] = 'Team 1';
$lang['team2'] = 'Team 2';
$lang['match_date'] = 'Date';

// Journée
$lang['fixture'] = 'Fixture';
$lang['add_fixture'] = 'Add a fixture';
$lang['edit_fixture'] = 'Edit fixture';
$lang['enter_fixture_results'] = 'Enter fixture results';
$lang['choose_fixture'] = 'Choose this fixture';
$lang['fixture_name'] = 'Fixture name';

$lang['add_a_user'] = 'Add a user';
$lang['first_name'] = 'First name';
$lang['last_name'] = 'Last name';
$lang['user_name'] = 'Username';
$lang['password'] = 'Password';
$lang['password_confirmation'] = 'Password confirmation';
$lang['new_password'] = 'New password';
$lang['new_password_confirmation'] = 'New password confirmation';
$lang['email'] = 'Email';
$lang['isadmin'] = 'Admin ?';
$lang['add_user'] = 'Add user';
$lang['view_user'] = 'View';
$lang['never_connected'] = 'Has never logged in';
$lang['activate_user'] = 'Activate';
$lang['deactivate_user'] = 'Deactivate';
$lang['promote_user'] = 'Promote';
$lang['demote_user'] = 'Demote';

$lang['language'] = 'Language';
$lang['french'] = 'French';
$lang['english'] = 'English';
$lang['add_date'] = 'Creation date';
$lang['last_connection'] = 'Last connection';
$lang['score'] = 'Score';
$lang['acl'] = 'Acl';
$lang['is_active'] = 'Active ?';
$lang['activate_deactivate'] = 'Activate / Deactivate';
$lang['promote_demote'] = 'Promote / Desmote';
$lang['no_data'] = 'N/A';

$lang['cancel'] = 'Cancel';