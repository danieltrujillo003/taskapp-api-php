# TASKAPP

RESTful API to manage tasks. The API is built in Vanila PHP with a local database in MySQL.

## Endpoints

| functionality | Method | Route | Params |
| ------------- | :----: | :---: | :----: |
| List all tasks | GET | `/taskapp/api/read.php` | - |
| Read one task by id | GET | `/taskapp/api/read_single.php` | id: int |
| List tasks by priority | GET | `/taskapp/api/read_by_priority.php` | p: int \| array |
| Create a new task | POST | `taskapp/api/create.php` | - |
| Update an existing task | PUT | `taskapp/api/update.php` | - |
| Delete tasks by id | DELETE | `taskapp/api/delete.php` | - |

## Missing

- id to update in query instead of body
- Update only needed values