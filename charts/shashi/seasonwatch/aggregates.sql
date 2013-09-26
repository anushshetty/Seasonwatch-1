-- is_leaf_mature is_leaf_fresh is_flower_bud is_fruit_ripe is_fruit_unripe is_flower_open

SELECT YEAR( DATE ) , MONTH( DATE ) , COUNT( * ) , AVG( {X} ) , STDDEV_SAMP( {X} ) 
FROM `user_tree_observations_sane` 
WHERE YEAR( DATE ) > 2007 AND {X} is not null;
GROUP BY YEAR( DATE ) , MONTH( DATE ) 
ORDER BY YEAR( DATE ) , MONTH( DATE )

-- 
