// Basketball
SELECT distinct email 
FROM `Person` p
inner join Person_Activity a on a.person_id = p.person_id
WHERE p.email is not null
and p.email != ''
and a.activity_id = 1


// Volleyball
SELECT distinct email 
FROM `Person` p
inner join Person_Activity a on a.person_id = p.person_id
WHERE p.email is not null
and p.email != ''
and a.activity_id = 2


// Basketball not on a team
SELECT distinct email 
FROM `Person` p
inner join Person_Activity a on a.person_id = p.person_id
left outer join Team_Member t on p.person_id = t.person_id
WHERE p.email is not null
and p.email != ''
and a.activity_id = 1
and t.person_id is null


// Volleyball not on a team
SELECT distinct email 
FROM `Person` p
inner join Person_Activity a on a.person_id = p.person_id
left outer join Team_Member t on p.person_id = t.person_id
WHERE p.email is not null
and p.email != ''
and a.activity_id = 2
and t.person_id is null