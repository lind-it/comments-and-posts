--1
SELECT * FROM users WHERE 1;
--2
SELECT * FROM users WHERE deleted = 1;
--3
SELECT * FROM users ORDER BY name ASC; 
--4
SELECT users.citi_id, cities.id, COUNT(users.name)
FROM users JOIN cities
ON users.citi_id = cities.id
GROUP By cities.id;
--5
SELECT users.name ||" "|| users.secondName AS name, users.citi_id, cities.id, COUNT(users.name)
FROM users JOIN cities
ON users.citi_id = cities.id
WHERE deleted = 0
GROUP BY cities.id
ORDER BY name;
--6
SELECT users.name ||" "|| users.secondName AS name
FROM users JOIN cities
ON users.citi_id = cities.id
WHERE cities.name IN("Moscow");