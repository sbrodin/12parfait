<?php
/**
 * System messages translation for 12parfait application
 * @author  Stanislas BRODIN
 */
defined("BASEPATH") OR exit("No direct script access allowed");

// Champs génériques
$lang['yes'] = 'Oui';
$lang['no'] = 'Non';
$lang['home'] = 'Accueil';
$lang['back'] = 'Retour';
$lang['confirm'] = 'Valider';
$lang['user'] = 'Utilisateur';
$lang['users'] = 'Utilisateurs';
$lang['log_in'] = 'Connexion';
$lang['log_out'] = 'Déconnexion';
$lang['search'] = 'Recherche';
$lang['admin'] = 'Admin';
$lang['12_parfait'] = '12parfait';
$lang['add'] = 'Ajouter';
$lang['edit'] = 'Editer';
$lang['link_to_home'] = 'Lien vers la page d\'accueil';
$lang['view'] = 'Voir';
$lang['contact'] = 'Contact';

// Champs spécifiques à l'application
$lang['application_title'] = '12parfait';
$lang['copyright'] = '&copy; sbrodin, 2015';
$lang['generated_with'] = 'Generated with <a href="http://www.codeigniter.com">CodeIgniter</a>';
$lang['version'] = 'v. alpha';

// Menu admin
$lang['site_admin'] = 'Gestion du site';
$lang['back_to_site_admin'] = 'Retour à la gestion du site';
$lang['users_admin'] = 'Gestion des utilisateurs';
$lang['back_to_users_admin'] = 'Retour à la gestion des utilisateurs';
$lang['championships_admin'] = 'Gestion des championnats';
$lang['back_to_championships_admin'] = 'Retour à la gestion des championnats';
$lang['teams_admin'] = 'Gestion des équipes';
$lang['back_to_teams_admin'] = 'Retour à la gestion des équipes';
$lang['matches_admin'] = 'Gestion des matchs';
$lang['back_to_matches_admin'] = 'Retour à la gestion des matchs';
$lang['fixtures_admin'] = 'Gestion des journées';
$lang['back_to_fixtures_admin'] = 'Retour à la gestion des journées';
$lang['back_to_home'] = 'Retour à l\'accueil';
$lang['back_to_bets_index'] = 'Retour aux paris';

// Messages de succès
$lang['profile_modified'] = 'Profil modifié avec succès !';
$lang['account_successful_creation'] = 'Compte créé avec succès !';
$lang['championship_successful_creation'] = 'Championnat créé avec succès !';
$lang['championship_successful_edition'] = 'Championnat édité avec succès !';
$lang['team_successful_creation'] = 'Equipe créée avec succès !';
$lang['team_successful_edition'] = 'Equipe mise à jour avec succès !';
$lang['success_user_add'] = 'Utilisateur ajouté avec succès !';
$lang['success_user_edit'] = 'Utilisateur mis à jour avec succès !';
$lang['fixture_successful_creation'] = 'Journée créée avec succès !';
$lang['fixture_successful_edition'] = 'Journée éditée avec succès !';
$lang['fixture_matches_successful_edition'] = 'Résultats de la journée édités avec succès !';

// Messages d'information
$lang['reset_password_email_sent'] = 'Email pour la réinitialisation du mot de passe envoyé, veuillez vérifier votre boîte mail.';
$lang['complete_fixture'] = 'Journée complète.';
$lang['no_match_for_fixture'] = 'Aucun match défini pour cette journée.';
$lang['no_fixture_for_championship'] = 'Aucune journée remplie pour ce championnat.';

// Messages d'erreur
$lang['incorrect_login'] = 'Mauvaise paire email / mot de passe.';
$lang['deactivated_account'] = 'Votre compte a été désactivé.';
$lang['upgrade_browser'] = 'Votre navigateur n\'est pas assez récent.';
$lang['not_in_database_email'] = 'Aucun email ne correspond en base.';
$lang['duplicate_teams'] = 'Des équipes apparaissent plusieurs fois.';

// Messages de contrôle des formulaires
$lang['required_field'] = 'Le champ "%s" est requis.';
$lang['already_in_db_field'] = 'Le champ "%s" existe déjà.';
$lang['must_match_field'] = 'Le champ "%s" doit correspondre au champ "%s".';
$lang['must_differ_field'] = 'Le champ "%s" doit être différent du champ "%s".';
$lang['valid_email'] = 'Le champ "%s" n\'est pas un email valide.';
$lang['min_length_field'] = 'Le champ "%s" doit contenir au moins %s caractères.';
$lang['must_contain_uppercase_field'] = 'Le champ "%s" doit contenir au moins une majuscule.';
$lang['must_contain_lowercase_field'] = 'Le champ "%s" doit contenir au moins une minuscule.';
$lang['must_contain_number_field'] = 'Le champ "%s" doit contenir au moins un chiffre.';
$lang['must_be_year_field'] = 'Le champ "%s" doit être une année supérieure ou égale à 2016.';
$lang['too_long_5_field'] = 'Le champ "%s" ne doit pas faire plus de 5 caractères.';

// Profil
$lang['profile'] = 'Profil';
$lang['create_account'] = 'Créer un compte';
$lang['forgotten_password'] = 'Mot de passe oublié ?';
$lang['reset_password'] = 'Réinitialiser le mot de passe';
$lang['profile_edit'] = 'Editer le profil';
$lang['my_profile_edit'] = 'Editer mon profil';

// Championnats
$lang['championship'] = 'Championnat';
$lang['championships'] = 'Championnats';
$lang['add_championship'] = 'Ajouter un championnat';
$lang['edit_championship'] = 'Editer un championnat';
$lang['championship_name'] = 'Nom du championnat';
$lang['sport'] = 'Sport';
$lang['football'] = 'Football';
$lang['rugby'] = 'Rugby';
$lang['country'] = 'Pays';
$lang['france'] = 'France';
$lang['europe'] = 'Europe';
$lang['level'] = 'Niveau';
$lang['year'] = 'Année';
$lang['activate_championship'] = 'Activer';
$lang['deactivate_championship'] = 'Désactiver';

// Equipes
$lang['team'] = 'Equipe';
$lang['add_team'] = 'Ajouter une équipe';
$lang['team_name'] = 'Nom de l\'équipe';
$lang['team_short_name'] = 'Nom court';
$lang['edit_team'] = 'Editer';

// Matchs
$lang['match'] = 'Match';
$lang['add_match'] = 'Ajouter un match';
$lang['edit_matches'] = 'Editer les matchs';
$lang['choose_championship'] = 'Choisir ce championnat';
$lang['team1'] = 'Equipe 1';
$lang['team2'] = 'Equipe 2';
$lang['match_date'] = 'Date';
$lang['yesterday_matches'] = 'Matchs d\'hier';
$lang['today_matches'] = 'Matchs du jour';
$lang['tomorrow_matches'] = 'Matchs de demain';
$lang['no_match_this_day'] = 'Pas de match pour ce jour';
$lang['no_match_yesterday'] = 'Pas de match hier';
$lang['no_match_today'] = 'Pas de match aujourd\'hui';
$lang['no_match_tomorrow'] = 'Pas de match demain';
$lang['no_match_3days'] = 'Pas de match hier, aujourd\'hui, ou demain';

// Journée
$lang['fixture'] = 'Journée';
$lang['add_fixture'] = 'Ajouter une journée';
$lang['edit_fixture'] = 'Editer la journée';
$lang['enter_fixture_results'] = 'Entrer les résultats';
$lang['choose_fixture'] = 'Choisir cette journée';
$lang['fixture_name'] = 'Nom de la journée';
$lang['close_fixture'] = 'Fermer';
$lang['open_fixture'] = 'Ouvrir la journée';

$lang['add_a_user'] = 'Ajouter un utilisateur';
$lang['index_user'] = 'Liste des utilisateurs';
$lang['first_name'] = 'Prénom';
$lang['last_name'] = 'Nom';
$lang['user_name'] = 'Nom d\'utilisateur';
$lang['password'] = 'Mot de passe';
$lang['password_rules'] = '(min 8 caractères, 1 majuscule, 1 minuscule et 1 chiffre)';
$lang['password_confirmation'] = 'Confirmation du mot de passe';
$lang['new_password'] = 'Nouveau mot de passe';
$lang['new_password_confirmation'] = 'Confirmation du nouveau mot de passe';
$lang['email'] = 'Email';
$lang['isadmin'] = 'Admin ?';
$lang['add_user'] = 'Ajouter l\'utilisateur';
$lang['no_password_message'] = 'Si aucun mot de passe n\'est entré, le nom d\'utilisateur sera utilisé comme mot de passe';
$lang['never_connected'] = 'Ne s\'est jamais connecté';
$lang['incorrect_email'] = "Le champ %s ne correspond pas à une adresse email valide";
$lang['edit_user'] = 'Mettre à jour';
$lang['activate_user'] = 'Activer';
$lang['deactivate_user'] = 'Désactiver';
$lang['promote_user'] = 'Promouvoir';
$lang['demote_user'] = 'Destituer';

$lang['language'] = 'Langue';
$lang['french'] = 'Français';
$lang['english'] = 'Anglais';
$lang['add_date'] = 'Date d\'inscription';
$lang['you_are_in_since'] = 'Vous êtes inscrit depuis le ';
$lang['last_connection'] = 'Dernière connexion';
$lang['score'] = 'Score';
$lang['my_score'] = 'Mon score';
$lang['acl'] = 'acl';
$lang['is_active'] = 'Actif ?';
$lang['activate_deactivate'] = 'Activer / Désactiver';
$lang['promote_demote'] = 'Promouvoir / Destituer';
$lang['no_data'] = 'N/A';

$lang['cancel'] = 'Annuler';

// Pari
$lang['place_bet'] = 'Parier !';
$lang['add_edit_bet'] = 'Parier !';
$lang['my_bets'] = 'Mes paris';
$lang['result'] = 'Résultat';
$lang['result_short'] = 'Rés.';
$lang['results'] = 'Résultats';
$lang['not_available'] = 'Non disponible';
$lang['not_available_short'] = 'N/A';

// Scores
$lang['view_ladder'] = 'Classement';
$lang['view_my_scores'] = 'Mes scores';
$lang['anonymous'] = 'Anonyme';
$lang['nb_12parfait'] = 'Nombre 12parfait';
$lang['congratulations'] = 'Félicitations !';
$lang['can_do_better'] = 'Vous pouvez faire mieux !';
$lang['you_have_x_scores_12'] = 'Vous avez %d 12parfait.';
$lang['you_have_x_scores_7'] = 'Vous avez %d score(s) à 7pts.';
$lang['you_have_x_scores_6'] = 'Vous avez %d score(s) à 6pts.';
$lang['you_have_x_scores_4'] = 'Vous avez %d score(s) à 4pts.';
$lang['you_have_x_scores_3'] = 'Vous avez %d score(s) à 3pts.';
$lang['you_have_x_scores_0'] = 'Vous avez %d score(s) à 0pts.';
$lang['points_short'] = 'pts';