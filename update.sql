ALTER TABLE `user` ADD `date_hash` DATETIME NULL AFTER `hash`;
ALTER TABLE `championship` ADD UNIQUE( `sport`, `country`, `level`, `year`);