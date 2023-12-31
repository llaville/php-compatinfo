<!-- markdownlint-disable MD013 -->
# Console CLI

> **WARNING** Depending on your PHP version, with 8.0 you won't have usage of the most up-to-date Database version of `CompatInfoDB`
>
> With PHP 8.1 or greater `CompatInfoDB` 6.1+ is supported,
> adding the `db:new` command that combine `db:create` and `db:init` actions.

```text
phpCompatInfo version 7.1.0 DB version 5.14.1

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --profile         Display timing and memory usage information
      --progress        Show progress bar
      --output=OUTPUT   Affect output to produce results in different format [default: ["console"]] (multiple values allowed)
      --debug           Display debugging information
  -c, --config=CONFIG   Read configuration from PHP file
      --php=PHP         PHP feature version (format Major.Minor)
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  about         Shows short information about this package
  completion    Dump the shell completion script
  diagnose      Diagnoses the system to identify common errors
  help          Display help for a command
  list          List commands
 analyser
  analyser:run  Analyse a data source to find out requirements
 db
  db:create     Create the database schema and load its contents from JSON files
  db:init       Load JSON file(s) into database
  db:list       List all references supported in the Database
  db:show       Show details of a reference supported in the Database
 rule
  rule:list     Display list of Compatibility Analyser rules supported
```
