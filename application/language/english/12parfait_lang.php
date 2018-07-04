<?php
/**
 * System messages translation for 12parfait application
 * @author  Stanislas BRODIN
 */
defined("BASEPATH") OR exit("No direct script access allowed");

// Champs génériques
$lang['yes'] = 'Yes';
$lang['no'] = 'No';
$lang['ok'] = 'OK';
$lang['home'] = 'Home';
$lang['back'] = 'Back';
$lang['cancel'] = 'Cancel';
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
$lang['link_to_home'] = 'Link to home';
$lang['links'] = 'Links';
$lang['view'] = 'View';
$lang['from_the'] = 'from';
$lang['to'] = 'to';
$lang['on'] = 'on';
$lang['contact'] = 'Contact';
$lang['terms_of_use'] = 'Terms of use';
$lang['filter_verb'] = 'Filter';
$lang['filters'] = 'Filters';
$lang['show_hide'] = 'Show / Hide';
$lang['stats'] = 'Stats';
$lang['logo_12parfait'] = '12parfait logo';

// Champs spécifiques à l'application
$lang['application_title'] = '12parfait';
$lang['copyright'] = '&copy; sbrodin, 2015-2018';
$lang['generated_with'] = 'Generated with <a href="http://www.codeigniter.com" rel="noopener">CodeIgniter</a>';
$lang['version'] = 'v. beta';

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
$lang['messages_admin'] = 'Messages admin';
$lang['back_to_messages_admin'] = 'Back to messages admin';
$lang['logs_admin'] = 'Logs admin';
$lang['back_to_home'] = 'Back to home';
$lang['back_to_bets_index'] = 'Back to bets';

// Messages de succès
$lang['profile_modified'] = 'Profile successfully modified !';
$lang['account_successful_creation'] = 'Account successfully created !';
$lang['championship_successful_creation'] = 'Championship successfully created !';
$lang['championship_successful_edition'] = 'Championship successfully edited !';
$lang['team_successful_creation'] = 'Team successfully created !';
$lang['team_successful_edition'] = 'Team successfully edited !';
$lang['success_user_add'] = 'User successfully added !';
$lang['success_user_edit'] = 'User successfully updated !';
$lang['fixture_successful_creation'] = 'Fixture successfully created !';
$lang['fixture_successful_edition'] = 'Fixture successfully edited !';
$lang['fixture_matches_successful_edition'] = 'Fixture matches successfully edited !';
$lang['bets_successful_edition'] = 'Bets successfully edited !';
$lang['message_successful_creation'] = 'Message successfully created !';
$lang['message_successful_edition'] = 'Message successfully edited !';
$lang['message_successfully_sent'] = 'Message successfully sent !';
$lang['password_modified'] = 'Password successfully modified !';

// Messages d'information
$lang['reset_password_email_sent'] = 'Email for password reset successfully sent, please check your inbox.';
$lang['complete_fixture'] = 'Fixture complete.';
$lang['no_match_for_fixture'] = 'No match defined for this fixture.';
$lang['no_fixture_for_championship'] = 'No fixture defined for this championship.';
$lang['user_has_never_played'] = 'This user has never played !';
$lang['match_has_not_started'] = 'This match has not started yet.';
$lang['no_stats_for_match'] = 'No stats available for this match.';

// Messages d'erreur
$lang['incorrect_login'] = 'Wrong email / password.';
$lang['deactivated_account'] = 'Your account has been deactivated.';
$lang['upgrade_browser'] = 'Your browser is not recent enough.';
$lang['not_in_database_email'] = 'No email matches in the database.';
$lang['duplicate_teams'] = 'Some teams appear more than once.';

// Messages de contrôle des formulaires
$lang['required_field'] = 'The field "%s" is required.';
$lang['already_in_db_field'] = 'The field "%s" already exists.';
$lang['must_match_field'] = 'The field "%s" must match field "%s".';
$lang['must_differ_field'] = 'The field "%s" must be different from field "%s".';
$lang['valid_email'] = 'The field "%s" is not a valid email.';
$lang['min_length_field'] = 'The field "%s" must contain at least %s characters.';
$lang['must_contain_uppercase_field'] = 'The field "%s" must contain at least one capital letter.';
$lang['must_contain_lowercase_field'] = 'The field "%s" must contain at least one lower case letter.';
$lang['must_contain_number_field'] = 'The field "%s" must contain at least one number.';
$lang['must_be_year_field'] = 'The field "%s" must be a year greater than or equal to 2016.';
$lang['too_long_5_field'] = 'The field "%s" must not be more than 5 character long.';

// Emails
$lang['welcome_email_subject'] = 'Welcome on 12parfait !';

// Profil
$lang['profile'] = 'Profile';
$lang['create_account'] = 'Create account';
$lang['forgotten_password'] = 'Forgotten password ?';
$lang['reset_password'] = 'Reset password';
$lang['profile_edit'] = 'Edit profile';
$lang['my_profile_edit'] = 'Edit my profile';
$lang['profile_password_edit'] = 'Password edition';
$lang['my_password_edit'] = 'Edit my password';

// Championships
$lang['championship'] = 'Championship';
$lang['championships'] = 'Championships';
$lang['add_championship'] = 'Add a championship';
$lang['edit_championship'] = 'Edit a championship';
$lang['championship_name'] = 'Championship name';
$lang['sport'] = 'Sport';
$lang['football'] = 'Football';
$lang['rugby'] = 'Rugby';
$lang['country'] = 'Country';
$lang['france'] = 'France';
$lang['europe'] = 'Europe';
$lang['world'] = 'World';
$lang['level'] = 'Level';
$lang['year'] = 'Year';
$lang['activate_championship'] = 'Activate';
$lang['deactivate_championship'] = 'Deactivate';

// Equipes
$lang['team'] = 'Team';
$lang['add_team'] = 'Add a team';
$lang['team_name'] = 'Team name';
$lang['team_short_name'] = 'Short name';
$lang['local'] = 'Local';
$lang['national'] = 'National';
$lang['edit_team'] = 'Edit';

// Matches
$lang['match'] = 'Match';
$lang['add_match'] = 'Add a match';
$lang['edit_matches'] = 'Edit matches';
$lang['choose_championship'] = 'Choose this championship';
$lang['team1'] = 'Team 1';
$lang['team2'] = 'Team 2';
$lang['match_date'] = 'Date';
$lang['yesterday_matches'] = 'Yesterday matches';
$lang['today_matches'] = 'Today matches';
$lang['tomorrow_matches'] = 'Tomorrow matches';
$lang['last_matches'] = 'Last matches';
$lang['next_matches'] = 'Next matches,<br />on %s';
$lang['no_match_this_day'] = 'No match this day';
$lang['no_match_yesterday'] = 'No match yesterday';
$lang['no_match_today'] = 'No match today';
$lang['no_match_tomorrow'] = 'No match tomorrow';
$lang['no_match_3days'] = 'No match yesterday, today, nor tomorrow';

// Journée
$lang['fixture'] = 'Fixture';
$lang['add_fixture'] = 'Add a fixture';
$lang['edit_fixture'] = 'Edit fixture';
$lang['enter_fixture_results'] = 'Enter fixture results';
$lang['choose_fixture'] = 'Choose this fixture';
$lang['fixture_name'] = 'Fixture name';
$lang['close_fixture'] = 'Close';
$lang['open_fixture'] = 'Open fixture';

// Message
$lang['message'] = 'Message';
$lang['add_message'] = 'Add a message';
$lang['edit_message'] = 'Edit the message';
$lang['message_name'] = 'Message name';
$lang['message_language'] = 'Language';
$lang['message_content'] = 'Content';
$lang['french_content'] = 'French content';
$lang['english_content'] = 'English content';

// Log
$lang['log'] = 'Log';
$lang['view_logs'] = 'View logs';
$lang['log_controller'] = 'Controller';
$lang['log_method'] = 'Method';
$lang['log_userip'] = 'IP';
$lang['log_userid'] = 'User ID';
$lang['log_message'] = 'Log message';
$lang['log_date'] = 'Log date';

$lang['add_a_user'] = 'Add a user';
$lang['index_user'] = 'Users list';
$lang['first_name'] = 'First name';
$lang['last_name'] = 'Last name';
$lang['user_name'] = 'Username';
$lang['rand_userid'] = 'Rand id';
$lang['password'] = 'Password';
$lang['password_rules'] = '(min 8 characters, 1 uppercase letter, 1 lowercase letter and 1 number)';
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

// Pari
$lang['bets'] = 'Bets';
$lang['place_bet'] = 'Bet !';
$lang['add_edit_bet'] = 'Bet !';
$lang['my_bets'] = 'My bets';
$lang['bets_of'] = 'Bets of';
$lang['view_bets_of'] = 'View bets of';
$lang['score_of_home_against'] = 'Score of %s at home against %s';
$lang['score_of_out_against'] = 'Score of %s outside against %s';
$lang['result'] = 'Result';
$lang['result_short'] = 'Res.';
$lang['results'] = 'Results';
$lang['not_available'] = 'Not available';
$lang['not_available_short'] = 'N/A';

// Scores
$lang['define_username_profile'] = 'If your name is not displayed it means that you have not defined a username. <br/> Go to "<a class="alert-link" href="%s">'.$lang['profile'].'</a>" (top right corner) to edit that right now !';
$lang['ladder'] = 'Ladder';
$lang['score'] = 'Score';
$lang['scores'] = 'Scores';
$lang['my_score'] = 'My score';
$lang['my_scores'] = 'My&nbsp;scores';
$lang['scores_of_player'] = 'Scores of player';
$lang['anonymous'] = 'Anonymous';
$lang['del_filter'] = 'Delete filters';
$lang['nb_12parfait'] = 'Number 12parfait';
$lang['congratulations'] = 'Congratulations !';
$lang['can_do_better'] = 'You can do better !';
$lang['you_have_x_scores_12'] = 'You have <span class="tag tag-success">%d</span> 12parfait.';
$lang['you_have_x_scores_7'] = 'You have <span class="tag tag-success">%d</span> 7pts score(s).';
$lang['you_have_x_scores_6'] = 'You have <span class="tag tag-success">%d</span> 6pts score(s).';
$lang['you_have_x_scores_4'] = 'You have <span class="tag tag-success">%d</span> 4pts score(s).';
$lang['you_have_x_scores_3'] = 'You have <span class="tag tag-success">%d</span> 3pts score(s).';
$lang['you_have_x_scores_0'] = 'You have <span class="tag tag-success">%d</span> 0pts score(s).';
$lang['player_has_x_scores_12'] = 'The player has <span class="tag tag-warning">%d</span> 12parfait.';
$lang['player_has_x_scores_7'] = 'The player has <span class="tag tag-warning">%d</span> 7pts score(s).';
$lang['player_has_x_scores_6'] = 'The player has <span class="tag tag-warning">%d</span> 6pts score(s).';
$lang['player_has_x_scores_4'] = 'The player has <span class="tag tag-warning">%d</span> 4pts score(s).';
$lang['player_has_x_scores_3'] = 'The player has <span class="tag tag-warning">%d</span> 3pts score(s).';
$lang['player_has_x_scores_0'] = 'The player has <span class="tag tag-warning">%d</span> 0pts score(s).';
$lang['scores_12parfait'] = '12parfait';
$lang['scores_7_points'] = '7 points';
$lang['scores_6_points'] = '6 points';
$lang['scores_4_points'] = '4 points';
$lang['scores_3_points'] = '3 points';
$lang['scores_0_points'] = '0 points';
$lang['stats_on_x_bets'] = 'Among your %d bets, you have :';
$lang['stats_on_x_points'] = 'Your %d points are distributed this way :';
$lang['stats_on_x_bets_player'] = 'Among their %d bets, the player has :';
$lang['stats_on_x_points_player'] = 'Their %d points are distributed this way :';
$lang['points_short'] = 'pts';

// Contact
$lang['motif'] = 'Object';
$lang['your_name'] = 'Your name';
$lang['your_message'] = 'Your message';
$lang['idea_evolution'] = 'Evolution idea';
$lang['evolution'] = 'Evolution';
$lang['critic'] = 'Critic';
$lang['error_result'] = 'Result mistake';
$lang['bug'] = 'Bug';
$lang['other'] = 'Other';
$lang['send_message'] = 'Send message';

// Maintenance / Construction
$lang['maintenance'] = 'Maintenance';
$lang['construction'] = 'Construction';

// Match
$lang['match_stats'] = 'Match stats';
$lang['result_distribution'] = 'Bet results distribution';
$lang['home_victory_count'] = 'Victories';
$lang['draw_count'] = 'Draws';
$lang['away_victory_count'] = 'Losses';
$lang['bets_count'] = 'Bets total';
$lang['goals_bet_count'] = 'Goals bet total';
$lang['home_goals_count'] = 'Home team';
$lang['away_goals_count'] = 'Away team';
$lang['average_goals_bet'] = 'Average goals bet';
$lang['average_home_goals_count'] = 'Home team';
$lang['average_away_goals_count'] = 'Away team';
$lang['no_bet_yet'] = 'No bet for this match yet !';
$lang['x_bets_placed'] = '%d bets for this match !';