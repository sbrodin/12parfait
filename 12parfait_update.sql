DROP TABLE user_bet;
ALTER TABLE `bet` ADD `user_id` INT(11) UNSIGNED NOT NULL AFTER `bet_id`;