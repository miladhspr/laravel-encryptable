# Laravel Encryptable Package

## Overview

`laravel-encryptable` is a package that provides automatic encryption and decryption of model attributes in Laravel applications. This ensures that sensitive data is stored in an encrypted format in the database and is automatically decrypted when accessed within your application.

## Features

- **Automatic Encryption and Decryption**: Automatically encrypts and decrypts specified attributes when interacting with your models.
- **Customizable**: You can define which attributes should be encrypted using the `$encryptable` property on the model.
- **Transparent for Queries**: Queries like `where`, `whereHas`, `orWhere`, etc., work seamlessly with encrypted attributes.
- **Secure**: Data is encrypted using the key defined in your `.env` file, ensuring that only your application can access it.

## Installation

### 1. Install the Package

Run the following command to install the package via Composer:

```bash
composer require miladhspr/laravel-encryptable
```

### 2. Publish the Configuration (Optional)

You can publish the package's config file with the following command:

```bash
php artisan vendor:publish --provider="Miladhspr\LaravelEncryptable\EncryptableServiceProvider"
```

### 3. Enable/Disable Encryption
Set ```ENCRYPTION_ENABLED=true``` or ```ENCRYPTION_ENABLED=false``` in your .env file to enable or disable encryption globally.

### 4. Define Encrypted Attributes in Your Model

Use the Encryptable trait in your model and specify the $encryptable attribute for fields to be encrypted:
```bash
namespace App\Models;
use Miladhspr\LaravelEncryptable\Traits\Encryptable;

class User extends Model
{
    use Encryptable;

    protected $encryptable = ['email', 'phone_number'];
}
```

## Usage

### Inserting/Updating Data

When inserting or updating records, specified attributes in $encryptable are automatically encrypted:

```
User::create([
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'phone_number' => '1234567890',
]);
```
