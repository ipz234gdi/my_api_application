# Symfony REST API

## 📌 Встановлення
   Зайдіть в **PowerShell** як **адміністратор**

1. Встановіть choco:
 
```bash
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))

```

2. Встановіть PHP, Symfony CLI, Composer, Postman:

```bash 
choco install php --version=8.1.27
choco install symfony-cli -y 
choco install composer -y 
choco install postman -y 
```

3. Клонуйте проєкт:
```bash 
git clone https://github.com/ipz234gdi/my_api_application.git
```
- зайдіть в папку:
```bash 
cd my_api_application
```

4. Встановіть залежності:
```bash 
composer install
```

5. Згенерувати ключі:
```bash
php bin/console lexik:jwt:generate-keypair
```

6. Запустіть сервер:
```bash 
symfony serve
```

7. API доступне за посиланням
```bash
http://127.0.0.1:8000/api/v1/users
```
## 📜 Документація
👉 **[Postman UI](https://documenter.getpostman.com/view/41722534/2sAYX3qiNL)**
