# ⚡ Mitsuki Commands

**Mitsuki Commands** is the dedicated CLI (Command Line Interface) engine for the Mitsuki Framework. Built on top of Symfony components, it provides an elegant and robust interface to manage your development tasks, featuring a built-in development server.

---

## 🚀 Key Features

* **Stylized Console**: Custom ASCII branding for a premium developer experience.
* **Built-in Dev Server**: Easily launch your Mitsuki application with routing support via a single command.
* **Extensible Architecture**: Seamlessly register custom commands to automate your workflow.
* **Process Management**: Uses `proc_open` for stable and controllable server execution.

---

## 🛠 Installation

Install the package via Composer:

```bash
composer require mitsuki/commands

```

---

## 📖 Usage

### 1. Create the Entry Point

Create a file named `mitsuki` (no extension) in your project root:

```php
#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Mitsuki\Command\ServerCommand;
use Mitsuki\Console\ConsoleApplication;

// Register your commands here
$app = new ConsoleApplication([
    new ServerCommand(),
]);

$app->run();

```

Make the file executable:

```bash
chmod +x mitsuki

```

### 2. Running the Server

To start the Mitsuki development server on the default port (8000):

```bash
./mitsuki run:serve

```

**Available Options:**

* `--host` or `-H`: Change the host (Default: `127.0.0.1`)
* `--port` or `-p`: Change the port (Default: `8000`)

Example:

```bash
./mitsuki run:serve --port=9000 --host=0.0.0.0

```

---

## 🏗 Adding Custom Commands

To create a new command, extend the `Symfony\Component\Console\Command\Command` class and register it in your `ConsoleApplication` instance.

```php
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:my-task', description: 'Does something awesome')]
class MyTaskCommand extends Command 
{
    // Your logic here...
}

```

---

## 🛡 Security

This component is part of the **Mitsuki Framework | Security Edition**. It is designed to handle system processes cleanly and provides clear feedback while maintaining a secure environment for local development.

---

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](https://www.google.com/search?q=LICENSE) file for details.

---

**Developed with ❤️ by [Zgeniuscoders**](mailto:zgeniuscoders@gmail.com)

> **Need help?** Feel free to open an Issue or submit a Pull Request!

---