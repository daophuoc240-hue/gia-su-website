@echo off
title He Thong Ket Noi & Quan Ly Gia Su - Gia Su Tri Thuc
color 0A
echo ===================================================
echo   DANG KHOI DONG WEBSITE GIA SU TRI THUC
echo ===================================================
echo.
echo Website dang chay tai dia chi: http://localhost:8000
echo Trang Dang Nhap: http://localhost:8000/login
echo.
echo (De giu website hoat dong, vui long KHONG tat cua so nay)
echo ===================================================
echo.

cd /d "%~dp0"
set "PHP_CMD=C:\laragon\bin\php\php-8.3.36-Win32-vs16-x64\php.exe"
if not exist "%PHP_CMD%" (
    set "PHP_CMD=php"
)

"%PHP_CMD%" artisan serve --host=127.0.0.1 --port=8000

pause
