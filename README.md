# TASKAPP

RESTful API to manage tasks. The API is built in Vanila PHP with a local database in MySQL.  
`taskapp.sql` can be found on `./config` ready to be imported and so the API can run with no problems.

## Endpoints

| functionality | Method | Route | Params |
| ------------- | :----: | :---: | :----: |
| List all tasks | GET | `/api/read.php` | - |
| Read one task by id | GET | `/api/read_single.php` | id: int |
| List tasks by priority | GET | `/api/read_by_priority.php` | p: int \| array |
| Create a new task | POST | `/api/create.php` | - |
| Update an existing task | PUT | `/api/update.php` | - |
| Delete tasks by id | DELETE | `/api/delete.php` | - |

## Missing

- id to update in query instead of body
- Update only needed values
