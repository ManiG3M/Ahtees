SELECT customer_master.*, 
	movie_industry_master.description, 
	talent_master.description as talent_description 
FROM customer_master, 
movie_industry_master, 
talent_master 
WHERE 
	customer_master.status = 1 AND 
	(customer_master.first_name LIKE '%Sai%' OR customer_master.last_name LIKE '%Sai%' OR customer_master.star_name LIKE '%Sai%') 
	AND customer_master.primary_industry_id = movie_industry_master.id 
	AND customer_master.primary_skill_id = talent_master.id 
order by customer_master.star_name
