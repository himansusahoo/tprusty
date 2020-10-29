ALTER TABLE `rbac_actions` ADD `module_id` BIGINT NOT NULL AFTER `code`;
create or replace view `rbac_actions_list_vw` as
select
    `a`.`action_id` as `action_id`,
    `a`.`name` as `name`,
    `a`.`code` as `code`,
    `a`.`status` as `status`,
    `a`.`created` as `created`,
    `a`.`modified` as `modified`,
    `m`.`name` as `module_name`,
    `m`.`module_id` as `module_id`
from
    (`rbac_actions` `a`
left join `rbac_modules` `m` on
    ((`a`.`module_id` = `m`.`module_id`)));

create or replace view `module_actions_vw` as
select
    `m`.`module_id` as `module_id`,
    `m`.`name` as `module_name`,
    `m`.`code` as `module_code`,
    `m`.`status` as `module_status`,
    `m`.`created` as `module_created`,
    `m`.`modified` as `module_modified`,
    `a`.`action_id` as `action_id`,
    `a`.`name` as `action_name`,
    `a`.`code` as `action_code`,
    `a`.`status` as `action_status`,
    `a`.`created` as `action_created`,
    `a`.`modified` as `action_modified`
from
    (`rbac_modules` `m`
join `rbac_actions` `a`)
where
    (`a`.`module_id` = 0)
union all
select
    `m`.`module_id` as `module_id`,
    `m`.`name` as `module_name`,
    `m`.`code` as `module_code`,
    `m`.`status` as `module_status`,
    `m`.`created` as `module_created`,
    `m`.`modified` as `module_modified`,
    `a`.`action_id` as `action_id`,
    `a`.`name` as `action_name`,
    `a`.`code` as `action_code`,
    `a`.`status` as `action_status`,
    `a`.`created` as `action_created`,
    `a`.`modified` as `action_modified`
from
    (`rbac_modules` `m`
left join `rbac_actions` `a` on
    ((`a`.`module_id` = `m`.`module_id`)))
where
    (`a`.`module_id` > 0);
