
/**
    1. Write a query to display the ff columns ID (should start
        with T + 11 digits of trn_teacher.id with leading zeros like
        'T00000088424'), Nickname, Status and Roles (like
        Trainer/Assessor/Staff) using table trn_teacher and
        trn_teacher_role.
 */
SELECT
    CONCAT('T', LPAD(trn_teacher.id, 11, 0)) AS `ID`,
    `nickname` As `Nickname`,
    (CASE
         WHEN `status` = 1 THEN 'Discontinued'
         WHEN `status` = 2 THEN 'Active'
         ELSE 'Deactivated'
        END) AS `Status`,
    GROUP_CONCAT(
            CASE
                WHEN `role` = 1 THEN 'Trainer'
                WHEN `role` = 2 THEN 'Assesor'
                ELSE 'Staff'
                END
                SEPARATOR '/') AS `Roles`
FROM `trn_teacher`
         INNER JOIN `trn_teacher_role` ON `trn_teacher`.`id` = `trn_teacher_role`.`teacher_id`
GROUP BY `ID`, `Nickname`, `Status`


/**
    2. Write a query to display the ff columns ID (from teacher.id),
        Nickname, Open (total open slots from trn_teacher_time_table),
        Reserved (total reserved slots from trn_teacher_time_table),
        Taught (total taught from trn_evaluation) and NoShow (total
        no_show from trn_evaluation) using all tables above. Should
        show only those who are active (trn_teacher.status = 1 or 2)
        and those who have both Trainer and Assessor role.
 */
SELECT
    `trn_teacher`.`id` AS `ID`,
    `nickname` As `Nickname`,
    `Open`,
    `Reserved`,
    `Taught`,
    `No Show`
FROM trn_teacher
         INNER JOIN
     (
         SELECT
             `teacher_id`,
             SUM(IF(`status` = 1, 1, 0)) AS `Open`,
             SUM(IF(`status` = 3, 1, 0)) AS `Reserved`
         FROM `trn_time_table`
         GROUP BY `teacher_id`
     ) AS `trn_time_table`
     ON `trn_teacher`.`id` = `trn_time_table`.`teacher_id`
         INNER JOIN
     (
         SELECT
             `teacher_id`,
             SUM(IF(`result` = 1, 1, 0)) AS `Taught`,
             SUM(IF(`result` = 2, 1, 0)) AS `No Show`
         FROM `trn_evaluation`
         GROUP BY `teacher_id`
     ) AS `trn_evaluation`
     ON `trn_evaluation`.`teacher_id` = `trn_teacher`.`id`
WHERE (`trn_teacher`.`status` = 1 OR `trn_teacher`.`status` = 2)
  AND EXISTS (SELECT * FROM trn_teacher_role WHERE `trn_teacher_role`.`teacher_id` = `trn_teacher`.`id` and `role` = 1)
  AND EXISTS (SELECT * FROM trn_teacher_role WHERE `trn_teacher_role`.`teacher_id` = `trn_teacher`.`id` and `role` = 2)
















