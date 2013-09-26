DELETE FROM `user_tree_observations_sane` WHERE `deleted`=1; -- 75 rows
DELETE FROM  `user_tree_observations_sane` WHERE  `is_leaf_fresh` +  `is_flower_bud` +  `is_fruit_ripe` +  `is_fruit_unripe` +  `is_flower_open` >5; -- 90 rows
DELETE FROM  `user_tree_observations_sane` WHERE  `date` > NOW( ); -- 94 rows
DELETE n1 FROM `user_tree_observations_sane` n1, `user_tree_observations_sane` n2 WHERE n1.observation_id > n2.observation_id AND n1.date = n2.date and n1.user_tree_id = n2.user_tree_id; -- remove duplicates, keep only the last one. 7172 rows
update user_tree_observations set freshleaf_count = 0 where freshleaf_count = "Few";# 203 rows affected.

update user_tree_observations set freshleaf_count = 1 where freshleaf_count = "Many";# 152 rows affected.

update user_tree_observations set freshleaf_count = 2 where freshleaf_count = "Full";# 31 rows affected.

update user_tree_observations set matureleaf_count = 0 where matureleaf_count = "Few";# 135 rows affected.

update user_tree_observations set matureleaf_count = 1 where matureleaf_count = "Many";# 230 rows affected.

update user_tree_observations set matureleaf_count = 2 where matureleaf_count = "Full";# 55 rows affected.

update user_tree_observations set bud_count = 0 where bud_count = "Few";# 144 rows affected.

update user_tree_observations set bud_count = 1 where bud_count = "Many";# 30 rows affected.

update user_tree_observations set bud_count = 2 where bud_count = "Full";# 3 rows affected.

update user_tree_observations set fruit_ripe_count = 0 where fruit_ripe_count = "Few";# 55 rows affected.

update user_tree_observations set fruit_ripe_count = 1 where fruit_ripe_count = "Many";# 45 rows affected.

update user_tree_observations set fruit_ripe_count = 2 where fruit_ripe_count = "Full";# 1 row affected.

update user_tree_observations set fruit_unripe_count = 0 where fruit_unripe_count = "Few";# 87 rows affected.

update user_tree_observations set fruit_unripe_count = 1 where fruit_unripe_count = "Many";# 33 rows affected.

update user_tree_observations set fruit_unripe_count = 2 where fruit_unripe_count = "Full";# 3 rows affected.

update user_tree_observations set open_flower_count = 0 where open_flower_count = "Few";# 119 rows affected.

update user_tree_observations set open_flower_count = 1 where open_flower_count = "Many";# 45 rows affected.

update user_tree_observations set open_flower_count = 2 where open_flower_count = "Full";# 4 rows affected.

