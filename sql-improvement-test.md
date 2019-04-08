Given a SQL query that produce a search result. The query produces results in approximately 8 second.

Please suggest what improvements should be done to the query in order to improve its performance.

Suggestions:

* Index all columns used in `where`, `order by`, and `group by` clauses

* Use `explain` to analyze and optimize MySQL queries

* Use subqueries
```
SELECT * FROM
(
  SELECT * FROM jobs WHERE publish_status = 1 AND deleted IS NULL
) Jobs
LEFT JOIN ...
```
