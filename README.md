# Druid Ingestion Task Automation

## Druid Task CURL
  - curl -X 'POST' -H 'Content-Type:application/json' -d @<path/to/task.json> http://<druid-user>:<password>@<druid-host-ip>:<druid-overload-port>/druid/indexer/v1/task

## To Do
  1. Run `composer install`
  2. Run `cp .env.example .env`
  3. Write the required environment variable's value in `.env`
  4. Keep your task in a json file inside `tasks` directory
  5. Run `php index.php`
  6. Give your task file name with extension as console input
  7. Log will be found in `task_responses/logs` file