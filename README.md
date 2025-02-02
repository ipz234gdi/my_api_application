# Symfony REST API

## 📌 Встановлення
   Зайдіть в **PowerShell** як **адміністратор**

1. Встановіть choco:
 
```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))

```

2. Встановіть PHP, Symfony CLI, Composer, Postman:

```powershell 
choco install php --version=8.1.27
```
```powershell 
choco install symfony-cli -y
```
```powershell 
choco install composer -y
```
```powershell 
choco install postman -y
```
```powershell 
choco install openssl -y 
```

3. Клонуйте проєкт:
```git
git clone https://github.com/ipz234gdi/my_api_application.git
```
- зайдіть в папку:
```powershell 
cd my_api_application
```

4. Встановіть залежності:
```powershell 
composer install
```
```powershell 
composer require "lexik/jwt-authentication-bundle"
```

5. Згенерувати ключі:
```powershell
php bin/console lexik:jwt:generate-keypair
```

6. Запустіть сервер:
```powershell 
symfony serve
```

7. API доступне за посиланням
```git
http://127.0.0.1:8000/api/v1/users
```
## 📜 Документація
👉 **[Postman UI](https://documenter.getpostman.com/view/41722534/2sAYX3qiNL)**
