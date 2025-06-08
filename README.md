# Laravel Repository Generator

A Laravel package to generate repositories and interfaces with automatic binding in your `AppServiceProvider`.

## Features

- Quickly generate repository and interface files
- Automatically register bindings in `AppServiceProvider`
- Clean, consistent structure for your repositories


## Installation

### 1. Install via Composer

```bash
composer require ravisaini/laravel-repository-generator 
```

## Usage

### Generate a Repository

Run the following Artisan command:

```bash
php artisan make:repository User
```

This will:

- Create `app/Repositories/User.php`
- Create `app/Repositories/Interfaces/UserInterface.php`
- Auto-register the binding in `app/Providers/AppServiceProvider.php`

### Output Example

```
🎉 Repository and Interface created successfully!
📂 Interface: app/Repositories/Interfaces/UserInterface.php
📂 Repository: app/Repositories/User.php
🔗 Auto-registered in: app/Providers/AppServiceProvider.php
```

## Requirements

- PHP ^8.1
- Laravel 10, 11, or 12

## License

MIT

---

**Author:** Ravi Saini  
[GitHub](https://github.com/ravi372037)
